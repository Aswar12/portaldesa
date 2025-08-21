@extends('admin.layouts.main')

@section('content')
<div class="row">
    <div class="col-lg-12 d-flex align-items-stretch">
      <div class="card w-100 modern-card">
        <div class="card-header modern-header">
            <div class="row align-items-center">
                <div class="col-6">
                    <h5 class="card-title fw-bold text-white mb-0">
                        <i class="fas fa-newspaper me-2"></i>Manajemen Berita
                    </h5>
                </div>
                <div class="col-6 text-end">
                    <a href="{{ route('berita.create') }}" 
                       class="btn btn-light btn-elevated tambah-berita-btn"
                       title="Klik untuk menambah berita baru">
                        <i class="fas fa-plus me-1"></i>Tambah Berita
                    </a>
                </div>
            </div>
        </div>
        
        <div class="card-body modern-body">
            @if (session()->has('success'))
                <div class="alert alert-success modern-alert" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                </div>
            @endif

            <!-- Enhanced Nav tabs -->
            <ul class="nav nav-tabs modern-tabs" id="myTabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="publish-tab" data-toggle="tab" href="#publish" role="tab" aria-controls="publish" aria-selected="true">
                        <i class="fas fa-globe me-2"></i>Published
                        <span class="badge bg-success ms-2">{{ count($beritas) }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="draft-tab" data-toggle="tab" href="#draft" role="tab" aria-controls="draft" aria-selected="false">
                        <i class="fas fa-edit me-2"></i>Draft
                        <span class="badge bg-warning ms-2">{{ count($beritaDraft) }}</span>
                    </a>
                </li>
            </ul>

            <!-- Enhanced Tab panes -->
            <div class="tab-content mt-4">
                <div class="tab-pane fade show active" id="publish" role="tabpanel" aria-labelledby="publish-tab">
                    <div class="table-wrapper-enhanced">
                        <div class="table-responsive">
                            <table id="table_id" class="table modern-table">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th>Judul</th>
                                        <th>Ringkasan</th>
                                        <th class="text-center">Penulis</th>
                                        <th class="text-center">Tanggal</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($beritas as $berita)
                                        <tr>
                                            <td class="text-center number-cell">{{ $loop->iteration }}</td>
                                            <td class="title-cell">
                                                <div class="title-wrapper">
                                                    <h6 class="title-text mb-1">{{ Str::limit($berita->judul, 60) }}</h6>
                                                    <small class="text-muted">ID: #{{ $berita->id }}</small>
                                                </div>
                                            </td>
                                            <td class="excerpt-cell">
                                                <div class="excerpt-wrapper">
                                                    {{ Str::limit($berita->excerpt, 80) }}
                                                </div>
                                            </td>
                                            <td class="text-center author-cell">
                                                <div class="author-wrapper">
                                                    <i class="fas fa-user me-1"></i>
                                                    <span>{{ $berita->user->name }}</span>
                                                </div>
                                            </td>
                                            <td class="text-center date-cell">
                                                <div class="date-wrapper">
                                                    <div class="date-main">{{ $berita->created_at->format('d/m/Y') }}</div>
                                                    <div class="time-sub">{{ $berita->created_at->format('H:i') }}</div>
                                                </div>
                                            </td>
                                            <td class="text-center status-cell">
                                                @if ($berita->status->status == 'publish')
                                                    <span class="status-badge status-published">
                                                        <i class="fas fa-globe me-1"></i>Published
                                                    </span>
                                                @else
                                                    <span class="status-badge status-draft">
                                                        <i class="fas fa-edit me-1"></i>{{ ucfirst($berita->status->status) }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="text-center action-cell">
                                                <div class="action-buttons-group">
                                                    <a href="/berita/{{ $berita->slug }}" target="_blank" 
                                                       class="action-btn view-btn" title="Lihat Berita">
                                                        <i class="fas fa-external-link-alt"></i>
                                                    </a>
                                                    <a href="{{ route('berita.edit', $berita->id) }}" 
                                                       class="action-btn edit-btn" title="Edit Berita">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form id="{{ $berita->id }}" action="{{ route('berita.destroy', $berita->id) }}" method="POST" class="d-inline">
                                                        @method('delete')
                                                        @csrf
                                                        <button type="button" class="action-btn delete-btn swal-confirm" 
                                                                data-form="{{ $berita->id }}" title="Hapus Berita">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>                                    
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="draft" role="tabpanel" aria-labelledby="draft-tab">
                    <div class="table-wrapper-enhanced">
                        <div class="table-responsive">
                            <table id="table_draft" class="table modern-table">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th>Judul</th>
                                        <th>Ringkasan</th>
                                        <th class="text-center">Penulis</th>
                                        <th class="text-center">Tanggal</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($beritaDraft as $berita)
                                        <tr>
                                            <td class="text-center number-cell">{{ $loop->iteration }}</td>
                                            <td class="title-cell">
                                                <div class="title-wrapper">
                                                    <h6 class="title-text mb-1">{{ Str::limit($berita->judul, 60) }}</h6>
                                                    <small class="text-muted">ID: #{{ $berita->id }}</small>
                                                </div>
                                            </td>
                                            <td class="excerpt-cell">
                                                <div class="excerpt-wrapper">
                                                    {{ Str::limit($berita->excerpt, 80) }}
                                                </div>
                                            </td>
                                            <td class="text-center author-cell">
                                                <div class="author-wrapper">
                                                    <i class="fas fa-user me-1"></i>
                                                    <span>{{ $berita->user->name }}</span>
                                                </div>
                                            </td>
                                            <td class="text-center date-cell">
                                                <div class="date-wrapper">
                                                    <div class="date-main">{{ $berita->created_at->format('d/m/Y') }}</div>
                                                    <div class="time-sub">{{ $berita->created_at->format('H:i') }}</div>
                                                </div>
                                            </td>
                                            <td class="text-center status-cell">
                                                @if ($berita->status->status == 'publish')
                                                    <span class="status-badge status-published">
                                                        <i class="fas fa-globe me-1"></i>Published
                                                    </span>
                                                @else
                                                    <span class="status-badge status-draft">
                                                        <i class="fas fa-edit me-1"></i>{{ ucfirst($berita->status->status) }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="text-center action-cell">
                                                <div class="action-buttons-group">
                                                    <a href="{{ route('berita.edit', $berita->id) }}" 
                                                       class="action-btn edit-btn" title="Edit Berita">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form id="{{ $berita->id }}" action="{{ route('berita.destroy', $berita->id) }}" method="POST" class="d-inline">
                                                        @method('delete')
                                                        @csrf
                                                        <button type="button" class="action-btn delete-btn swal-confirm" 
                                                                data-form="{{ $berita->id }}" title="Hapus Berita">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>                                    
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

      </div>
    </div>
</div>

<style>
    /* Modern Card Styling */
    .modern-card {
        border: none;
        border-radius: 20px;
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        background: linear-gradient(145deg, #ffffff 0%, #f8f9fa 100%);
    }

    .modern-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        padding: 24px 32px;
        position: relative;
    }

    .modern-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPGRlZnM+CjxwYXR0ZXJuIGlkPSJncmlkIiB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHBhdHRlcm5Vbml0cz0idXNlclNwYWNlT25Vc2UiPgo8cGF0aCBkPSJNIDAgMCBMIDAgNjAgTCA2MCA2MCBMIDYwIDAgTCAwIDAgeiIgZmlsbD0ibm9uZSIgc3Ryb2tlPSJyZ2JhKDI1NSwgMjU1LCAyNTUsIDAuMSkiIHN0cm9rZS13aWR0aD0iMSIvPgo8L3BhdHRlcm4+CjwvZGVmcz4KPHJlY3Qgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgZmlsbD0idXJsKCNncmlkKSIvPgo8L3N2Zz4=');
        opacity: 0.1;
    }

    .modern-body {
        padding: 32px;
    }

    .btn-elevated {
        border: 2px solid rgba(255, 255, 255, 0.3);
        border-radius: 12px;
        padding: 10px 20px;
        font-weight: 600;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 4px 12px rgba(255, 255, 255, 0.2);
        position: relative;
        z-index: 100;
    }

    .btn-elevated:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(255, 255, 255, 0.3);
        background: rgba(255, 255, 255, 0.95);
        text-decoration: none;
    }

    /* Modern Alert */
    .modern-alert {
        border: none;
        border-radius: 12px;
        padding: 16px 20px;
        margin-bottom: 24px;
        border-left: 4px solid #28a745;
        background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
        box-shadow: 0 4px 12px rgba(40, 167, 69, 0.15);
    }

    /* Modern Tabs */
    .modern-tabs {
        border: none;
        background: transparent;
        margin-bottom: 24px;
    }

    .modern-tabs .nav-link {
        border: none;
        border-radius: 12px;
        padding: 14px 24px;
        margin-right: 8px;
        font-weight: 600;
        color: #6c757d;
        background: #f8f9fa;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .modern-tabs .nav-link::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(102, 126, 234, 0.1), transparent);
        transition: left 0.5s;
    }

    .modern-tabs .nav-link:hover::before {
        left: 100%;
    }

    .modern-tabs .nav-link:hover {
        color: #667eea;
        background: #ffffff;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
    }

    .modern-tabs .nav-link.active {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
    }

    /* Enhanced Table Wrapper */
    .table-wrapper-enhanced {
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

    .table-wrapper-enhanced::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #667eea, #764ba2, #667eea);
        animation: tableShimmer 3s ease-in-out infinite;
    }

    @keyframes tableShimmer {
        0%, 100% { opacity: 0.7; }
        50% { opacity: 1; }
    }

    /* Modern Table Styling */
    .modern-table {
        margin-bottom: 0;
        background: transparent;
        border-collapse: separate;
        border-spacing: 0;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .modern-table thead th {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        font-weight: 700;
        padding: 16px 14px;
        border: none;
        font-size: 13px;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        position: sticky;
        top: 0;
        z-index: 10;
    }

    .modern-table thead th:first-child {
        border-radius: 12px 0 0 0;
    }

    .modern-table thead th:last-child {
        border-radius: 0 12px 0 0;
    }

    .modern-table tbody tr {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border-radius: 8px;
    }

    .modern-table tbody tr:hover {
        background: linear-gradient(145deg, #f8f9fa 0%, #e9ecef 100%);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
    }

    .modern-table tbody td {
        padding: 16px 14px;
        border: none;
        background: rgba(255, 255, 255, 0.8);
        border-bottom: 1px solid rgba(222, 226, 230, 0.5);
        vertical-align: middle;
    }

    .modern-table tbody tr:hover td {
        background: transparent;
    }

    /* Column Width Optimization */
    .modern-table th:nth-child(1) { width: 6%; }   /* No */
    .modern-table th:nth-child(2) { width: 23%; }  /* Judul */
    .modern-table th:nth-child(3) { width: 23%; }  /* Ringkasan */
    .modern-table th:nth-child(4) { width: 12%; }  /* Penulis */
    .modern-table th:nth-child(5) { width: 12%; }  /* Tanggal */
    .modern-table th:nth-child(6) { width: 12%; }  /* Status */
    .modern-table th:nth-child(7) { width: 12%; }  /* Aksi */

    /* Cell Styling */
    .number-cell {
        font-weight: 700;
        color: #667eea;
        font-size: 14px;
    }

    .title-cell .title-wrapper {
        max-width: 250px;
    }

    .title-text {
        font-weight: 600;
        color: #2c3e50;
        line-height: 1.4;
        margin-bottom: 4px;
    }

    .excerpt-cell {
        color: #6c757d;
        font-size: 13px;
        line-height: 1.4;
    }

    .excerpt-wrapper {
        max-width: 200px;
    }

    .author-cell {
        font-weight: 500;
        color: #495057;
    }

    .author-wrapper i {
        color: #667eea;
    }

    .date-cell {
        font-family: 'Courier New', monospace;
    }

    .date-main {
        font-weight: 600;
        color: #2c3e50;
        font-size: 13px;
    }

    .time-sub {
        font-size: 11px;
        color: #6c757d;
        margin-top: 2px;
    }

    /* Enhanced date column styling */
    #table_id td:nth-child(5), #table_draft td:nth-child(5) { 
        white-space: nowrap; 
        font-family: monospace; 
        font-size: 0.9em; 
        color: #666; 
    }

    /* Style for timezone indicator */
    .timezone { 
        font-size: 0.8em; 
        color: #888; 
        font-weight: 500; 
        margin-left: 2px; 
    }

    /* Status Badges */
    .status-badge {
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border: 2px solid transparent;
        transition: all 0.3s ease;
        display: inline-block;
        min-width: 90px;
        text-align: center;
    }

    .status-published {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        color: white;
        border-color: rgba(40, 167, 69, 0.3);
    }

    .status-draft {
        background: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%);
        color: white;
        border-color: rgba(255, 193, 7, 0.3);
    }

    .status-badge:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }

    /* Status Cell Styling */
    .status-cell {
        white-space: nowrap;
        min-width: 120px;
    }

    /* Action Buttons */
    .action-buttons-group {
        display: flex;
        gap: 8px;
        justify-content: center;
        align-items: center;
    }

    .action-btn {
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

    .view-btn {
        background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
        color: white;
    }

    .view-btn:hover {
        background: linear-gradient(135deg, #138496 0%, #117a8b 100%);
        transform: translateY(-3px) scale(1.05);
        box-shadow: 0 8px 20px rgba(23, 162, 184, 0.4);
        color: white;
    }

    .edit-btn {
        background: linear-gradient(135deg, #ffc107 0%, #e0a800 100%);
        color: white;
    }

    .edit-btn:hover {
        background: linear-gradient(135deg, #e0a800 0%, #d39e00 100%);
        transform: translateY(-3px) scale(1.05);
        box-shadow: 0 8px 20px rgba(255, 193, 7, 0.4);
        color: white;
    }

    .delete-btn {
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        color: white;
    }

    .delete-btn:hover {
        background: linear-gradient(135deg, #c82333 0%, #a71e2a 100%);
        transform: translateY(-3px) scale(1.05);
        box-shadow: 0 8px 20px rgba(220, 53, 69, 0.4);
        color: white;
    }

    .action-btn:active {
        transform: translateY(-1px) scale(0.95);
    }

    .action-btn:hover i {
        animation: actionPulse 0.6s ease-in-out;
    }

    @keyframes actionPulse {
        0%, 100% { transform: scale(1); }
        25% { transform: scale(1.1) rotate(5deg); }
        50% { transform: scale(1.2) rotate(-5deg); }
        75% { transform: scale(1.1) rotate(3deg); }
    }

    /* Responsive Design */
    @media (max-width: 1200px) {
        .modern-table {
            font-size: 13px;
        }
        
        .modern-table thead th,
        .modern-table tbody td {
            padding: 12px 10px;
        }
    }

    @media (max-width: 768px) {
        .modern-body {
            padding: 20px;
        }

        .table-wrapper-enhanced {
            padding: 16px;
            border-radius: 12px;
        }

        .modern-table {
            font-size: 12px;
        }

        .modern-table thead th,
        .modern-table tbody td {
            padding: 10px 8px;
        }

        .action-btn {
            width: 32px;
            height: 32px;
            font-size: 12px;
        }

        .status-badge {
            padding: 6px 12px;
            font-size: 11px;
        }
    }
</style>

<script>
    $(document).ready( function () {
        $('#table_id').DataTable({
            "order": [[4, "desc"]], // Sort by date column by default
            "language": {
                "url": "/assets/i18n/Indonesian.json"
            }
        });
        $('#table_draft').DataTable({
            "order": [[4, "desc"]], // Sort by date column by default
            "language": {
                "url": "/assets/i18n/Indonesian.json"
            }
        });
    });
</script>

<script>
    $(document).ready( function () {
        $('#myTabs a').on('click', function (e) {
            e.preventDefault();
            $(this).tab('show');
        });
    });
</script>
@endsection

