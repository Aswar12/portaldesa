<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Penduduk;
use App\Models\Agama;
use App\Models\JenisKelamin;
use App\Models\Pekerjaan;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ImportPendudukCsv extends Command
{
    protected $signature = 'import:penduduk-csv {file="DATA PENDUDUK KADUN.xlsx - DATA PENDUDUK.csv"}';
    protected $description = 'Import penduduk data from CSV file and update the database';

    public function handle()
    {
        $filePath = base_path($this->argument('file'));

        if (!file_exists($filePath)) {
            $this->error("File not found: {$filePath}");
            return 1;
        }

        $this->info("Loading file: {$filePath}");

        if (($handle = fopen($filePath, 'r')) === false) {
            $this->error("Failed to open file: {$filePath}");
            return 1;
        }

        $header = null;
        DB::beginTransaction();

        try {
            while (($row = fgetcsv($handle, 1000, ',')) !== false) {
                if (!$header) {
                    $header = array_map('strtolower', $row);
                    continue;
                }

                $rowData = array_combine($header, $row);

                $nik = trim($rowData['nik'] ?? '');
                if (empty($nik)) {
                    $this->warn("Skipping row with empty NIK");
                    continue;
                }

                $nama = $rowData['nama'] ?? '';
                $ttlRaw = $rowData['tanggal lahir'] ?? $rowData['ttl'] ?? null;
                $ttl = null;
                if ($ttlRaw) {
                    try {
                        $ttl = Carbon::parse($ttlRaw)->format('Y-m-d');
                    } catch (\Exception $e) {
                        $this->warn("Invalid date format for NIK {$nik}: {$ttlRaw}");
                    }
                }

                $jenisKelaminStr = strtolower(trim($rowData['jenis kelamin'] ?? ''));
                $agamaStr = strtolower(trim($rowData['agama'] ?? ''));
                $pekerjaanStr = strtolower(trim($rowData['pekerjaan'] ?? ''));

                $jenisKelaminId = $this->getJenisKelaminId($jenisKelaminStr);
                $agamaId = $this->getAgamaId($agamaStr);
                $pekerjaanId = $this->getPekerjaanId($pekerjaanStr);

                $alamat = $rowData['alamat'] ?? '';
                $statusPerkawinan = $rowData['status perkawinan'] ?? null;
                $kewarganegaraan = $rowData['kewarganegaraan'] ?? null;

                $penduduk = Penduduk::where('nik', $nik)->first();

                $data = [
                    'nama' => $nama,
                    'ttl' => $ttl,
                    'jenis_kelamin_id' => $jenisKelaminId,
                    'agama_id' => $agamaId,
                    'pekerjaan_id' => $pekerjaanId,
                    'alamat' => $alamat,
                    'status_perkawinan' => $statusPerkawinan,
                    'kewarganegaraan' => $kewarganegaraan,
                ];

                if ($penduduk) {
                    $penduduk->update($data);
                    $this->info("Updated penduduk NIK: {$nik}");
                } else {
                    $data['nik'] = $nik;
                    Penduduk::create($data);
                    $this->info("Created penduduk NIK: {$nik}");
                }
            }

            fclose($handle);
            DB::commit();
            $this->info("CSV import completed successfully.");
        } catch (\Exception $e) {
            DB::rollBack();
            $this->error("Import failed: " . $e->getMessage());
            return 1;
        }

        return 0;
    }

    protected function getJenisKelaminId($name)
    {
        $jenisKelamin = JenisKelamin::whereRaw('LOWER(name) = ?', [$name])->first();
        return $jenisKelamin ? $jenisKelamin->id : null;
    }

    protected function getAgamaId($name)
    {
        $agama = Agama::whereRaw('LOWER(name) = ?', [$name])->first();
        return $agama ? $agama->id : null;
    }

    protected function getPekerjaanId($name)
    {
        $pekerjaan = Pekerjaan::whereRaw('LOWER(name) = ?', [$name])->first();
        return $pekerjaan ? $pekerjaan->id : null;
    }
}
