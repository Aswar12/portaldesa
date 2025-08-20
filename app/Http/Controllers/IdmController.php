<?php

namespace App\Http\Controllers;

use App\Models\Idm;
use Illuminate\Http\Request;

class IdmController extends Controller
{
    public function index(Request $request)
    {
        // Ambil semua data IDM dari database, diurutkan berdasarkan tahun terbaru
        $allIdms = Idm::orderBy('tahun', 'desc')->get();
        
        // Jika tidak ada data IDM sama sekali, redirect dengan pesan
        if ($allIdms->isEmpty()) {
            return redirect()->route('home')->with('error', 'Belum ada data IDM. Silakan tambahkan data IDM terlebih dahulu di halaman admin.');
        }
        
        // Ambil data yang aktif atau terbaru jika tidak ada yang aktif
        $currentIdm = $allIdms->where('is_active', true)->first() ?: $allIdms->first();
        
        // Data historis untuk grafik - ambil 5 tahun terakhir
        $historicalData = $allIdms->take(5);
        
        // Data untuk grafik tren (5 tahun terakhir, diurutkan ascending untuk chart)
        $chartData = [
            'years' => $historicalData->reverse()->pluck('tahun')->toArray(),
            'scores' => $historicalData->reverse()->pluck('skor_idm')->map(function($score) {
                return (float) $score;
            })->toArray(),
            'iks' => $historicalData->reverse()->pluck('skor_iks')->map(function($score) {
                return (float) $score;
            })->toArray(),
            'ike' => $historicalData->reverse()->pluck('skor_ike')->map(function($score) {
                return (float) $score;
            })->toArray(),
            'ikl' => $historicalData->reverse()->pluck('skor_ikl')->map(function($score) {
                return (float) $score;
            })->toArray(),
        ];
        
        return view('idm.index', compact('currentIdm', 'historicalData', 'allIdms', 'chartData'));
    }
    
    public function infografis()
    {
        return redirect()->route('idm.index');
    }
}
