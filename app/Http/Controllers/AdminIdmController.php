<?php

namespace App\Http\Controllers;

use App\Models\Idm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminIdmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $idms = Idm::orderBy('tahun', 'desc')->get();
        return view('admin.idm.index', compact('idms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.idm.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tahun' => 'required|integer|unique:idms,tahun',
            'skor_idm' => 'required|numeric|between:0,1',
            'status_idm' => 'required|string',
            'target_status' => 'required|string',
            'skor_minimal' => 'required|numeric|between:0,1',
            'penambahan' => 'required|numeric',
            'skor_iks' => 'required|numeric|between:0,1',
            'skor_ike' => 'required|numeric|between:0,1',
            'skor_ikl' => 'required|numeric|between:0,1',
            'deskripsi' => 'nullable|string',
            'is_active' => 'boolean'
        ], [
            'tahun.required' => 'Tahun wajib diisi',
            'tahun.unique' => 'Data IDM untuk tahun ini sudah ada',
            'skor_idm.required' => 'Skor IDM wajib diisi',
            'skor_idm.between' => 'Skor IDM harus antara 0 dan 1',
            'status_idm.required' => 'Status IDM wajib diisi',
            'target_status.required' => 'Target status wajib diisi',
            'skor_minimal.required' => 'Skor minimal wajib diisi',
            'penambahan.required' => 'Penambahan wajib diisi',
            'skor_iks.required' => 'Skor IKS wajib diisi',
            'skor_ike.required' => 'Skor IKE wajib diisi',
            'skor_ikl.required' => 'Skor IKL wajib diisi'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Jika status aktif, nonaktifkan yang lain
        if ($request->is_active) {
            Idm::where('is_active', true)->update(['is_active' => false]);
        }

        Idm::create($request->all());

        return redirect()->route('admin.idm.index')
            ->with('success', 'Data IDM berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $idm = Idm::findOrFail($id);
        return view('admin.idm.show', compact('idm'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $idm = Idm::findOrFail($id);
        return view('admin.idm.edit', compact('idm'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $idm = Idm::findOrFail($id);
        
        $validator = Validator::make($request->all(), [
            'tahun' => 'required|integer|unique:idms,tahun,' . $id,
            'skor_idm' => 'required|numeric|between:0,1',
            'status_idm' => 'required|string',
            'target_status' => 'required|string',
            'skor_minimal' => 'required|numeric|between:0,1',
            'penambahan' => 'required|numeric',
            'skor_iks' => 'required|numeric|between:0,1',
            'skor_ike' => 'required|numeric|between:0,1',
            'skor_ikl' => 'required|numeric|between:0,1',
            'deskripsi' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Jika status aktif, nonaktifkan yang lain
        if ($request->is_active) {
            Idm::where('id', '!=', $id)->update(['is_active' => false]);
        }

        $idm->update($request->all());

        return redirect()->route('admin.idm.index')
            ->with('success', 'Data IDM berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $idm = Idm::findOrFail($id);
        $idm->delete();

        return redirect()->route('admin.idm.index')
            ->with('success', 'Data IDM berhasil dihapus');
    }

    /**
     * Toggle active status
     */
    public function toggleActive(string $id)
    {
        $idm = Idm::findOrFail($id);
        
        // Toggle status aktif tanpa menonaktifkan yang lain
        // Admin bisa mengaktifkan beberapa IDM sekaligus
        $idm->update(['is_active' => !$idm->is_active]);

        $status = $idm->is_active ? 'diaktifkan' : 'dinonaktifkan';
        return redirect()->route('admin.idm.index')
            ->with('success', "IDM tahun {$idm->tahun} berhasil {$status}");
    }
}
