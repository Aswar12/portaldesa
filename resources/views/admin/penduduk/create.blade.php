@extends('admin.layouts.main')

@section('content')
<div class="container">
    <h1>Tambah Penduduk</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.penduduk.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama') }}" required>
        </div>
        <div class="mb-3">
            <label for="nik" class="form-label">NIK</label>
            <input type="text" class="form-control" id="nik" name="nik" value="{{ old('nik') }}" required maxlength="16">
        </div>
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea class="form-control" id="alamat" name="alamat" rows="3" required>{{ old('alamat') }}</textarea>
        </div>
        <div class="mb-3">
            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required>
        </div>
        <div class="mb-3">
            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
            <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                <option value="">Pilih Jenis Kelamin</option>
                <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="agama_id" class="form-label">Agama</label>
            <select class="form-select" id="agama_id" name="agama_id" required>
                <option value="">Pilih Agama</option>
                @foreach($agamas as $agama)
                    <option value="{{ $agama->id }}" {{ old('agama_id') == $agama->id ? 'selected' : '' }}>{{ $agama->agama }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="pekerjaan_id" class="form-label">Pekerjaan</label>
            <select class="form-select" id="pekerjaan_id" name="pekerjaan_id" required>
                <option value="">Pilih Pekerjaan</option>
                @foreach($pekerjaans as $pekerjaan)
                    <option value="{{ $pekerjaan->id }}" {{ old('pekerjaan_id') == $pekerjaan->id ? 'selected' : '' }}>{{ $pekerjaan->pekerjaan }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('admin.penduduk.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
