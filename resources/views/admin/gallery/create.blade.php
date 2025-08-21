@extends('admin.layouts.main')

@section('content')
    <div class="row">
        <div class="col-lg-12 d-flex align-items-strech">
            <div class="card w-100">
                <div class="card-header bg-primary">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <h5 class="card-title fw-semibold text-white">Tambah Gallery</h5>
                        </div>
                        <div class="col-6 text-right">
                            <a href="/admin/gallery" type="button" class="btn btn-warning float-end">Kembali</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="/admin/gallery" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <img src="" class="img-preview img-fluid mb-3 mt-2" id="preview"
                                style="border-radius: 5px; max-height:300px; overflow:hidden;"><br>
                            <label for="gambar" class="form-label">Gambar <span style="color: red">*</span></label>
                            <input class="form-control" type="file" id="gambar" name="gambar"
                                onchange="previewImage()">
                            @error('gambar')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan <span style="color: red">*</span></label>
                            <input type="text" class="form-control" name="keterangan" id="keterangan"
                                value="{{ old('keterangan') }}">
                            @error('keterangan')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="published_at" class="form-label">
                                <i class="fas fa-calendar-alt me-1"></i>Waktu Unggah (WIT) 
                                <span style="color: red">*</span>
                            </label>
                            <input type="datetime-local" class="form-control" name="published_at" id="published_at" 
                                   value="{{ old('published_at', now()->setTimezone('Asia/Jayapura')->format('Y-m-d\TH:i')) }}" required>
                            <div class="form-text">
                                <i class="fas fa-info-circle me-1"></i>
                                <strong>Info:</strong> Tahun dari tanggal ini akan otomatis digunakan untuk filter di halaman galeri publik.
                                <br>
                                <i class="fas fa-filter me-1"></i>
                                Pengunjung dapat memfilter foto berdasarkan tahun unggah ini.
                            </div>
                            @error('published_at')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary m-1 float-end">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Preview Image -->
    <script>
        function previewImage() {
            preview.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>
@endsection
