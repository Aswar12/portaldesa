<?php

namespace App\Http\Controllers;

use App\Models\Stunting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminStuntingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Stunting::query();
        
        // Filter berdasarkan tahun jika ada
        if ($request->tahun) {
            $query->where('tahun', $request->tahun);
        }
        
        $stuntings = $query->orderBy('tahun', 'DESC')
                          ->orderBy('id', 'DESC')
                          ->get();
        
        // Data untuk dropdown filter
        $tahunOptions = Stunting::select('tahun')
                              ->distinct()
                              ->orderBy('tahun', 'DESC')
                              ->pluck('tahun');
        
        return view('admin.stunting.index', compact('stuntings', 'tahunOptions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.stunting.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul'              => 'required|string|max:255',
            'balita_normal'      => 'required|integer|min:0',
            'balita_stunting'    => 'required|integer|min:0',
            'balita_kurus'       => 'required|integer|min:0',
            'balita_gemuk'       => 'required|integer|min:0',
            'tahun'              => 'required|integer|min:2020|max:2030',
            'keterangan'         => 'nullable|string',
            'gambar'             => 'nullable|mimes:jpg,png,jpeg|max:2048',
            'tampil_infografis'  => 'boolean',
            'warna_chart'        => 'nullable|string|max:7'
        ], [
            'judul.required'           => 'Judul wajib diisi!',
            'balita_normal.required'   => 'Jumlah balita normal wajib diisi!',
            'balita_stunting.required' => 'Jumlah balita stunting wajib diisi!',
            'balita_kurus.required'    => 'Jumlah balita kurus wajib diisi!',
            'balita_gemuk.required'    => 'Jumlah balita gemuk wajib diisi!',
            'tahun.required'           => 'Tahun wajib diisi!',
            'gambar.mimes'             => 'Format gambar yang diizinkan: png, jpg, jpeg!',
            'gambar.max'               => 'Ukuran gambar maksimal 2MB!'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                           ->withErrors($validator)
                           ->withInput();
        }

        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        $data['tampil_infografis'] = $request->has('tampil_infografis');

        // Handle gambar upload
        if ($request->hasFile('gambar')) {
            $path = 'img-stunting/';
            $file = $request->file('gambar');
            $extension = $file->getClientOriginalExtension();
            $fileName = uniqid() . '.' . $extension;
            $data['gambar'] = $file->storeAs($path, $fileName, 'public');
        }

        Stunting::create($data);

        return redirect()->route('admin.stunting.index')
                       ->with('success', 'Data stunting berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $stunting = Stunting::findOrFail($id);
        return view('admin.stunting.edit', compact('stunting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $stunting = Stunting::findOrFail($id);
        
        $validator = Validator::make($request->all(), [
            'judul'              => 'required|string|max:255',
            'balita_normal'      => 'required|integer|min:0',
            'balita_stunting'    => 'required|integer|min:0',
            'balita_kurus'       => 'required|integer|min:0',
            'balita_gemuk'       => 'required|integer|min:0',
            'tahun'              => 'required|integer|min:2020|max:2030',
            'keterangan'         => 'nullable|string',
            'gambar'             => 'nullable|mimes:jpg,png,jpeg|max:2048',
            'tampil_infografis'  => 'boolean',
            'warna_chart'        => 'nullable|string|max:7'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                           ->withErrors($validator)
                           ->withInput();
        }

        $data = $request->all();
        $data['tampil_infografis'] = $request->has('tampil_infografis');

        // Handle gambar upload
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($stunting->gambar && Storage::disk('public')->exists($stunting->gambar)) {
                Storage::disk('public')->delete($stunting->gambar);
            }

            $path = 'img-stunting/';
            $file = $request->file('gambar');
            $extension = $file->getClientOriginalExtension();
            $fileName = uniqid() . '.' . $extension;
            $data['gambar'] = $file->storeAs($path, $fileName, 'public');
        }

        $stunting->update($data);

        return redirect()->route('admin.stunting.index')
                       ->with('success', 'Data stunting berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $stunting = Stunting::findOrFail($id);
        
        // Hapus gambar jika ada
        if ($stunting->gambar && Storage::disk('public')->exists($stunting->gambar)) {
            Storage::disk('public')->delete($stunting->gambar);
        }
        
        $stunting->delete();

        return redirect()->route('admin.stunting.index')
                       ->with('success', 'Data stunting berhasil dihapus!');
    }
}
