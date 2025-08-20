<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Anggaran;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Cviebrock\EloquentSluggable\Services\SlugService;

class AdminAnggaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Anggaran::query();
        
        // Filter berdasarkan tahun jika ada
        if ($request->tahun) {
            $query->where('tahun_anggaran', $request->tahun);
        }
        
        // Filter berdasarkan jenis jika ada
        if ($request->jenis) {
            $query->where('jenis', $request->jenis);
        }
        
        $anggarans = $query->orderBy('tahun_anggaran', 'DESC')
                          ->orderBy('jenis', 'ASC')
                          ->orderBy('id', 'DESC')
                          ->get();
        
        // Data untuk dropdown filter
        $tahunOptions = Anggaran::select('tahun_anggaran')
                              ->distinct()
                              ->orderBy('tahun_anggaran', 'DESC')
                              ->pluck('tahun_anggaran');
        
        $jenisOptions = ['pendapatan', 'belanja', 'pembiayaan'];
        
        return view('admin.apbdes.index', compact('anggarans', 'tahunOptions', 'jenisOptions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jenisOptions = [
            'pendapatan' => 'Pendapatan',
            'belanja' => 'Belanja',
            'pembiayaan' => 'Pembiayaan'
        ];
        
        return view('admin.apbdes.create', compact('jenisOptions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul'         => 'required|string|max:255',
            'slug'          => 'required|unique:anggarans,slug',
            'keterangan'    => 'required',
            'jenis'         => 'required|in:pendapatan,belanja,pembiayaan',
            'jumlah'        => 'required|numeric|min:0',
            'realisasi'     => 'nullable|numeric|min:0',
            'tahun_anggaran'=> 'required|integer|min:2020|max:2030',
            'kategori'      => 'nullable|string|max:255',
            'deskripsi'     => 'nullable|string',
            'gambar'        => 'nullable|mimes:jpg,png,jpeg|max:2048'
        ], [
            'judul.required'        => 'Judul wajib diisi!',
            'slug.required'         => 'Slug tidak boleh kosong!',
            'slug.unique'           => 'Slug sudah digunakan!',
            'jenis.required'        => 'Jenis anggaran wajib dipilih!',
            'jenis.in'              => 'Jenis anggaran tidak valid!',
            'jumlah.required'       => 'Jumlah anggaran wajib diisi!',
            'jumlah.numeric'        => 'Jumlah anggaran harus berupa angka!',
            'realisasi.numeric'     => 'Realisasi harus berupa angka!',
            'tahun_anggaran.required' => 'Tahun anggaran wajib diisi!',
            'tahun_anggaran.integer'  => 'Tahun anggaran harus berupa angka!',
            'gambar.mimes'          => 'Format gambar yang diizinkan: png, jpg, jpeg!',
            'gambar.max'            => 'Ukuran gambar maksimal 2MB!',
            'keterangan.required'   => 'Keterangan wajib diisi!'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                           ->withErrors($validator)
                           ->withInput();
        }

        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        $data['realisasi'] = $data['realisasi'] ?? 0;

        // Handle gambar upload
        if ($request->hasFile('gambar')) {
            $path = 'img-anggaran/';
            $file = $request->file('gambar');
            $extension = $file->getClientOriginalExtension();
            $fileName = uniqid() . '.' . $extension;
            $data['gambar'] = $file->storeAs($path, $fileName, 'public');
        }

        Anggaran::create($data);

        return redirect()->route('admin.apbdes.index')
                       ->with('success', 'Data anggaran berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $anggaran = Anggaran::findOrFail($id);
        
        $jenisOptions = [
            'pendapatan' => 'Pendapatan',
            'belanja' => 'Belanja',
            'pembiayaan' => 'Pembiayaan'
        ];
        
        return view('admin.apbdes.edit', compact('anggaran', 'jenisOptions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $anggaran = Anggaran::findOrFail($id);
        
        $validator = Validator::make($request->all(), [
            'judul'         => 'required|string|max:255',
            'slug'          => 'required|unique:anggarans,slug,' . $id,
            'keterangan'    => 'required',
            'jenis'         => 'required|in:pendapatan,belanja,pembiayaan',
            'jumlah'        => 'required|numeric|min:0',
            'realisasi'     => 'nullable|numeric|min:0',
            'tahun_anggaran'=> 'required|integer|min:2020|max:2030',
            'kategori'      => 'nullable|string|max:255',
            'deskripsi'     => 'nullable|string',
            'gambar'        => 'nullable|mimes:jpg,png,jpeg|max:2048'
        ], [
            'judul.required'        => 'Judul wajib diisi!',
            'slug.required'         => 'Slug tidak boleh kosong!',
            'slug.unique'           => 'Slug sudah digunakan!',
            'jenis.required'        => 'Jenis anggaran wajib dipilih!',
            'jenis.in'              => 'Jenis anggaran tidak valid!',
            'jumlah.required'       => 'Jumlah anggaran wajib diisi!',
            'jumlah.numeric'        => 'Jumlah anggaran harus berupa angka!',
            'realisasi.numeric'     => 'Realisasi harus berupa angka!',
            'tahun_anggaran.required' => 'Tahun anggaran wajib diisi!',
            'tahun_anggaran.integer'  => 'Tahun anggaran harus berupa angka!',
            'gambar.mimes'          => 'Format gambar yang diizinkan: png, jpg, jpeg!',
            'gambar.max'            => 'Ukuran gambar maksimal 2MB!',
            'keterangan.required'   => 'Keterangan wajib diisi!'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                           ->withErrors($validator)
                           ->withInput();
        }

        $data = $request->all();
        $data['realisasi'] = $data['realisasi'] ?? 0;

        // Handle gambar upload
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($anggaran->gambar && Storage::disk('public')->exists($anggaran->gambar)) {
                Storage::disk('public')->delete($anggaran->gambar);
            }

            $path = 'img-anggaran/';
            $file = $request->file('gambar');
            $extension = $file->getClientOriginalExtension();
            $fileName = uniqid() . '.' . $extension;
            $data['gambar'] = $file->storeAs($path, $fileName, 'public');
        }

        $anggaran->update($data);

        return redirect()->route('admin.apbdes.index')
                       ->with('success', 'Data anggaran berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $anggaran = Anggaran::findOrFail($id);
        
        // Hapus gambar jika ada
        if ($anggaran->gambar && Storage::disk('public')->exists($anggaran->gambar)) {
            Storage::disk('public')->delete($anggaran->gambar);
        }
        
        $anggaran->delete();

        return redirect()->route('admin.apbdes.index')
                       ->with('success', 'Data anggaran berhasil dihapus!');
    }

    /**
     * Generate slug for anggaran
     */
    public function slug(Request $request)
    {
        $slug = SlugService::createSlug(Anggaran::class, 'slug', $request->judul);
        return response()->json(['slug' => $slug]);
    }
}
