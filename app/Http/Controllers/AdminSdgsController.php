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
            'judul'                => 'nullable|string|max:255',
            'target_1'            => 'required|integer|min:1|max:5',
            'target_2'            => 'required|integer|min:1|max:5', 
            'target_3'            => 'required|integer|min:1|max:5',
            'target_4'            => 'required|integer|min:1|max:5',
            'target_5'            => 'required|integer|min:1|max:5',
            'tahun'               => 'required|integer|min:2020|max:2030',
            'keterangan'          => 'nullable|string',
            'gambar'              => 'nullable|mimes:jpg,png,jpeg|max:2048',
            'infografis'          => 'boolean',
            'warna_chart'         => 'nullable|string|max:7'
        ], [
            'target_1.required'   => 'Target 1 wajib diisi!',
            'target_2.required'   => 'Target 2 wajib diisi!',
            'target_3.required'   => 'Target 3 wajib diisi!',
            'target_4.required'   => 'Target 4 wajib diisi!',
            'target_5.required'   => 'Target 5 wajib diisi!',
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
        $data['tampil_infografis'] = $request->has('infografis');
        
        // Hitung skor rata-rata dari target yang dipilih
        $targets = [
            $data['target_1'] ?? 0,
            $data['target_2'] ?? 0,
            $data['target_3'] ?? 0,
            $data['target_4'] ?? 0,
            $data['target_5'] ?? 0
        ];
        $validTargets = array_filter($targets);
        $data['skor_rata_rata'] = count($validTargets) > 0 ? array_sum($validTargets) / count($validTargets) : 0;

        // Set skor individual sama dengan target
        $data['skor_1'] = $data['target_1'] ?? 0;
        $data['skor_2'] = $data['target_2'] ?? 0;
        $data['skor_3'] = $data['target_3'] ?? 0;
        $data['skor_4'] = $data['target_4'] ?? 0;
        $data['skor_5'] = $data['target_5'] ?? 0;

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
            'judul'                => 'nullable|string|max:255',
            'target_1'            => 'required|integer|min:1|max:5',
            'target_2'            => 'required|integer|min:1|max:5', 
            'target_3'            => 'required|integer|min:1|max:5',
            'target_4'            => 'required|integer|min:1|max:5',
            'target_5'            => 'required|integer|min:1|max:5',
            'tahun'               => 'required|integer|min:2020|max:2030',
            'keterangan'          => 'nullable|string',
            'gambar'              => 'nullable|mimes:jpg,png,jpeg|max:2048',
            'infografis'          => 'boolean',
            'warna_chart'         => 'nullable|string|max:7'
        ], [
            'target_1.required'   => 'Target 1 wajib diisi!',
            'target_2.required'   => 'Target 2 wajib diisi!',
            'target_3.required'   => 'Target 3 wajib diisi!',
            'target_4.required'   => 'Target 4 wajib diisi!',
            'target_5.required'   => 'Target 5 wajib diisi!',
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
        $data['tampil_infografis'] = $request->has('infografis');
        
        // Hitung skor rata-rata dari target yang dipilih
        $targets = [
            $data['target_1'] ?? 0,
            $data['target_2'] ?? 0,
            $data['target_3'] ?? 0,
            $data['target_4'] ?? 0,
            $data['target_5'] ?? 0
        ];
        $validTargets = array_filter($targets);
        $data['skor_rata_rata'] = count($validTargets) > 0 ? array_sum($validTargets) / count($validTargets) : 0;

        // Set skor individual sama dengan target
        $data['skor_1'] = $data['target_1'] ?? 0;
        $data['skor_2'] = $data['target_2'] ?? 0;
        $data['skor_3'] = $data['target_3'] ?? 0;
        $data['skor_4'] = $data['target_4'] ?? 0;
        $data['skor_5'] = $data['target_5'] ?? 0;

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
