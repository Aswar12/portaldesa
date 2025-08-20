@extends('layouts.main')

@section('styles')
<style>
    .gallery-item {
        transition: all 0.3s ease;
        cursor: pointer;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        background: white;
    }
    
    .gallery-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }

    .gallery-img {
        width: 100%;
        height: 220px;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .gallery-item:hover .gallery-img {
        transform: scale(1.05);
    }

    .gallery-info {
        padding: 16px;
        background: white;
    }

    .filter-section {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 25px;
        border-radius: 15px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        margin-bottom: 40px;
        color: white;
    }

    .filter-title {
        color: white;
        font-weight: 700;
        font-size: 1.1rem;
        margin-bottom: 20px;
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: center;
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
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .btn-primary.btn-filter {
        background: linear-gradient(135deg, #ffd700 0%, #ffb347 100%);
        color: #333;
    }

    .btn-primary.btn-filter:hover {
        background: linear-gradient(135deg, #ffb347 0%, #ffd700 100%);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(255, 215, 0, 0.4);
    }

    .btn-secondary.btn-filter {
        background: rgba(255, 255, 255, 0.2);
        color: white;
        border: 2px solid rgba(255, 255, 255, 0.3);
    }

    .btn-secondary.btn-filter:hover {
        background: rgba(255, 255, 255, 0.3);
        transform: translateY(-2px);
        color: white;
    }

    .year-select {
        position: relative;
    }

    .year-select select {
        appearance: none;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
        background-position: right 12px center;
        background-repeat: no-repeat;
        background-size: 16px;
        padding-right: 40px;
    }

    .active-filters {
        background: rgba(255, 255, 255, 0.1);
        border-radius: 8px;
        padding: 10px 15px;
        margin-top: 15px;
        display: none;
    }

    .active-filters.show {
        display: block;
    }

    .filter-tag {
        background: rgba(255, 215, 0, 0.9);
        color: #333;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        margin: 2px;
    }

    .filter-tag .remove {
        cursor: pointer;
        font-weight: bold;
    }

    .pagination {
        justify-content: center;
    }

    .section-title h2 {
        color: #333;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .section-title p {
        color: #666;
        font-size: 1.1rem;
    }

    .gallery-badge {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 20px;
        padding: 4px 12px;
        font-size: 0.8rem;
        font-weight: 600;
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        background: white;
        border-radius: 15px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .empty-state i {
        color: #ddd;
        margin-bottom: 20px;
    }

    .empty-state h4 {
        color: #666;
        margin-bottom: 10px;
    }

    .empty-state p {
        color: #999;
    }

    @media (max-width: 768px) {
        .filter-section {
            padding: 20px 15px;
        }
        
        .filter-form {
            padding: 15px;
        }
        
        .btn-filter {
            width: 100%;
            margin-bottom: 10px;
        }
    }
</style>
@endsection

@section('content')
    <section class="counts section-bg">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                <h2>Gallery</h2>
                <p>Dokumentasi Kegiatan Desa</p>
            </div>

            <div class="filter-section">
                <div class="filter-title">
                    <i class="bi bi-funnel"></i>
                    Filter Gallery
                </div>
                
                <form method="GET" action="{{ url('/gallery') }}" class="filter-form" id="filterForm">
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
                                    <i class="bi bi-sort-down-alt"></i> Terbaru
                                </option>
                                <option value="oldest" {{ $selectedSort == 'oldest' ? 'selected' : '' }}>
                                    <i class="bi bi-sort-up"></i> Terlama
                                </option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary btn-filter flex-fill">
                                    <i class="bi bi-search"></i> 
                                    <span>Terapkan</span>
                                </button>
                                <a href="{{ url('/gallery') }}" class="btn btn-secondary btn-filter flex-fill">
                                    <i class="bi bi-arrow-clockwise"></i>
                                    <span>Reset</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Active Filters Display -->
                    <div class="active-filters" id="activeFilters">
                        <small class="text-white-50 mb-2 d-block">Filter Aktif:</small>
                        <div id="filterTags"></div>
                    </div>
                </form>
            </div>

            <div class="row g-4">
                @foreach ($galerrys as $gallery)
                    <div class="col-lg-3 col-md-4 col-sm-6" data-aos="zoom-in" data-aos-delay="{{ $loop->iteration * 50 }}">
                        <div class="gallery-item">
                            <a href="{{ asset('storage/' . $gallery->gambar) }}" class="glightbox" data-title="{{ $gallery->keterangan }}">
                                <img src="{{ asset('storage/' . $gallery->gambar) }}" 
                                     class="gallery-img"
                                     alt="{{ $gallery->keterangan }}">
                            </a>
                            <div class="gallery-info">
                                <p class="mb-2 fw-medium">{{ $gallery->keterangan }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="gallery-badge">{{ $gallery->year ?? 'Tidak ada tahun' }}</span>
                                    <small class="text-muted">
                                        {{ $gallery->published_at ? $gallery->published_at->timezone('Asia/Jayapura')->format('d/m/Y') : '-' }}
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                @if($galerrys->isEmpty())
                    <div class="col-12">
                        <div class="empty-state">
                            <i class="bi bi-images" style="font-size: 4rem;"></i>
                            <h4>Tidak Ada Foto Ditemukan</h4>
                            <p>
                                @if($selectedYear)
                                    Tidak ada foto untuk tahun {{ $selectedYear }}.
                                @else
                                    Belum ada foto yang tersedia saat ini.
                                @endif
                            </p>
                            @if($selectedYear || $selectedSort != 'latest')
                                <a href="{{ url('/gallery') }}" class="btn btn-primary mt-3">
                                    <i class="bi bi-arrow-clockwise"></i> Lihat Semua Foto
                                </a>
                            @endif
                        </div>
                    </div>
                @endif
            </div>

            <div class="my-4">
                {{ $galerrys->links() }}
            </div>
        </div>
    </section>
@endsection

@section('scripts')
<script>
    // Initialize GLightbox
    const lightbox = GLightbox({
        touchNavigation: true,
        loop: true,
        autoplayVideos: true,
        selector: '.glightbox'
    });

    // Initialize AOS
    AOS.init({
        duration: 600,
        easing: 'ease-in-out',
        once: true,
        mirror: false
    });

    // Filter functionality
    document.addEventListener('DOMContentLoaded', function() {
        const filterForm = document.getElementById('filterForm');
        const yearSelect = document.getElementById('year');
        const sortSelect = document.getElementById('sort');
        const activeFilters = document.getElementById('activeFilters');
        const filterTags = document.getElementById('filterTags');

        // Update active filters display
        function updateActiveFilters() {
            const selectedYear = yearSelect.value;
            const selectedSort = sortSelect.value;
            
            filterTags.innerHTML = '';
            let hasActiveFilters = false;

            if (selectedYear) {
                hasActiveFilters = true;
                const yearTag = document.createElement('span');
                yearTag.className = 'filter-tag';
                yearTag.innerHTML = `
                    Tahun: ${selectedYear} 
                    <span class="remove" onclick="clearYearFilter()">&times;</span>
                `;
                filterTags.appendChild(yearTag);
            }

            if (selectedSort && selectedSort !== 'latest') {
                hasActiveFilters = true;
                const sortTag = document.createElement('span');
                sortTag.className = 'filter-tag';
                const sortText = selectedSort === 'oldest' ? 'Terlama' : 'Terbaru';
                sortTag.innerHTML = `
                    Urutan: ${sortText} 
                    <span class="remove" onclick="clearSortFilter()">&times;</span>
                `;
                filterTags.appendChild(sortTag);
            }

            if (hasActiveFilters) {
                activeFilters.classList.add('show');
            } else {
                activeFilters.classList.remove('show');
            }
        }

        // Auto-submit on select change
        yearSelect.addEventListener('change', function() {
            updateActiveFilters();
            // Optional: Auto-submit form when year changes
            // filterForm.submit();
        });

        sortSelect.addEventListener('change', function() {
            updateActiveFilters();
            // Optional: Auto-submit form when sort changes
            // filterForm.submit();
        });

        // Initialize active filters display
        updateActiveFilters();

        // Add loading state to filter button
        filterForm.addEventListener('submit', function() {
            const submitBtn = filterForm.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="bi bi-hourglass-split"></i> <span>Memuat...</span>';
            submitBtn.disabled = true;
        });
    });

    // Global functions for filter tag removal
    function clearYearFilter() {
        document.getElementById('year').value = '';
        document.getElementById('filterForm').submit();
    }

    function clearSortFilter() {
        document.getElementById('sort').value = 'latest';
        document.getElementById('filterForm').submit();
    }

    // Add smooth scrolling to gallery after filter
    if (window.location.search) {
        setTimeout(() => {
            const gallerySection = document.querySelector('.row.g-4');
            if (gallerySection) {
                gallerySection.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        }, 100);
    }

    // Add hover effects to gallery items
    document.querySelectorAll('.gallery-item').forEach(item => {
        item.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-8px) scale(1.02)';
        });
        
        item.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
    });

    // Add loading animation for images
    document.querySelectorAll('.gallery-img').forEach(img => {
        img.addEventListener('load', function() {
            this.style.opacity = '1';
        });
        
        img.style.opacity = '0';
        img.style.transition = 'opacity 0.3s ease';
        
        if (img.complete) {
            img.style.opacity = '1';
        }
    });
</script>
@endsection
