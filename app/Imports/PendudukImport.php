<?php

namespace App\Imports;

use App\Models\Penduduk;
use App\Models\Agama;
use App\Models\JenisKelamin;
use App\Models\Pekerjaan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\Importable;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class PendudukImport implements ToModel, WithHeadingRow, WithStartRow
{
    use Importable;

    private $importedCount = 0;
    private $updatedCount = 0;
    private $errors = [];
    private $rowNumber = 0;

    /**
     * Skip the first few rows to reach the header
     */
    public function startRow(): int
    {
        return 3; // Start from row 3 karena baris 1-2 biasanya berisi judul atau keterangan
    }
    
    /**
     * Konfigurasikan heading row
     */
    public function headingRow(): int
    {
        return 3; // Header ada di baris 3
    }
    
    /**
     * Normalisasi nama header
     */
    public function map($row): array
    {
        $result = [];
        foreach ($row as $key => $value) {
            // Normalisasi key: Lowercase, ganti spasi dengan underscore
            $newKey = strtolower(preg_replace('/\s+/', '_', trim($key)));
            $result[$newKey] = $value;
        }
        return $result;
    }
    
    /**
     * Validasi NIK berdasarkan panjang dan format
     * 
     * @param string $nik
     * @return bool
     */
    private function isValidNIK($nik)
    {
        // NIK harus 16 digit numerik
        return !empty($nik) && strlen($nik) == 16 && is_numeric($nik);
    }

    public function model(array $row)
    {
        $this->rowNumber++;
        
        try {
            // Debug awal - cek struktur data yang diterima
            Log::debug('Import row ' . $this->rowNumber . ': ' . json_encode(array_keys($row)));
            
            // Skip baris kosong atau header
            if (empty($row) || count(array_filter($row)) < 2) {
                Log::debug('Skipping empty row: ' . $this->rowNumber);
                return null;
            }
            
            // Periksa kolom kunci
            $nikKey = $this->findColumn($row, ['nik']);
            $namaKey = $this->findColumn($row, ['nama']);
            
            if (!$nikKey) {
                Log::warning('Kolom NIK tidak ditemukan pada baris: ' . $this->rowNumber);
                $this->errors[] = 'Kolom NIK tidak ditemukan pada baris: ' . $this->rowNumber;
                return null;
            }
            
            // Validate and clean NIK (harus 16 digit)
            $nik = trim($row[$nikKey] ?? '');
            $nama = trim($row[$namaKey] ?? 'Tidak ada nama');
            
            // Skip if NIK is empty or invalid
            if (empty($nik)) {
                // Skip jika sepertinya ini header atau baris judul
                if (strtolower($nama) === 'nama' || strtolower($nama) === 'nik' || 
                    strtolower($nik) === 'nik' || preg_match('/^no\.?\s*$/i', $nik)) {
                    Log::debug('Skipping header row: ' . $this->rowNumber);
                    return null;
                }
                
                $this->errors[] = 'NIK kosong pada baris ' . $this->rowNumber . ' dengan nama: ' . $nama;
                return null;
            }
            
            // Kita beri kelonggaran untuk NIK karena kadang Excel mengubah format
            if (!is_numeric($nik) || (strlen($nik) != 16 && strlen($nik) != 17)) {
                // Skip jika sepertinya ini header (terdeteksi dari isi kolom)
                if (strtolower($nik) === 'nik' || 
                    strtolower($nama) === 'nama' || 
                    preg_match('/(no\.?|nomor)/i', $nik)) {
                    Log::debug('Skipping header row (detected from content): ' . $this->rowNumber);
                    return null;
                }
                
                if (is_numeric($nik)) {
                    // Jika numeric tapi tidak 16 digit, coba koreksi
                    $nik = str_pad($nik, 16, '0', STR_PAD_LEFT);
                    Log::info('NIK dikoreksi menjadi: ' . $nik);
                } else {
                    $this->errors[] = 'Format NIK tidak valid pada baris ' . $this->rowNumber . ': ' . $nik . ' (harus berupa angka)';
                    return null;
                }
            }
            
            // Cari kolom untuk tanggal lahir
            $tanggalLahirKey = $this->findColumn($row, ['tanggal_lahir', 'tanggal lahir', 'ttl']);
            $tanggalLahir = null;
            
            if ($tanggalLahirKey) {
                $tanggalLahir = $this->parseTanggalLahir($row[$tanggalLahirKey]);
            }
            
            if (empty($tanggalLahir)) {
                Log::warning('Tanggal lahir kosong atau tidak valid pada baris ' . $this->rowNumber . ' untuk NIK: ' . $nik);
                // Tetap lanjutkan meskipun tanggal lahir kosong
            }
            
            // Cari dan normalisasi kolom lain
            $jenisKelaminKey = $this->findColumn($row, ['jenis_kelamin', 'jenis kelamin']);
            $agamaKey = $this->findColumn($row, ['agama']);
            $pekerjaanKey = $this->findColumn($row, ['pekerjaan']);
            $alamatKey = $this->findColumn($row, ['alamat']);
            $statusKey = $this->findColumn($row, ['status_dlm_keluarga', 'status dlm keluarga', 'status']);
            $tempatLahirKey = $this->findColumn($row, ['tempat_lahir', 'tempat lahir']);
            $kkKey = $this->findColumn($row, ['no_kk', 'no. kk', 'kk', 'nomor kk', 'nomor kartu keluarga']);
            
            // Get string values directly dengan normalisasi
            $jenisKelamin = $jenisKelaminKey ? $this->normalizeJenisKelamin($row[$jenisKelaminKey]) : null;
            $agama = $agamaKey ? $this->normalizeAgama($row[$agamaKey]) : null;
            $pekerjaan = $pekerjaanKey ? $this->normalizePekerjaan($row[$pekerjaanKey]) : null;
            
            // Cari data ID jenis kelamin, agama, dan pekerjaan dari string
            $jenisKelaminId = null;
            $agamaId = null;
            $pekerjaanId = null;
            
            // Lookup reference IDs if string values exist
            if ($jenisKelamin) {
                $jenisKelaminRecord = \App\Models\JenisKelamin::where('jenis_kelamin', $jenisKelamin)->first();
                if ($jenisKelaminRecord) {
                    $jenisKelaminId = $jenisKelaminRecord->id;
                    Log::debug("Found jenis_kelamin_id: $jenisKelaminId for $jenisKelamin");
                } else {
                    // Create record if it doesn't exist
                    try {
                        $jenisKelaminRecord = \App\Models\JenisKelamin::create([
                            'jenis_kelamin' => $jenisKelamin,
                            'jumlah' => 0, // Default value
                            'user_id' => 1  // Default admin user ID
                        ]);
                        $jenisKelaminId = $jenisKelaminRecord->id;
                        Log::debug("Created new jenis_kelamin_id: $jenisKelaminId for $jenisKelamin");
                    } catch (\Exception $e) {
                        Log::warning("Failed to create jenis_kelamin: " . $e->getMessage());
                    }
                }
            }
            
            if ($agama) {
                $agamaRecord = \App\Models\Agama::where('agama', $agama)->first();
                if ($agamaRecord) {
                    $agamaId = $agamaRecord->id;
                    Log::debug("Found agama_id: $agamaId for $agama");
                } else {
                    // Create record if it doesn't exist
                    try {
                        $agamaRecord = \App\Models\Agama::create([
                            'agama' => $agama,
                            'penganut' => 0, // Default value
                            'user_id' => 1   // Default admin user ID
                        ]);
                        $agamaId = $agamaRecord->id;
                        Log::debug("Created new agama_id: $agamaId for $agama");
                    } catch (\Exception $e) {
                        Log::warning("Failed to create agama: " . $e->getMessage());
                    }
                }
            }
            
            if ($pekerjaan) {
                $pekerjaanRecord = \App\Models\Pekerjaan::where('pekerjaan', $pekerjaan)->first();
                if ($pekerjaanRecord) {
                    $pekerjaanId = $pekerjaanRecord->id;
                    Log::debug("Found pekerjaan_id: $pekerjaanId for $pekerjaan");
                } else {
                    // Create record if it doesn't exist
                    try {
                        $pekerjaanRecord = \App\Models\Pekerjaan::create([
                            'pekerjaan' => $pekerjaan,
                            'jumlah' => 0, // Default value
                            'user_id' => 1  // Default admin user ID
                        ]);
                        $pekerjaanId = $pekerjaanRecord->id;
                        Log::debug("Created new pekerjaan_id: $pekerjaanId for $pekerjaan");
                    } catch (\Exception $e) {
                        Log::warning("Failed to create pekerjaan: " . $e->getMessage());
                    }
                }
            }
            
            // Kita bisa mencari ID dari tabel referensi jika diperlukan
            // Untuk saat ini kita biarkan null karena kolom sudah nullable
            
            // Data untuk dimasukkan ke database
            $data = [
                'nik' => $nik,
                'nama' => $nama,
                'kk' => $kkKey ? trim($row[$kkKey]) : null,
                'ttl' => $tanggalLahir,
                'tempat_lahir' => $tempatLahirKey ? trim($row[$tempatLahirKey]) : null,
                'jenis_kelamin' => $jenisKelamin,
                'jenis_kelamin_id' => $jenisKelaminId, // Set null, sudah diijinkan oleh migrasi
                'alamat' => $alamatKey ? trim($row[$alamatKey]) : null,
                'agama' => $agama,
                'agama_id' => $agamaId, // Set null, sudah diijinkan oleh migrasi
                'pekerjaan' => $pekerjaan,
                'pekerjaan_id' => $pekerjaanId, // Set null, sudah diijinkan oleh migrasi
                'status_dlm_keluarga' => $statusKey ? trim($row[$statusKey]) : null,
                'kewarganegaraan' => 'WNI', // Default value
                'status_perkawinan' => null, // Can be added if needed
            ];

            // Check if penduduk already exists
            $existingPenduduk = Penduduk::where('nik', $data['nik'])->first();
            
            if ($existingPenduduk) {
                $existingPenduduk->update($data);
                $this->updatedCount++;
                return null;
            } else {
                $this->importedCount++;
                return new Penduduk($data);
            }

        } catch (\Exception $e) {
            Log::error('Import error for row: ' . json_encode($row) . '. Error: ' . $e->getMessage());
            $this->errors[] = 'Error importing row with NIK ' . ($row['nik'] ?? 'unknown') . ': ' . $e->getMessage();
            return null;
        }
    }

    public function getImportedCount()
    {
        return $this->importedCount;
    }

    public function getUpdatedCount()
    {
        return $this->updatedCount;
    }

    public function getErrors()
    {
        return $this->errors;
    }
    
    /**
     * Get total rows processed
     * 
     * @return int
     */
    public function getTotalRows()
    {
        return $this->rowNumber;
    }
    
    /**
     * Get debug summary
     * 
     * @return string
     */
    public function getDebugSummary()
    {
        return "Total baris: {$this->rowNumber}, Import: {$this->importedCount}, Update: {$this->updatedCount}, Error: " . count($this->errors);
    }

    /**
     * Parse tanggal lahir from string to date format
     */
    /**
     * Parse tanggal lahir dari berbagai format yang mungkin ada di Excel
     * 
     * @param mixed $tanggalString
     * @return string|null
     */
    private function parseTanggalLahir($tanggalString)
    {
        if (empty($tanggalString)) {
            Log::debug('Tanggal lahir kosong');
            return null;
        }

        try {
            // Jika tanggal sudah berupa objek DateTime atau Carbon
            if ($tanggalString instanceof \DateTime || $tanggalString instanceof Carbon) {
                Log::debug('Tanggal berupa objek DateTime');
                return Carbon::instance($tanggalString)->format('Y-m-d');
            }
            
            // Format Excel serial date (angka) - biasanya berupa float
            if (is_numeric($tanggalString)) {
                // Excel dates start from 1900-01-01 (day 1)
                $excelBaseDate = Carbon::createFromDate(1899, 12, 30);
                $days = (int)$tanggalString;
                
                Log::debug("Format Excel numeric date: $tanggalString (days since 1899-12-30)");
                return $excelBaseDate->addDays($days)->format('Y-m-d');
            }
            
            // Jika berupa string, coba parsing
            if (is_string($tanggalString)) {
                // Bersihkan string dari karakter aneh
                $tanggalString = trim($tanggalString);
                
                // Jika kosong setelah trim
                if (empty($tanggalString) || $tanggalString === '-') {
                    return null;
                }
                
                // Format sesuai template: "19 - Jul - 1986" atau "19-Jul-1986" atau "19/Jul/1986"
                if (preg_match('/(\d{1,2})\s*[\-\/\.]\s*([A-Za-z]{3,})\s*[\-\/\.]\s*(\d{4})/', $tanggalString, $matches)) {
                    $day = str_pad($matches[1], 2, '0', STR_PAD_LEFT);
                    $month = $this->convertMonthToNumber($matches[2]);
                    $year = $matches[3];
                    
                    if ($month) {
                        Log::debug("Format tanggal DD-MMM-YYYY: $day-$month-$year");
                        return Carbon::createFromFormat('Y-m-d', "$year-$month-$day")->format('Y-m-d');
                    }
                }
                
                // Format: DD/MM/YYYY atau DD-MM-YYYY atau DD.MM.YYYY
                if (preg_match('/^(\d{1,2})[\/\-\.](\d{1,2})[\/\-\.](\d{2,4})$/', $tanggalString, $matches)) {
                    $day = str_pad($matches[1], 2, '0', STR_PAD_LEFT);
                    $month = str_pad($matches[2], 2, '0', STR_PAD_LEFT);
                    $year = $matches[3];
                    
                    // Handle 2-digit years
                    if (strlen($year) == 2) {
                        // Assume 21st century for years < 30, 20th century otherwise
                        $year = (int)$year < 30 ? '20' . $year : '19' . $year;
                    }
                    
                    // Validate month and day
                    if ((int)$month > 12 || (int)$day > 31) {
                        Log::debug("Invalid date components: day=$day, month=$month, year=$year");
                        
                        // Try swapping month and day if that makes a valid date
                        if ((int)$day <= 12 && (int)$month <= 31) {
                            $temp = $day;
                            $day = $month;
                            $month = $temp;
                            Log::debug("Swapped day and month: day=$day, month=$month");
                        } else {
                            return null;
                        }
                    }
                    
                    Log::debug("Format tanggal DD/MM/YYYY: $day-$month-$year");
                    return Carbon::createFromFormat('Y-m-d', "$year-$month-$day")->format('Y-m-d');
                }
                
                // Format: YYYY/MM/DD atau YYYY-MM-DD (ISO)
                if (preg_match('/^(\d{4})[\/\-\.](\d{1,2})[\/\-\.](\d{1,2})$/', $tanggalString, $matches)) {
                    $year = $matches[1];
                    $month = str_pad($matches[2], 2, '0', STR_PAD_LEFT);
                    $day = str_pad($matches[3], 2, '0', STR_PAD_LEFT);
                    
                    Log::debug("Format tanggal YYYY-MM-DD: $year-$month-$day");
                    return Carbon::createFromFormat('Y-m-d', "$year-$month-$day")->format('Y-m-d');
                }
                
                // Format: DD-MMM-YY atau DD MMM YY (dengan nama bulan)
                if (preg_match('/^(\d{1,2})\s*[\-\/\.\s]\s*([A-Za-z]{3,})\s*[\-\/\.\s]\s*(\d{2})$/', $tanggalString, $matches)) {
                    $day = str_pad($matches[1], 2, '0', STR_PAD_LEFT);
                    $month = $this->convertMonthToNumber($matches[2]);
                    $year = $matches[3];
                    
                    // Handle 2-digit years
                    $year = (int)$year < 30 ? '20' . $year : '19' . $year;
                    
                    if ($month) {
                        Log::debug("Format tanggal DD-MMM-YY: $day-$month-$year");
                        return Carbon::createFromFormat('Y-m-d', "$year-$month-$day")->format('Y-m-d');
                    }
                }
                
                // Format: text format (31 Desember 2020)
                if (preg_match('/^(\d{1,2})\s+([A-Za-z]+)\s+(\d{4})$/', $tanggalString, $matches)) {
                    $day = str_pad($matches[1], 2, '0', STR_PAD_LEFT);
                    $monthName = $matches[2];
                    $year = $matches[3];
                    
                    // Extended month mapping for Bahasa Indonesia
                    $extendedMonthMap = [
                        'januari' => '01', 'january' => '01',
                        'februari' => '02', 'pebruari' => '02', 'february' => '02',
                        'maret' => '03', 'march' => '03',
                        'april' => '04',
                        'mei' => '05', 'may' => '05',
                        'juni' => '06', 'june' => '06',
                        'juli' => '07', 'july' => '07',
                        'agustus' => '08', 'augustus' => '08', 'august' => '08',
                        'september' => '09',
                        'oktober' => '10', 'october' => '10',
                        'nopember' => '11', 'november' => '11',
                        'desember' => '12', 'december' => '12'
                    ];
                    
                    $month = $extendedMonthMap[strtolower($monthName)] ?? null;
                    
                    if ($month) {
                        Log::debug("Format tanggal text Indonesia: $day-$month-$year");
                        return Carbon::createFromFormat('Y-m-d', "$year-$month-$day")->format('Y-m-d');
                    }
                }
                
                // Coba format umum lainnya menggunakan Carbon
                try {
                    Log::debug("Mencoba parse format lainnya dengan Carbon: $tanggalString");
                    $date = Carbon::parse($tanggalString);
                    return $date->format('Y-m-d');
                } catch (\Exception $carbonEx) {
                    Log::debug("Carbon parse failed: " . $carbonEx->getMessage());
                    // Continue to try other methods
                }
                
                // Fallback untuk format lainnya menggunakan strtotime
                $timestamp = strtotime($tanggalString);
                if ($timestamp !== false) {
                    Log::debug("Berhasil parse dengan strtotime: $tanggalString");
                    return date('Y-m-d', $timestamp);
                }
            }

            Log::warning('Format tanggal tidak dikenal: ' . json_encode($tanggalString));
            return null;
        } catch (\Exception $e) {
            Log::warning('Failed to parse date: ' . json_encode($tanggalString) . ' - Error: ' . $e->getMessage());
            return null;
        }
    }

    private function convertMonthToNumber($monthAbbr)
    {
        // Normalize the month abbreviation
        $monthAbbr = ucfirst(strtolower(trim($monthAbbr)));
        
        $months = [
            // Bahasa Indonesia - short
            'Jan' => '01', 'Feb' => '02', 'Mar' => '03', 'Apr' => '04',
            'Mei' => '05', 'May' => '05', 'Jun' => '06', 'Jul' => '07',
            'Agu' => '08', 'Aug' => '08', 'Sep' => '09', 'Okt' => '10',
            'Oct' => '10', 'Nov' => '11', 'Des' => '12', 'Dec' => '12',
            
            // English - full
            'January' => '01', 'February' => '02', 'March' => '03', 'April' => '04',
            'June' => '06', 'July' => '07', 'August' => '08', 'September' => '09',
            'October' => '10', 'November' => '11', 'December' => '12',
            
            // Bahasa Indonesia - full
            'Januari' => '01', 'Februari' => '02', 'Maret' => '03', 'April' => '04',
            'Juni' => '06', 'Juli' => '07', 'Agustus' => '08', 'September' => '09',
            'Oktober' => '10', 'Nopember' => '11', 'November' => '11', 'Desember' => '12',
            
            // Alternative spellings
            'Peb' => '02', 'Pebruari' => '02',  // Alternative for Februari
            'Agus' => '08'                       // Alternative for Agustus
        ];

        return $months[$monthAbbr] ?? null;
    }

    /**
     * Normalisasi nilai jenis kelamin agar konsisten
     * 
     * @param string $jenisKelamin
     * @return string|null
     */
    private function normalizeJenisKelamin($jenisKelamin)
    {
        if (empty($jenisKelamin)) return null;

        $jenisKelamin = strtolower(trim($jenisKelamin));
        
        if (str_contains($jenisKelamin, 'laki') || $jenisKelamin === 'l' || $jenisKelamin === 'l-l' || $jenisKelamin === 'lk') {
            return 'Laki-laki';
        } elseif (str_contains($jenisKelamin, 'perempuan') || $jenisKelamin === 'p' || $jenisKelamin === 'pr' || $jenisKelamin === 'wanita') {
            return 'Perempuan';
        }

        return ucwords($jenisKelamin);
    }

    /**
     * Normalisasi nilai agama agar konsisten
     * 
     * @param string $agama
     * @return string|null
     */
    private function normalizeAgama($agama)
    {
        if (empty($agama)) return null;

        $agama = strtolower(trim($agama));
        
        // Mapping lengkap agama
        $agamaMapping = [
            'islam' => 'Islam',
            'katholik' => 'Katolik',
            'katolik' => 'Katolik',
            'kristen' => 'Kristen',
            'kristen protestan' => 'Kristen',
            'protestan' => 'Kristen',
            'hindu' => 'Hindu',
            'buddha' => 'Buddha',
            'budha' => 'Buddha',
            'konghuchu' => 'Konghucu',
            'konghucu' => 'Konghucu',
            'khonghucu' => 'Konghucu',
            'aliran kepercayaan' => 'Aliran Kepercayaan',
            'lainnya' => 'Lainnya'
        ];

        return $agamaMapping[$agama] ?? ucwords($agama);
    }

    private function normalizePekerjaan($pekerjaan)
    {
        if (empty($pekerjaan)) return null;

        $pekerjaan = strtolower(trim($pekerjaan));
        
        // Mapping umum pekerjaan
        $pekerjaanMapping = [
            'wiraswasta' => 'Wiraswasta',
            'irt' => 'IRT',
            'ibu rumah tangga' => 'IRT',
            'pelajar/mahasiswa' => 'Pelajar',
            'pelajar' => 'Pelajar',
            'mahasiswa' => 'Mahasiswa',
            'petani' => 'Petani',
            'belum/tidak bekerja' => 'Belum Bekerja',
            'belum bekerja' => 'Belum Bekerja',
            'tidak bekerja' => 'Belum Bekerja',
            'karyawan swasta' => 'Karyawan Swasta',
            'swasta' => 'Swasta',
            'polri' => 'Polri',
            'tni' => 'TNI',
            'pedagang' => 'Pedagang',
            'pns' => 'PNS',
            'pegawai negeri' => 'PNS',
            'pensiunan' => 'Pensiunan'
        ];

        return $pekerjaanMapping[$pekerjaan] ?? ucwords($pekerjaan);
    }

    // Keep old methods for backward compatibility but mark as deprecated
    private function getJenisKelaminId($jenisKelamin)
    {
        return null; // No longer used
    }

    private function getAgamaId($agama)
    {
        return null; // No longer used
    }

    private function getPekerjaanId($pekerjaan)
    {
        return null; // No longer used
    }
    
    /**
     * Cari kolom berdasarkan beberapa kemungkinan nama
     * 
     * @param array $row
     * @param array $possibleNames
     * @return string|null
     */
    private function findColumn(array $row, array $possibleNames)
    {
        // Cari langsung key yang cocok
        foreach ($possibleNames as $name) {
            if (isset($row[$name])) {
                return $name;
            }
        }
        
        // Cari key yang mengandung string yang dicari
        foreach ($row as $key => $value) {
            foreach ($possibleNames as $name) {
                if (stripos($key, $name) !== false) {
                    return $key;
                }
            }
        }
        
        return null;
    }
}
