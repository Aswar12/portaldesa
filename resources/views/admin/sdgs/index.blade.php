@extends('admin.layouts.main')

@section('content')
    <div class="row">
        <div class="col-lg-12 d-flex align-items-strech">
            <div class="card w-100">
                <div class="card-header bg-primary">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <h5 class="card-title fw-semibold text-white">Data SDGS (Sustainable Development Goals)</h5>
                        </div>
                        <div class="col-6 text-right">
                            <button type="button" id="deleteSelectedBtn" class="btn btn-danger me-2" style="display: none;">
                                <i class="fas fa-trash me-2"></i>Hapus Terpilih (<span id="selectedCount">0</span>)
                            </button>
                            <a href="{{ route('admin.sdgs.create') }}" type="button" class="btn btn-warning float-end">
                                <i class="fas fa-plus me-2"></i>Tambah Data SDGS
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
                            <form method="GET" action="{{ route('admin.sdgs.index') }}">
                                <div class="row align-items-end">
                                    <div class="col-md-3">
                                        <label class="form-label">Tahun</label>
                                        <select name="tahun" class="form-select">
                                            <option value="">Semua Tahun</option>
                                            @if(isset($tahunOptions))
                                                @foreach($tahunOptions as $tahun)
                                                    <option value="{{ $tahun }}" {{ request('tahun') == $tahun ? 'selected' : '' }}>
                                                        {{ $tahun }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Status</label>
                                        <select name="status" class="form-select">
                                            <option value="">Semua Status</option>
                                            <option value="Sangat Baik" {{ request('status') == 'Sangat Baik' ? 'selected' : '' }}>Sangat Baik</option>
                                            <option value="Baik" {{ request('status') == 'Baik' ? 'selected' : '' }}>Baik</option>
                                            <option value="Sedang" {{ request('status') == 'Sedang' ? 'selected' : '' }}>Sedang</option>
                                            <option value="Kurang" {{ request('status') == 'Kurang' ? 'selected' : '' }}>Kurang</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-filter me-2"></i>Filter
                                        </button>
                                        <a href="{{ route('admin.sdgs.index') }}" class="btn btn-secondary">
                                            <i class="fas fa-times me-2"></i>Reset
                                        </a>
                                    </div>
                                    <div class="col-md-3 text-end">
                                        <small class="text-muted">
                                            Total: {{ $sdgs->count() ?? 0 }} data
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
                                        <th width="8%">Tahun</th>
                                        <th width="25%">Judul/Program</th>
                                        <th width="12%">Skor Rata-rata</th>
                                        <th width="10%">Status</th>
                                        <th width="10%">Infografis</th>
                                        <th width="12%">Tanggal Input</th>
                                        <th width="15%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                    @forelse ($sdgs as $item)
                        <tr>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input row-checkbox" type="checkbox" value="{{ $item->id }}">
                                </div>
                            </td>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <span class="badge bg-info fs-2">{{ $item->tahun }}</span>
                            </td>
                            <td>
                                <div>
                                    <h6 class="fw-semibold mb-1">{{ $item->judul ?? 'Program SDGS ' . $item->tahun }}</h6>
                                    @if($item->keterangan)
                                        <small class="text-muted">{{ Str::limit($item->keterangan, 50) }}</small>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="text-center">
                                    <div class="fs-4 fw-bold text-primary">{{ number_format($item->skor_rata_rata, 2) }}</div>
                                    <small class="text-muted">dari 5.0</small>
                                </div>
                            </td>
                            <td>
                                @php
                                    $status = $item->status ?? ($item->skor_rata_rata >= 4.5 ? 'Sangat Baik' : ($item->skor_rata_rata >= 3.5 ? 'Baik' : ($item->skor_rata_rata >= 2.5 ? 'Sedang' : 'Kurang')));
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
                                @if($item->infografis || $item->tampil_infografis)
                                    <span class="badge bg-success fs-2">
                                        <i class="fas fa-eye"></i> Aktif
                                    </span>
                                @else
                                    <span class="badge bg-secondary fs-2">
                                        <i class="fas fa-eye-slash"></i> Tidak Aktif
                                    </span>
                                @endif
                            </td>
                            <td>
                                <small class="text-muted">
                                    {{ $item->created_at ? $item->created_at->format('d/m/Y H:i') : '-' }}
                                </small>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.sdgs.edit', $item) }}" 
                                       class="btn btn-warning btn-sm" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" 
                                            class="btn btn-info btn-sm"
                                            data-bs-toggle="modal" 
                                            data-bs-target="#viewModal{{ $item->id }}" 
                                            title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button type="button" 
                                            class="btn btn-danger btn-sm"
                                            onclick="confirmDelete({{ $item->id }})" 
                                            title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center py-4">
                                <div class="d-flex flex-column align-items-center">
                                    <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                    <h5 class="text-muted">Belum Ada Data SDGS</h5>
                                    <p class="text-muted mb-3">Silakan tambah data SDGS terlebih dahulu</p>
                                    <a href="{{ route('admin.sdgs.create') }}" class="btn btn-primary">
                                        <i class="fas fa-plus me-2"></i>Tambah Data SDGS
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modals for viewing details -->
    @foreach($sdgs as $item)
    <div class="modal fade" id="viewModal{{ $item->id }}" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail SDGS - {{ $item->judul ?? 'Program ' . $item->tahun }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-sm">
                                <tr>
                                    <th width="40%">Tahun:</th>
                                    <td>{{ $item->tahun }}</td>
                                </tr>
                                <tr>
                                    <th>Skor Rata-rata:</th>
                                    <td><span class="badge bg-info">{{ number_format($item->skor_rata_rata, 2) }}</span></td>
                                </tr>
                                <tr>
                                    <th>Target 1:</th>
                                    <td>{{ $item->target_1 ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Target 2:</th>
                                    <td>{{ $item->target_2 ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Target 3:</th>
                                    <td>{{ $item->target_3 ?? '-' }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-sm">
                                <tr>
                                    <th width="40%">Target 4:</th>
                                    <td>{{ $item->target_4 ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Target 5:</th>
                                    <td>{{ $item->target_5 ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Infografis:</th>
                                    <td>
                                        @if($item->infografis || $item->tampil_infografis)
                                            <span class="badge bg-success">Aktif</span>
                                        @else
                                            <span class="badge bg-secondary">Tidak Aktif</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Dibuat:</th>
                                    <td>{{ $item->created_at ? $item->created_at->format('d/m/Y H:i') : '-' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    @if($item->keterangan)
                    <hr>
                    <h6>Keterangan:</h6>
                    <p>{{ $item->keterangan }}</p>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <a href="{{ route('admin.sdgs.edit', $item) }}" class="btn btn-primary">Edit</a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
</div>

<script>
// Bulk delete functionality
document.addEventListener('DOMContentLoaded', function() {
    const selectAllCheckbox = document.getElementById('selectAll');
    const rowCheckboxes = document.querySelectorAll('.row-checkbox');
    const deleteSelectedBtn = document.getElementById('deleteSelectedBtn');
    const selectedCountSpan = document.getElementById('selectedCount');
    
    // Select all functionality
    if(selectAllCheckbox) {
        selectAllCheckbox.addEventListener('change', function() {
            rowCheckboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
            updateDeleteButton();
        });
    }
    
    // Individual checkbox functionality
    rowCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            updateSelectAll();
            updateDeleteButton();
        });
    });
    
    function updateSelectAll() {
        if(!selectAllCheckbox) return;
        const checkedCount = document.querySelectorAll('.row-checkbox:checked').length;
        const totalCount = rowCheckboxes.length;
        
        selectAllCheckbox.indeterminate = checkedCount > 0 && checkedCount < totalCount;
        selectAllCheckbox.checked = checkedCount === totalCount;
    }
    
    function updateDeleteButton() {
        if(!deleteSelectedBtn) return;
        const checkedBoxes = document.querySelectorAll('.row-checkbox:checked');
        if (checkedBoxes.length > 0) {
            deleteSelectedBtn.style.display = 'inline-block';
            selectedCountSpan.textContent = checkedBoxes.length;
        } else {
            deleteSelectedBtn.style.display = 'none';
        }
    }
    
    // Bulk delete action
    if(deleteSelectedBtn) {
        deleteSelectedBtn.addEventListener('click', function() {
            const checkedBoxes = document.querySelectorAll('.row-checkbox:checked');
            const ids = Array.from(checkedBoxes).map(cb => cb.value);
            
            if (confirm(`Apakah Anda yakin ingin menghapus ${ids.length} data terpilih?`)) {
                // Implement bulk delete logic here
                console.log('Deleting IDs:', ids);
            }
        });
    }
});

function confirmDelete(id) {
    if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
        // Create form for delete
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/admin/sdgs/${id}`;
        
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = '{{ csrf_token() }}';
        
        const methodField = document.createElement('input');
        methodField.type = 'hidden';
        methodField.name = '_method';
        methodField.value = 'DELETE';
        
        form.appendChild(csrfToken);
        form.appendChild(methodField);
        document.body.appendChild(form);
        form.submit();
    }
}
</script>
@endsection
