@extends('admin.layouts.main')

@section('content')
<div class="card bg-light-info shadow-none position-relative overflow-hidden">
    <div class="card-body px-4 py-3">
        <div class="row align-items-center">
            <div class="col-9">
                <h4 class="fw-semibold mb-8">SDGS (Sustainable Development Goals)</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a class="text-muted text-decoration-none" href="/admin">Home</a>
                        </li>
                        <li class="breadcrumb-item active">SDGS</li>
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
            <h5 class="card-title fw-semibold">Data SDGS</h5>
            <a href="{{ route('sdgs.create') }}" class="btn btn-primary">
                <i class="ti ti-plus me-1"></i>Tambah SDGS
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Tahun</th>
                        <th>Skor Rata-rata</th>
                        <th>Status</th>
                        <th>Infografis</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($sdgs as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->tahun }}</td>
                            <td>
                                <span class="badge bg-info fs-2">{{ number_format($item->skor_rata_rata, 2) }}</span>
                            </td>
                            <td>
                                @php
                                    $status = $item->status;
                                    $badgeClass = match($status) {
                                        'Sangat Baik' => 'bg-success',
                                        'Baik' => 'bg-primary',
                                        'Sedang' => 'bg-warning',
                                        'Kurang' => 'bg-danger',
                                        default => 'bg-secondary'
                                    };
                                @endphp
                                <span class="badge {{ $badgeClass }} fs-2">{{ $status }}</span>
                            </td>
                            <td>
                                @if($item->infografis)
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
                                    <a href="{{ route('sdgs.edit', $item) }}" 
                                       class="btn btn-warning btn-sm">
                                        <i class="ti ti-edit"></i>
                                    </a>
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
                            <td colspan="6" class="text-center py-4">
                                <div class="d-flex flex-column align-items-center">
                                    <i class="ti ti-file-x fs-8 text-muted mb-2"></i>
                                    <span class="text-muted">Belum ada data SDGS</span>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if(method_exists($sdgs, 'links'))
            <div class="d-flex justify-content-center mt-4">
                {{ $sdgs->links() }}
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
                <p>Apakah Anda yakin ingin menghapus data SDGS ini?</p>
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
    form.action = '/admin/sdgs/' + id;
    
    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    modal.show();
}
</script>
@endsection
