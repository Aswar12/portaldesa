<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use App\Models\Agama;
use App\Models\Pekerjaan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

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
        return view('admin.penduduk.create', compact('agamas', 'pekerjaans'));
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
        // Format tanggal_lahir to d-m-Y for display (day month year)
        $penduduk->tanggal_lahir = Carbon::parse($penduduk->tanggal_lahir)->format('d F Y');
        return view('admin.penduduk.edit', compact('penduduk', 'agamas', 'pekerjaans'));
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
            'excel_file' => 'required|file|mimes:xlsx,xls',
        ]);

        $file = $request->file('excel_file');

        try {
            $rows = Excel::toArray([], $file->getPathname())[0];

            $header = array_map('strtolower', $rows[0]);
            $dataRows = array_slice($rows, 1);

            $errors = [];
            DB::beginTransaction();

            foreach ($dataRows as $index => $row) {
                $rowData = array_combine($header, $row);

                \Log::info('Import Penduduk Row ' . ($index + 2) . ': ' . json_encode($rowData));

                $nik = trim($rowData['nik'] ?? '');
                if (empty($nik)) {
                    \Log::warning('Import Penduduk Row ' . ($index + 2) . ': NIK kosong, dilewati.');
                    continue;
                }

                $nama = trim($rowData['nama'] ?? '');
                $ttlRaw = $rowData['tanggal lahir'] ?? null;
                $ttl = null;
                if ($ttlRaw) {
                    try {
                        // Parsing tanggal lahir dengan format "d - M - Y"
                        $ttl = \Carbon\Carbon::createFromFormat('d - M - Y', $ttlRaw)->format('Y-m-d');
                    } catch (\Exception $e1) {
                        try {
                            $ttl = \Carbon\Carbon::parse($ttlRaw)->format('Y-m-d');
                        } catch (\Exception $e2) {
                            $ttl = null;
                            \Log::warning('Import Penduduk Row ' . ($index + 2) . ': Gagal parsing tanggal lahir: ' . $ttlRaw);
                        }
                    }
                }

                $jenisKelaminStr = strtolower(trim($rowData['jenis kelamin'] ?? ''));
                $agamaStr = strtolower(trim($rowData['agama'] ?? ''));
                $pekerjaanStr = strtolower(trim($rowData['pekerjaan'] ?? ''));

                $jenisKelaminId = $this->getJenisKelaminId($jenisKelaminStr);
                $agamaId = $this->getAgamaId($agamaStr);
                $pekerjaanId = $this->getPekerjaanId($pekerjaanStr);

                if (!$jenisKelaminId) {
                    $errors[] = "Baris " . ($index + 2) . ": Jenis Kelamin '$jenisKelaminStr' tidak ditemukan.";
                    \Log::warning('Import Penduduk Row ' . ($index + 2) . ': Jenis Kelamin tidak ditemukan: ' . $jenisKelaminStr);
                }
                if (!$agamaId) {
                    $errors[] = "Baris " . ($index + 2) . ": Agama '$agamaStr' tidak ditemukan.";
                    \Log::warning('Import Penduduk Row ' . ($index + 2) . ': Agama tidak ditemukan: ' . $agamaStr);
                }
                if (!$pekerjaanId) {
                    $errors[] = "Baris " . ($index + 2) . ": Pekerjaan '$pekerjaanStr' tidak ditemukan.";
                    \Log::warning('Import Penduduk Row ' . ($index + 2) . ': Pekerjaan tidak ditemukan: ' . $pekerjaanStr);
                }

                $alamat = trim($rowData['alamat'] ?? '');
                $statusPerkawinan = trim($rowData['status dlm keluarga'] ?? null);
                $kk = trim($rowData['no. kk'] ?? null);
                $tempatLahir = trim($rowData['tempat lahir'] ?? null);

                $penduduk = Penduduk::where('nik', $nik)->first();

                $data = [
                    'nama' => $nama,
                    'ttl' => $ttl,
                    'jenis_kelamin_id' => $jenisKelaminId,
                    'agama_id' => $agamaId,
                    'pekerjaan_id' => $pekerjaanId,
                    'alamat' => $alamat,
                    'status_perkawinan' => $statusPerkawinan,
                    'kk' => $kk,
                    'tempat_lahir' => $tempatLahir,
                ];

                if ($penduduk) {
                    $penduduk->update($data);
                } else {
                    $data['nik'] = $nik;
                    Penduduk::create($data);
                }
            }

            if (count($errors) > 0) {
                DB::rollBack();
                $errorMessage = implode(' ', $errors);
                return redirect()->route('admin.penduduk.index')->with('error', 'Gagal mengimpor data: ' . $errorMessage);
            }

            DB::commit();
            return redirect()->route('admin.penduduk.index')->with('success', 'Data penduduk berhasil diimpor dari Excel.');
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Import Penduduk Error: ' . $e->getMessage());
            return redirect()->route('admin.penduduk.index')->with('error', 'Gagal mengimpor data: ' . $e->getMessage());
        }
    }

    protected function getJenisKelaminId($name)
    {
        $jenisKelamin = \App\Models\JenisKelamin::whereRaw('LOWER(jenis_kelamin) = ?', [$name])->first();
        return $jenisKelamin ? $jenisKelamin->id : null;
    }

    protected function getAgamaId($name)
    {
        $agama = \App\Models\Agama::whereRaw('LOWER(name) = ?', [$name])->first();
        return $agama ? $agama->id : null;
    }

    protected function getPekerjaanId($name)
    {
        $pekerjaan = \App\Models\Pekerjaan::whereRaw('LOWER(name) = ?', [$name])->first();
        return $pekerjaan ? $pekerjaan->id : null;
    }

}
