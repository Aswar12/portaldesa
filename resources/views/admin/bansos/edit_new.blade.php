@extends('admin.layouts.main')

@section('content')
<div class="card bg-light-info shadow-none position-relative overflow-hidden">
    <div class="card-body px-4 py-3">
        <div class="row align-items-center">
            <div class="col-9">
                <h4 class="fw-semibold mb-8">Edit Data Bansos</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a class="text-muted text-decoration-none" href="/admin">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a class="text-muted text-decoration-none" href="{{ route('admin.bansos.index') }}">Bansos</a>
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
            <h5 class="card-title fw-semibold">Form Edit Bansos - {{ $bansos->judul }}</h5>
            <div class="badge bg-info fs-3">
                Penerima: {{ number_format($bansos->jumlah_penerima) }} | Dana: {{ $bansos->dana_formatted }}
            </div>
        </div>
        
        <form action="{{ route('admin.bansos.update', $bansos) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul Program <span class="text-danger">*</span></label>
                        <input type="text" 
                               class="form-control @error('judul') is-invalid @enderror" 
                               id="judul" 
                               name="judul" 
                               value="{{ old('judul', $bansos->judul) }}" 
                               placeholder="Contoh: Program Bantuan Sosial Tahap 1"
                               required>
                        @error('judul')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="jenis_bansos" class="form-label">Jenis Bantuan Sosial <span class="text-danger">*</span></label>
                        <select class="form-control @error('jenis_bansos') is-invalid @enderror" 
                                id="jenis_bansos" 
                                name="jenis_bansos" 
                                required>
                            <option value="">Pilih Jenis Bantuan Sosial</option>
                            @foreach($jenisBansosOptions as $key => $value)
                                <option value="{{ $key }}" {{ old('jenis_bansos', $bansos->jenis_bansos) == $key ? 'selected' : '' }}>
                                    {{ $value }}
                                </option>
                            @endforeach
                        </select>
                        @error('jenis_bansos')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="tahun" class="form-label">Tahun <span class="text-danger">*</span></label>
                        <select class="form-control @error('tahun') is-invalid @enderror" 
                                id="tahun" 
                                name="tahun" 
                                required>
                            <option value="">Pilih Tahun</option>
                            @for($year = date('Y'); $year >= 2020; $year--)
                                <option value="{{ $year }}" {{ old('tahun', $bansos->tahun) == $year ? 'selected' : '' }}>
                                    {{ $year }}
                                </option>
                            @endfor
                        </select>
                        @error('tahun')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="jumlah_penerima" class="form-label">Jumlah Penerima <span class="text-danger">*</span></label>
                        <input type="number" 
                               class="form-control @error('jumlah_penerima') is-invalid @enderror" 
                               id="jumlah_penerima" 
                               name="jumlah_penerima" 
                               value="{{ old('jumlah_penerima', $bansos->jumlah_penerima) }}" 
                               min="0"
                               required>
                        @error('jumlah_penerima')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="jumlah_dana" class="form-label">Jumlah Dana <span class="text-danger">*</span></label>
                        <input type="number" 
                               class="form-control @error('jumlah_dana') is-invalid @enderror" 
                               id="jumlah_dana" 
                               name="jumlah_dana" 
                               value="{{ old('jumlah_dana', $bansos->jumlah_dana) }}" 
                               min="0" 
                               step="0.01"
                               required>
                        @error('jumlah_dana')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="periode_mulai" class="form-label">Periode Mulai <span class="text-danger">*</span></label>
                        <input type="date" 
                               class="form-control @error('periode_mulai') is-invalid @enderror" 
                               id="periode_mulai" 
                               name="periode_mulai" 
                               value="{{ old('periode_mulai', $bansos->periode_mulai?->format('Y-m-d')) }}"
                               required>
                        @error('periode_mulai')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="periode_selesai" class="form-label">Periode Selesai</label>
                        <input type="date" 
                               class="form-control @error('periode_selesai') is-invalid @enderror" 
                               id="periode_selesai" 
                               name="periode_selesai" 
                               value="{{ old('periode_selesai', $bansos->periode_selesai?->format('Y-m-d')) }}">
                        @error('periode_selesai')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">Kosongkan jika program masih berjalan</small>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="gambar" class="form-label">Gambar</label>
                        @if($bansos->gambar)
                            <div class="mb-2">
                                <img src="{{ Storage::url($bansos->gambar) }}" alt="Current Image" class="img-thumbnail" style="max-height: 100px;">
                                <small class="d-block text-muted">Gambar saat ini</small>
                            </div>
                        @endif
                        <input type="file" 
                               class="form-control @error('gambar') is-invalid @enderror" 
                               id="gambar" 
                               name="gambar"
                               accept=".jpg,.jpeg,.png">
                        @error('gambar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">Format: JPG, JPEG, PNG. Max: 2MB. Kosongkan jika tidak ingin mengganti.</small>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="warna_chart" class="form-label">Warna Chart</label>
                        <input type="color" 
                               class="form-control form-control-color @error('warna_chart') is-invalid @enderror" 
                               id="warna_chart" 
                               name="warna_chart" 
                               value="{{ old('warna_chart', $bansos->warna_chart) }}">
                        @error('warna_chart')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">Warna untuk tampilan chart/grafik</small>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea class="form-control @error('keterangan') is-invalid @enderror" 
                                  id="keterangan" 
                                  name="keterangan" 
                                  rows="3"
                                  placeholder="Keterangan atau deskripsi tambahan...">{{ old('keterangan', $bansos->keterangan) }}</textarea>
                        @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="mb-4">
                        <div class="form-check form-switch">
                            <input class="form-check-input" 
                                   type="checkbox" 
                                   id="tampil_infografis" 
                                   name="tampil_infografis" 
                                   value="1" 
                                   {{ old('tampil_infografis', $bansos->tampil_infografis) ? 'checked' : '' }}>
                            <label class="form-check-label" for="tampil_infografis">
                                <strong>Tampilkan di Halaman Infografis</strong>
                                <br><small class="text-muted">Aktifkan untuk menampilkan data ini di halaman infografis publik</small>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.bansos.index') }}" class="btn btn-secondary">
                    <i class="ti ti-arrow-left me-1"></i>Kembali
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="ti ti-device-floppy me-1"></i>Update Data
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
