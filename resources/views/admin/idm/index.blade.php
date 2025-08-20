@extends('admin.layouts.main')

@section('content')
<div class="row">
    <div class="col-lg-12 d-flex align-items-strech">
        <div class="card w-100 shadow-sm">
            <div class="card-header bg-gradient-primary border-0">
                <div class="row align-items-center">
                    <div class="col-6">
                        <h4 class="card-title fw-bold text-white mb-0">
                            <i class="fas fa-chart-line me-2"></i>Data Indeks Desa Membangun (IDM)
                        </h4>
                        <small class="text-white-50">Kelola data perkembangan desa berdasarkan indeks IDM</small>
                    </div>
                    <div class="col-6 text-end">
                        <a href="{{ route('admin.idm.create') }}" class="btn btn-light btn-lg shadow-sm">
                            <i class="fas fa-plus me-2"></i>Tambah Data IDM
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

                <!-- Summary Cards -->
                @if($idms->count() > 0)
                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="card bg-primary text-white shadow-sm">
                            <div class="card-body text-center">
                                <i class="fas fa-calendar-alt fa-2x mb-2"></i>
                                <h5 class="card-title">Total Data</h5>
                                <h3 class="mb-0">{{ $idms->count() }}</h3>
                                <small>Tahun Tercatat</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-success text-white shadow-sm">
                            <div class="card-body text-center">
                                <i class="fas fa-trophy fa-2x mb-2"></i>
                                <h5 class="card-title">Skor Terbaru</h5>
                                <h3 class="mb-0">{{ number_format($idms->first()->skor_idm ?? 0, 3) }}</h3>
                                <small>Tahun {{ $idms->first()->tahun ?? '-' }}</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-warning text-dark shadow-sm">
                            <div class="card-body text-center">
                                <i class="fas fa-chart-line fa-2x mb-2"></i>
                                <h5 class="card-title">Status Terbaru</h5>
                                <h3 class="mb-0">{{ $idms->first()->status_idm ?? '-' }}</h3>
                                <small>Kategori Desa</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-info text-white shadow-sm">
                            <div class="card-body text-center">
                                <i class="fas fa-eye fa-2x mb-2"></i>
                                <h5 class="card-title">Data Aktif</h5>
                                <h3 class="mb-0">{{ $idms->where('is_active', true)->count() }}</h3>
                                <small>Ditampilkan Public</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Info tentang Status Aktif -->
                <div class="alert alert-info border-0 shadow-sm mb-4">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-info-circle fa-2x me-3 text-info"></i>
                        <div>
                            <h6 class="alert-heading mb-1">
                                <i class="fas fa-toggle-on me-1"></i>Tentang Status Aktif IDM
                            </h6>
                            <p class="mb-0">
                                Anda dapat mengaktifkan <strong>beberapa data IDM sekaligus</strong>. Data yang aktif akan ditampilkan dalam dropdown pilihan di halaman publik. 
                                Gunakan tombol <i class="fas fa-toggle-on text-success mx-1"></i> untuk mengaktifkan atau <i class="fas fa-toggle-off text-secondary mx-1"></i> untuk menonaktifkan data.
                            </p>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Data Table -->
                <div class="table-responsive shadow-sm rounded">
                    <table id="idm-table" class="table table-striped table-hover table-compact mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th width="4%" class="text-center">
                                    <i class="fas fa-hashtag"></i>
                                </th>
                                <th width="8%" class="text-center">
                                    <i class="fas fa-calendar me-1"></i>Tahun
                                </th>
                                <th width="12%" class="text-center">
                                    <i class="fas fa-star me-1"></i>Skor IDM
                                </th>
                                <th width="12%" class="text-center">
                                    <i class="fas fa-flag me-1"></i>Status
                                </th>
                                <th width="12%" class="text-center">
                                    <i class="fas fa-target me-1"></i>Target
                                </th>
                                <th width="10%" class="text-center">
                                    <i class="fas fa-home me-1"></i>IKS
                                </th>
                                <th width="10%" class="text-center">
                                    <i class="fas fa-graduation-cap me-1"></i>IKE  
                                </th>
                                <th width="10%" class="text-center">
                                    <i class="fas fa-heartbeat me-1"></i>IKL
                                </th>
                                <th width="8%" class="text-center">
                                    <i class="fas fa-chart-bar me-1"></i>Status
                                </th>
                                <th width="14%" class="text-center">
                                    <i class="fas fa-cogs me-1"></i>Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($idms as $key => $idm)
                            <tr class="{{ $idm->is_active ? 'table-success' : '' }}">
                                <td class="text-center fw-bold text-primary py-3">{{ $key + 1 }}</td>
                                <td class="text-center py-3">
                                    <span class="badge bg-dark fs-6 px-2 py-1">
                                        {{ $idm->tahun }}
                                    </span>
                                </td>
                                <td class="text-center py-3">
                                    <div class="d-flex flex-column align-items-center">
                                        <span class="badge bg-primary fs-7 px-2 py-1 mb-1" style="font-size: 0.75rem;">
                                            {{ number_format($idm->skor_idm, 3) }}
                                        </span>
                                        <small class="text-muted" style="font-size: 0.7rem;">Indeks</small>
                                    </div>
                                </td>
                                <td class="text-center py-3">
                                    <span class="badge bg-{{ $idm->status_color }} fs-7 px-2 py-1 text-uppercase" style="font-size: 0.7rem;">
                                        {{ $idm->status_idm }}
                                    </span>
                                </td>
                                <td class="text-center py-3">
                                    <span class="badge bg-info text-dark fs-7 px-2 py-1" style="font-size: 0.7rem;">
                                        {{ $idm->target_status }}
                                    </span>
                                </td>
                                <td class="text-center py-3 px-2">
                                    <div class="d-flex flex-column align-items-center">
                                        <div class="progress mb-1" style="height: 4px; width: 60px; min-width: 50px;">
                                            <div class="progress-bar bg-success" role="progressbar" 
                                                 style="width: {{ $idm->skor_iks * 100 }}%"
                                                 aria-valuenow="{{ $idm->skor_iks * 100 }}" 
                                                 aria-valuemin="0" aria-valuemax="100">
                                            </div>
                                        </div>
                                        <small class="text-muted" style="font-size: 0.65rem;">{{ number_format($idm->skor_iks, 3) }}</small>
                                    </div>
                                </td>
                                <td class="text-center py-3 px-2">
                                    <div class="d-flex flex-column align-items-center">
                                        <div class="progress mb-1" style="height: 4px; width: 60px; min-width: 50px;">
                                            <div class="progress-bar bg-warning" role="progressbar" 
                                                 style="width: {{ $idm->skor_ike * 100 }}%"
                                                 aria-valuenow="{{ $idm->skor_ike * 100 }}" 
                                                 aria-valuemin="0" aria-valuemax="100">
                                            </div>
                                        </div>
                                        <small class="text-muted" style="font-size: 0.65rem;">{{ number_format($idm->skor_ike, 3) }}</small>
                                    </div>
                                </td>
                                <td class="text-center py-3 px-2">
                                    <div class="d-flex flex-column align-items-center">
                                        <div class="progress mb-1" style="height: 4px; width: 60px; min-width: 50px;">
                                            <div class="progress-bar bg-info" role="progressbar" 
                                                 style="width: {{ $idm->skor_ikl * 100 }}%"
                                                 aria-valuenow="{{ $idm->skor_ikl * 100 }}" 
                                                 aria-valuemin="0" aria-valuemax="100">
                                            </div>
                                        </div>
                                        <small class="text-muted" style="font-size: 0.65rem;">{{ number_format($idm->skor_ikl, 3) }}</small>
                                    </div>
                                </td>
                                <td class="text-center py-3">
                                    @if($idm->is_active)
                                        <span class="badge bg-success fs-7 px-2 py-1" style="font-size: 0.7rem;">
                                            <i class="fas fa-check-circle me-1"></i>Aktif
                                        </span>
                                    @else
                                        <span class="badge bg-danger fs-7 px-2 py-1" style="font-size: 0.7rem;">
                                            <i class="fas fa-times-circle me-1"></i>Non-Aktif
                                        </span>
                                    @endif
                                </td>
                                <td class="text-center py-3">
                                    <div class="btn-group-vertical btn-group-sm d-flex flex-column" role="group" style="gap: 2px;">
                                        <a href="{{ route('admin.idm.show', $idm->id) }}" 
                                           class="btn btn-info btn-sm shadow-sm" 
                                           style="font-size: 0.7rem; padding: 0.25rem 0.4rem; min-width: 30px;"
                                           title="Detail Data IDM {{ $idm->tahun }}"
                                           data-bs-toggle="tooltip">
                                            <i class="fas fa-eye" style="font-size: 0.7rem;"></i>
                                        </a>
                                        <a href="{{ route('admin.idm.edit', $idm->id) }}" 
                                           class="btn btn-warning btn-sm shadow-sm" 
                                           style="font-size: 0.7rem; padding: 0.25rem 0.4rem; min-width: 30px;"
                                           title="Edit Data IDM {{ $idm->tahun }}"
                                           data-bs-toggle="tooltip">
                                            <i class="fas fa-edit" style="font-size: 0.7rem;"></i>
                                        </a>
                                        <form action="{{ route('admin.idm.toggle-active', $idm->id) }}" 
                                              method="POST" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" 
                                                    class="btn btn-{{ $idm->is_active ? 'secondary' : 'success' }} btn-sm shadow-sm"
                                                    style="font-size: 0.7rem; padding: 0.25rem 0.4rem; min-width: 30px;"
                                                    title="{{ $idm->is_active ? 'Nonaktifkan' : 'Aktifkan' }} Data"
                                                    data-bs-toggle="tooltip">
                                                <i class="fas fa-{{ $idm->is_active ? 'toggle-off' : 'toggle-on' }}" style="font-size: 0.7rem;"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.idm.destroy', $idm->id) }}" 
                                              method="POST" class="d-inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="btn btn-danger btn-sm shadow-sm delete-btn" 
                                                    style="font-size: 0.7rem; padding: 0.25rem 0.4rem; min-width: 30px;"
                                                    title="Hapus Data IDM {{ $idm->tahun }}"
                                                    data-bs-toggle="tooltip"
                                                    data-year="{{ $idm->tahun }}">
                                                <i class="fas fa-trash" style="font-size: 0.7rem;"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr id="empty-row">
                                <td colspan="9" class="text-center py-5">
                                    <div class="text-muted">
                                        <i class="fas fa-chart-line fa-4x text-primary mb-4 opacity-50"></i>
                                        <h4 class="text-muted">Belum Ada Data IDM</h4>
                                        <p class="mb-4">Data Indeks Desa Membangun belum tersedia. Silakan tambahkan data IDM untuk memulai tracking perkembangan desa.</p>
                                        <a href="{{ route('admin.idm.create') }}" class="btn btn-primary btn-lg shadow-sm">
                                            <i class="fas fa-plus me-2"></i>Tambah Data IDM Pertama
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Custom Styles and Scripts -->
<style>
    .bg-gradient-primary {
        background: linear-gradient(45deg, #007bff, #0056b3) !important;
    }
    
    .table-hover tbody tr:hover {
        background-color: rgba(0,123,255,0.08);
        transform: translateY(-1px);
        transition: all 0.2s ease-in-out;
    }
    
    .btn-group .btn {
        margin-right: 2px;
        transition: all 0.2s ease-in-out;
    }
    
    .btn-group .btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.15);
    }
    
    .table-success {
        --bs-table-accent-bg: rgba(25, 135, 84, 0.1);
        border-left: 4px solid #198754;
    }
    
    .progress {
        background-color: rgba(0,0,0,0.1);
        border-radius: 10px;
    }
    
    .progress-bar {
        border-radius: 10px;
        transition: width 0.6s ease;
    }
    
    .badge {
        font-weight: 500;
        letter-spacing: 0.3px;
        font-size: 0.75rem !important;
    }
    
    .table tbody td {
        vertical-align: middle;
        padding: 0.5rem 0.25rem;
        font-size: 0.85rem;
        line-height: 1.2;
    }
    
    .table thead th {
        font-size: 0.75rem;
        padding: 0.6rem 0.25rem;
        white-space: nowrap;
        text-align: center;
        vertical-align: middle;
    }
    
    .btn-group-vertical {
        width: fit-content;
        margin: 0 auto;
    }
    
    .btn-group-vertical .btn {
        margin: 0;
        transition: all 0.2s ease-in-out;
    }
    
    .btn-group-vertical .btn:hover {
        transform: translateX(-2px);
        box-shadow: 2px 2px 8px rgba(0,0,0,0.15);
    }
    
    .progress {
        background-color: rgba(0,0,0,0.1);
        border-radius: 8px;
        margin: 0 auto;
    }
    
    .progress-bar {
        border-radius: 8px;
        transition: width 0.6s ease;
        font-size: 0.65rem;
    }
    
    .badge {
        font-weight: 500;
        letter-spacing: 0.2px;
    }
    
    /* Compact table styling */
    .table-compact td {
        padding: 0.4rem 0.2rem !important;
    }
    
    .table-compact th {
        padding: 0.5rem 0.2rem !important;
    }
    
    .card {
        border: none;
        border-radius: 15px;
        overflow: hidden;
    }
    
    .card-header {
        border-radius: 0;
    }
    
    .shadow-sm {
        box-shadow: 0 2px 4px rgba(0,0,0,0.1) !important;
    }
    
    .table thead th {
        border-bottom: 2px solid #dee2e6;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
        padding: 0.75rem 0.5rem;
        white-space: nowrap;
    }
    
    .table tbody td {
        vertical-align: middle;
        padding: 0.75rem 0.5rem;
        font-size: 0.85rem;
    }
    
    /* Responsive adjustments */
    @media (max-width: 1200px) {
        .table {
            font-size: 0.8rem;
        }
        
        .badge {
            font-size: 0.7rem !important;
            padding: 0.25rem 0.5rem !important;
        }
        
        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
        }
    }
    
    @media (max-width: 768px) {
        .btn-group-vertical {
            flex-direction: row;
            justify-content: center;
        }
        
        .btn-group-vertical .btn {
            margin-right: 2px;
            min-width: 28px;
            padding: 0.2rem 0.4rem;
        }
        
        .table-responsive {
            font-size: 0.75rem;
        }
        
        .badge {
            font-size: 0.65rem !important;
            padding: 0.2rem 0.4rem !important;
        }
        
        .progress {
            height: 4px !important;
        }
    }
</style>

<script>
$(document).ready(function() {
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
    
    // Initialize DataTable only if there's data
    var tableRows = $('#idm-table tbody tr').length;
    var hasData = $('#idm-table tbody tr:first td').attr('colspan') === undefined;
    
    if (hasData && tableRows > 0) {
        $('#idm-table').DataTable({
            "pageLength": 10,
            "responsive": true,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
            },
            "columnDefs": [
                { "orderable": false, "targets": [0, 8] }, // Disable sorting for No and Action columns
                { "searchable": false, "targets": [0, 8] }
            ],
            "order": [[1, 'desc']], // Order by year column in descending order
            "drawCallback": function(settings) {
                // Re-initialize tooltips after each draw
                var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                    return new bootstrap.Tooltip(tooltipTriggerEl);
                });
            }
        });
    }
    
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
