@extends('admin.layouts.main')

@section('content')
    <div class="row">
        <div class="col-lg-12 d-flex align-items-strech">
            <div class="card w-100">
                <div class="card-header bg-primary">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <h5 class="card-title fw-semibold text-white">Gallery</h5>
                        </div>
                        <div class="col-6 text-right">
                            <a href="/admin/gallery/create" type="button" class="btn btn-warning float-end">Tambah
                                Gallery</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <!-- Info Alert -->
                    <div class="alert alert-info mb-3">
                        <i class="fas fa-info-circle me-2"></i>
                        <strong>Info Fitur Filter:</strong> 
                        Tahun dari setiap foto akan otomatis digunakan untuk filter di halaman galeri publik. 
                        Pengunjung dapat memfilter foto berdasarkan tahun unggah.
                        <a href="{{ url('/gallery') }}" target="_blank" class="btn btn-sm btn-outline-primary ms-2">
                            <i class="fas fa-external-link-alt me-1"></i>Lihat Galeri Publik
                        </a>
                    </div>
                    
                    <form method="GET" action="{{ url('/admin/gallery') }}" class="mb-3">
                        <div class="row g-2 align-items-center">
                            <div class="col-auto">
                                <label for="year" class="col-form-label">
                                    <i class="fas fa-calendar-alt me-1"></i>Filter Tahun:
                                </label>
                            </div>
                            <div class="col-auto">
                                <input type="number" name="year" id="year" class="form-control" placeholder="Masukkan Tahun" value="{{ old('year', $filterYear) }}">
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-filter me-1"></i>Filter
                                </button>
                                <a href="{{ url('/admin/gallery') }}" class="btn btn-secondary">
                                    <i class="fas fa-times me-1"></i>Reset
                                </a>
                            </div>
                        </div>
                    </form>

                    @if (session()->has('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="row">
                        <div class="table-responsive">
                            <table id="table_id" class="table display">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Gambar</th>
                                        <th>Keterangan</th>
                                        <th>Tahun</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($gallerys as $gallery)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td><img src="{{ asset('storage/' . $gallery->gambar) }}" alt="Foto Gallery"
                                                    class="img-fluid" style="max-height: 200px; max-width: 200px"></td>
                                            <td>{{ $gallery->keterangan }}</td>
                                            <td>{{ $gallery->year ?? '-' }}</td>
                                            <td>
                                                <a href="/admin/gallery/{{ $gallery->id }}/edit" type="button"
                                                    class="btn btn-warning mb-1"><i class="ti ti-edit"></i></a>
                                                <form id="{{ $gallery->id }}" action="/admin/gallery/{{ $gallery->id }}"
                                                    method="POST" class="d-inline">
                                                    @method('delete')
                                                    @csrf
                                                    <button type="button" class="btn btn-danger swal-confirm mb-1"
                                                        data-form="{{ $gallery->id }}"><i class="ti ti-trash"></i></button>
                                                </form>
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

    <script>
        $(document).ready(function() {
            $('#table_id').DataTable();
        });
    </script>
@endsection
