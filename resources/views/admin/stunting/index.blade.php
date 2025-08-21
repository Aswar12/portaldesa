@extends('admin.layouts.main')

@section('content')
    <div class="row">
        <div class="col-lg-12 d-flex align-items-stretch">
            <div class="card w-100 modern-stunting-card">
                <div class="card-header modern-stunting-header">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <h5 class="card-title fw-bold text-white mb-0">
                                <i class="fas fa-child me-2"></i>Data Stunting
                            </h5>
                            <small class="text-light opacity-75">Manajemen data stunting balita</small>
                        </div>
                        <div class="col-6 text-end">
                            <a href="{{ route('admin.stunting.create') }}" 
                               class="btn btn-light btn-stunting-add"
                               title="Klik untuk menambah data stunting baru">
                                <i class="fas fa-plus me-2"></i>Tambah Data Stunting
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body modern-stunting-body">
                    @if (session()->has('success'))
                        <div class="alert alert-success modern-stunting-alert" role="alert">
                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <!-- Enhanced Filter Section -->
                    <div class="card stunting-filter-card mb-4">
                        <div class="card-body">
                            <form method="GET" action="{{ route('admin.stunting.index') }}">
                                <div class="row align-items-end">
                                    <div class="col-md-3">
                                        <label class="form-label fw-semibold">
                                            <i class="fas fa-calendar-alt me-1"></i>Tahun
                                        </label>
                                        <select name="tahun" class="form-select stunting-select">
                                            <option value="">Semua Tahun</option>
                                            @foreach($tahunOptions as $tahun)
                                                <option value="{{ $tahun }}" {{ request('tahun') == $tahun ? 'selected' : '' }}>
                                                    {{ $tahun }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-stunting-filter">
                                            <i class="fas fa-filter me-2"></i>Filter
                                        </button>
                                        <a href="{{ route('admin.stunting.index') }}" class="btn btn-stunting-reset">
                                            <i class="fas fa-sync-alt me-2"></i>Reset
                                        </a>
                                    </div>
                                    <div class="col-md-5 text-end">
                                        <div class="stunting-summary">
                                            <span class="summary-item">
                                                <i class="fas fa-chart-bar me-1"></i>
                                                Total: <strong>{{ $stuntings->count() }}</strong> data
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="stunting-table-wrapper">
                        <div class="table-responsive">
                            <table id="table_id" class="table stunting-table">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Gambar</th>
                                        <th>Judul</th>
                                        <th class="text-center">Tahun</th>
                                        <th class="text-center">Normal</th>
                                        <th class="text-center">Stunting</th>
                                        <th class="text-center">Kurus</th>
                                        <th class="text-center">Gemuk</th>
                                        <th class="text-center">Infografis</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($stuntings as $stunting)
                                        <tr>
                                            <td class="text-center stunting-number-cell">{{ $loop->iteration }}</td>
                                            <td class="text-center stunting-image-cell">
                                                @if($stunting->gambar)
                                                    <div class="stunting-image-wrapper">
                                                        <img src="{{ asset('storage/' . $stunting->gambar) }}" 
                                                             alt="Gambar {{ $stunting->judul }}"
                                                             class="stunting-image">
                                                    </div>
                                                @else
                                                    <div class="stunting-image-placeholder">
                                                        <i class="fas fa-child"></i>
                                                    </div>
                                                @endif
                                            </td>
                                            <td class="stunting-title-cell">
                                                <div class="stunting-title-wrapper">
                                                    <h6 class="stunting-title">{{ Str::limit($stunting->judul, 40) }}</h6>
                                                    <div class="stunting-subtitle">
                                                        <i class="fas fa-users me-1"></i>
                                                        Total: {{ $stunting->total_balita }} balita
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center stunting-year-cell">
                                                <span class="year-badge">{{ $stunting->tahun }}</span>
                                            </td>
                                            <td class="text-center stunting-stat-cell">
                                                <div class="stat-wrapper stat-normal">
                                                    <div class="stat-number">{{ $stunting->balita_normal }}</div>
                                                    <div class="stat-percentage">{{ $stunting->persentase_normal }}%</div>
                                                </div>
                                            </td>
                                            <td class="text-center stunting-stat-cell">
                                                <div class="stat-wrapper stat-stunting">
                                                    <div class="stat-number">{{ $stunting->balita_stunting }}</div>
                                                    <div class="stat-percentage">{{ $stunting->persentase_stunting }}%</div>
                                                </div>
                                            </td>
                                            <td class="text-center stunting-stat-cell">
                                                <div class="stat-wrapper stat-kurus">
                                                    <div class="stat-number">{{ $stunting->balita_kurus }}</div>
                                                    <div class="stat-percentage">{{ $stunting->persentase_kurus }}%</div>
                                                </div>
                                            </td>
                                            <td class="text-center stunting-stat-cell">
                                                <div class="stat-wrapper stat-gemuk">
                                                    <div class="stat-number">{{ $stunting->balita_gemuk }}</div>
                                                    <div class="stat-percentage">{{ $stunting->persentase_gemuk }}%</div>
                                                </div>
                                            </td>
                                            <td class="text-center stunting-infografis-cell">
                                                @if($stunting->tampil_infografis)
                                                    <span class="infografis-badge infografis-yes">
                                                        <i class="fas fa-chart-bar me-1"></i>Ya
                                                    </span>
                                                @else
                                                    <span class="infografis-badge infografis-no">
                                                        <i class="fas fa-times me-1"></i>Tidak
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="text-center stunting-action-cell">
                                                <div class="stunting-action-group">
                                                    <a href="{{ route('admin.stunting.edit', $stunting->id) }}" 
                                                       class="stunting-action-btn stunting-edit-btn" 
                                                       title="Edit Data Stunting">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form id="delete-{{ $stunting->id }}" 
                                                          action="{{ route('admin.stunting.destroy', $stunting->id) }}"
                                                          method="POST" class="d-inline">
                                                        @method('delete')
                                                        @csrf
                                                        <button type="button" 
                                                                class="stunting-action-btn stunting-delete-btn swal-confirm" 
                                                                data-form="delete-{{ $stunting->id }}"
                                                                title="Hapus Data Stunting">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr id="empty-row">
                                            <td colspan="10" class="text-center py-5 stunting-empty-cell">
                                                <div class="stunting-empty-state">
                                                    <i class="fas fa-child fa-3x text-muted mb-3"></i>
                                                    <h5 class="text-muted mb-2">Belum ada data stunting</h5>
                                                    <p class="text-muted mb-4">Silakan tambah data stunting untuk memulai monitoring kesehatan balita</p>
                                                    <a href="{{ route('admin.stunting.create') }}" class="btn btn-primary">
                                                        <i class="fas fa-plus me-2"></i>Tambah Data Pertama
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
    </div>

<style>
    /* Modern Stunting Card Styling */
    .modern-stunting-card {
        border: none;
        border-radius: 20px;
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        background: linear-gradient(145deg, #ffffff 0%, #f8f9fa 100%);
    }

    .modern-stunting-header {
        background: linear-gradient(135deg, #ff6b6b 0%, #ee5a24 100%);
        border: none;
        padding: 24px 32px;
        position: relative;
    }

    .modern-stunting-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPGRlZnM+CjxwYXR0ZXJuIGlkPSJncmlkIiB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHBhdHRlcm5Vbml0cz0idXNlclNwYWNlT25Vc2UiPgo8cGF0aCBkPSJNIDAgMCBMIDAgNjAgTCA2MCA2MCBMIDYwIDAgTCAwIDAgeiIgZmlsbD0ibm9uZSIgc3Ryb2tlPSJyZ2JhKDI1NSwgMjU1LCAyNTUsIDAuMSkiIHN0cm9rZS13aWR0aD0iMSIvPgo8L3BhdHRlcm4+CjwvZGVmcz4KPHJlY3Qgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgZmlsbD0idXJsKCNncmlkKSIvPgo8L3N2Zz4=');
        opacity: 0.1;
    }

    .modern-stunting-body {
        padding: 32px;
    }

    .btn-stunting-add {
        border: 2px solid rgba(255, 255, 255, 0.3);
        border-radius: 12px;
        padding: 10px 20px;
        font-weight: 600;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 4px 12px rgba(255, 255, 255, 0.2);
        position: relative;
        z-index: 100;
        cursor: pointer;
        text-decoration: none;
    }

    .btn-stunting-add:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(255, 255, 255, 0.3);
        background: rgba(255, 255, 255, 0.95);
        text-decoration: none;
        color: #333;
    }

    /* Modern Alert */
    .modern-stunting-alert {
        border: none;
        border-radius: 12px;
        padding: 16px 20px;
        margin-bottom: 24px;
        border-left: 4px solid #28a745;
        background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
        box-shadow: 0 4px 12px rgba(40, 167, 69, 0.15);
    }

    /* Filter Card */
    .stunting-filter-card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.06);
        background: linear-gradient(145deg, #ffffff 0%, #f8f9fa 100%);
        border-left: 4px solid #ff6b6b;
    }

    .stunting-select {
        border-radius: 8px;
        border: 2px solid #e9ecef;
        transition: all 0.3s ease;
    }

    .stunting-select:focus {
        border-color: #ff6b6b;
        box-shadow: 0 0 0 0.2rem rgba(255, 107, 107, 0.25);
    }

    .btn-stunting-filter {
        background: linear-gradient(135deg, #ff6b6b 0%, #ee5a24 100%);
        border: none;
        border-radius: 8px;
        padding: 8px 20px;
        font-weight: 600;
        color: white;
        transition: all 0.3s ease;
        margin-right: 8px;
    }

    .btn-stunting-filter:hover {
        background: linear-gradient(135deg, #ee5a24 0%, #d63031 100%);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(255, 107, 107, 0.4);
        color: white;
    }

    .btn-stunting-reset {
        background: #6c757d;
        border: none;
        border-radius: 8px;
        padding: 8px 20px;
        font-weight: 600;
        color: white;
        transition: all 0.3s ease;
    }

    .btn-stunting-reset:hover {
        background: #5a6268;
        transform: translateY(-2px);
        color: white;
    }

    .stunting-summary {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-radius: 10px;
        padding: 12px 16px;
        border-left: 4px solid #17a2b8;
    }

    .summary-item {
        color: #495057;
        font-weight: 600;
    }

    /* Enhanced Table Wrapper */
    .stunting-table-wrapper {
        background: linear-gradient(145deg, #ffffff 0%, #f8f9fa 100%);
        border-radius: 16px;
        padding: 24px;
        box-shadow: 
            0 8px 32px rgba(0, 0, 0, 0.06),
            0 4px 16px rgba(0, 0, 0, 0.03);
        border: 1px solid rgba(255, 255, 255, 0.8);
        position: relative;
        overflow: hidden;
    }

    .stunting-table-wrapper::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #ff6b6b, #ee5a24, #ff6b6b);
        animation: stuntingTableShimmer 3s ease-in-out infinite;
    }

    @keyframes stuntingTableShimmer {
        0%, 100% { opacity: 0.7; }
        50% { opacity: 1; }
    }

    /* Modern Stunting Table */
    .stunting-table {
        margin-bottom: 0;
        background: transparent;
        border-collapse: separate;
        border-spacing: 0;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .stunting-table thead th {
        background: linear-gradient(135deg, #ff6b6b 0%, #ee5a24 100%);
        color: white;
        font-weight: 700;
        padding: 16px 12px;
        border: none;
        font-size: 13px;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        position: sticky;
        top: 0;
        z-index: 10;
    }

    .stunting-table thead th:first-child {
        border-radius: 12px 0 0 0;
    }

    .stunting-table thead th:last-child {
        border-radius: 0 12px 0 0;
    }

    .stunting-table tbody tr {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .stunting-table tbody tr:hover {
        background: linear-gradient(145deg, #fff5f5 0%, #ffe6e6 100%);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(255, 107, 107, 0.1);
    }

    .stunting-table tbody td {
        padding: 16px 12px;
        border: none;
        background: rgba(255, 255, 255, 0.8);
        border-bottom: 1px solid rgba(222, 226, 230, 0.5);
        vertical-align: middle;
    }

    .stunting-table tbody tr:hover td {
        background: transparent;
    }

    /* Column Width Optimization */
    .stunting-table th:nth-child(1) { width: 5%; }   /* No */
    .stunting-table th:nth-child(2) { width: 10%; }  /* Gambar */
    .stunting-table th:nth-child(3) { width: 20%; }  /* Judul */
    .stunting-table th:nth-child(4) { width: 8%; }   /* Tahun */
    .stunting-table th:nth-child(5) { width: 11%; }  /* Normal */
    .stunting-table th:nth-child(6) { width: 11%; }  /* Stunting */
    .stunting-table th:nth-child(7) { width: 11%; }  /* Kurus */
    .stunting-table th:nth-child(8) { width: 11%; }  /* Gemuk */
    .stunting-table th:nth-child(9) { width: 8%; }   /* Infografis */
    .stunting-table th:nth-child(10) { width: 5%; }  /* Aksi */

    /* Cell Styling */
    .stunting-number-cell {
        font-weight: 700;
        color: #ff6b6b;
        font-size: 14px;
    }

    .stunting-image-wrapper {
        width: 80px;
        height: 80px;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        margin: 0 auto;
    }

    .stunting-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .stunting-image:hover {
        transform: scale(1.05);
    }

    .stunting-image-placeholder {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #6c757d;
        font-size: 24px;
        margin: 0 auto;
        border: 2px dashed #dee2e6;
    }

    .stunting-title-wrapper {
        max-width: 200px;
    }

    .stunting-title {
        font-weight: 600;
        color: #2c3e50;
        line-height: 1.4;
        margin-bottom: 6px;
        font-size: 14px;
    }

    .stunting-subtitle {
        color: #6c757d;
        font-size: 12px;
    }

    .stunting-subtitle i {
        color: #ff6b6b;
    }

    .year-badge {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 600;
        box-shadow: 0 2px 8px rgba(102, 126, 234, 0.3);
    }

    /* Statistics Styling */
    .stat-wrapper {
        padding: 8px 12px;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .stat-wrapper:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .stat-normal {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        color: white;
    }

    .stat-stunting {
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        color: white;
    }

    .stat-kurus {
        background: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%);
        color: white;
    }

    .stat-gemuk {
        background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
        color: white;
    }

    .stat-number {
        font-size: 18px;
        font-weight: 700;
        line-height: 1.2;
    }

    .stat-percentage {
        font-size: 11px;
        opacity: 0.9;
        margin-top: 2px;
    }

    /* Infografis Badges */
    .infografis-badge {
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        transition: all 0.3s ease;
    }

    .infografis-yes {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        color: white;
        box-shadow: 0 2px 8px rgba(40, 167, 69, 0.3);
    }

    .infografis-no {
        background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
        color: white;
        box-shadow: 0 2px 8px rgba(108, 117, 125, 0.3);
    }

    .infografis-badge:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }

    /* Action Buttons */
    .stunting-action-group {
        display: flex;
        gap: 6px;
        justify-content: center;
    }

    .stunting-action-btn {
        width: 36px;
        height: 36px;
        border-radius: 8px;
        border: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        cursor: pointer;
        font-size: 14px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    }

    .stunting-edit-btn {
        background: linear-gradient(135deg, #ffc107 0%, #e0a800 100%);
        color: white;
    }

    .stunting-edit-btn:hover {
        background: linear-gradient(135deg, #e0a800 0%, #d39e00 100%);
        transform: translateY(-3px) scale(1.05);
        box-shadow: 0 8px 20px rgba(255, 193, 7, 0.4);
        color: white;
    }

    .stunting-delete-btn {
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        color: white;
    }

    .stunting-delete-btn:hover {
        background: linear-gradient(135deg, #c82333 0%, #a71e2a 100%);
        transform: translateY(-3px) scale(1.05);
        box-shadow: 0 8px 20px rgba(220, 53, 69, 0.4);
        color: white;
    }

    .stunting-action-btn:active {
        transform: translateY(-1px) scale(0.95);
    }

    /* Empty State */
    .stunting-empty-state {
        padding: 60px 20px;
        background: linear-gradient(145deg, #f8f9fa 0%, #e9ecef 100%);
        border-radius: 12px;
    }

    /* Responsive Design */
    @media (max-width: 1200px) {
        .stunting-table {
            font-size: 13px;
        }
        
        .stunting-table thead th,
        .stunting-table tbody td {
            padding: 12px 8px;
        }

        .stunting-image-wrapper,
        .stunting-image-placeholder {
            width: 60px;
            height: 60px;
        }
    }

    @media (max-width: 768px) {
        .modern-stunting-body {
            padding: 20px;
        }

        .stunting-table-wrapper {
            padding: 16px;
        }

        .stunting-table {
            font-size: 12px;
        }

        .stunting-table thead th,
        .stunting-table tbody td {
            padding: 10px 6px;
        }

        .stunting-action-btn {
            width: 32px;
            height: 32px;
            font-size: 12px;
        }

        .stunting-image-wrapper,
        .stunting-image-placeholder {
            width: 50px;
            height: 50px;
        }

        .stat-number {
            font-size: 16px;
        }
    }
</style>

    <script>
        $(document).ready(function() {
            // Initialize DataTable only if there are data rows (not just empty state)
            var tableRows = $('#table_id tbody tr').length;
            var hasData = $('#table_id tbody tr:first td').attr('colspan') === undefined;
            
            if (hasData && tableRows > 0) {
                $('#table_id').DataTable({
                    "pageLength": 25,
                    "responsive": true,
                    "language": {
                        "url": "/assets/i18n/Indonesian.json"
                    },
                    "columnDefs": [
                        { "orderable": false, "targets": [1, 9] }, // Disable sorting for image and action columns
                        { "searchable": false, "targets": [1, 9] }
                    ],
                    "order": [[3, 'desc']], // Order by year column (index 3) in descending order
                    "drawCallback": function(settings) {
                        // Re-initialize tooltips after each draw
                        $('[title]').tooltip();
                    }
                });
            } else {
                // If no data, just make the table responsive without DataTables features
                $('#table_id').addClass('table-responsive');
            }
        });

        // SweetAlert for delete confirmation
        $('.swal-confirm').click(function(e) {
            e.preventDefault();
            var form = $(this).data('form');
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#' + form).submit();
                }
            });
        });
    </script>
@endsection
