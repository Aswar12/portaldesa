@extends('admin.layouts.main')

@section('content')
<div class="row">
    <div class="col-lg-12 d-flex align-items-strech">
        <div class="card w-100 shadow-sm">
            <div class="card-header bg-gradient-info border-0">
                <div class="row align-items-center">
                    <div class="col-6">
                        <h4 class="card-title fw-bold text-white mb-0">
                            <i class="fas fa-chart-line me-2"></i>Detail Data IDM Tahun {{ $idm->tahun }}
                        </h4>
                        <small class="text-white-50">Informasi lengkap Indeks Desa Membangun</small>
                    </div>
                    <div class="col-6 text-end">
                        <a href="{{ route('admin.idm.edit', $idm->id) }}" class="btn btn-warning btn-lg shadow-sm me-2">
                            <i class="fas fa-edit me-2"></i>Edit Data
                        </a>
                        <a href="{{ route('admin.idm.index') }}" class="btn btn-light btn-lg shadow-sm">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body p-4">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        <strong>Berhasil!</strong> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <!-- Status Badge -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="d-flex align-items-center mb-3">
                            <span class="badge bg-{{ $idm->status_color }} fs-5 px-4 py-2 me-3">
                                <i class="fas fa-award me-2"></i>{{ $idm->status_idm }}
                            </span>
                            @if($idm->is_active)
                                <span class="badge bg-success fs-6 px-3 py-2">
                                    <i class="fas fa-eye me-1"></i>Aktif (Ditampilkan Publik)
                                </span>
                            @else
                                <span class="badge bg-secondary fs-6 px-3 py-2">
                                    <i class="fas fa-eye-slash me-1"></i>Non-Aktif
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Main Information Cards -->
                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="card bg-primary text-white shadow-sm h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-star fa-3x mb-3"></i>
                                <h4 class="card-title">Skor IDM</h4>
                                <h2 class="display-6 fw-bold">{{ number_format($idm->skor_idm, 4) }}</h2>
                                <small>Indeks Desa Membangun</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-success text-white shadow-sm h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-home fa-3x mb-3"></i>
                                <h4 class="card-title">Skor IKS</h4>
                                <h2 class="display-6 fw-bold">{{ number_format($idm->skor_iks, 4) }}</h2>
                                <small>Indeks Ketahanan Sosial</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-warning text-dark shadow-sm h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-graduation-cap fa-3x mb-3"></i>
                                <h4 class="card-title">Skor IKE</h4>
                                <h2 class="display-6 fw-bold">{{ number_format($idm->skor_ike, 4) }}</h2>
                                <small>Indeks Ketahanan Ekonomi</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-info text-white shadow-sm h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-leaf fa-3x mb-3"></i>
                                <h4 class="card-title">Skor IKL</h4>
                                <h2 class="display-6 fw-bold">{{ number_format($idm->skor_ikl, 4) }}</h2>
                                <small>Indeks Ketahanan Lingkungan</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Detailed Information -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="card shadow-sm h-100">
                            <div class="card-header bg-light">
                                <h5 class="card-title mb-0">
                                    <i class="fas fa-info-circle text-primary me-2"></i>Informasi Umum
                                </h5>
                            </div>
                            <div class="card-body">
                                <table class="table table-borderless">
                                    <tr>
                                        <td class="fw-bold" width="40%">
                                            <i class="fas fa-calendar-alt text-primary me-2"></i>Tahun
                                        </td>
                                        <td>: {{ $idm->tahun }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">
                                            <i class="fas fa-flag text-primary me-2"></i>Status IDM
                                        </td>
                                        <td>: 
                                            <span class="badge bg-{{ $idm->status_color }} px-3 py-1">
                                                {{ $idm->status_idm }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">
                                            <i class="fas fa-target text-primary me-2"></i>Target Status
                                        </td>
                                        <td>: 
                                            <span class="badge bg-info text-dark px-3 py-1">
                                                {{ $idm->target_status }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">
                                            <i class="fas fa-chart-line text-primary me-2"></i>Skor Minimal
                                        </td>
                                        <td>: {{ number_format($idm->skor_minimal, 4) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">
                                            <i class="fas fa-plus text-primary me-2"></i>Penambahan
                                        </td>
                                        <td>: {{ number_format($idm->penambahan, 4) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">
                                            <i class="fas fa-eye text-primary me-2"></i>Status Aktif
                                        </td>
                                        <td>: 
                                            @if($idm->is_active)
                                                <span class="badge bg-success px-3 py-1">
                                                    <i class="fas fa-check me-1"></i>Aktif
                                                </span>
                                            @else
                                                <span class="badge bg-secondary px-3 py-1">
                                                    <i class="fas fa-times me-1"></i>Non-Aktif
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="card shadow-sm h-100">
                            <div class="card-header bg-light">
                                <h5 class="card-title mb-0">
                                    <i class="fas fa-chart-bar text-success me-2"></i>Visualisasi Skor
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-4">
                                    <label class="fw-bold text-muted mb-2">
                                        <i class="fas fa-home text-success me-1"></i>
                                        Indeks Ketahanan Sosial (IKS)
                                    </label>
                                    <div class="progress mb-2" style="height: 20px;">
                                        <div class="progress-bar bg-success" role="progressbar" 
                                             style="width: {{ $idm->skor_iks * 100 }}%"
                                             aria-valuenow="{{ $idm->skor_iks * 100 }}" 
                                             aria-valuemin="0" aria-valuemax="100">
                                            {{ number_format($idm->skor_iks * 100, 1) }}%
                                        </div>
                                    </div>
                                    <small class="text-muted">Skor: {{ number_format($idm->skor_iks, 4) }}</small>
                                </div>

                                <div class="mb-4">
                                    <label class="fw-bold text-muted mb-2">
                                        <i class="fas fa-graduation-cap text-warning me-1"></i>
                                        Indeks Ketahanan Ekonomi (IKE)
                                    </label>
                                    <div class="progress mb-2" style="height: 20px;">
                                        <div class="progress-bar bg-warning" role="progressbar" 
                                             style="width: {{ $idm->skor_ike * 100 }}%"
                                             aria-valuenow="{{ $idm->skor_ike * 100 }}" 
                                             aria-valuemin="0" aria-valuemax="100">
                                            {{ number_format($idm->skor_ike * 100, 1) }}%
                                        </div>
                                    </div>
                                    <small class="text-muted">Skor: {{ number_format($idm->skor_ike, 4) }}</small>
                                </div>

                                <div class="mb-4">
                                    <label class="fw-bold text-muted mb-2">
                                        <i class="fas fa-leaf text-info me-1"></i>
                                        Indeks Ketahanan Lingkungan (IKL)
                                    </label>
                                    <div class="progress mb-2" style="height: 20px;">
                                        <div class="progress-bar bg-info" role="progressbar" 
                                             style="width: {{ $idm->skor_ikl * 100 }}%"
                                             aria-valuenow="{{ $idm->skor_ikl * 100 }}" 
                                             aria-valuemin="0" aria-valuemax="100">
                                            {{ number_format($idm->skor_ikl * 100, 1) }}%
                                        </div>
                                    </div>
                                    <small class="text-muted">Skor: {{ number_format($idm->skor_ikl, 4) }}</small>
                                </div>

                                <div class="alert alert-info mt-4">
                                    <h6 class="alert-heading">
                                        <i class="fas fa-lightbulb me-2"></i>Informasi
                                    </h6>
                                    <small class="mb-0">
                                        Skor IDM dihitung berdasarkan rata-rata dari ketiga indeks: 
                                        IKS (Sosial), IKE (Ekonomi), dan IKL (Lingkungan).
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Deskripsi -->
                @if($idm->deskripsi)
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card shadow-sm">
                            <div class="card-header bg-light">
                                <h5 class="card-title mb-0">
                                    <i class="fas fa-file-alt text-primary me-2"></i>Deskripsi
                                </h5>
                            </div>
                            <div class="card-body">
                                <p class="mb-0">{{ $idm->deskripsi }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Action Buttons -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="d-flex gap-2 flex-wrap">
                            <a href="{{ route('admin.idm.edit', $idm->id) }}" class="btn btn-warning shadow-sm">
                                <i class="fas fa-edit me-2"></i>Edit Data
                            </a>
                            <form action="{{ route('admin.idm.toggle-active', $idm->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-{{ $idm->is_active ? 'secondary' : 'success' }} shadow-sm">
                                    <i class="fas fa-{{ $idm->is_active ? 'toggle-off' : 'toggle-on' }} me-2"></i>
                                    {{ $idm->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                                </button>
                            </form>
                            <form action="{{ route('admin.idm.destroy', $idm->id) }}" method="POST" class="d-inline delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger shadow-sm delete-btn" data-year="{{ $idm->tahun }}">
                                    <i class="fas fa-trash me-2"></i>Hapus Data
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Custom Styles -->
<style>
    .bg-gradient-info {
        background: linear-gradient(45deg, #17a2b8, #138496) !important;
    }
    
    .progress {
        border-radius: 10px;
        background-color: rgba(0,0,0,0.1);
    }
    
    .progress-bar {
        border-radius: 10px;
        font-weight: 600;
        font-size: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .card {
        border: none;
        border-radius: 15px;
        overflow: hidden;
    }
    
    .shadow-sm {
        box-shadow: 0 2px 4px rgba(0,0,0,0.1) !important;
    }
    
    .badge {
        font-weight: 500;
        letter-spacing: 0.5px;
    }
</style>

<script>
$(document).ready(function() {
    // Enhanced delete confirmation with SweetAlert
    $('.delete-btn').click(function(e) {
        e.preventDefault();
        var form = $(this).closest('.delete-form');
        var year = $(this).data('year');
        
        Swal.fire({
            title: 'Konfirmasi Hapus Data',
            html: `Apakah Anda yakin ingin menghapus data IDM tahun <strong>${year}</strong>?<br><small class="text-muted">Data yang dihapus tidak dapat dikembalikan!</small>`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: '<i class="fas fa-trash me-1"></i>Ya, Hapus!',
            cancelButtonText: '<i class="fas fa-times me-1"></i>Batal',
            backdrop: true,
            allowOutsideClick: false,
            customClass: {
                popup: 'shadow-lg'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Show loading
                Swal.fire({
                    title: 'Menghapus Data...',
                    html: 'Mohon tunggu sebentar',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading()
                    }
                });
                
                form.submit();
            }
        });
    });
});
</script>
@endsection
