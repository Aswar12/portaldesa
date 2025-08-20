@extends('admin.layouts.main')

@section('content')
<div class="card bg-light-info shadow-none position-relative overflow-hidden">
    <div class="card-body px-4 py-3">
        <div class="row align-items-center">
            <div class="col-9">
                <h4 class="fw-semibold mb-8">Edit Data SDGS</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a class="text-muted text-decoration-none" href="/admin">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a class="text-muted text-decoration-none" href="{{ route('sdgs.index') }}">SDGS</a>
                        </li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </nav>
            </div>
            <div class="col-3">
                <div class="text-center mb-n5">
                    <img src="/admin/assets/images/breadcrumb/ChatBc.png" alt="" class="img-fluid mb-n4" />
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="card-title fw-semibold">Form Edit SDGS - {{ $sdgs->tahun }}</h5>
            <div class="badge bg-info fs-3">
                Skor: {{ number_format($sdgs->skor_rata_rata, 2) }} | Status: {{ $sdgs->status }}
            </div>
        </div>
        
        <form action="{{ route('sdgs.update', $sdgs) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="tahun" class="form-label">Tahun <span class="text-danger">*</span></label>
                        <input type="number" 
                               class="form-control @error('tahun') is-invalid @enderror" 
                               id="tahun" 
                               name="tahun" 
                               value="{{ old('tahun', $sdgs->tahun) }}" 
                               min="2020" 
                               max="2030" 
                               required>
                        @error('tahun')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="infografis" class="form-label">Tampilkan di Infografis</label>
                        <div class="form-check form-switch">
                            <input class="form-check-input" 
                                   type="checkbox" 
                                   id="infografis" 
                                   name="infografis" 
                                   value="1" 
                                   {{ old('infografis', $sdgs->infografis) ? 'checked' : '' }}>
                            <label class="form-check-label" for="infografis">
                                Aktifkan untuk menampilkan di halaman infografis
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <h6 class="fw-semibold mb-3 mt-4">Target SDGS (Skor 1-5)</h6>
            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="target_1" class="form-label">
                            Target 1: Tanpa Kemiskinan <span class="text-danger">*</span>
                        </label>
                        <select class="form-select @error('target_1') is-invalid @enderror" 
                                id="target_1" 
                                name="target_1" 
                                required>
                            <option value="">Pilih Skor</option>
                            @for($i = 1; $i <= 5; $i++)
                                <option value="{{ $i }}" {{ old('target_1', $sdgs->target_1) == $i ? 'selected' : '' }}>
                                    {{ $i }} - {{ $i == 1 ? 'Sangat Kurang' : ($i == 2 ? 'Kurang' : ($i == 3 ? 'Sedang' : ($i == 4 ? 'Baik' : 'Sangat Baik'))) }}
                                </option>
                            @endfor
                        </select>
                        @error('target_1')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="target_2" class="form-label">
                            Target 2: Tanpa Kelaparan <span class="text-danger">*</span>
                        </label>
                        <select class="form-select @error('target_2') is-invalid @enderror" 
                                id="target_2" 
                                name="target_2" 
                                required>
                            <option value="">Pilih Skor</option>
                            @for($i = 1; $i <= 5; $i++)
                                <option value="{{ $i }}" {{ old('target_2', $sdgs->target_2) == $i ? 'selected' : '' }}>
                                    {{ $i }} - {{ $i == 1 ? 'Sangat Kurang' : ($i == 2 ? 'Kurang' : ($i == 3 ? 'Sedang' : ($i == 4 ? 'Baik' : 'Sangat Baik'))) }}
                                </option>
                            @endfor
                        </select>
                        @error('target_2')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="target_3" class="form-label">
                            Target 3: Kehidupan Sehat <span class="text-danger">*</span>
                        </label>
                        <select class="form-select @error('target_3') is-invalid @enderror" 
                                id="target_3" 
                                name="target_3" 
                                required>
                            <option value="">Pilih Skor</option>
                            @for($i = 1; $i <= 5; $i++)
                                <option value="{{ $i }}" {{ old('target_3', $sdgs->target_3) == $i ? 'selected' : '' }}>
                                    {{ $i }} - {{ $i == 1 ? 'Sangat Kurang' : ($i == 2 ? 'Kurang' : ($i == 3 ? 'Sedang' : ($i == 4 ? 'Baik' : 'Sangat Baik'))) }}
                                </option>
                            @endfor
                        </select>
                        @error('target_3')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="target_4" class="form-label">
                            Target 4: Pendidikan Berkualitas <span class="text-danger">*</span>
                        </label>
                        <select class="form-select @error('target_4') is-invalid @enderror" 
                                id="target_4" 
                                name="target_4" 
                                required>
                            <option value="">Pilih Skor</option>
                            @for($i = 1; $i <= 5; $i++)
                                <option value="{{ $i }}" {{ old('target_4', $sdgs->target_4) == $i ? 'selected' : '' }}>
                                    {{ $i }} - {{ $i == 1 ? 'Sangat Kurang' : ($i == 2 ? 'Kurang' : ($i == 3 ? 'Sedang' : ($i == 4 ? 'Baik' : 'Sangat Baik'))) }}
                                </option>
                            @endfor
                        </select>
                        @error('target_4')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="target_5" class="form-label">
                            Target 5: Kesetaraan Gender <span class="text-danger">*</span>
                        </label>
                        <select class="form-select @error('target_5') is-invalid @enderror" 
                                id="target_5" 
                                name="target_5" 
                                required>
                            <option value="">Pilih Skor</option>
                            @for($i = 1; $i <= 5; $i++)
                                <option value="{{ $i }}" {{ old('target_5', $sdgs->target_5) == $i ? 'selected' : '' }}>
                                    {{ $i }} - {{ $i == 1 ? 'Sangat Kurang' : ($i == 2 ? 'Kurang' : ($i == 3 ? 'Sedang' : ($i == 4 ? 'Baik' : 'Sangat Baik'))) }}
                                </option>
                            @endfor
                        </select>
                        @error('target_5')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="catatan" class="form-label">Catatan</label>
                <textarea class="form-control @error('catatan') is-invalid @enderror" 
                          id="catatan" 
                          name="catatan" 
                          rows="3" 
                          placeholder="Catatan atau keterangan tambahan...">{{ old('catatan', $sdgs->catatan) }}</textarea>
                @error('catatan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex gap-2 justify-content-end">
                <a href="{{ route('sdgs.index') }}" class="btn btn-secondary">
                    <i class="ti ti-arrow-left me-1"></i>Kembali
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="ti ti-device-floppy me-1"></i>Update
                </button>
            </div>
        </form>
    </div>
</div>

<script>
// Realtime calculation preview
function updatePreview() {
    const targets = [1,2,3,4,5].map(i => {
        const val = document.getElementById(`target_${i}`).value;
        return val ? parseInt(val) : 0;
    });
    
    const total = targets.reduce((a, b) => a + b, 0);
    const avg = targets.filter(t => t > 0).length === 5 ? total / 5 : 0;
    
    if(avg > 0) {
        let status = avg >= 4.5 ? 'Sangat Baik' : (avg >= 3.5 ? 'Baik' : (avg >= 2.5 ? 'Sedang' : 'Kurang'));
        console.log(`Preview: Rata-rata ${avg.toFixed(2)} - Status: ${status}`);
    }
}

// Add event listeners
document.addEventListener('DOMContentLoaded', function() {
    [1,2,3,4,5].forEach(i => {
        document.getElementById(`target_${i}`).addEventListener('change', updatePreview);
    });
});
</script>
@endsection
