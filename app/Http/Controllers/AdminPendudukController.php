<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use App\Models\Agama;
use App\Models\Pekerjaan;
use App\Models\JenisKelamin;
use App\Imports\PendudukImport;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminPendudukController extends Controller
{
    /**
     * Display a listing of the penduduk.
     */
    public function index()
    {
        $penduduks = Penduduk::with(['agama', 'jenisKelamin', 'pekerjaan'])->paginate(10);
        return view('admin.penduduk.index', compact('penduduks'));
    }

    /**
     * Show the form for creating a new penduduk.
     */
    public function create()
    {
        $agamas = Agama::all();
        $pekerjaans = Pekerjaan::all();
        $jenisKelamins = JenisKelamin::all();
        return view('admin.penduduk.create', compact('agamas', 'pekerjaans', 'jenisKelamins'));
    }

    /**
     * Store a newly created penduduk in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|max:16|unique:penduduks,nik',
            'alamat' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string',
            'agama_id' => 'required|exists:agamas,id',
            'pekerjaan_id' => 'required|exists:pekerjaans,id',
        ]);

        Penduduk::create($validated);

        return redirect()->route('admin.penduduk.index')->with('success', 'Penduduk created successfully.');
    }

    /**
     * Show the form for editing the specified penduduk.
     */
    public function edit(Penduduk $penduduk)
    {
        $agamas = Agama::all();
        $pekerjaans = Pekerjaan::all();
        $jenisKelamins = JenisKelamin::all();
        // Format tanggal_lahir to d-m-Y for display (day month year)
        $penduduk->tanggal_lahir = Carbon::parse($penduduk->ttl)->format('d F Y');
        return view('admin.penduduk.edit', compact('penduduk', 'agamas', 'pekerjaans', 'jenisKelamins'));
    }

    /**
     * Update the specified penduduk in storage.
     */
    public function update(Request $request, Penduduk $penduduk)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|max:16|unique:penduduks,nik,' . $penduduk->id,
            'alamat' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string',
            'agama_id' => 'required|exists:agamas,id',
            'pekerjaan_id' => 'required|exists:pekerjaans,id',
        ]);

        $penduduk->update($validated);

        return redirect()->route('admin.penduduk.index')->with('success', 'Penduduk updated successfully.');
    }

    /**
     * Remove the specified penduduk from storage.
     */
    public function destroy(Penduduk $penduduk)
    {
        $penduduk->delete();

        return redirect()->route('admin.penduduk.index')->with('success', 'Penduduk deleted successfully.');
    }

    /**
     * Import penduduk data from Excel file.
     */
    public function importFromExcel(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|file|mimes:xlsx,xls,csv,txt|max:10240', // max 10MB
        ]);

        try {
            $import = new PendudukImport();
            Excel::import($import, $request->file('excel_file'));

            $importedCount = $import->getImportedCount();
            $updatedCount = $import->getUpdatedCount();
            $errors = $import->getErrors();

            // Debug info
            Log::info($import->getDebugSummary());
            
            $message = "Import berhasil! ";
            $message .= "Data baru: $importedCount, ";
            $message .= "Data diperbarui: $updatedCount";
            
            if (method_exists($import, 'getTotalRows')) {
                $totalRows = $import->getTotalRows();
                $message .= " (Total baris diproses: $totalRows)";
            }

            // Jika ada error, tapi hanya header yang terdeteksi, jangan tampilkan sebagai warning
            $headerErrors = 0;
            foreach ($errors as $error) {
                if (strpos($error, 'Format NIK tidak valid pada baris 1:') !== false || 
                    strpos($error, 'NIK kosong pada baris 1') !== false) {
                    $headerErrors++;
                }
            }
            
            // Jika semua error hanya masalah header, anggap sukses
            if (!empty($errors) && count($errors) === $headerErrors) {
                return redirect()->route('admin.penduduk.index')->with('success', $message);
            } 
            // Jika ada error lain selain header
            else if (!empty($errors)) {
                // Filter out header-related errors
                $filteredErrors = array_filter($errors, function($error) {
                    return strpos($error, 'Format NIK tidak valid pada baris 1:') === false && 
                           strpos($error, 'NIK kosong pada baris 1') === false;
                });
                
                if (count($filteredErrors) > 0) {
                    $message .= ". Beberapa error: " . implode(', ', array_slice($filteredErrors, 0, 3));
                    if (count($filteredErrors) > 3) {
                        $message .= " dan " . (count($filteredErrors) - 3) . " error lainnya.";
                    }
                    
                    // Debug error detail
                    Log::debug('Import errors: ' . json_encode(array_slice($filteredErrors, 0, 20)));
                    
                    return redirect()->route('admin.penduduk.index')->with('warning', $message);
                }
                
                return redirect()->route('admin.penduduk.index')->with('success', $message);
            }

            return redirect()->route('admin.penduduk.index')->with('success', $message);

        } catch (\Exception $e) {
            Log::error('Import Excel Error: ' . $e->getMessage());
            return redirect()->route('admin.penduduk.index')
                ->with('error', 'Gagal mengimpor data: ' . $e->getMessage());
        }
    }

    /**
     * Download template Excel untuk import data penduduk.
     */
    public function downloadTemplate()
    {
        $templateData = [
            [
                'NO' => 1,
                'NO. KK' => '9109012701120047',
                'NIK' => '9109011907860010',
                'NAMA' => 'CONTOH NAMA',
                'JENIS KELAMIN' => 'LAKI-LAKI',
                'TEMPAT LAHIR' => 'JAKARTA',
                'TANGGAL LAHIR' => '19 - Jul - 1986',
                'AGAMA' => 'ISLAM',
                'PEKERJAAN' => 'WIRASWASTA',
                'STATUS DLM KELUARGA' => 'KEPALA KELUARGA',
                'UMUR' => '39 TAHUN',
                'ALAMAT' => 'RT 01'
            ]
        ];

        return Excel::download(new class($templateData) implements \Maatwebsite\Excel\Concerns\FromArray {
            private $data;
            
            public function __construct($data) {
                $this->data = $data;
            }
            
            public function array(): array {
                return $this->data;
            }
        }, 'template_import_penduduk.xlsx');
    }
    
    /**
     * Export data penduduk ke Excel
     */
    public function exportToExcel()
    {
        $penduduks = Penduduk::with(['agama', 'jenisKelamin', 'pekerjaan'])->get();
        
        // Prepare data for export
        $exportData = [
            // Header row
            [
                'NO', 'NIK', 'NAMA', 'NO KK', 'TEMPAT LAHIR', 'TANGGAL LAHIR', 
                'JENIS KELAMIN', 'AGAMA', 'PEKERJAAN', 'STATUS DLM KELUARGA', 'ALAMAT'
            ]
        ];
        
        // Add data rows
        $no = 1;
        foreach ($penduduks as $penduduk) {
            $exportData[] = [
                $no++,
                $penduduk->nik,
                $penduduk->nama,
                $penduduk->kk ?? '-',
                $penduduk->tempat_lahir ?? '-',
                $penduduk->ttl ? Carbon::parse($penduduk->ttl)->format('d-m-Y') : '-',
                $penduduk->jenis_kelamin ?? ($penduduk->jenisKelamin ? $penduduk->jenisKelamin->jenis_kelamin : '-'),
                $penduduk->agama ?? ($penduduk->agama_relation ? $penduduk->agama_relation->agama : '-'),
                $penduduk->pekerjaan ?? ($penduduk->pekerjaan_relation ? $penduduk->pekerjaan_relation->pekerjaan : '-'),
                $penduduk->status_dlm_keluarga ?? '-',
                $penduduk->alamat ?? '-'
            ];
        }
        
        $timestamp = Carbon::now()->format('Ymd_His');
        $filename = "data_penduduk_{$timestamp}.xlsx";
        
        return Excel::download(new class($exportData) implements \Maatwebsite\Excel\Concerns\FromArray, \Maatwebsite\Excel\Concerns\WithHeadings, \Maatwebsite\Excel\Concerns\WithStyles {
            private $data;
            
            public function __construct($data) {
                $this->data = $data;
            }
            
            public function array(): array {
                // Return all but first row (which is header)
                return array_slice($this->data, 1);
            }
            
            public function headings(): array {
                // Return first row as headings
                return $this->data[0];
            }
            
            public function styles($sheet) {
                return [
                    1 => ['font' => ['bold' => true, 'size' => 12]],
                    'A1:K1' => ['fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'color' => ['rgb' => 'EEEEEE']]],
                ];
            }
        }, $filename);
    }

}
