@extends('admin.layouts.main')

@section('content')
<div class="card bg-light-info shadow-none position-relative overflow-hidden">
    <div class="card-body px-4 py-3">
        <div class="row align-items-center">
            <div class="col-9">
                <h4 class="fw-semibold mb-8">Bansos (Bantuan Sosial)</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a class="text-muted text-decoration-none" href="/admin">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Bansos</li>
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
            <h5 class="card-title fw-semibold">Data Bantuan Sosial</h5>
            <div class="d-flex gap-2">
                <a href="{{ route('infografis.bansos') }}" target="_blank" class="btn btn-info">
                    <i class="ti ti-chart-line me-1"></i>Lihat Infografis
                </a>
                <a href="{{ route('admin.bansos.create') }}" class="btn btn-primary">
                    <i class="ti ti-plus me-1"></i>Tambah Bansos
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @php
            $totalBansos = $bansos->count();
            $aktivInfografis = $bansos->where('tampil_infografis', true)->count();
            $tidakAktifInfografis = $totalBansos - $aktivInfografis;
        @endphp

        @if($tidakAktifInfografis > 0)
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <i class="ti ti-alert-triangle me-2"></i>
                <strong>Perhatian:</strong> {{ $tidakAktifInfografis }} dari {{ $totalBansos }} data bansos tidak ditampilkan di halaman infografis. 
                Data tersebut hanya terlihat di halaman admin ini.
                <br><small>Untuk menampilkan data di infografis, edit data dan aktifkan opsi "Tampilkan di Halaman Infografis"</small>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Filter Form -->
        <div class="card mb-4">
            <div class="card-body">
                <form method="GET" action="{{ route('admin.bansos.index') }}">
                    <div class="row g-3 align-items-end">
                        <div class="col-md-4">
                            <label for="tahun" class="form-label">Filter Tahun</label>
                            <select name="tahun" id="tahun" class="form-select">
                                <option value="">Semua Tahun</option>
                                @foreach($tahunOptions as $tahun)
                                    <option value="{{ $tahun }}" {{ request('tahun') == $tahun ? 'selected' : '' }}>
                                        {{ $tahun }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="jenis_bansos" class="form-label">Filter Jenis Bansos</label>
                            <select name="jenis_bansos" id="jenis_bansos" class="form-select">
                                <option value="">Semua Jenis</option>
                                @foreach($jenisBansosOptions as $jenis)
                                    <option value="{{ $jenis }}" {{ request('jenis_bansos') == $jenis ? 'selected' : '' }}>
                                        {{ $jenis }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="tampil_infografis" class="form-label">Filter Status Infografis</label>
                            <select name="tampil_infografis" id="tampil_infografis" class="form-select">
                                <option value="">Semua Status</option>
                                <option value="1" {{ request('tampil_infografis') == '1' ? 'selected' : '' }}>
                                    Aktif di Infografis
                                </option>
                                <option value="0" {{ request('tampil_infografis') == '0' ? 'selected' : '' }}>
                                    Tidak Aktif di Infografis
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="row g-3 align-items-end mt-2">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary me-2">
                                <i class="ti ti-filter me-1"></i>Filter
                            </button>
                            <a href="{{ route('admin.bansos.index') }}" class="btn btn-outline-secondary">
                                <i class="ti ti-refresh me-1"></i>Reset
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Judul/Program</th>
                        <th>Jenis Bansos</th>
                        <th>Jumlah Penerima</th>
                        <th>Nominal Dana</th>
                        <th>Periode</th>
                        <th>Tahun</th>
                        <th>Infografis</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($bansos as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <strong>{{ $item->judul }}</strong>
                            </td>
                            <td>
                                <span class="badge bg-primary fs-2">{{ $item->jenis_full_name }}</span>
                            </td>
                            <td>
                                <span class="badge bg-info fs-3">{{ number_format($item->jumlah_penerima) }}</span>
                            </td>
                            <td>
                                <span class="badge bg-success fs-3">{{ $item->dana_formatted }}</span>
                            </td>
                            <td>
                                <small class="text-muted">
                                    {{ $item->periode_mulai?->format('d/m/Y') }}
                                    @if($item->periode_selesai)
                                        - {{ $item->periode_selesai->format('d/m/Y') }}
                                    @endif
                                </small>
                            </td>
                            <td>
                                <span class="badge bg-secondary">{{ $item->tahun }}</span>
                            </td>
                            <td>
                                @if($item->tampil_infografis)
                                    <span class="badge bg-success fs-2">
                                        <i class="ti ti-check"></i> Aktif
                                    </span>
                                @else
                                    <span class="badge bg-secondary fs-2">
                                        <i class="ti ti-x"></i> Tidak Aktif
                                    </span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.bansos.edit', $item) }}" 
                                       class="btn btn-warning btn-sm">
                                        <i class="ti ti-edit"></i>
                                    </a>
                                    @if($item->tampil_infografis)
                                        <form method="POST" action="{{ route('admin.bansos.toggle-infografis', $item) }}" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" 
                                                    class="btn btn-success btn-sm"
                                                    title="Nonaktifkan dari Infografis">
                                                <i class="ti ti-eye-off"></i>
                                            </button>
                                        </form>
                                    @else
                                        <form method="POST" action="{{ route('admin.bansos.toggle-infografis', $item) }}" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" 
                                                    class="btn btn-outline-success btn-sm"
                                                    title="Aktifkan di Infografis">
                                                <i class="ti ti-eye"></i>
                                            </button>
                                        </form>
                                    @endif
                                    <button type="button" 
                                            class="btn btn-danger btn-sm"
                                            onclick="confirmDelete({{ $item->id }})">
                                        <i class="ti ti-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center py-4">
                                <div class="d-flex flex-column align-items-center">
                                    <i class="ti ti-file-x fs-8 text-muted mb-2"></i>
                                    <span class="text-muted">Belum ada data Bansos</span>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if(method_exists($bansos, 'links'))
            <div class="d-flex justify-content-center mt-4">
                {{ $bansos->links() }}
            </div>
        @endif
    </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus data Bansos ini?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form id="deleteForm" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function confirmDelete(id) {
    const form = document.getElementById('deleteForm');
    form.action = '/admin/bansos/' + id;
    
    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    modal.show();
}
</script>
@endsection
