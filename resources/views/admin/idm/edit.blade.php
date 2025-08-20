@extends('admin.layouts.main')

@section('content')
<div class="row">
    <div class="col-lg-12 d-flex align-items-strech">
        <div class="card w-100">
            <div class="card-header bg-warning">
                <div class="row align-items-center">
                    <div class="col-6">
                        <h5 class="card-title fw-semibold text-dark">
                            <i class="fas fa-edit me-2"></i>Edit Data IDM Tahun {{ $idm->tahun }}
                        </h5>
                    </div>
                    <div class="col-6 text-right">
                        <a href="{{ route('admin.idm.index') }}" type="button" class="btn btn-secondary float-end">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.idm.update', $idm->id) }}">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <!-- Kolom Kiri -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="tahun" class="form-label">Tahun <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('tahun') is-invalid @enderror" 
                                       name="tahun" id="tahun" value="{{ old('tahun', $idm->tahun) }}" 
                                       min="2000" max="{{ date('Y') + 5 }}">
                                @error('tahun')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="skor_idm" class="form-label">Skor IDM <span class="text-danger">*</span></label>
                                <input type="number" step="0.0001" min="0" max="1" 
                                       class="form-control @error('skor_idm') is-invalid @enderror" 
                                       name="skor_idm" id="skor_idm" value="{{ old('skor_idm', $idm->skor_idm) }}" 
                                       placeholder="0.0000">
                                @error('skor_idm')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="status_idm" class="form-label">Status IDM <span class="text-danger">*</span></label>
                                <select class="form-control @error('status_idm') is-invalid @enderror" name="status_idm" id="status_idm">
                                    <option value="">-- Pilih Status --</option>
                                    <option value="MANDIRI" {{ old('status_idm', $idm->status_idm) == 'MANDIRI' ? 'selected' : '' }}>MANDIRI</option>
                                    <option value="MAJU" {{ old('status_idm', $idm->status_idm) == 'MAJU' ? 'selected' : '' }}>MAJU</option>
                                    <option value="BERKEMBANG" {{ old('status_idm', $idm->status_idm) == 'BERKEMBANG' ? 'selected' : '' }}>BERKEMBANG</option>
                                    <option value="TERTINGGAL" {{ old('status_idm', $idm->status_idm) == 'TERTINGGAL' ? 'selected' : '' }}>TERTINGGAL</option>
                                </select>
                                @error('status_idm')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="target_status" class="form-label">Target Status <span class="text-danger">*</span></label>
                                <select class="form-control @error('target_status') is-invalid @enderror" name="target_status" id="target_status">
                                    <option value="">-- Pilih Target --</option>
                                    <option value="MANDIRI" {{ old('target_status', $idm->target_status) == 'MANDIRI' ? 'selected' : '' }}>MANDIRI</option>
                                    <option value="MAJU" {{ old('target_status', $idm->target_status) == 'MAJU' ? 'selected' : '' }}>MAJU</option>
                                    <option value="BERKEMBANG" {{ old('target_status', $idm->target_status) == 'BERKEMBANG' ? 'selected' : '' }}>BERKEMBANG</option>
                                </select>
                                @error('target_status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="skor_minimal" class="form-label">Skor Minimal <span class="text-danger">*</span></label>
                                <input type="number" step="0.0001" min="0" max="1" 
                                       class="form-control @error('skor_minimal') is-invalid @enderror" 
                                       name="skor_minimal" id="skor_minimal" value="{{ old('skor_minimal', $idm->skor_minimal) }}" 
                                       placeholder="0.0000">
                                @error('skor_minimal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="penambahan" class="form-label">Penambahan <span class="text-danger">*</span></label>
                                <input type="number" step="0.0001" 
                                       class="form-control @error('penambahan') is-invalid @enderror" 
                                       name="penambahan" id="penambahan" value="{{ old('penambahan', $idm->penambahan) }}" 
                                       placeholder="0.0000">
                                @error('penambahan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Kolom Kanan -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="skor_iks" class="form-label">Skor IKS <span class="text-danger">*</span></label>
                                <input type="number" step="0.0001" min="0" max="1" 
                                       class="form-control @error('skor_iks') is-invalid @enderror" 
                                       name="skor_iks" id="skor_iks" value="{{ old('skor_iks', $idm->skor_iks) }}" 
                                       placeholder="0.0000">
                                <small class="text-muted">Indeks Ketahanan Sosial</small>
                                @error('skor_iks')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="skor_ike" class="form-label">Skor IKE <span class="text-danger">*</span></label>
                                <input type="number" step="0.0001" min="0" max="1" 
                                       class="form-control @error('skor_ike') is-invalid @enderror" 
                                       name="skor_ike" id="skor_ike" value="{{ old('skor_ike', $idm->skor_ike) }}" 
                                       placeholder="0.0000">
                                <small class="text-muted">Indeks Ketahanan Ekonomi</small>
                                @error('skor_ike')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="skor_ikl" class="form-label">Skor IKL <span class="text-danger">*</span></label>
                                <input type="number" step="0.0001" min="0" max="1" 
                                       class="form-control @error('skor_ikl') is-invalid @enderror" 
                                       name="skor_ikl" id="skor_ikl" value="{{ old('skor_ikl', $idm->skor_ikl) }}" 
                                       placeholder="0.0000">
                                <small class="text-muted">Indeks Ketahanan Lingkungan</small>
                                @error('skor_ikl')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                          name="deskripsi" id="deskripsi" rows="4" 
                                          placeholder="Deskripsi tambahan tentang data IDM tahun ini...">{{ old('deskripsi', $idm->deskripsi) }}</textarea>
                                @error('deskripsi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="is_active" id="is_active" 
                                           value="1" {{ old('is_active', $idm->is_active) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_active">
                                        <strong>Aktifkan sebagai data terbaru</strong>
                                    </label>
                                </div>
                                <small class="text-muted">Data yang aktif akan ditampilkan di halaman publik</small>
                                @if($idm->is_active)
                                    <div class="alert alert-info mt-2 py-2">
                                        <i class="fas fa-info-circle me-1"></i>
                                        <small>Data ini sedang aktif dan ditampilkan di halaman publik</small>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-12">
                            <button type="submit" class="btn btn-warning text-dark">
                                <i class="fas fa-save me-2"></i>Update Data
                            </button>
                            <a href="{{ route('admin.idm.show', $idm->id) }}" class="btn btn-info">
                                <i class="fas fa-eye me-2"></i>Lihat Detail
                            </a>
                            <a href="{{ route('admin.idm.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times me-2"></i>Batal
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// Auto calculate penambahan
document.addEventListener('DOMContentLoaded', function() {
    const skorIdm = document.getElementById('skor_idm');
    const skorMinimal = document.getElementById('skor_minimal');
    const penambahan = document.getElementById('penambahan');
    
    function calculatePenambahan() {
        const idm = parseFloat(skorIdm.value) || 0;
        const minimal = parseFloat(skorMinimal.value) || 0;
        const result = Math.max(0, minimal - idm);
        penambahan.value = result.toFixed(4);
    }
    
    skorIdm.addEventListener('input', calculatePenambahan);
    skorMinimal.addEventListener('input', calculatePenambahan);
});
</script>
@endsection
