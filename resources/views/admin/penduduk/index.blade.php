@extends('admin.layouts.main')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Daftar Penduduk</h1>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.penduduk.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Penduduk
            </a>
        </div>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('warning'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ session('warning') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Import Excel Card -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">
                <i class="fas fa-file-excel text-success"></i> Import Data Penduduk dari Excel
            </h5>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-12">
                    <a href="{{ route('admin.penduduk.template') }}" class="btn btn-outline-success">
                        <i class="fas fa-download"></i> Download Template Excel
                    </a>
                </div>
            </div>
            <form action="{{ route('admin.penduduk.import') }}" method="POST" enctype="multipart/form-data" id="importForm">
                @csrf
                <div class="row">
                    <div class="col-md-8">
                        <input type="file" name="excel_file" class="form-control" accept=".xlsx,.xls,.csv,.txt" required>
                        <small class="text-muted">Format yang didukung: .xlsx, .xls, .csv, .txt (Maksimal 10MB)</small>
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-success w-100" id="importBtn">
                            <i class="fas fa-upload"></i> Import Excel
                        </button>
                    </div>
                </div>
            </form>
            <hr>
            <div class="alert alert-info mb-0">
                <small>
                    <strong>Format Excel yang diharapkan:</strong><br>
                    Kolom: NO, NO. KK, NIK, NAMA, JENIS KELAMIN, TEMPAT LAHIR, TANGGAL LAHIR, AGAMA, PEKERJAAN, STATUS DLM KELUARGA, UMUR, ALAMAT
                    <br><strong>Contoh file:</strong> DATA PENDUDUK KADUN.xlsx
                    <br><br>
                    <strong>Catatan penting:</strong>
                    <ul class="mb-0">
                        <li>NIK harus berupa 16 digit angka</li>
                        <li>Baris header akan otomatis dilewati</li>
                        <li>Format tanggal yang didukung: DD/MM/YYYY, DD-MM-YYYY, YYYY-MM-DD, DD-MMM-YYYY (19-Jul-1986)</li>
                        <li>Jenis kelamin: Laki-laki/Perempuan (atau L/P)</li>
                        <li>Agama: Islam, Kristen, Katolik, Hindu, Buddha, Konghucu, dll</li>
                    </ul>
                </small>
            </div>
        </div>
    </div>

    <!-- Data Table -->
    <div class="card">
        <div class="card-header bg-light d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                <i class="fas fa-users"></i> Data Penduduk
                <span class="badge bg-primary ms-2">{{ $penduduks->total() }} Total</span>
            </h5>
            <div class="input-group" style="max-width: 300px;">
                <input type="text" id="searchInput" class="form-control" placeholder="Cari NIK atau nama..." aria-label="Search">
                <button class="btn btn-outline-secondary" type="button" id="searchButton">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <!-- Filter Section -->
            <div class="row mb-3">
                <div class="col-md-12">
                    <div class="d-flex flex-wrap gap-2">
                        <select id="filterJenisKelamin" class="form-select form-select-sm" style="max-width: 150px;">
                            <option value="">Semua Jenis Kelamin</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                        <select id="filterAgama" class="form-select form-select-sm" style="max-width: 150px;">
                            <option value="">Semua Agama</option>
                            @foreach(\App\Models\Penduduk::getValidAgama() as $agama)
                                <option value="{{ $agama }}">{{ $agama }}</option>
                            @endforeach
                        </select>
                        <button id="resetFilter" class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-sync-alt"></i> Reset Filter
                        </button>
                        <button id="exportExcel" class="btn btn-sm btn-outline-success ms-auto">
                            <i class="fas fa-file-excel"></i> Export Excel
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="table-responsive table-wrapper">
                <table class="table table-hover custom-table" id="pendudukTable">
                    <thead>
                        <tr class="table-header">
                            <th class="sortable" data-sort="nik">NIK <i class="fas fa-sort"></i></th>
                            <th class="sortable" data-sort="nama">Nama <i class="fas fa-sort"></i></th>
                            <th>Alamat</th>
                            <th>No KK</th>
                            <th class="sortable" data-sort="ttl">Tanggal Lahir <i class="fas fa-sort"></i></th>
                            <th class="sortable" data-sort="umur">Usia <i class="fas fa-sort"></i></th>
                            <th>Jenis Kelamin</th>
                            <th>Agama</th>
                            <th>Pekerjaan</th>
                            <th class="text-center action-column">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($penduduks as $penduduk)
                        <tr>
                            <td><small>{{ $penduduk->nik }}</small></td>
                            <td>{{ $penduduk->nama }}</td>
                            <td>{{ Str::limit($penduduk->alamat, 30) }}</td>
                            <td>{{ $penduduk->kk ?? '-' }}</td>
                            <td>
                                @if($penduduk->ttl)
                                    {{ \Carbon\Carbon::parse($penduduk->ttl)->format('d/m/Y') }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if($penduduk->ttl)
                                    {{ $penduduk->umur }} tahun
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if($penduduk->jenis_kelamin)
                                    <span class="badge {{ $penduduk->jenis_kelamin == 'Laki-laki' ? 'text-bg-primary' : 'text-bg-danger' }}" 
                                          style="{{ $penduduk->jenis_kelamin == 'Laki-laki' ? 'background-color: #0d6efd;' : 'background-color: #ff69b4;' }}">
                                        {{ $penduduk->jenis_kelamin }}
                                    </span>
                                @elseif($penduduk->jenisKelamin)
                                    <span class="badge {{ $penduduk->jenisKelamin->jenis_kelamin == 'Laki-laki' ? 'text-bg-primary' : 'text-bg-danger' }}"
                                          style="{{ $penduduk->jenisKelamin->jenis_kelamin == 'Laki-laki' ? 'background-color: #0d6efd;' : 'background-color: #ff69b4;' }}">
                                        {{ $penduduk->jenisKelamin->jenis_kelamin }}
                                    </span>
                                @else
                                    <span class="badge bg-secondary">Tidak Ada</span>
                                @endif
                            </td>
                            <td>
                                @if($penduduk->agama)
                                    {{ $penduduk->agama }}
                                @elseif($penduduk->agama_relation)
                                    {{ $penduduk->agama_relation->agama }}
                                @else
                                    <span class="text-muted">Tidak Ada</span>
                                @endif
                            </td>
                            <td>
                                @if($penduduk->pekerjaan)
                                    {{ Str::limit($penduduk->pekerjaan, 20) }}
                                @elseif($penduduk->pekerjaan_relation)
                                    {{ Str::limit($penduduk->pekerjaan_relation->pekerjaan, 20) }}
                                @else
                                    <span class="text-muted">Tidak Ada</span>
                                @endif
                            </td>
                            <td class="text-center action-cell">
                                <div class="action-buttons">
                                    <a href="{{ route('admin.penduduk.edit', $penduduk->id) }}" 
                                       class="btn btn-warning btn-sm action-btn edit-btn" 
                                       data-bs-toggle="tooltip" 
                                       title="Edit Data">
                                        <i class="fa-solid fa-pen-to-square fa-fw"></i>
                                    </a>
                                    <button type="button" 
                                            class="btn btn-danger btn-sm action-btn delete-btn" 
                                            data-id="{{ $penduduk->id }}" 
                                            data-name="{{ $penduduk->nama }}" 
                                            data-bs-toggle="tooltip" 
                                            title="Hapus Data">
                                        <i class="fa-solid fa-trash-can fa-fw"></i>
                                    </button>
                                </div>
                                <form id="delete-form-{{ $penduduk->id }}" 
                                      action="{{ route('admin.penduduk.destroy', $penduduk->id) }}" 
                                      method="POST" 
                                      style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10" class="text-center">
                                <div class="py-4">
                                    <i class="fas fa-users fa-3x text-muted mb-3"></i>
                                    <p class="text-muted">Belum ada data penduduk</p>
                                    <a href="{{ route('admin.penduduk.create') }}" class="btn btn-primary">
                                        <i class="fas fa-plus"></i> Tambah Penduduk Pertama
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            @if($penduduks->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $penduduks->links() }}
                </div>
            @endif
        </div>
    </div>
</div>

<script>
// Setup CSRF token for AJAX requests
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// Handle import form submission
document.getElementById('importForm').addEventListener('submit', function(e) {
    const importBtn = document.getElementById('importBtn');
    
    // Check if CSRF token exists
    const csrfToken = document.querySelector('input[name="_token"]').value;
    if (!csrfToken) {
        e.preventDefault();
        alert('Session expired. Please refresh the page and try again.');
        location.reload();
        return false;
    }
    
    importBtn.disabled = true;
    importBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mengimpor...';
});

// Initialize table functionality when the DOM is fully loaded
document.addEventListener('DOMContentLoaded', function() {
    // Table filtering and sorting
    const searchInput = document.getElementById('searchInput');
    const searchButton = document.getElementById('searchButton');
    const filterJenisKelamin = document.getElementById('filterJenisKelamin');
    const filterAgama = document.getElementById('filterAgama');
    const resetFilter = document.getElementById('resetFilter');
    const exportExcel = document.getElementById('exportExcel');
    const table = document.getElementById('pendudukTable');
    const rows = table.querySelectorAll('tbody tr');
    
    // Search functionality
    function performSearch() {
        const searchTerm = searchInput.value.toLowerCase();
        const jenisKelaminFilter = filterJenisKelamin.value;
        const agamaFilter = filterAgama.value;
        
        rows.forEach(function(row) {
            const nik = row.cells[0].textContent.toLowerCase();
            const nama = row.cells[1].textContent.toLowerCase();
            const jenisKelamin = row.cells[6].textContent.trim();
            const agama = row.cells[7].textContent.trim();
            
            const matchesSearch = searchTerm === '' || 
                                 nik.includes(searchTerm) || 
                                 nama.includes(searchTerm);
                                 
            const matchesJenisKelamin = jenisKelaminFilter === '' || 
                                       jenisKelamin.includes(jenisKelaminFilter);
                                       
            const matchesAgama = agamaFilter === '' || 
                               agama.includes(agamaFilter);
            
            row.style.display = (matchesSearch && matchesJenisKelamin && matchesAgama) ? '' : 'none';
        });
    }
    
    // Add event listeners
    searchInput.addEventListener('keyup', performSearch);
    searchButton.addEventListener('click', performSearch);
    filterJenisKelamin.addEventListener('change', performSearch);
    filterAgama.addEventListener('change', performSearch);
    
    // Reset filter
    resetFilter.addEventListener('click', function() {
        searchInput.value = '';
        filterJenisKelamin.selectedIndex = 0;
        filterAgama.selectedIndex = 0;
        performSearch();
    });
    
    // Sorting functionality
    document.querySelectorAll('.sortable').forEach(function(header) {
        header.addEventListener('click', function() {
            const column = this.getAttribute('data-sort');
            const ascending = this.classList.contains('sort-asc');
            
            // Reset all headers
            document.querySelectorAll('.sortable').forEach(h => {
                h.classList.remove('sort-asc', 'sort-desc');
                h.querySelector('i').className = 'fas fa-sort';
            });
            
            // Set new sort direction
            if (ascending) {
                this.classList.add('sort-desc');
                this.querySelector('i').className = 'fas fa-sort-down';
            } else {
                this.classList.add('sort-asc');
                this.querySelector('i').className = 'fas fa-sort-up';
            }
            
            // Sort the rows
            const rowsArray = Array.from(rows);
            rowsArray.sort(function(a, b) {
                let valA, valB;
                
                switch(column) {
                    case 'nik':
                        valA = a.cells[0].textContent.trim();
                        valB = b.cells[0].textContent.trim();
                        break;
                    case 'nama':
                        valA = a.cells[1].textContent.trim();
                        valB = b.cells[1].textContent.trim();
                        break;
                    case 'ttl':
                        valA = a.cells[4].textContent.trim();
                        valB = b.cells[4].textContent.trim();
                        // Handle '-' values
                        if (valA === '-') valA = '01/01/2100';
                        if (valB === '-') valB = '01/01/2100';
                        break;
                    case 'umur':
                        valA = parseInt(a.cells[5].textContent.trim()) || 0;
                        valB = parseInt(b.cells[5].textContent.trim()) || 0;
                        return ascending ? valA - valB : valB - valA;
                }
                
                // String comparison for non-numeric values
                if (typeof valA === 'string') {
                    return ascending ? 
                        valA.localeCompare(valB) : 
                        valB.localeCompare(valA);
                }
            });
            
            // Reorder the table
            const tbody = table.querySelector('tbody');
            rowsArray.forEach(function(row) {
                tbody.appendChild(row);
            });
        });
    });
    
    // Export to Excel
    exportExcel.addEventListener('click', function() {
        window.location.href = "{{ route('admin.penduduk.export') }}";
    });
});

// Auto refresh CSRF token every 5 minutes
setInterval(function() {
    fetch('/admin/penduduk', {
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    }).then(response => {
        if (response.status === 419) {
            alert('Session expired. Page will be refreshed.');
            location.reload();
        }
    }).catch(error => {
        console.log('CSRF check error:', error);
    });
}, 300000); // 5 minutes
</script>
<style>
    /* Enhanced Table Styles */
    .table-wrapper {
        background: linear-gradient(145deg, #ffffff 0%, #f8f9fa 100%);
        padding: 24px;
        border-radius: 16px;
        box-shadow: 
            0 8px 32px rgba(0, 0, 0, 0.08),
            0 4px 16px rgba(0, 0, 0, 0.04);
        border: 1px solid rgba(255, 255, 255, 0.8);
        position: relative;
        overflow: hidden;
    }

    .table-wrapper::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #667eea, #764ba2, #667eea);
        animation: shimmer 3s ease-in-out infinite;
    }

    @keyframes shimmer {
        0%, 100% { opacity: 0.7; }
        50% { opacity: 1; }
    }

    .custom-table {
        margin-bottom: 0;
        width: 100%;
        min-width: 1100px;
        background: transparent;
        border-collapse: separate;
        border-spacing: 0;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .table-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        position: sticky;
        top: 0;
        z-index: 10;
    }

    .custom-table th {
        font-weight: 700;
        padding: 16px 12px;
        border: none;
        color: white;
        text-align: center;
        font-size: 13px;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        position: relative;
        white-space: nowrap;
    }

    .custom-table th:first-child {
        border-radius: 12px 0 0 0;
    }

    .custom-table th:last-child {
        border-radius: 0 12px 0 0;
    }

    .custom-table td {
        padding: 14px 12px;
        vertical-align: middle;
        border: none;
        color: #495057;
        font-size: 14px;
        line-height: 1.4;
        background: rgba(255, 255, 255, 0.8);
        border-bottom: 1px solid rgba(222, 226, 230, 0.5);
        text-align: center;
    }

    .custom-table tbody tr {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border-radius: 8px;
    }

    .custom-table tbody tr:hover {
        background: linear-gradient(145deg, #f8f9fa 0%, #e9ecef 100%);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
    }

    .custom-table tbody tr:hover td {
        background: transparent;
        color: #2c3e50;
    }

    /* Optimized Column Widths for Better Readability */
    .custom-table th:nth-child(1) { width: 12%; } /* NIK */
    .custom-table th:nth-child(2) { width: 16%; } /* Nama */
    .custom-table th:nth-child(3) { width: 16%; } /* Alamat */
    .custom-table th:nth-child(4) { width: 8%; }  /* No KK */
    .custom-table th:nth-child(5) { width: 10%; } /* Tgl Lahir */
    .custom-table th:nth-child(6) { width: 6%; }  /* Usia */
    .custom-table th:nth-child(7) { width: 10%; } /* Jenis Kelamin */
    .custom-table th:nth-child(8) { width: 8%; }  /* Agama */
    .custom-table th:nth-child(9) { width: 8%; }  /* Pekerjaan */
    .custom-table th:nth-child(10) { width: 6%; } /* Aksi */

    /* Enhanced Sorting Styles */
    .sortable {
        cursor: pointer;
        position: relative;
        user-select: none;
        transition: all 0.3s ease;
    }

    .sortable:hover {
        background: rgba(255, 255, 255, 0.2);
        transform: translateY(-1px);
    }

    .sortable i {
        margin-left: 6px;
        font-size: 11px;
        opacity: 0.7;
        transition: all 0.3s ease;
    }

    .sortable:hover i {
        opacity: 1;
        transform: scale(1.1);
    }

    .sort-asc, .sort-desc {
        background: rgba(255, 255, 255, 0.15);
    }

    .sort-asc i::before {
        content: "\f0de";
        color: #ffffff;
    }

    .sort-desc i::before {
        content: "\f0dd";  
        color: #ffffff;
    }

    /* Enhanced Action Buttons */
    .action-buttons {
        display: flex;
        gap: 8px;
        justify-content: center;
        align-items: center;
    }

    .action-btn {
        width: 36px;
        height: 36px;
        padding: 0;
        border-radius: 8px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        border: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    }

    .action-btn i {
        font-size: 14px;
        transition: transform 0.3s ease;
    }

    .edit-btn {
        background: linear-gradient(135deg, #ffc107 0%, #ff9800 100%);
        color: #ffffff;
        border: 1px solid rgba(255, 193, 7, 0.3);
    }

    .edit-btn:hover {
        background: linear-gradient(135deg, #ff9800 0%, #f57c00 100%);
        transform: translateY(-3px) scale(1.05);
        box-shadow: 0 8px 20px rgba(255, 152, 0, 0.4);
        color: #ffffff;
    }

    .delete-btn {
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        color: #ffffff;
        border: 1px solid rgba(220, 53, 69, 0.3);
    }

    .delete-btn:hover {
        background: linear-gradient(135deg, #c82333 0%, #a71e2a 100%);
        transform: translateY(-3px) scale(1.05);
        box-shadow: 0 8px 20px rgba(220, 53, 69, 0.4);
        color: #ffffff;
    }

    .action-btn:active {
        transform: translateY(-1px) scale(0.95);
    }

    /* Enhanced pulse effect on hover */
    .action-btn:hover i {
        animation: enhancedPulse 0.6s ease-in-out;
    }

    @keyframes enhancedPulse {
        0%, 100% { transform: scale(1); }
        25% { transform: scale(1.1) rotate(5deg); }
        50% { transform: scale(1.2) rotate(-5deg); }
        75% { transform: scale(1.1) rotate(3deg); }
    }

    .action-column {
        width: 80px;
    }

    /* Enhanced Badges */
    .badge {
        font-size: 12px;
        padding: 6px 12px;
        border-radius: 20px;
        font-weight: 600;
        letter-spacing: 0.3px;
        text-transform: uppercase;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
        border: 2px solid transparent;
        transition: all 0.3s ease;
    }

    .text-bg-primary {
        background: linear-gradient(135deg, #4285f4 0%, #1976d2 100%) !important;
        border-color: rgba(66, 133, 244, 0.3);
    }

    .text-bg-danger {
        background: linear-gradient(135deg, #ff69b4 0%, #e91e63 100%) !important;
        border-color: rgba(255, 105, 180, 0.3);
    }

    .bg-secondary {
        background: linear-gradient(135deg, #6c757d 0%, #495057 100%) !important;
    }

    .badge:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }

    /* Enhanced Responsive Design */
    @media (max-width: 1200px) {
        .custom-table {
            min-width: 900px;
            font-size: 13px;
        }
        
        .custom-table th,
        .custom-table td {
            padding: 10px 8px;
        }
    }

    @media (max-width: 768px) {
        .table-wrapper {
            padding: 16px;
            border-radius: 12px;
        }

        .custom-table {
            font-size: 12px;
            min-width: 800px;
        }

        .custom-table th,
        .custom-table td {
            padding: 8px 6px;
        }

        .action-buttons {
            gap: 4px;
        }

        .action-btn {
            width: 32px;
            height: 32px;
        }

        .action-btn i {
            font-size: 12px;
        }

        .badge {
            font-size: 10px;
            padding: 4px 8px;
        }
    }

    /* Cell Content Styling */
    .custom-table td:first-child {
        font-family: 'Courier New', monospace;
        font-size: 13px;
        color: #495057;
        font-weight: 600;
    }

    .custom-table td:nth-child(2) {
        font-weight: 600;
        color: #2c3e50;
    }

    .custom-table td:nth-child(3) {
        color: #6c757d;
        font-size: 13px;
    }

    .custom-table td:nth-child(4) {
        font-family: 'Courier New', monospace;
        font-size: 13px;
    }

    .custom-table td:nth-child(5),
    .custom-table td:nth-child(6) {
        font-weight: 500;
        color: #495057;
    }

    /* Loading States */
    .table-loading {
        position: relative;
        opacity: 0.6;
        pointer-events: none;
    }

    .table-loading::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 32px;
        height: 32px;
        border: 3px solid #f3f3f3;
        border-top: 3px solid #667eea;
        border-radius: 50%;
        animation: spin 1s linear infinite;
        transform: translate(-50%, -50%);
        z-index: 1000;
    }

    @keyframes spin {
        0% { transform: translate(-50%, -50%) rotate(0deg); }
        100% { transform: translate(-50%, -50%) rotate(360deg); }
    }

    /* Empty State Styling */
    .empty-state {
        padding: 60px 20px;
        text-align: center;
        background: linear-gradient(145deg, #f8f9fa 0%, #e9ecef 100%);
        border-radius: 12px;
    }

    .empty-state i {
        color: #6c757d;
        margin-bottom: 20px;
        opacity: 0.6;
    }

    .empty-state p {
        color: #6c757d;
        font-size: 16px;
        margin-bottom: 25px;
    }

    /* Additional Utilities */
    .text-nowrap {
        white-space: nowrap;
    }

    .text-ellipsis {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        max-width: 150px;
    }

    /* Enhanced Tooltip Styling */
    .tooltip {
        font-size: 12px;
        font-weight: 500;
    }

    .tooltip-inner {
        background-color: #2c3e50;
        border-radius: 6px;
        padding: 8px 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }

    .tooltip.bs-tooltip-top .tooltip-arrow::before {
        border-top-color: #2c3e50;
    }

    .tooltip.bs-tooltip-bottom .tooltip-arrow::before {
        border-bottom-color: #2c3e50;
    }

    .tooltip.bs-tooltip-start .tooltip-arrow::before {
        border-left-color: #2c3e50;
    }

    .tooltip.bs-tooltip-end .tooltip-arrow::before {
        border-right-color: #2c3e50;
    }
</style>

<script>
    // Initialize delete buttons
    document.addEventListener('DOMContentLoaded', function() {
        // Add event listeners to delete buttons
        const deleteButtons = document.querySelectorAll('.delete-btn');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const name = this.getAttribute('data-name');
                
                if (confirm('Yakin ingin menghapus data penduduk ' + name + '?')) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        });

        // Initialize tooltips
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[title]'));
        const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
</script>
@endsection
