<?php

namespace App\Http\Controllers;

use App\Models\Sdgs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminSdgsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Sdgs::query();
        
        // Filter berdasarkan tahun jika ada
        if ($request->tahun) {
            $query->where('tahun', $request->tahun);
        }
        
        $sdgs = $query->orderBy('tahun', 'DESC')
                     ->orderBy('id', 'DESC')
                     ->get();
        
        // Data untuk dropdown filter
        $tahunOptions = Sdgs::select('tahun')
                           ->distinct()
                           ->orderBy('tahun', 'DESC')
                           ->pluck('tahun');
        
        return view('admin.sdgs.index', compact('sdgs', 'tahunOptions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.sdgs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul'                => 'required|string|max:255',
            'target_1'            => 'nullable|string',
            'target_2'            => 'nullable|string', 
            'target_3'            => 'nullable|string',
            'target_4'            => 'nullable|string',
            'target_5'            => 'nullable|string',
            'skor_1'              => 'nullable|numeric|min:0|max:100',
            'skor_2'              => 'nullable|numeric|min:0|max:100',
            'skor_3'              => 'nullable|numeric|min:0|max:100',
            'skor_4'              => 'nullable|numeric|min:0|max:100',
            'skor_5'              => 'nullable|numeric|min:0|max:100',
            'tahun'               => 'required|integer|min:2020|max:2030',
            'keterangan'          => 'nullable|string',
            'gambar'              => 'nullable|mimes:jpg,png,jpeg|max:2048',
            'tampil_infografis'   => 'boolean',
            'warna_chart'         => 'nullable|string|max:7'
        ], [
            'judul.required'      => 'Judul wajib diisi!',
            'tahun.required'      => 'Tahun wajib diisi!',
            'gambar.mimes'        => 'Format gambar yang diizinkan: png, jpg, jpeg!',
            'gambar.max'          => 'Ukuran gambar maksimal 2MB!'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                           ->withErrors($validator)
                           ->withInput();
        }

        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        $data['tampil_infografis'] = $request->has('tampil_infografis');
        
        // Hitung skor rata-rata
        $scores = array_filter([
            $data['skor_1'] ?? 0,
            $data['skor_2'] ?? 0,
            $data['skor_3'] ?? 0,
            $data['skor_4'] ?? 0,
            $data['skor_5'] ?? 0
        ]);
        $data['skor_rata_rata'] = count($scores) > 0 ? array_sum($scores) / count($scores) : 0;

        // Handle gambar upload
        if ($request->hasFile('gambar')) {
            $path = 'img-sdgs/';
            $file = $request->file('gambar');
            $extension = $file->getClientOriginalExtension();
            $fileName = uniqid() . '.' . $extension;
            $data['gambar'] = $file->storeAs($path, $fileName, 'public');
        }

        Sdgs::create($data);

        return redirect()->route('admin.sdgs.index')
                       ->with('success', 'Data SDGS berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $sdgs = Sdgs::findOrFail($id);
        return view('admin.sdgs.edit', compact('sdgs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $sdgs = Sdgs::findOrFail($id);
        
        $validator = Validator::make($request->all(), [
            'judul'                => 'required|string|max:255',
            'target_1'            => 'nullable|string',
            'target_2'            => 'nullable|string', 
            'target_3'            => 'nullable|string',
            'target_4'            => 'nullable|string',
            'target_5'            => 'nullable|string',
            'skor_1'              => 'nullable|numeric|min:0|max:100',
            'skor_2'              => 'nullable|numeric|min:0|max:100',
            'skor_3'              => 'nullable|numeric|min:0|max:100',
            'skor_4'              => 'nullable|numeric|min:0|max:100',
            'skor_5'              => 'nullable|numeric|min:0|max:100',
            'tahun'               => 'required|integer|min:2020|max:2030',
            'keterangan'          => 'nullable|string',
            'gambar'              => 'nullable|mimes:jpg,png,jpeg|max:2048',
            'tampil_infografis'   => 'boolean',
            'warna_chart'         => 'nullable|string|max:7'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                           ->withErrors($validator)
                           ->withInput();
        }

        $data = $request->all();
        $data['tampil_infografis'] = $request->has('tampil_infografis');
        
        // Hitung skor rata-rata
        $scores = array_filter([
            $data['skor_1'] ?? 0,
            $data['skor_2'] ?? 0,
            $data['skor_3'] ?? 0,
            $data['skor_4'] ?? 0,
            $data['skor_5'] ?? 0
        ]);
        $data['skor_rata_rata'] = count($scores) > 0 ? array_sum($scores) / count($scores) : 0;

        // Handle gambar upload
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($sdgs->gambar && Storage::disk('public')->exists($sdgs->gambar)) {
                Storage::disk('public')->delete($sdgs->gambar);
            }

            $path = 'img-sdgs/';
            $file = $request->file('gambar');
            $extension = $file->getClientOriginalExtension();
            $fileName = uniqid() . '.' . $extension;
            $data['gambar'] = $file->storeAs($path, $fileName, 'public');
        }

        $sdgs->update($data);

        return redirect()->route('admin.sdgs.index')
                       ->with('success', 'Data SDGS berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sdgs = Sdgs::findOrFail($id);
        
        // Hapus gambar jika ada
        if ($sdgs->gambar && Storage::disk('public')->exists($sdgs->gambar)) {
            Storage::disk('public')->delete($sdgs->gambar);
        }
        
        $sdgs->delete();

        return redirect()->route('admin.sdgs.index')
                       ->with('success', 'Data SDGS berhasil dihapus!');
    }
}
