@extends('admin.layouts.main')

@section('content')
    <div class="row">
        <div class="col-lg-12 d-flex align-items-strech">
            <div class="card w-100">
                <div class="card-header bg-primary">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <h5 class="card-title fw-semibold text-white">Data APBDES</h5>
                        </div>
                        <div class="col-6 text-right">
                            <button type="button" id="deleteSelectedBtn" class="btn btn-danger me-2" style="display: none;">
                                <i class="fas fa-trash me-2"></i>Hapus Terpilih (<span id="selectedCount">0</span>)
                            </button>
                            <a href="/admin/apbdes/create" type="button" class="btn btn-warning float-end">
                                <i class="fas fa-plus me-2"></i>Tambah Data APBDES
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <!-- Filter Section -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <form method="GET" action="{{ route('admin.apbdes.index') }}">
                                <div class="row align-items-end">
                                    <div class="col-md-3">
                                        <label class="form-label">Tahun Anggaran</label>
                                        <select name="tahun" class="form-select">
                                            <option value="">Semua Tahun</option>
                                            @foreach($tahunOptions as $tahun)
                                                <option value="{{ $tahun }}" {{ request('tahun') == $tahun ? 'selected' : '' }}>
                                                    {{ $tahun }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Jenis Anggaran</label>
                                        <select name="jenis" class="form-select">
                                            <option value="">Semua Jenis</option>
                                            @foreach($jenisOptions as $jenis)
                                                <option value="{{ $jenis }}" {{ request('jenis') == $jenis ? 'selected' : '' }}>
                                                    {{ ucfirst($jenis) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-filter me-2"></i>Filter
                                        </button>
                                        <a href="{{ route('admin.apbdes.index') }}" class="btn btn-secondary">
                                            <i class="fas fa-times me-2"></i>Reset
                                        </a>
                                    </div>
                                    <div class="col-md-3 text-end">
                                        <small class="text-muted">
                                            Total: {{ $anggarans->count() }} data
                                        </small>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="row">
                        <div class="table-responsive">
                            <table id="table_id" class="table table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th width="3%">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="selectAll">
                                                <label class="form-check-label text-white" for="selectAll"></label>
                                            </div>
                                        </th>
                                        <th width="5%">No</th>
                                        <th width="10%">Gambar</th>
                                        <th width="20%">Judul</th>
                                        <th width="10%">Jenis</th>
                                        <th width="8%">Tahun</th>
                                        <th width="12%">Jumlah</th>
                                        <th width="12%">Realisasi</th>
                                        <th width="8%">Infografis</th>
                                        <th width="15%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($anggarans && $anggarans->count() > 0)
                                        @foreach ($anggarans as $anggaran)
                                            <tr>
                                                <td>
                                                    <div class="form-check">
                                                        <input class="form-check-input row-checkbox" type="checkbox" 
                                                               value="{{ $anggaran->id }}" id="check{{ $anggaran->id }}">
                                                        <label class="form-check-label" for="check{{ $anggaran->id }}"></label>
                                                    </div>
                                                </td>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    @if($anggaran->gambar)
                                                        <img src="{{ asset('storage/' . $anggaran->gambar) }}" 
                                                             alt="Gambar {{ $anggaran->judul }}"
                                                             class="img-fluid rounded" 
                                                             style="max-height: 80px; max-width: 80px; object-fit: cover;">
                                                    @else
                                                        <div class="bg-light rounded d-flex align-items-center justify-content-center"
                                                             style="width: 80px; height: 80px;">
                                                            <i class="fas fa-image text-muted"></i>
                                                        </div>
                                                    @endif
                                                </td>
                                                <td>
                                                    <strong>{{ Str::limit($anggaran->judul, 40) }}</strong>
                                                    @if($anggaran->kategori)
                                                        <br><small class="text-muted">{{ $anggaran->kategori }}</small>
                                                    @endif
                                                </td>
                                                <td>
                                                    <span class="badge 
                                                        @if($anggaran->jenis == 'pendapatan') bg-success 
                                                        @elseif($anggaran->jenis == 'belanja') bg-danger 
                                                        @else bg-warning @endif">
                                                        {{ ucfirst($anggaran->jenis) }}
                                                    </span>
                                                </td>
                                                <td>{{ $anggaran->tahun_anggaran }}</td>
                                                <td>{{ $anggaran->jumlah_formatted ?? 'Rp 0' }}</td>
                                                <td>{{ $anggaran->realisasi_formatted ?? 'Rp 0' }}</td>
                                                <td class="text-center">
                                                    @if(isset($anggaran->tampil_infografis) && $anggaran->tampil_infografis)
                                                        <span class="badge bg-success">
                                                            <i class="fas fa-chart-bar me-1"></i>Ya
                                                        </span>
                                                    @else
                                                        <span class="badge bg-secondary">Tidak</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <a href="/apbdes/{{ $anggaran->slug }}" 
                                                           target="_blank" 
                                                           class="btn btn-success btn-sm" 
                                                           title="Lihat">
                                                            <i class="ti ti-eye"></i>
                                                        </a>
                                                        <a href="/admin/apbdes/{{ $anggaran->id }}/edit" 
                                                           class="btn btn-warning btn-sm" 
                                                           title="Edit">
                                                            <i class="ti ti-edit"></i>
                                                        </a>
                                                        <form id="delete-{{ $anggaran->id }}" 
                                                              action="/admin/apbdes/{{ $anggaran->id }}"
                                                              method="POST" class="d-inline">
                                                            @method('delete')
                                                            @csrf
                                                            <button type="button" 
                                                                    class="btn btn-danger btn-sm swal-confirm" 
                                                                    data-form="delete-{{ $anggaran->id }}"
                                                                    title="Hapus">
                                                                <i class="ti ti-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="10" class="text-center py-4">
                                                <div class="text-muted">
                                                    <i class="fas fa-folder-open fa-3x mb-3"></i>
                                                    <p>Belum ada data APBDES</p>
                                                    <a href="/admin/apbdes/create" class="btn btn-primary">
                                                        <i class="fas fa-plus me-2"></i>Tambah Data Pertama
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Form tersembunyi untuk bulk delete -->
    <form id="bulkDeleteForm" action="{{ route('admin.apbdes.bulk-delete') }}" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
        <input type="hidden" name="selected_ids" id="selectedIds">
    </form>

    <script>
        $(document).ready(function() {
            // Delay DataTable initialization to ensure DOM is fully loaded
            setTimeout(function() {
                $('#table_id').DataTable({
                    "pageLength": 25,
                    "responsive": false,
                    "autoWidth": false,
                    "processing": true,
                    "language": {
                        "emptyTable": "Tidak ada data yang tersedia",
                        "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                        "infoEmpty": "Menampilkan 0 sampai 0 dari 0 entri",
                        "infoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
                        "lengthMenu": "Tampilkan _MENU_ entri",
                        "loadingRecords": "Sedang memuat...",
                        "processing": "Sedang memproses...",
                        "search": "Cari:",
                        "zeroRecords": "Tidak ditemukan data yang sesuai",
                        "paginate": {
                            "first": "Pertama",
                            "last": "Terakhir",
                            "next": "Selanjutnya",
                            "previous": "Sebelumnya"
                        }
                    },
                    "columnDefs": [
                        { "orderable": false, "targets": [0, 2, 9] }, // Disable sorting for checkbox, image and action columns
                        { "width": "3%", "targets": 0 },
                        { "width": "5%", "targets": 1 },
                        { "width": "10%", "targets": 2 },
                        { "width": "20%", "targets": 3 },
                        { "width": "10%", "targets": 4 },
                        { "width": "8%", "targets": 5 },
                        { "width": "12%", "targets": 6 },
                        { "width": "12%", "targets": 7 },
                        { "width": "8%", "targets": 8 },
                        { "width": "15%", "targets": 9 }
                    ]
                });
            }, 100);

            // Select All functionality
            $(document).on('change', '#selectAll', function() {
                $('.row-checkbox').prop('checked', this.checked);
                updateSelectedCount();
            });

            // Individual checkbox change
            $(document).on('change', '.row-checkbox', function() {
                updateSelectedCount();
                
                // Update select all checkbox
                var totalCheckboxes = $('.row-checkbox').length;
                var checkedCheckboxes = $('.row-checkbox:checked').length;
                
                $('#selectAll').prop('indeterminate', checkedCheckboxes > 0 && checkedCheckboxes < totalCheckboxes);
                $('#selectAll').prop('checked', checkedCheckboxes === totalCheckboxes);
            });

            // Update selected count and show/hide delete button
            function updateSelectedCount() {
                var selectedCount = $('.row-checkbox:checked').length;
                $('#selectedCount').text(selectedCount);
                
                if (selectedCount > 0) {
                    $('#deleteSelectedBtn').show();
                } else {
                    $('#deleteSelectedBtn').hide();
                }
            }

            // Bulk delete with double confirmation
            $('#deleteSelectedBtn').click(function() {
                var selectedIds = [];
                $('.row-checkbox:checked').each(function() {
                    selectedIds.push($(this).val());
                });

                if (selectedIds.length === 0) {
                    Swal.fire({
                        title: 'Peringatan!',
                        text: 'Pilih data yang ingin dihapus terlebih dahulu.',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                    });
                    return;
                }

                // First confirmation
                Swal.fire({
                    title: 'Konfirmasi Hapus Data',
                    html: `Anda akan menghapus <strong>${selectedIds.length} data APBDES</strong>.<br>
                           <span style="color: #d33;">Data yang dihapus tidak dapat dikembalikan!</span>`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Lanjutkan',
                    cancelButtonText: 'Batal',
                    customClass: {
                        confirmButton: 'btn btn-danger',
                        cancelButton: 'btn btn-secondary'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Second confirmation (more strict)
                        Swal.fire({
                            title: 'KONFIRMASI AKHIR!',
                            html: `<div style="background: #fff3cd; padding: 15px; border-radius: 5px; margin-bottom: 15px;">
                                     <i class="fas fa-exclamation-triangle" style="color: #856404; margin-right: 5px;"></i>
                                     <strong>PERINGATAN KERAS:</strong>
                                   </div>
                                   Anda yakin ingin menghapus <strong style="color: #d33;">${selectedIds.length} data APBDES</strong>?<br><br>
                                   <strong>Tindakan ini tidak dapat dibatalkan!</strong><br>
                                   <small>Ketik "HAPUS" di bawah untuk melanjutkan:</small>`,
                            input: 'text',
                            inputPlaceholder: 'Ketik "HAPUS" untuk konfirmasi',
                            showCancelButton: true,
                            confirmButtonColor: '#dc3545',
                            cancelButtonColor: '#6c757d',
                            confirmButtonText: 'Ya, Hapus Sekarang!',
                            cancelButtonText: 'Batalkan',
                            inputValidator: (value) => {
                                if (value !== 'HAPUS') {
                                    return 'Anda harus mengetik "HAPUS" untuk melanjutkan!'
                                }
                            },
                            customClass: {
                                confirmButton: 'btn btn-danger',
                                cancelButton: 'btn btn-secondary'
                            }
                        }).then((finalResult) => {
                            if (finalResult.isConfirmed) {
                                // Show processing message
                                Swal.fire({
                                    title: 'Menghapus Data...',
                                    text: 'Mohon tunggu, sedang memproses penghapusan.',
                                    allowOutsideClick: false,
                                    didOpen: () => {
                                        Swal.showLoading();
                                    }
                                });

                                // Submit the form
                                $('#selectedIds').val(selectedIds.join(','));
                                $('#bulkDeleteForm').submit();
                            }
                        });
                    }
                });
            });
        });

        // SweetAlert for individual delete confirmation
        $(document).on('click', '.swal-confirm', function(e) {
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

<style>
/* Custom checkbox styling */
.form-check-input:checked {
    background-color: #dc3545;
    border-color: #dc3545;
}

.form-check-input:focus {
    box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.25);
}

#deleteSelectedBtn {
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.05);
    }
    100% {
        transform: scale(1);
    }
}

/* Indeterminate checkbox style */
.form-check-input:indeterminate {
    background-color: #ffc107;
    border-color: #ffc107;
}

/* Table row hover effect when checkbox checked */
.row-checkbox:checked + label {
    background-color: rgba(220, 53, 69, 0.1);
}

tr:has(.row-checkbox:checked) {
    background-color: rgba(220, 53, 69, 0.05) !important;
}

/* Better button styling */
#deleteSelectedBtn {
    border: none;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    box-shadow: 0 4px 8px rgba(220, 53, 69, 0.3);
}

#deleteSelectedBtn:hover {
    transform: translateY(-1px);
    box-shadow: 0 6px 12px rgba(220, 53, 69, 0.4);
}
</style>
@endsection
