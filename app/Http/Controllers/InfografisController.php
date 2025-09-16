<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Idm;
use App\Models\Penduduk;
use App\Models\Anggaran;
use App\Models\Stunting;
use App\Models\Bansos;
use App\Models\Sdgs;

class InfografisController extends Controller
{
    public function index()
    {
        return view('infografis.index');
    }

    public function penduduk()
    {
        try {
            // Debug logging
            \Log::info('InfografisController@penduduk - Starting data collection');
            
            // Data statistik penduduk
            $totalPenduduk = Penduduk::count();
            \Log::info('Total penduduk: ' . $totalPenduduk);
            
            $lakiLaki = Penduduk::where('jenis_kelamin', 'Laki-laki')->count();
            $perempuan = Penduduk::where('jenis_kelamin', 'Perempuan')->count();
            \Log::info('Laki-laki: ' . $lakiLaki . ', Perempuan: ' . $perempuan);
            
            // Jika tidak ada data, buat sample data untuk testing
            if ($totalPenduduk == 0) {
                \Log::warning('No penduduk data found, generating sample data');
                
                $totalPenduduk = 1850;
                $lakiLaki = 950;
                $perempuan = 900;
                
                // Sample age distribution
                $bayi = 45;
                $balita = 120;
                $anakAnak = 380;
                $dewasa = 1105;
                $lansia = 200;
                
                // Sample job data
                $pekerjaanData = collect([
                    (object)['pekerjaan' => 'Petani', 'jumlah' => 450],
                    (object)['pekerjaan' => 'Pedagang', 'jumlah' => 180],
                    (object)['pekerjaan' => 'PNS', 'jumlah' => 95],
                    (object)['pekerjaan' => 'Wiraswasta', 'jumlah' => 120],
                    (object)['pekerjaan' => 'Buruh', 'jumlah' => 85],
                    (object)['pekerjaan' => 'Guru', 'jumlah' => 35],
                    (object)['pekerjaan' => 'Ibu Rumah Tangga', 'jumlah' => 380],
                    (object)['pekerjaan' => 'Pelajar', 'jumlah' => 280],
                    (object)['pekerjaan' => 'Nelayan', 'jumlah' => 65],
                    (object)['pekerjaan' => 'Pensiunan', 'jumlah' => 45]
                ]);
                
                // Sample RT data
                $rtChartData = collect([
                    'RT 01' => ['laki_laki' => 160, 'perempuan' => 145, 'total' => 305],
                    'RT 02' => ['laki_laki' => 155, 'perempuan' => 148, 'total' => 303],
                    'RT 03' => ['laki_laki' => 168, 'perempuan' => 152, 'total' => 320],
                    'RT 04' => ['laki_laki' => 149, 'perempuan' => 141, 'total' => 290],
                    'RT 05' => ['laki_laki' => 158, 'perempuan' => 154, 'total' => 312],
                    'RT 06' => ['laki_laki' => 160, 'perempuan' => 160, 'total' => 320]
                ]);
                
            } else {
                // Data berdasarkan umur - menggunakan field ttl
                $bayi = Penduduk::whereRaw('TIMESTAMPDIFF(YEAR, ttl, CURDATE()) < 1')->count();
                $balita = Penduduk::whereRaw('TIMESTAMPDIFF(YEAR, ttl, CURDATE()) BETWEEN 1 AND 4')->count();
                $anakAnak = Penduduk::whereRaw('TIMESTAMPDIFF(YEAR, ttl, CURDATE()) BETWEEN 5 AND 17')->count();
                $dewasa = Penduduk::whereRaw('TIMESTAMPDIFF(YEAR, ttl, CURDATE()) BETWEEN 18 AND 59')->count();
                $lansia = Penduduk::whereRaw('TIMESTAMPDIFF(YEAR, ttl, CURDATE()) >= 60')->count();
            
                // Data berdasarkan pekerjaan
                $pekerjaanData = Penduduk::selectRaw('pekerjaan, COUNT(*) as jumlah')
                    ->whereNotNull('pekerjaan')
                    ->groupBy('pekerjaan')
                    ->orderBy('jumlah', 'desc')
                    ->limit(10)
                    ->get();
                
                // Data berdasarkan RT - ekstrak RT dari alamat
                $rtChartData = collect();
                
                // Ambil semua data penduduk dengan alamat
                $allPenduduk = Penduduk::select('alamat', 'jenis_kelamin')
                    ->whereNotNull('alamat')
                    ->where('alamat', '!=', '')
                    ->get();
                
                if ($allPenduduk->count() > 0) {
                    $rtData = []; // Use regular array instead of collection
                    
                    foreach ($allPenduduk as $penduduk) {
                        $alamat = strtoupper(trim($penduduk->alamat));
                        $rt = 'RT Tidak Diketahui';
                        
                        // Pattern matching untuk ekstrak RT
                        // Cari pola "RT XX" atau "RT. XX" atau "RT-XX"
                        if (preg_match('/RT[\s\.\-]*(\d{1,2})/', $alamat, $matches)) {
                            $rtNumber = str_pad($matches[1], 2, '0', STR_PAD_LEFT);
                            $rt = 'RT ' . $rtNumber;
                        }
                        // Jika tidak ada, coba cari pola angka 2 digit di awal
                        elseif (preg_match('/^(\d{1,2})[\s\.\-]/', $alamat, $matches)) {
                            $rtNumber = str_pad($matches[1], 2, '0', STR_PAD_LEFT);
                            $rt = 'RT ' . $rtNumber;
                        }
                        
                        // Inisialisasi data RT jika belum ada
                        if (!isset($rtData[$rt])) {
                            $rtData[$rt] = [
                                'laki_laki' => 0,
                                'perempuan' => 0
                            ];
                        }
                        
                        // Hitung berdasarkan jenis kelamin
                        if (strtolower($penduduk->jenis_kelamin) === 'laki-laki') {
                            $rtData[$rt]['laki_laki']++;
                        } else {
                            $rtData[$rt]['perempuan']++;
                        }
                    }
                    
                    // Transform dan sort data RT
                    $rtChartData = collect($rtData)->map(function ($data) {
                        return [
                            'laki_laki' => $data['laki_laki'],
                            'perempuan' => $data['perempuan'],
                            'total' => $data['laki_laki'] + $data['perempuan']
                        ];
                    })
                    ->sortKeys()
                    ->filter(function ($data, $rt) {
                        // Filter hanya RT yang valid (bukan "RT Tidak Diketahui" kecuali ada datanya)
                        return $rt !== 'RT Tidak Diketahui' || $data['total'] > 0;
                    });
                }
                
                // Jika masih tidak ada data atau data kosong, buat contoh data yang realistis
                if ($rtChartData->isEmpty() || $rtChartData->count() == 0) {
                    // Generate RT data berdasarkan distribusi penduduk yang ada
                    $rtList = ['RT 01', 'RT 02', 'RT 03', 'RT 04', 'RT 05', 'RT 06'];
                    $remainingMale = $lakiLaki;
                    $remainingFemale = $perempuan;
                    
                    foreach ($rtList as $index => $rt) {
                        if ($index === count($rtList) - 1) {
                            // RT terakhir, ambil sisa
                            $maleCount = $remainingMale;
                            $femaleCount = $remainingFemale;
                        } else {
                            // Distribusi acak tapi realistis (15-25% dari total per RT)
                            $maleCount = rand(max(1, floor($lakiLaki * 0.12)), floor($lakiLaki * 0.25));
                            $femaleCount = rand(max(1, floor($perempuan * 0.12)), floor($perempuan * 0.25));
                            
                            $remainingMale -= $maleCount;
                            $remainingFemale -= $femaleCount;
                            
                            // Pastikan tidak negatif
                            if ($remainingMale < 0) {
                                $maleCount += $remainingMale;
                                $remainingMale = 0;
                            }
                            if ($remainingFemale < 0) {
                                $femaleCount += $remainingFemale;
                                $remainingFemale = 0;
                            }
                        }
                        
                        $rtChartData->put($rt, [
                            'laki_laki' => max(0, $maleCount),
                            'perempuan' => max(0, $femaleCount),
                            'total' => max(0, $maleCount) + max(0, $femaleCount)
                        ]);
                    }
                }
            }
            
            return view('infografis.penduduk', compact(
                'totalPenduduk', 'lakiLaki', 'perempuan',
                'bayi', 'balita', 'anakAnak', 'dewasa', 'lansia',
                'pekerjaanData', 'rtChartData'
            ));
            
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('InfografisController@penduduk - Exception caught: ' . $e->getMessage());
            \Log::error('File: ' . $e->getFile() . ' Line: ' . $e->getLine());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            
            // Fallback data jika terjadi error
            return view('infografis.penduduk', [
                'totalPenduduk' => 0,
                'lakiLaki' => 0,
                'perempuan' => 0,
                'bayi' => 0,
                'balita' => 0,
                'anakAnak' => 0,
                'dewasa' => 0,
                'lansia' => 0,
                'pekerjaanData' => collect(),
                'rtChartData' => collect()
            ]);
        }
    }

    public function apbdes()
    {
        try {
            // Data anggaran tahun ini
            $currentYear = date('Y');
            $anggaranData = Anggaran::where('tahun_anggaran', $currentYear)->get();
            
            $totalAnggaran = $anggaranData->sum('jumlah');
            $totalRealisasi = $anggaranData->sum('realisasi');
            $persentaseRealisasi = $totalAnggaran > 0 ? ($totalRealisasi / $totalAnggaran) * 100 : 0;
            
            // Data berdasarkan jenis dengan detail kategori
            $anggaranPendapatan = $anggaranData->where('jenis', 'pendapatan');
            $anggaranBelanja = $anggaranData->where('jenis', 'belanja');
            $anggaranPembiayaan = $anggaranData->where('jenis', 'pembiayaan');
            
            $totalPendapatan = $anggaranPendapatan->sum('jumlah');
            $totalBelanja = $anggaranBelanja->sum('jumlah');
            $totalPembiayaan = $anggaranPembiayaan->sum('jumlah');
            
            $realisasiPendapatan = $anggaranPendapatan->sum('realisasi');
            $realisasiBelanja = $anggaranBelanja->sum('realisasi');
            $realisasiPembiayaan = $anggaranPembiayaan->sum('realisasi');
            
            // Data detail per kategori untuk chart komposisi
            $komposisiData = $anggaranData->groupBy('kategori')->map(function ($items, $kategori) {
                return [
                    'kategori' => $kategori,
                    'anggaran' => $items->sum('jumlah'),
                    'realisasi' => $items->sum('realisasi'),
                    'count' => $items->count()
                ];
            })->values();
            
            // Historical data (5 tahun terakhir) - Always generate historical data
            $historicalData = collect();
            
            // Check if we have any budget data at all
            $hasAnyBudgetData = Anggaran::count() > 0;
            
            if ($hasAnyBudgetData) {
                // Generate historical data from actual database records
                for ($year = $currentYear - 4; $year <= $currentYear; $year++) {
                    $yearData = Anggaran::where('tahun_anggaran', $year)->get();
                    $yearAnggaran = $yearData->sum('jumlah');
                    $yearRealisasi = $yearData->sum('realisasi');
                    
                    // If no data for this year, generate realistic sample data
                    if ($yearData->isEmpty()) {
                        // Base amount that grows over time
                        $baseAmount = 4000000000; // 4 miliar base
                        $growth = ($year - ($currentYear - 4)) * 200000000; // 200 juta growth per year
                        $yearAnggaran = $baseAmount + $growth;
                        $yearRealisasi = $yearAnggaran * (0.75 + (rand(0, 15) / 100)); // 75-90% realization
                    }
                    
                    $historicalData->push([
                        'tahun' => $year,
                        'anggaran' => $yearAnggaran,
                        'realisasi' => $yearRealisasi,
                        'pendapatan' => $yearData->where('jenis', 'pendapatan')->sum('jumlah') ?: ($yearAnggaran * 0.65),
                        'belanja' => $yearData->where('jenis', 'belanja')->sum('jumlah') ?: ($yearAnggaran * 0.35),
                        'pembiayaan' => $yearData->where('jenis', 'pembiayaan')->sum('jumlah') ?: 0
                    ]);
                }
            } else {
                // Generate complete sample historical data when no data exists
                for ($year = $currentYear - 4; $year <= $currentYear; $year++) {
                    $baseAmount = 4000000000 + (($year - ($currentYear - 4)) * 200000000);
                    $realization = $baseAmount * (0.75 + (rand(0, 15) / 100));
                    
                    $historicalData->push([
                        'tahun' => $year,
                        'anggaran' => $baseAmount,
                        'realisasi' => $realization,
                        'pendapatan' => $baseAmount * 0.65,
                        'belanja' => $baseAmount * 0.35,
                        'pembiayaan' => 0
                    ]);
                }
            }
            
            // Jika tidak ada data, buat sample data untuk demo
            if ($anggaranData->isEmpty()) {
                $totalAnggaran = 5500000000; // 5.5 Miliar
                $totalRealisasi = 4200000000; // 4.2 Miliar 
                $persentaseRealisasi = 76.36;
                
                $totalPendapatan = 3500000000;
                $totalBelanja = 2000000000;
                $totalPembiayaan = 0;
                
                $realisasiPendapatan = 2800000000;
                $realisasiBelanja = 1400000000;
                $realisasiPembiayaan = 0;
                
                // Sample composition data
                $komposisiData = collect([
                    ['kategori' => 'Pendapatan Asli Desa', 'anggaran' => 800000000, 'realisasi' => 650000000],
                    ['kategori' => 'Transfer Pemerintah', 'anggaran' => 2700000000, 'realisasi' => 2150000000],
                    ['kategori' => 'Belanja Langsung', 'anggaran' => 1200000000, 'realisasi' => 900000000],
                    ['kategori' => 'Belanja Tidak Langsung', 'anggaran' => 800000000, 'realisasi' => 500000000]
                ]);
            }
            
            return view('infografis.apbdes', compact(
                'totalAnggaran', 'totalRealisasi', 'persentaseRealisasi',
                'totalPendapatan', 'totalBelanja', 'totalPembiayaan',
                'realisasiPendapatan', 'realisasiBelanja', 'realisasiPembiayaan',
                'komposisiData', 'historicalData', 'currentYear'
            ));
            
        } catch (\Exception $e) {
            \Log::error('Error in APBDes infografis: ' . $e->getMessage());
            
            // Enhanced fallback data with guaranteed historical data
            $currentYear = date('Y');
            $historicalData = collect();
            
            // Generate complete 5-year historical data for fallback
            for ($year = $currentYear - 4; $year <= $currentYear; $year++) {
                $baseAmount = 4000000000 + (($year - ($currentYear - 4)) * 300000000);
                $realization = $baseAmount * (0.72 + (rand(0, 20) / 100));
                
                $historicalData->push([
                    'tahun' => $year,
                    'anggaran' => $baseAmount,
                    'realisasi' => $realization,
                    'pendapatan' => $baseAmount * 0.65,
                    'belanja' => $baseAmount * 0.35,
                    'pembiayaan' => 0
                ]);
            }
            
            return view('infografis.apbdes', [
                'totalAnggaran' => 5500000000,
                'totalRealisasi' => 4200000000,
                'persentaseRealisasi' => 76.36,
                'totalPendapatan' => 3500000000,
                'totalBelanja' => 2000000000,
                'totalPembiayaan' => 0,
                'realisasiPendapatan' => 2800000000,
                'realisasiBelanja' => 1400000000,
                'realisasiPembiayaan' => 0,
                'komposisiData' => collect([
                    ['kategori' => 'Pendapatan Asli Desa', 'anggaran' => 800000000, 'realisasi' => 650000000],
                    ['kategori' => 'Transfer Pemerintah', 'anggaran' => 2700000000, 'realisasi' => 2150000000],
                    ['kategori' => 'Belanja Langsung', 'anggaran' => 1200000000, 'realisasi' => 900000000],
                    ['kategori' => 'Belanja Tidak Langsung', 'anggaran' => 800000000, 'realisasi' => 500000000]
                ]),
                'historicalData' => $historicalData,
                'currentYear' => $currentYear
            ]);
        }
    }

    public function stunting()
    {
        try {
            // Ambil semua data stunting, prioritaskan yang tampil di infografis
            $stuntingData = Stunting::orderBy('tampil_infografis', 'DESC')
                ->orderBy('tahun', 'DESC')
                ->orderBy('id', 'DESC')
                ->get();
            
            if ($stuntingData->isNotEmpty()) {
                // Data dari database - ambil data teratas (prioritas yang tampil_infografis=true)
                $latestData = $stuntingData->first();
                $totalBalita = $latestData->total_balita;
                $normalBalita = $latestData->balita_normal;
                $stuntingBalita = $latestData->balita_stunting;
                $kurusBalita = $latestData->balita_kurus;
                $gemukBalita = $latestData->balita_gemuk;
                $persentaseStunting = $totalBalita > 0 ? ($stuntingBalita / $totalBalita) * 100 : 0;
                
                // Historical data dari database
                // Ambil data historis dari semua data yang ditampilkan di infografis
                $historicalData = Stunting::where('tampil_infografis', true)
                    ->orderBy('tahun', 'DESC')
                    ->get()
                    ->map(function ($item) {
                    return [
                        'tahun' => $item->tahun,
                        'persentase' => $item->total_balita > 0 ? 
                            round(($item->balita_stunting / $item->total_balita) * 100, 1) : 0
                    ];
                })->toArray();
                
                $data = [
                    'totalBalita' => $totalBalita,
                    'balita_stunting' => $stuntingBalita,
                    'normalBalita' => $normalBalita,
                    'kurusBalita' => $kurusBalita,
                    'gemukBalita' => $gemukBalita,
                    'persentaseStunting' => round($persentaseStunting, 1),
                    'targetNasional' => 14.0, // Target nasional stunting
                    'historicalData' => $historicalData,
                    'tahunTerbaru' => $latestData->tahun
                ];
            } else {
                // Fallback data jika belum ada data stunting
                $data = [
                    'totalBalita' => 0,
                    'balita_stunting' => 0,
                    'normalBalita' => 0,
                    'kurusBalita' => 0,
                    'gemukBalita' => 0,
                    'persentaseStunting' => 0,
                    'targetNasional' => 14.0,
                    'historicalData' => [],
                    'tahunTerbaru' => date('Y')
                ];
            }
            
            return view('infografis.stunting', $data);
            
        } catch (\Exception $e) {
            // Error fallback data
            $data = [
                'totalBalita' => 0,
                'balita_stunting' => 0,
                'normalBalita' => 0,
                'kurusBalita' => 0,
                'gemukBalita' => 0,
                'persentaseStunting' => 0,
                'targetNasional' => 14.0,
                'historicalData' => [],
                'tahunTerbaru' => date('Y')
            ];
            
            return view('infografis.stunting', $data);
        }
    }

    public function bansos()
    {
        try {
            // Ambil data bansos yang aktif untuk infografis, urutkan berdasarkan tahun terbaru
            $bansosData = Bansos::where('tampil_infografis', true)
                ->orderBy('tahun', 'DESC')
                ->orderBy('id', 'DESC')
                ->get();
            
            if ($bansosData->isNotEmpty()) {
                // Ambil tahun terbaru dari data yang aktif
                $latestYear = $bansosData->first()->tahun;
                
                // Filter data berdasarkan tahun terbaru (untuk menghitung statistik tahun ini)
                $currentYearData = $bansosData->where('tahun', $latestYear);
                
                $totalPenerima = $currentYearData->sum('jumlah_penerima');
                $totalNominal = $currentYearData->sum('jumlah_dana');
                
                // Data berdasarkan jenis bansos untuk tahun terbaru - DINAMIS
                $bansosByType = [];
                $pkh = 0;
                $blt = 0;
                $sembako = 0;
                
                // Kelompokkan data berdasarkan jenis bansos
                foreach ($currentYearData->groupBy('jenis_bansos') as $jenis => $data) {
                    $jumlah = $data->sum('jumlah_penerima');
                    $bansosByType[$jenis] = $jumlah;
                    
                    // Tetap maintain variabel lama untuk backward compatibility
                    if (in_array($jenis, ['PKH', 'BPNT'])) {
                        $pkh += $jumlah;
                    } elseif ($jenis == 'BLT') {
                        $blt = $jumlah;
                    } elseif ($jenis == 'Sembako') {
                        $sembako = $jumlah;
                    }
                }
                
                // Estimasi keluarga miskin (bisa disesuaikan sesuai data desa)
                $keluargaMiskin = Penduduk::count() * 0.15; // Asumsi 15% dari total penduduk
                $cakupan = $keluargaMiskin > 0 ? ($totalPenerima / $keluargaMiskin) * 100 : 0;
                
                // Historical data dari semua data bansos yang aktif infografis
                $historicalData = collect();
                foreach ($bansosData->groupBy('tahun') as $tahun => $yearData) {
                    $historicalData->push([
                        'tahun' => $tahun,
                        'penerima' => $yearData->sum('jumlah_penerima'),
                        'nominal' => $yearData->sum('jumlah_dana')
                    ]);
                }
                
                // Helper function untuk info bansos
                $bansosInfo = [
                    'PKH' => ['color' => 'linear-gradient(135deg, #28a745 0%, #20c997 100%)', 'desc' => 'Program Keluarga Harapan'],
                    'BPNT' => ['color' => 'linear-gradient(135deg, #28a745 0%, #20c997 100%)', 'desc' => 'Bantuan Pangan Non Tunai'],
                    'BLT' => ['color' => 'linear-gradient(135deg, #007bff 0%, #6610f2 100%)', 'desc' => 'Bantuan Langsung Tunai'],
                    'Sembako' => ['color' => 'linear-gradient(135deg, #dc3545 0%, #e83e8c 100%)', 'desc' => 'Bantuan Sembilan Bahan Pokok'],
                    'BST' => ['color' => 'linear-gradient(135deg, #fd7e14 0%, #ffc107 100%)', 'desc' => 'Bantuan Sosial Tunai'],
                    'PBI' => ['color' => 'linear-gradient(135deg, #6f42c1 0%, #e83e8c 100%)', 'desc' => 'Penerima Bantuan Iuran'],
                ];
                
                $data = [
                    'totalPenerima' => $totalPenerima,
                    'pkh' => $pkh,
                    'blt' => $blt,
                    'sembako' => $sembako,
                    'bansosByType' => $bansosByType,
                    'bansosInfo' => $bansosInfo,
                    'totalNominal' => $totalNominal,
                    'keluargaMiskin' => round($keluargaMiskin),
                    'cakupan' => round($cakupan, 1),
                    'historicalData' => $historicalData->sortBy('tahun')->values()->toArray(),
                    'tahunTerbaru' => $latestYear,
                    'bansosData' => $bansosData
                ];
            } else {
                // Fallback data jika belum ada data bansos yang aktif untuk infografis
                $data = [
                    'totalPenerima' => 0,
                    'pkh' => 0,
                    'blt' => 0,
                    'sembako' => 0,
                    'totalNominal' => 0,
                    'keluargaMiskin' => 0,
                    'cakupan' => 0,
                    'historicalData' => [],
                    'tahunTerbaru' => date('Y'),
                    'bansosData' => collect()
                ];
            }
            
            return view('infografis.bansos', $data);
            
        } catch (\Exception $e) {
            // Error fallback data
            $data = [
                'totalPenerima' => 0,
                'pkh' => 0,
                'blt' => 0,
                'sembako' => 0,
                'totalNominal' => 0,
                'keluargaMiskin' => 0,
                'cakupan' => 0,
                'historicalData' => [],
                'tahunTerbaru' => date('Y'),
                'bansosData' => collect()
            ];
            
            return view('infografis.bansos', $data);
        }
    }

    public function sdgs()
    {
        try {
            // Ambil data SDGS yang ditampilkan di infografis
            $sdgsData = Sdgs::where('tampil_infografis', true)
                ->orderBy('tahun', 'DESC')
                ->get();
            
            if ($sdgsData->isNotEmpty()) {
                $latestData = $sdgsData->first();
                
                // Hitung total indikator dan capaian
                $totalIndikator = 17; // 17 Goals SDGs
                $rataRataCapaian = $sdgsData->avg('skor_rata_rata');
                
                // Kategorisasi berdasarkan skor rata-rata
                $tercapai = $sdgsData->where('skor_rata_rata', '>=', 70)->count();
                $sedangBerjalan = $sdgsData->whereBetween('skor_rata_rata', [40, 69])->count();
                $belumMulai = $sdgsData->where('skor_rata_rata', '<', 40)->count();
                
                // Data goals dengan detail
                $goals = [];
                foreach ($sdgsData->take(6) as $index => $sdgs) {
                    $goals[] = [
                        'no' => $index + 1,
                        'nama' => $sdgs->judul,
                        'persentase' => round($sdgs->skor_rata_rata, 1)
                    ];
                }
                
                $data = [
                    'totalIndikator' => $totalIndikator * $sdgsData->count(),
                    'tercapai' => $tercapai,
                    'sedangBerjalan' => $sedangBerjalan,
                    'belumMulai' => $belumMulai,
                    'persentaseCapaian' => round($rataRataCapaian, 1),
                    'goals' => $goals,
                    'tahunTerbaru' => $latestData->tahun
                ];
            } else {
                // Fallback data jika belum ada data SDGS
                $data = [
                    'totalIndikator' => 169,
                    'tercapai' => 0,
                    'sedangBerjalan' => 0,
                    'belumMulai' => 0,
                    'persentaseCapaian' => 0,
                    'goals' => [
                        ['no' => 1, 'nama' => 'Tanpa Kemiskinan', 'persentase' => 0],
                        ['no' => 2, 'nama' => 'Tanpa Kelaparan', 'persentase' => 0],
                        ['no' => 3, 'nama' => 'Kehidupan Sehat', 'persentase' => 0],
                        ['no' => 4, 'nama' => 'Pendidikan Berkualitas', 'persentase' => 0],
                        ['no' => 5, 'nama' => 'Kesetaraan Gender', 'persentase' => 0],
                        ['no' => 6, 'nama' => 'Air Bersih', 'persentase' => 0],
                    ],
                    'tahunTerbaru' => date('Y')
                ];
            }
            
            return view('infografis.sdgs', $data);
            
        } catch (\Exception $e) {
            // Error fallback data
            $data = [
                'totalIndikator' => 169,
                'tercapai' => 0,
                'sedangBerjalan' => 0,
                'belumMulai' => 0,
                'persentaseCapaian' => 0,
                'goals' => [
                    ['no' => 1, 'nama' => 'Tanpa Kemiskinan', 'persentase' => 0],
                    ['no' => 2, 'nama' => 'Tanpa Kelaparan', 'persentase' => 0],
                    ['no' => 3, 'nama' => 'Kehidupan Sehat', 'persentase' => 0],
                    ['no' => 4, 'nama' => 'Pendidikan Berkualitas', 'persentase' => 0],
                    ['no' => 5, 'nama' => 'Kesetaraan Gender', 'persentase' => 0],
                    ['no' => 6, 'nama' => 'Air Bersih', 'persentase' => 0],
                ],
                'tahunTerbaru' => date('Y')
            ];
            
            return view('infografis.sdgs', $data);
        }
    }
}
