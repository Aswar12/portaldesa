<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $query = Gallery::query();

        // Get available years from database
        $availableYears = Gallery::whereNotNull('year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        if ($request->has('year') && $request->year != '') {
            $query->where('year', $request->year);
        }

        // Sorting
        if ($request->sort == 'oldest') {
            $query->orderBy('published_at', 'asc');
        } else {
            $query->orderBy('published_at', 'desc');
        }

        $galerrys = $query->paginate(12)->withQueryString();

        return view('gallery.index', [
            'galerrys'  => $galerrys,
            'availableYears' => $availableYears,
            'selectedYear' => $request->year,
            'selectedSort' => $request->sort ?? 'latest'
        ]);
    }
}
