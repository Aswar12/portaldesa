@extends('layouts.main')

@section('content')
    <section class="counts section-bg">
        <div class="section-title">
            <h2>Gallery</h2>
        </div>
        <div class="container">
            <form method="GET" action="{{ url('/gallery') }}" class="mb-3">
                <div class="row g-3 align-items-center">
                    <div class="col-auto">
                        <label for="year" class="col-form-label fw-bold">Filter Tahun:</label>
                    </div>
                    <div class="col-auto">
                        <input type="number" name="year" id="year" class="form-control" placeholder="Masukkan Tahun" value="{{ old('year', $filterYear) }}" min="1900" max="{{ date('Y') }}">
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary">Filter</button>
                        <a href="{{ url('/gallery') }}" class="btn btn-secondary">Reset</a>
                    </div>
                </div>
            </form>
            <div class="row">
                @foreach ($galerrys as $gallery)
                    <div class="col-lg-3 mb-4">
                        <picture>
                            <img src="{{ asset('storage/' . $gallery->gambar) }}" class="img-fluid img-thumbnail"
                                alt="Gallery" style="width: 300px; height: 200px; object-fit: cover;">
                            <p class="mt-2">{{ $gallery->keterangan }}</p>
                            <p><strong>Tahun:</strong> {{ $gallery->year ?? '-' }}</p>
                        </picture>
                    </div>
                @endforeach
            </div>
            <div class="paginate my-3" style="text-align: center">
                {{ $galerrys->links() }}
            </div>
        </div>
    </section>
@endsection
