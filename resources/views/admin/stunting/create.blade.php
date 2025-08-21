@extends('admin.layouts.main')

@section('content')
    <div class="row">
        <div class="col-lg-12 d-flex align-items-strech">
            <div class="card w-100">
                <div class="card-header bg-primary">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <h5 class="card-title fw-semibold text-white">Tambah Data Stunting</h5>
                        </div>
                        <div class="col-6 text-right">
                            <a href="/admin/stunting" type="button" class="btn btn-warning float-end">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <form method="POST" action="/admin/stunting" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="judul" class="form-label">Judul<span style="color: red">*</span></label>
                                <input type="text" class="form-control @error('judul') is-invalid @enderror" 
                                       name="judul" id="judul" value="{{ old('judul') }}"
                                       placeholder="Contoh: Data Stunting Balita 2024">
                                @error('judul')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="published_at" class="form-label">Waktu Unggah (WIT) <span style="color: red">*</span></label>
                                        <input type="datetime-local" class="form-control @error('published_at') is-invalid @enderror" 
                                               name="published_at" id="published_at" 
                                               value="{{ old('published_at', now()->setTimezone('Asia/Jayapura')->format('Y-m-d\TH:i')) }}" required>
                                        <small class="text-muted">Tahun akan otomatis diambil dari waktu unggah ini</small>
                                        @error('published_at')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="warna_chart" class="form-label">Warna Chart</label>
                                        <input type="color" class="form-control form-control-color" 
                                               name="warna_chart" id="warna_chart" value="{{ old('warna_chart', '#ff6b6b') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="card mb-3">
                                <div class="card-header bg-info text-white">
                                    <h6 class="mb-0">📊 Data Balita</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="balita_normal" class="form-label">
                                                    <i class="fas fa-smile text-success"></i> Balita Normal <span style="color: red">*</span>
                                                </label>
                                                <input type="number" class="form-control @error('balita_normal') is-invalid @enderror" 
                                                       name="balita_normal" id="balita_normal" value="{{ old('balita_normal', 0) }}" min="0">
                                                @error('balita_normal')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="balita_stunting" class="form-label">
                                                    <i class="fas fa-exclamation-triangle text-danger"></i> Balita Stunting <span style="color: red">*</span>
                                                </label>
                                                <input type="number" class="form-control @error('balita_stunting') is-invalid @enderror" 
                                                       name="balita_stunting" id="balita_stunting" value="{{ old('balita_stunting', 0) }}" min="0">
                                                @error('balita_stunting')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="balita_kurus" class="form-label">
                                                    <i class="fas fa-arrow-down text-warning"></i> Balita Kurus <span style="color: red">*</span>
                                                </label>
                                                <input type="number" class="form-control @error('balita_kurus') is-invalid @enderror" 
                                                       name="balita_kurus" id="balita_kurus" value="{{ old('balita_kurus', 0) }}" min="0">
                                                @error('balita_kurus')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="balita_gemuk" class="form-label">
                                                    <i class="fas fa-arrow-up text-info"></i> Balita Gemuk <span style="color: red">*</span>
                                                </label>
                                                <input type="number" class="form-control @error('balita_gemuk') is-invalid @enderror" 
                                                       name="balita_gemuk" id="balita_gemuk" value="{{ old('balita_gemuk', 0) }}" min="0">
                                                @error('balita_gemuk')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="alert alert-info">
                                        <i class="fas fa-info-circle"></i> <strong>Total Balita:</strong> <span id="total_balita">0</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="keterangan" class="form-label">Keterangan</label>
                                <textarea class="form-control @error('keterangan') is-invalid @enderror" 
                                          id="editor" name="keterangan" rows="6" 
                                          placeholder="Keterangan tambahan tentang data stunting">{{ old('keterangan') }}</textarea>
                                @error('keterangan')
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
                                    style="border-radius: 5px; max-height:300px; overflow:hidden; display:none; width: 100%; object-fit: cover;"><br>
                                <label for="gambar" class="form-label">Gambar Stunting</label>
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
                                <div class="card-header bg-success text-white">
                                    <h6 class="mb-0">📊 Pengaturan Infografis</h6>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" 
                                                   name="tampil_infografis" id="tampil_infografis" value="1"
                                                   {{ old('tampil_infografis', true) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="tampil_infografis">
                                                Tampilkan di Halaman Infografis
                                            </label>
                                        </div>
                                        <small class="text-muted">Data akan muncul di halaman infografis stunting</small>
                                    </div>
                                </div>
                            </div>
                            
                            <button type="submit" class="btn btn-primary w-100 mt-3">
                                <i class="fas fa-save me-2"></i>Simpan Data Stunting
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Preview Image Script -->
    <script>
        function previewImage() {
            const preview = document.querySelector('#preview');
            const file = event.target.files[0];
            
            if (file) {
                preview.src = URL.createObjectURL(file);
                preview.style.display = 'block';
            }
        }

        // Calculate total balita
        function calculateTotal() {
            const normal = parseInt(document.getElementById('balita_normal').value) || 0;
            const stunting = parseInt(document.getElementById('balita_stunting').value) || 0;
            const kurus = parseInt(document.getElementById('balita_kurus').value) || 0;
            const gemuk = parseInt(document.getElementById('balita_gemuk').value) || 0;
            
            const total = normal + stunting + kurus + gemuk;
            document.getElementById('total_balita').textContent = total.toLocaleString();
        }

        // Add event listeners
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = ['balita_normal', 'balita_stunting', 'balita_kurus', 'balita_gemuk'];
            inputs.forEach(id => {
                document.getElementById(id).addEventListener('input', calculateTotal);
            });
            calculateTotal(); // Initial calculation
        });
    </script>

    <!-- CK Editor 5 -->
    <script src="https://cdn.ckeditor.com/ckeditor5/35.3.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
