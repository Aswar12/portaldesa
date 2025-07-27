<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $query = Gallery::query();

        if ($request->has('year') && $request->year != '') {
            $query->where('year', $request->year);
        }

        $galerrys = $query->orderBy('id', 'DESC')->paginate(12);

        return view('gallery.index', [
            'galerrys'  => $galerrys,
            'filterYear' => $request->year ?? ''
        ]);
    }
}
