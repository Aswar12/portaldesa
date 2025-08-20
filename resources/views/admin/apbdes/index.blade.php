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
                                    @forelse ($anggarans as $anggaran)
                                        <tr>
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
                                            <td>{{ $anggaran->jumlah_formatted }}</td>
                                            <td>{{ $anggaran->realisasi_formatted }}</td>
                                            <td class="text-center">
                                                @if($anggaran->tampil_infografis)
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
                                    @empty
                                        <tr>
                                            <td colspan="9" class="text-center py-4">
                                                <div class="text-muted">
                                                    <i class="fas fa-folder-open fa-3x mb-3"></i>
                                                    <p>Belum ada data APBDES</p>
                                                    <a href="/admin/apbdes/create" class="btn btn-primary">
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

    <script>
        $(document).ready(function() {
            $('#table_id').DataTable({
                "pageLength": 25,
                "responsive": true,
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
                },
                "columnDefs": [
                    { "orderable": false, "targets": [1, 8] } // Disable sorting for image and action columns
                ]
            });
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
