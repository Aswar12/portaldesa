<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\VideoProfil;
use App\Models\Penduduk;
use App\Models\Umkm;
use App\Models\Stunting;

class BerandaController extends Controller
{
    public function index()
    {
        try {
            // Get basic statistics from database
            $totalPenduduk = Penduduk::count();
            $totalKeluarga = Penduduk::distinct('kk')->whereNotNull('kk')->count('kk');
            $totalUmkm = Umkm::count();
            
            // Calculate gender statistics
            $totalLaki = Penduduk::where('jenis_kelamin', 'Laki-laki')
                        ->orWhere('jenis_kelamin_id', 1)
                        ->count();
            $totalPerempuan = Penduduk::where('jenis_kelamin', 'Perempuan')
                            ->orWhere('jenis_kelamin_id', 2)
                            ->count();
            
            // Calculate age-based statistics
            $usiaProduktif = Penduduk::whereRaw('TIMESTAMPDIFF(YEAR, ttl, CURDATE()) BETWEEN 15 AND 64')->count();
            $lansia = Penduduk::whereRaw('TIMESTAMPDIFF(YEAR, ttl, CURDATE()) >= 60')->count();
            $balita = Penduduk::whereRaw('TIMESTAMPDIFF(YEAR, ttl, CURDATE()) BETWEEN 0 AND 4')->count();
            
            // Count farmers (Petani)
            $petani = Penduduk::where('pekerjaan', 'LIKE', '%Petani%')
                     ->orWhere('pekerjaan', 'LIKE', '%Tani%')
                     ->count();
            
            // Get latest stunting data
            $stuntingData = Stunting::where('tampil_infografis', true)
                           ->orderBy('tahun', 'DESC')
                           ->orderBy('id', 'DESC')
                           ->first();
            
            $balitaStunting = 0;
            $balitaNormal = 0;
            $balitaKurus = 0;
            $balitaGemuk = 0;
            $totalBalitaStunting = 0;
            
            if ($stuntingData) {
                $balitaStunting = $stuntingData->balita_stunting;
                $balitaNormal = $stuntingData->balita_normal;
                $balitaKurus = $stuntingData->balita_kurus;
                $balitaGemuk = $stuntingData->balita_gemuk;
                $totalBalitaStunting = $stuntingData->total_balita;
            }
            
            // If no data in database, use default values for demo
            if ($totalPenduduk == 0) {
                $totalPenduduk = 2456;
                $totalKeluarga = 687;
                $totalLaki = 1289;
                $totalPerempuan = 1167;
                $usiaProduktif = 1865;
                $lansia = 198;
                $balita = 165;
                $petani = 428;
                
                // Default stunting data when no database data exists
                if (!$stuntingData) {
                    $balitaStunting = 15;
                    $balitaNormal = 120;
                    $balitaKurus = 10;
                    $balitaGemuk = 5;
                    $totalBalitaStunting = 150;
                }
            }
            
            // Calculate village area (you can adjust this value or get from config)
            $luasWilayah = 15.2; // in km²
            
            return view('/index', [
                'sliders'           => Slider::all(),
                'beritas'           => Berita::where('status_id', 2)->latest()->take(3)->get(),
                'videoProfil'       => VideoProfil::first(),
                
                // Statistics for the homepage
                'totalPenduduk'     => $totalPenduduk,
                'totalKK'           => $totalKeluarga,
                'lakiLaki'          => $totalLaki,
                'perempuan'         => $totalPerempuan,
                'usiaProduktif'     => $usiaProduktif,
                'lansia'            => $lansia,
                'balita'            => $balita,
                'petani'            => $petani,
                
                // Stunting data
                'balitaStunting'    => $balitaStunting,
                'balitaNormal'      => $balitaNormal,
                'balitaKurus'       => $balitaKurus,
                'balitaGemuk'       => $balitaGemuk,
                'totalBalitaStunting' => $totalBalitaStunting,
                
                // Legacy variable names for compatibility
                'total_penduduk'    => $totalPenduduk,
                'total_kk'          => $totalKeluarga,
                'total_laki'        => $totalLaki,
                'total_perempuan'   => $totalPerempuan,
                
                // New structured format
                'statistik'         => [
                    'penduduk'      => $totalPenduduk,
                    'keluarga'      => $totalKeluarga,
                    'umkm'          => $totalUmkm,
                    'luas_wilayah'  => $luasWilayah
                ]
            ]);
            
        } catch (\Exception $e) {
            // Fallback data if there's an error
            return view('/index', [
                'sliders'           => Slider::all(),
                'beritas'           => Berita::where('status_id', 2)->latest()->take(3)->get(),
                'videoProfil'       => VideoProfil::first(),
                
                // Default statistics
                'totalPenduduk'     => 2456,
                'totalKK'           => 687,
                'lakiLaki'          => 1289,
                'perempuan'         => 1167,
                'usiaProduktif'     => 1865,
                'lansia'            => 198,
                'balita'            => 165,
                'petani'            => 428,
                
                // Default stunting data
                'balitaStunting'    => 15,
                'balitaNormal'      => 120,
                'balitaKurus'       => 10,
                'balitaGemuk'       => 5,
                'totalBalitaStunting' => 150,
                
                // Legacy variables
                'total_penduduk'    => 2456,
                'total_kk'          => 687,
                'total_laki'        => 1289,
                'total_perempuan'   => 1167,
                
                'statistik'         => [
                    'penduduk'      => 2456,
                    'keluarga'      => 687,
                    'umkm'          => 45,
                    'luas_wilayah'  => 15.2
                ]
            ]);
        }
    }
}
