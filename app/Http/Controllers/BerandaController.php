<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\VideoProfil;
use App\Models\Penduduk;
use App\Models\Umkm;

class BerandaController extends Controller
{
    public function index()
    {
        // Get statistics from database
        $totalPenduduk = Penduduk::count();
        $totalKeluarga = Penduduk::distinct('kk')->count('kk');
        $totalUmkm = Umkm::count();
        
        // Calculate gender statistics
        $totalLaki = Penduduk::where('jenis_kelamin_id', 1)->count();
        $totalPerempuan = Penduduk::where('jenis_kelamin_id', 2)->count();
        
        // Calculate village area (you can adjust this value or get from config)
        $luasWilayah = 15.2; // in km²
        
        return view('/index', [
            'sliders'           => Slider::all(),
            'beritas'           => Berita::where('status_id', 2)->latest()->take(3)->get(),
            'videoProfil'       => VideoProfil::first(),
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
    }
}
