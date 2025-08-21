@extends('admin.layouts.main')

@section('content')
<div class="row">
    <div class="col-lg-12 d-flex align-items-strech">
      <div class="card w-100">
        <div class="card-header bg-primary">
            <div class="row align-items-center">
                <div class="col-6">
                    <h5 class="card-title fw-semibold text-white">Tambah Berita</h5>
                </div>
                <div class="col-6 text-right">
                    <a href="{{ route('berita.index') }}" type="button" class="btn btn-warning float-end">Kembali</a>
                </div>
            </div>
        </div>
      </div>
    </div>
</div>

<div class="row">
    <form method="POST" action="{{ route('berita.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="judul" class="form-label">Judul <span style="color: red">*</span></label>
                            <input type="text" class="form-control" name="judul" id="judul" value="{{ old('judul') }}">
                            @error('judul')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="slug" class="form-label">Slug/Permalink <span style="color: red">*</span></label>
                            <input type="text" class="form-control" name="slug" id="slug" value="{{ old('slug') }}">
                            @error('slug')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="body" class="form-label">Isi Berita <span style="color: red">*</span></label>
                            <textarea class="form-control" id="editor" name="body" rows="10">{{ old('body') }}</textarea>
                            @error('body')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
               <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <img src="" class="img-preview img-fluid mb-3 mt-2" id="preview" style="border-radius: 5px; max-height:300px; overflow:hidden;"><br>
                            <label for="gambar" class="form-label">Gambar Slider <span style="color: red">*</span></label>
                            <input class="form-control" type="file" id="gambar" name="gambar" onchange="previewImage(event)">
                            @error('gambar')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="kategori" class="form-label">Kategori Berita <span style="color: red">*</span></label>
                            <select class="form-control" name="kategori_id" id="kategori_id">
                                <option value=""> -- Pilih Kategori -- </option>
                                @foreach ($kategories as $kategori)
                                    @if (old('kategori_id') == $kategori->id)
                                        <option value="{{ $kategori->id }}" selected>{{ $kategori->kategori }}</option>
                                    @else
                                        <option value="{{ $kategori->id }}">{{ $kategori->kategori }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('kategori_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status Berita <span style="color: red">*</span></label>
                            <select class="form-control" name="status_id" id="status_id">
                                <option value=""> -- Pilih Status -- </option>
                                @foreach ($postStatus as $status)
                                    @if (old('status_id') == $status->id)
                                        <option value="{{ $status->id }}" selected>{{ $status->status }}</option>
                                    @else
                                        <option value="{{ $status->id }}">{{ $status->status }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('status_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="published_at" class="form-label">
                                <i class="fas fa-calendar-alt me-1"></i>Tanggal Post (WIT) 
                                <span style="color: red">*</span>
                            </label>
                            <input type="datetime-local" class="form-control" name="published_at" id="published_at" 
                                   value="{{ old('published_at', now()->setTimezone('Asia/Jayapura')->format('Y-m-d\TH:i')) }}" required>
                            <div class="form-text">
                                <i class="fas fa-info-circle me-1"></i>
                                <strong>Info:</strong> Tahun dari tanggal ini akan otomatis digunakan untuk filter di halaman berita publik.
                                <br>
                                <i class="fas fa-filter me-1"></i>
                                Pengunjung dapat memfilter berita berdasarkan tahun publish ini.
                            </div>
                            @error('published_at')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                                                <button type="submit" class="btn btn-primary m-1 float-end">Simpan</button>
                    </div>
               </div>
            </div>
        </div>
    </form>
</div>

<script>
    // Initialize datetime-local input with current time
    document.addEventListener('DOMContentLoaded', function() {
        var now = new Date();
        now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
        var publishedAt = document.getElementById('published_at');
        if (publishedAt && !publishedAt.value) {
            publishedAt.value = now.toISOString().slice(0,16);
        }
    });


<!-- Generate Slug Otomatis -->
<script>
    const judul     = document.querySelector('#judul');
    const slug      = document.querySelector('#slug');

    judul.addEventListener('change', function(){
        fetch('/admin/berita/slug?judul=' + judul.value)
            .then(response => response.json())
            .then(data => slug.value = data.slug)
    });
</script>

<!-- Preview Image -->
<script>
    function previewImage(e){
        try {
            var fileInput = e && e.target ? e.target : document.getElementById('gambar');
            var previewEl = document.getElementById('preview');
            if (fileInput && fileInput.files && fileInput.files[0] && previewEl) {
                previewEl.src = URL.createObjectURL(fileInput.files[0]);
            }
        } catch(err) {
            console.error(err);
        }
    }
</script>

<!-- Ck Editor 5 -->
<script>
    let editorInstance;
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .then( editor => {
             editorInstance =editor;
        } )
        .catch( error => {
            console.error( error );
        } );
</script>

@endsection