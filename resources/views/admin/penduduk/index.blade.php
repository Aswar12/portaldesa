@extends('admin.layouts.main')
@section('content')
<div class="container">
    <h1>Daftar Penduduk</h1>
    <a href="{{ route('admin.penduduk.create') }}" class="btn btn-primary mb-3">Tambah Penduduk</a>

    <!-- Form Import Excel -->
    <form action="{{ route('admin.penduduk.import') }}" method="POST" enctype="multipart/form-data" class="mb-3">
        @csrf
        <div class="input-group">
            <input type="file" name="excel_file" class="form-control" accept=".xlsx,.xls" required>
            <button type="submit" class="btn btn-success">Import Excel</button>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-bordered" style="table-layout: auto; width: 100%;">
            <thead>
                <tr>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>No KK</th>
                    <th>Tanggal Lahir</th>
                    <th>Usia</th>
                    <th>Jenis Kelamin</th>
                    <th>Agama</th>
                    <th>Pekerjaan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($penduduks as $penduduk)
                <tr>
                    <td>{{ $penduduk->nik }}</td>
                    <td>{{ $penduduk->nama }}</td>
                    <td>{{ $penduduk->alamat }}</td>
                    <td>{{ $penduduk->kk ?? '-' }}</td>
                    <td>{{ \Carbon\Carbon::parse($penduduk->ttl)->format('d F Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($penduduk->ttl)->age }}</td>
                    <td>{{ $penduduk->jenisKelamin ? $penduduk->jenisKelamin->name : '-' }}</td>
                    <td>{{ $penduduk->agama ? $penduduk->agama->name : '-' }}</td>
                    <td>{{ $penduduk->pekerjaan ? $penduduk->pekerjaan->name : '-' }}</td>
                    <td>
                        <a href="{{ route('admin.penduduk.edit', $penduduk->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.penduduk.destroy', $penduduk->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $penduduks->links() }}
</div>
@endsection
