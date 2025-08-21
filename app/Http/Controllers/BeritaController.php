<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        $query = Berita::where('status_id', 2)->with(['user', 'status']);

        // Get available years from database based on created_at
        $availableYears = Berita::where('status_id', 2)
            ->selectRaw('YEAR(created_at) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        // Filter by year if provided
        if ($request->has('year') && $request->year != '') {
            $query->whereYear('created_at', $request->year);
        }

        // Sorting
        if ($request->sort == 'oldest') {
            $query->orderBy('created_at', 'asc');
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $beritas = $query->paginate(9)->withQueryString();

        return view('berita.index', [
            'beritas' => $beritas,
            'availableYears' => $availableYears,
            'selectedYear' => $request->year,
            'selectedSort' => $request->sort ?? 'latest'
        ]);
    }

    public function berita($slug)
    {
        $berita = Berita::where('slug', $slug)->with(['user', 'status', 'kategori', 'comments'])->first();
        $berita->views += 1;
        $berita->save();

        return view('berita.detail', [
            'berita'        => $berita,
            'beritaPopuler' => Berita::where('status_id', 2)->orderBy('views', 'desc')->take(5)->get(),
            'kategories'    => Kategori::all(),
        ]);
    }

    
}
