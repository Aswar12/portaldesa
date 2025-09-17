@extends('admin.layouts.main')

@section('content')
    <div class="row">
        <div class="col-lg-12 d-flex align-items-strech">
            <div class="card w-100">
                <div class="card-header bg-primary">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <h5 class="card-title fw-semibold text-white">Tambah Data APBDES</h5>
                        </div>
                        <div class="col-6 text-right">
                            <a href="/admin/apbdes" type="button" class="btn btn-warning float-end">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <form method="POST" action="/admin/apbdes" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="judul" class="form-label">Judul<span style="color: red">*</span></label>
                                <input type="text" class="form-control @error('judul') is-invalid @enderror" 
                                       name="judul" id="judul" value="{{ old('judul') }}">
                                @error('judul')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="slug" class="form-label">Slug/Permalink <span style="color: red">*</span></label>
                                <input type="text" class="form-control @error('slug') is-invalid @enderror" 
                                       name="slug" id="slug" value="{{ old('slug') }}">
                                @error('slug')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="jenis" class="form-label">Jenis Anggaran <span style="color: red">*</span></label>
                                        <select class="form-select @error('jenis') is-invalid @enderror" name="jenis" id="jenis">
                                            <option value="">Pilih Jenis</option>
                                            @foreach($jenisOptions as $key => $value)
                                                <option value="{{ $key }}" {{ old('jenis') == $key ? 'selected' : '' }}>
                                                    {{ $value }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('jenis')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="tahun_anggaran" class="form-label">Tahun Anggaran <span style="color: red">*</span></label>
                                        <input type="number" class="form-control @error('tahun_anggaran') is-invalid @enderror" 
                                               name="tahun_anggaran" id="tahun_anggaran" 
                                               value="{{ old('tahun_anggaran', date('Y')) }}" min="2020" max="2030">
                                        @error('tahun_anggaran')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="jumlah" class="form-label">Jumlah Anggaran (Rp) <span style="color: red">*</span></label>
                                        <input type="text" class="form-control @error('jumlah') is-invalid @enderror" 
                                               name="jumlah" id="jumlah" value="{{ old('jumlah') }}" 
                                               placeholder="Contoh: 123.456.789" oninput="formatNumber(this)">
                                        @error('jumlah')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="realisasi" class="form-label">Realisasi (Rp)</label>
                                        <input type="text" class="form-control @error('realisasi') is-invalid @enderror" 
                                               name="realisasi" id="realisasi" value="{{ old('realisasi', 0) }}" 
                                               placeholder="Contoh: 123.456.789" oninput="formatNumber(this)">
                                        @error('realisasi')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="kategori" class="form-label">Kategori</label>
                                <input type="text" class="form-control @error('kategori') is-invalid @enderror" 
                                       name="kategori" id="kategori" value="{{ old('kategori') }}"
                                       placeholder="Contoh: Infrastruktur, Kesehatan, Pendidikan">
                                @error('kategori')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="keterangan" class="form-label">Keterangan <span style="color: red">*</span></label>
                                <textarea class="form-control @error('keterangan') is-invalid @enderror" 
                                          id="editor" name="keterangan" rows="10">{{ old('keterangan') }}</textarea>
                                @error('keterangan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi Tambahan</label>
                                <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                          name="deskripsi" rows="4" placeholder="Deskripsi detail untuk infografis">{{ old('deskripsi') }}</textarea>
                                @error('deskripsi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <img src="" class="img-preview img-fluid mb-3 mt-2" id="preview"
                                    style="border-radius: 5px; max-height:300px; overflow:hidden; display:none;"><br>
                                <label for="gambar" class="form-label">Gambar APBDES <span style="color: red">*</span></label>
                                <div class="alert alert-warning py-2 mb-2" role="alert">
                                    <small><i class="fas fa-exclamation-triangle"></i> <strong>Wajib diisi:</strong> Upload gambar untuk menampilkan data APBDES</small>
                                </div>
                                <input class="form-control @error('gambar') is-invalid @enderror" 
                                       type="file" id="gambar" name="gambar" onchange="previewImage()"
                                       accept="image/jpeg,image/png,image/jpg">
                                <small class="text-muted">Format: JPG, PNG, JPEG. Maksimal 2MB</small>
                                @error('gambar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- Infografis Settings -->
                            <div class="card mt-3">
                                <div class="card-header bg-info text-white">
                                    <h6 class="mb-0">Pengaturan Infografis</h6>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="warna_chart" class="form-label">Warna Chart</label>
                                        <input type="color" class="form-control form-control-color" 
                                               name="warna_chart" id="warna_chart" value="{{ old('warna_chart', '#007bff') }}">
                                    </div>
                                    
                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" 
                                                   name="tampil_infografis" id="tampil_infografis" value="1"
                                                   {{ old('tampil_infografis') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="tampil_infografis">
                                                Tampilkan di Infografis
                                            </label>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="urutan_chart" class="form-label">Urutan Chart</label>
                                        <input type="number" class="form-control" name="urutan_chart" 
                                               id="urutan_chart" value="{{ old('urutan_chart', 1) }}" min="1">
                                    </div>
                                </div>
                            </div>
                            
                            <button type="submit" class="btn btn-primary w-100 mt-3">
                                <i class="fas fa-save me-2"></i>Simpan Data
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Generate Slug Otomatis -->
    <script>
        const judul = document.querySelector('#judul');
        const slug = document.querySelector('#slug');

        judul.addEventListener('change', function() {
            fetch('/admin/apbdes/slug?judul=' + judul.value)
                .then(response => response.json())
                .then(data => slug.value = data.slug)
        });

        // Function to format numbers with commas
        function formatNumber(input) {
            // Remove all non-digit characters except decimal point
            let value = input.value.replace(/[^\d]/g, '');
            
            // Format with commas
            if (value) {
                value = parseInt(value).toLocaleString('id-ID');
            }
            
            // Update input value
            input.value = value;
        }

        // Initialize formatting on page load for existing values
        document.addEventListener('DOMContentLoaded', function() {
            const jumlahInput = document.getElementById('jumlah');
            const realisasiInput = document.getElementById('realisasi');
            
            if (jumlahInput.value) {
                formatNumber(jumlahInput);
            }
            if (realisasiInput.value) {
                formatNumber(realisasiInput);
            }
        });
    </script>

    <!-- Preview Image -->
    <script>
        function previewImage() {
            const preview = document.querySelector('#preview');
            const file = event.target.files[0];
            
            if (file) {
                preview.src = URL.createObjectURL(file);
                preview.style.display = 'block';
            }
        }
    </script>

    <!-- CK Editor 5 -->
    <script src="https://cdn.ckeditor.com/ckeditor5/35.3.0/classic/ckeditor.js"></script>
    <script>
        let editorInstance;
        ClassicEditor
            .create(document.querySelector('#editor'))
            .then(editor => {
                editorInstance = editor;
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
