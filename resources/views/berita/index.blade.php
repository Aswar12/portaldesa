@extends('layouts.main')

@section('content')
<section class="counts section-bg">
    <div class="container">
  
      <div class="section-title">
        <h2>Berita Desa</h2>
      </div>

      <!-- Filter Section -->
      @if($availableYears->count() > 0)
      <div class="row mb-4">
        <div class="col-12">
            <div class="filter-section">
                <div class="filter-title">
                    <i class="bi bi-funnel"></i>
                    Filter Berita
                </div>
                
                <form method="GET" action="{{ url('/berita') }}" class="filter-form" id="filterForm">
                    <div class="row g-3 align-items-end">
                        <div class="col-md-4">
                            <label for="year" class="filter-label d-block">
                                <i class="bi bi-calendar"></i> Pilih Tahun
                            </label>
                            <div class="year-select">
                                <select name="year" id="year" class="form-select">
                                    <option value="">-- Semua Tahun --</option>
                                    @foreach($availableYears as $year)
                                        <option value="{{ $year }}" {{ $selectedYear == $year ? 'selected' : '' }}>
                                            {{ $year }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="sort" class="filter-label d-block">
                                <i class="bi bi-sort-down"></i> Urutkan
                            </label>
                            <select name="sort" id="sort" class="form-select">
                                <option value="latest" {{ $selectedSort == 'latest' ? 'selected' : '' }}>
                                    Terbaru
                                </option>
                                <option value="oldest" {{ $selectedSort == 'oldest' ? 'selected' : '' }}>
                                    Terlama
                                </option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-filter">
                                <i class="bi bi-search"></i>
                                Filter
                            </button>
                            <a href="{{ url('/berita') }}" class="btn btn-reset ms-2">
                                <i class="bi bi-arrow-clockwise"></i>
                                Reset
                            </a>
                        </div>
                    </div>
                </form>

                <!-- Active Filter Tags -->
                <div class="active-filters mt-3" id="activeFilters"></div>
            </div>
        </div>
      </div>
      @endif
  
      <div class="row">
        @if($beritas->count() > 0)
            @foreach ($beritas as $berita)
                <div class="col-lg-4 col-md-6 mb-3" data-aos="fade-up">
                    <div class="count-box news-card">
                        <div class="card">
                            <img src="{{ asset('storage/' . $berita->gambar) }}" alt="Gambar Berita" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title">{{ $berita->judul }}</h5>
                                <div class="news-date">
                                    <i class="bi bi-calendar me-1"></i>
                                    {{ \Carbon\Carbon::parse($berita->created_at)->format('d M Y') }}
                                    <span class="news-badge">{{ \Carbon\Carbon::parse($berita->created_at)->year }}</span>
                                </div>
                                <p class="card-text">{{ $berita->excerpt }}</p>                           
                            </div>
                            <div class="card-footer">
                                <a href="/berita/{{ $berita->slug }}" type="button" class="btn btn-link float-end">Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-12">
                <div class="no-results">
                    <div class="no-results-icon">
                        <i class="bi bi-newspaper"></i>
                    </div>
                    <h3>Tidak Ada Berita Ditemukan</h3>
                    <p>
                        @if($selectedYear)
                            Tidak ada berita untuk tahun {{ $selectedYear }}.
                        @else
                            Belum ada berita yang dipublikasikan.
                        @endif
                    </p>
                    @if($selectedYear || $selectedSort != 'latest')
                        <a href="{{ url('/berita') }}" class="btn btn-primary">Lihat Semua Berita</a>
                    @endif
                </div>
            </div>
        @endif
      </div>

      {{ $beritas->links() }}

    </div>
  </section>

<style>
/* Filter Styling */
.filter-section {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 15px;
    padding: 25px;
    margin-bottom: 30px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
}

.filter-title {
    color: white;
    font-size: 1.2rem;
    font-weight: 600;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.filter-form {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    border-radius: 12px;
    padding: 20px;
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.filter-label {
    color: white;
    font-weight: 600;
    margin-bottom: 8px;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.form-control, .form-select {
    border: 2px solid rgba(255, 255, 255, 0.2);
    border-radius: 8px;
    background: rgba(255, 255, 255, 0.9);
    color: #333;
    font-weight: 500;
    transition: all 0.3s ease;
    height: 45px;
}

.form-control:focus, .form-select:focus {
    border-color: #ffd700;
    box-shadow: 0 0 0 0.2rem rgba(255, 215, 0, 0.25);
    background: white;
}

.btn-filter {
    height: 45px;
    border-radius: 8px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    transition: all 0.3s ease;
    border: none;
    background: linear-gradient(45deg, #28a745, #20c997);
    color: white;
    padding: 0 20px;
}

.btn-filter:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(40, 167, 69, 0.4);
    color: white;
}

.btn-reset {
    height: 45px;
    border-radius: 8px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    transition: all 0.3s ease;
    border: 2px solid rgba(255, 255, 255, 0.3);
    background: transparent;
    color: white;
    padding: 0 20px;
}

.btn-reset:hover {
    background: rgba(255, 255, 255, 0.2);
    color: white;
    transform: translateY(-2px);
}

.news-badge {
    background: linear-gradient(45deg, #007bff, #6610f2);
    color: white;
    padding: 2px 8px;
    border-radius: 12px;
    font-size: 0.75rem;
    font-weight: 600;
    margin-left: 8px;
}

.no-results {
    text-align: center;
    padding: 60px 20px;
    color: #6c757d;
}

.no-results-icon {
    font-size: 4rem;
    margin-bottom: 20px;
    opacity: 0.5;
}

.active-filters {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}

.filter-tag {
    background: rgba(255, 255, 255, 0.2);
    color: white;
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
    display: flex;
    align-items: center;
    gap: 5px;
}

.filter-tag .remove {
    cursor: pointer;
    font-weight: bold;
    margin-left: 5px;
}

/* Responsive */
@media (max-width: 768px) {
    .filter-form .row {
        text-align: center;
    }
    
    .btn-filter, .btn-reset {
        width: 100%;
        margin-bottom: 10px;
    }
    
    .filter-section {
        padding: 20px 15px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const yearSelect = document.getElementById('year');
    const sortSelect = document.getElementById('sort');
    const activeFiltersDiv = document.getElementById('activeFilters');

    function updateActiveFilters() {
        activeFiltersDiv.innerHTML = '';
        
        const selectedYear = yearSelect.value;
        const selectedSort = sortSelect.value;
        
        if (selectedYear) {
            const yearTag = document.createElement('span');
            yearTag.className = 'filter-tag';
            yearTag.innerHTML = `
                <i class="bi bi-calendar"></i>
                Tahun: ${selectedYear}
                <span class="remove" onclick="clearYearFilter()">×</span>
            `;
            activeFiltersDiv.appendChild(yearTag);
        }
        
        if (selectedSort && selectedSort !== 'latest') {
            const sortTag = document.createElement('span');
            sortTag.className = 'filter-tag';
            sortTag.innerHTML = `
                <i class="bi bi-sort-down"></i>
                ${selectedSort === 'oldest' ? 'Terlama' : 'Terbaru'}
                <span class="remove" onclick="clearSortFilter()">×</span>
            `;
            activeFiltersDiv.appendChild(sortTag);
        }
    }

    window.clearYearFilter = function() {
        yearSelect.value = '';
        document.getElementById('filterForm').submit();
    }

    window.clearSortFilter = function() {
        sortSelect.value = 'latest';
        document.getElementById('filterForm').submit();
    }

    updateActiveFilters();
});
</script>
@endsection