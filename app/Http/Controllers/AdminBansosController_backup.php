<?php

namespace App\Http\Controllers;

use App\Models\Bansos;
use Illuminate\Http\Request;        $data = $request->all();
        $data['tampil_infografis'] = $request->has('tampil_infografis');
        $data['user_id'] = auth()->id();

        // Handle gambar upload
        if ($request->hasFile('gambar')) {
            $path = 'img-bansos/';
            $file = $request->file('gambar');
            $extension = $file->getClientOriginalExtension();
            $fileName = uniqid() . '.' . $extension;
            $data['gambar'] = $file->storeAs($path, $fileName, 'public');
        }

        Bansos::create($data);p\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminBansosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Bansos::query();
        
        // Filter berdasarkan tahun jika ada
        if ($request->tahun) {
            $query->where('tahun', $request->tahun);
        }
        
        // Filter berdasarkan jenis bansos
        if ($request->jenis_bansos) {
            $query->where('jenis_bansos', $request->jenis_bansos);
        }
        
        $bansos = $query->orderBy('tahun', 'DESC')
                       ->orderBy('id', 'DESC')
                       ->get();
        
        // Data untuk dropdown filter
        $tahunOptions = Bansos::select('tahun')
                             ->distinct()
                             ->orderBy('tahun', 'DESC')
                             ->pluck('tahun');
                             
        $jenisBansosOptions = ['PKH', 'BPNT', 'BST', 'PBI', 'Sembako', 'BLT'];
        
        return view('admin.bansos.index', compact('bansos', 'tahunOptions', 'jenisBansosOptions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jenisBansosOptions = [
            'PKH' => 'Program Keluarga Harapan (PKH)',
            'BPNT' => 'Bantuan Pangan Non Tunai (BPNT)', 
            'BST' => 'Bantuan Sosial Tunai (BST)',
            'PBI' => 'Penerima Bantuan Iuran (PBI)',
            'Sembako' => 'Bantuan Sembako',
            'BLT' => 'Bantuan Langsung Tunai (BLT)'
        ];
        
        return view('admin.bansos.create', compact('jenisBansosOptions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul'              => 'required|string|max:255',
            'jenis_bansos'       => 'required|string|max:50',
            'jumlah_penerima'    => 'required|integer|min:0',
            'jumlah_dana'        => 'required|numeric|min:0',
            'periode_mulai'      => 'required|date',
            'periode_selesai'    => 'nullable|date|after_or_equal:periode_mulai',
            'tahun'              => 'required|integer|min:2020|max:2030',
            'keterangan'         => 'nullable|string',
            'gambar'             => 'nullable|mimes:jpg,png,jpeg|max:2048',
            'tampil_infografis'  => 'boolean',
            'warna_chart'        => 'nullable|string|max:7'
        ], [
            'judul.required'           => 'Judul wajib diisi!',
            'jenis_bansos.required'    => 'Jenis bansos wajib dipilih!',
            'jumlah_penerima.required' => 'Jumlah penerima wajib diisi!',
            'jumlah_dana.required'     => 'Jumlah dana wajib diisi!',
            'periode_mulai.required'   => 'Periode mulai wajib diisi!',
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
            $path = 'img-bansos/';
            $file = $request->file('gambar');
            $extension = $file->getClientOriginalExtension();
            $fileName = uniqid() . '.' . $extension;
            $data['gambar'] = $file->storeAs($path, $fileName, 'public');
        }

        Bansos::create($data);

        return redirect()->route('admin.bansos.index')
                       ->with('success', 'Data bansos berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $bansos = Bansos::findOrFail($id);
        
        $jenisBansosOptions = [
            'PKH' => 'Program Keluarga Harapan (PKH)',
            'BPNT' => 'Bantuan Pangan Non Tunai (BPNT)', 
            'BST' => 'Bantuan Sosial Tunai (BST)',
            'PBI' => 'Penerima Bantuan Iuran (PBI)',
            'Sembako' => 'Bantuan Sembako',
            'BLT' => 'Bantuan Langsung Tunai (BLT)'
        ];
        
        return view('admin.bansos.edit', compact('bansos', 'jenisBansosOptions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $bansos = Bansos::findOrFail($id);
        
        $validator = Validator::make($request->all(), [
            'judul'              => 'required|string|max:255',
            'jenis_bansos'       => 'required|string|max:50',
            'jumlah_penerima'    => 'required|integer|min:0',
            'jumlah_dana'        => 'required|numeric|min:0',
            'periode_mulai'      => 'required|date',
            'periode_selesai'    => 'nullable|date|after_or_equal:periode_mulai',
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
            if ($bansos->gambar && Storage::disk('public')->exists($bansos->gambar)) {
                Storage::disk('public')->delete($bansos->gambar);
            }

            $path = 'img-bansos/';
            $file = $request->file('gambar');
            $extension = $file->getClientOriginalExtension();
            $fileName = uniqid() . '.' . $extension;
            $data['gambar'] = $file->storeAs($path, $fileName, 'public');
        }

        $bansos->update($data);

        return redirect()->route('admin.bansos.index')
                       ->with('success', 'Data bansos berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $bansos = Bansos::findOrFail($id);
        
        // Hapus gambar jika ada
        if ($bansos->gambar && Storage::disk('public')->exists($bansos->gambar)) {
            Storage::disk('public')->delete($bansos->gambar);
        }
        
        $bansos->delete();

        return redirect()->route('admin.bansos.index')
                       ->with('success', 'Data bansos berhasil dihapus!');
    }
}
