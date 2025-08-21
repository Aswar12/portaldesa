<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Gallery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Gallery::query();

        if ($request->has('year') && $request->year != '') {
            $query->where('year', $request->year);
        }

        $gallerys = $query->get();

        return view('admin.gallery.index', [
            'gallerys'  => $gallerys,
            'filterYear' => $request->year ?? ''
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.gallery.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'gambar'       => 'required|mimes:png,jpg,jpeg',
            'keterangan'   => 'required',
            'published_at' => 'required|date'
        ], [
            'gambar.required'       => 'Form wajib di isi !',
            'gambar.mimes'          => 'Format yang di izinkan png,jpg,jpeg !',
            'keterangan.required'   => 'Form wajib di isi!',
            'published_at.required' => 'Waktu unggah wajib diisi!',
            'published_at.date'     => 'Format tanggal tidak valid'
        ]);

        if ($request->hasFile('gambar')) {
            $path       = 'img-gallery/';
            $file       = $request->file('gambar');
            $extension  = $file->getClientOriginalExtension();
            $fileName   = uniqid() . '.' . $extension;
            $gambar     = $file->storeAs($path, $fileName, 'public');
        } else {
            $gambar     = null;
        }

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $published_at = \Carbon\Carbon::parse($request->published_at)->tz('Asia/Jayapura');

        // Auto-generate year from published_at
        $year = $published_at->year;

        Gallery::create([
            'gambar'       => $gambar,
            'keterangan'   => $request->keterangan,
            'year'         => $year,
            'user_id'      => auth()->user()->id,
            'published_at' => $published_at
        ]);

        return redirect('/admin/gallery')->with('success', 'Berhasil menambahkan informasi layanan baru');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $gallery = Gallery::find($id);
        return view('admin.gallery.edit', [
            'gallery'   => $gallery,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $gallery = Gallery::find($id);
        $validator = Validator::make($request->all(), [
            'gambar'       => 'mimes:png,jpg,jpeg',
            'keterangan'   => 'required',
            'published_at' => 'required|date'
        ], [
            'gambar.mimes'          => 'Format yang di izinkan png,jpg,jpeg !',
            'keterangan.required'   => 'Form wajib di isi!',
            'published_at.required' => 'Waktu unggah wajib diisi!',
            'published_at.date'     => 'Format tanggal tidak valid'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $gambar = $gallery->gambar;
        if ($request->hasFile('gambar')) {
            if ($gallery->gambar && Storage::disk('public')->exists($gallery->gambar)) {
                Storage::disk('public')->delete($gallery->gambar);
            }
            $path       = 'img-gallery/';
            $file       = $request->file('gambar');
            $extension  = $file->getClientOriginalExtension();
            $fileName   = uniqid() . '.' . $extension;
            $gambar     = $file->storeAs($path, $fileName, 'public');
        }

        // Auto-generate year from published_at
        $published_at = \Carbon\Carbon::parse($request->published_at)->tz('Asia/Jayapura');
        $year = $published_at->year;

        $gallery->update([
            'gambar'        => $gambar,
            'keterangan'    => $request->keterangan,
            'year'          => $year,
            'published_at'  => $published_at
        ]);

        return redirect('/admin/gallery')->with('success', 'Berhasil memperbarui data gallery');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $gallery = Gallery::find($id);
        if($gallery && $gallery->gambar && Storage::disk('public')->exists($gallery->gambar)){
            Storage::disk('public')->delete($gallery->gambar);
        }
        $gallery->delete();

        return redirect()->back()->with('success', 'Berhasil menghapus data');
    }
}
