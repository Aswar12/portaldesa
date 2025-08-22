@extends('admin.layouts.main')

@section('content')
    <div class="row">
        <div class="col-lg-12 d-flex align-items-strech">
            <div class="card w-100">
                <div class="card-header bg-primary">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <h5 class="card-title fw-semibold text-white">Edit Data SDGS - {{ $sdgs->tahun }}</h5>
                        </div>
                        <div class="col-6 text-right">
                            <a href="{{ route('admin.sdgs.index') }}" type="button" class="btn btn-warning float-end">
                                <i class="fas fa-arrow-left me-2"></i>Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <form method="POST" action="{{ route('admin.sdgs.update', $sdgs) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            @if (session()->has('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            <div class="alert alert-info">
                                <i class="fas fa-info-circle me-2"></i>
                                <strong>Data Saat Ini:</strong> Skor Rata-rata {{ number_format($sdgs->skor_rata_rata, 2) }} - Status Infografis: {{ ($sdgs->infografis ?? $sdgs->tampil_infografis) ? 'Aktif' : 'Tidak Aktif' }}
                            </div>

                            <div class="mb-3">
                                <label for="tahun" class="form-label">Tahun <span style="color: red">*</span></label>
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
                            
                            <div class="mb-3">
                                <label for="judul" class="form-label">Judul/Nama Program</label>
                                <input type="text" class="form-control @error('judul') is-invalid @enderror" 
                                       name="judul" id="judul" value="{{ old('judul', $sdgs->judul) }}" 
                                       placeholder="Masukkan judul program SDGS">
                                @error('judul')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <h6 class="fw-semibold mb-3 mt-4">Target SDGS (Skor 1-5)</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="target_1" class="form-label">
                                            Target 1: Tanpa Kemiskinan <span style="color: red">*</span>
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

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="target_2" class="form-label">
                                            Target 2: Tanpa Kelaparan <span style="color: red">*</span>
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

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="target_3" class="form-label">
                                            Target 3: Kehidupan Sehat <span style="color: red">*</span>
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

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="target_4" class="form-label">
                                            Target 4: Pendidikan Berkualitas <span style="color: red">*</span>
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

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="target_5" class="form-label">
                                            Target 5: Kesetaraan Gender <span style="color: red">*</span>
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
                                <label for="keterangan" class="form-label">Catatan/Keterangan</label>
                                <textarea class="form-control @error('keterangan') is-invalid @enderror" 
                                          id="keterangan" 
                                          name="keterangan" 
                                          rows="3" 
                                          placeholder="Catatan atau keterangan tambahan...">{{ old('keterangan', $sdgs->keterangan) }}</textarea>
                                @error('keterangan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title fw-semibold">Pengaturan Lainnya</h6>
                            
                            <div class="mb-3">
                                <label for="gambar" class="form-label">Gambar/Foto</label>
                                <input type="file" class="form-control @error('gambar') is-invalid @enderror" 
                                       name="gambar" id="gambar" accept="image/*">
                                <small class="text-muted">Format: JPG, PNG, JPEG. Maksimal 2MB</small>
                                @if($sdgs->gambar)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/' . $sdgs->gambar) }}" alt="Current" class="img-thumbnail" width="100">
                                    </div>
                                @endif
                                @error('gambar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" 
                                           type="checkbox" 
                                           id="infografis" 
                                           name="infografis" 
                                           value="1" 
                                           {{ old('infografis', $sdgs->infografis ?? $sdgs->tampil_infografis) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="infografis">
                                        <strong>Tampilkan di Infografis</strong><br>
                                        <small class="text-muted">Aktifkan untuk menampilkan di halaman infografis publik</small>
                                    </label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="warna_chart" class="form-label">Warna Chart</label>
                                <input type="color" class="form-control form-control-color @error('warna_chart') is-invalid @enderror" 
                                       id="warna_chart" name="warna_chart" value="{{ old('warna_chart', $sdgs->warna_chart ?? '#6f42c1') }}">
                                @error('warna_chart')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-2"></i>Update Data
                                </button>
                                <a href="{{ route('admin.sdgs.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-times me-2"></i>Batal
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Preview Card -->
                    <div class="card mt-3">
                        <div class="card-body">
                            <h6 class="card-title">Preview Skor</h6>
                            <div id="previewContent">
                                <div class="text-center">
                                    <div class="display-6 fw-bold text-primary" id="avgScore">{{ number_format($sdgs->skor_rata_rata, 2) }}</div>
                                    <small class="text-muted">Rata-rata</small>
                                    <div class="mt-2">
                                        @php
                                            $currentStatus = $sdgs->skor_rata_rata >= 4.5 ? 'Sangat Baik' : ($sdgs->skor_rata_rata >= 3.5 ? 'Baik' : ($sdgs->skor_rata_rata >= 2.5 ? 'Sedang' : 'Kurang'));
                                            $badgeClass = $sdgs->skor_rata_rata >= 4.5 ? 'bg-success' : ($sdgs->skor_rata_rata >= 3.5 ? 'bg-primary' : ($sdgs->skor_rata_rata >= 2.5 ? 'bg-warning' : 'bg-danger'));
                                        @endphp
                                        <span class="badge {{ $badgeClass }}" id="statusBadge">{{ $currentStatus }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

<script>
// Realtime calculation preview
function updatePreview() {
    const targets = [1,2,3,4,5].map(i => {
        const element = document.getElementById(`target_${i}`);
        const val = element ? element.value : '';
        return val ? parseInt(val) : 0;
    });
    
    const validTargets = targets.filter(t => t > 0);
    const total = validTargets.reduce((a, b) => a + b, 0);
    const avg = validTargets.length > 0 ? total / validTargets.length : 0;
    
    const avgScore = document.getElementById('avgScore');
    const statusBadge = document.getElementById('statusBadge');
    
    if(avgScore && statusBadge && avg > 0) {
        avgScore.textContent = avg.toFixed(2);
        
        let status, badgeClass;
        if (avg >= 4.5) {
            status = 'Sangat Baik';
            badgeClass = 'bg-success';
        } else if (avg >= 3.5) {
            status = 'Baik';
            badgeClass = 'bg-primary';
        } else if (avg >= 2.5) {
            status = 'Sedang';
            badgeClass = 'bg-warning';
        } else {
            status = 'Kurang';
            badgeClass = 'bg-danger';
        }
        
        statusBadge.className = `badge ${badgeClass}`;
        statusBadge.textContent = status;
    }
}

// Add event listeners
document.addEventListener('DOMContentLoaded', function() {
    [1,2,3,4,5].forEach(i => {
        const element = document.getElementById(`target_${i}`);
        if(element) {
            element.addEventListener('change', updatePreview);
        }
    });
});
</script>
@endsection
