@extends('admin.layouts.main')

@section('content')
<style>
    .slider-card {
        background: #ffffff;
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.3s ease;
        position: relative;
        height: 380px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        border: 1px solid #e5e7eb;
    }

    .slider-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
    }

    .slider-image {
        width: 100%;
        height: 220px;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        position: relative;
        overflow: hidden;
    }

    .slider-image::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(45deg, rgba(0,0,0,0.2), transparent);
        z-index: 1;
    }

    .slider-overlay {
        position: absolute;
        top: 12px;
        right: 12px;
        z-index: 2;
    }

    .slider-badge {
        background: rgba(255, 255, 255, 0.95);
        color: #374151;
        padding: 0.4rem 0.8rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 500;
        backdrop-filter: blur(8px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .slider-content {
        padding: 1.2rem;
        background: #ffffff;
        height: 160px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .slider-title {
        font-size: 1rem;
        font-weight: 600;
        color: #111827;
        margin-bottom: 0.5rem;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .btn-edit {
        background: #3b82f6;
        border: none;
        color: white;
        padding: 0.6rem 1.2rem;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.2s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        font-size: 0.9rem;
    }

    .btn-edit:hover {
        background: #2563eb;
        color: white;
        text-decoration: none;
        transform: translateY(-1px);
    }

    .page-header {
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        padding: 1.5rem;
        border-radius: 12px;
        color: #374151;
        margin-bottom: 2rem;
        position: relative;
        border: 1px solid #e5e7eb;
    }

    .page-header h5 {
        margin: 0;
        font-size: 1.5rem;
        font-weight: 600;
        position: relative;
        z-index: 1;
        color: #111827;
    }

    .btn-preview {
        background: #ffffff;
        border: 1px solid #d1d5db;
        color: #374151;
        padding: 0.6rem 1.2rem;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.2s ease;
        text-decoration: none;
    }

    .btn-preview:hover {
        background: #f9fafb;
        color: #111827;
        text-decoration: none;
        border-color: #9ca3af;
    }

    .empty-state {
        text-align: center;
        padding: 3rem 2rem;
        color: #6b7280;
        background: #f9fafb;
        border-radius: 12px;
        border: 1px solid #e5e7eb;
    }

    .empty-state i {
        font-size: 3rem;
        margin-bottom: 1rem;
        opacity: 0.6;
        color: #9ca3af;
    }

    .empty-state h4 {
        color: #374151;
        margin-bottom: 0.5rem;
    }

    .alert {
        border-radius: 8px;
        border: none;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .alert-success {
        background: #d1fae5;
        color: #065f46;
    }

    .alert-danger {
        background: #fee2e2;
        color: #991b1b;
    }
</style>

<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h5 class="mb-0">
                    <i class="bi bi-images me-2"></i>
                    Manajemen Slider
                </h5>
                <p class="mt-2 mb-0 opacity-75">Kelola gambar slider untuk halaman depan website desa</p>
            </div>
            <div class="col-md-6 text-md-end">
                <a href="/" class="btn btn-preview" target="_blank">
                    <i class="bi bi-eye me-2"></i>
                    Live Preview
                </a>
            </div>
        </div>
    </div>

    <!-- Alert Messages -->
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-circle-fill me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Slider Cards -->
    @if($sliders->count() > 0)
        <div class="row g-4">
            @foreach ($sliders as $slider)
            <div class="col-lg-4 col-md-6">
                <div class="slider-card">
                    <!-- Image -->
                    <div class="slider-image" style="background-image: url('{{ asset('storage/' . $slider->img_slider) }}');">
                        <div class="slider-overlay">
                            <span class="slider-badge">Slide {{ $loop->iteration }}</span>
                        </div>
                    </div>
                    
                    <!-- Content -->
                    <div class="slider-content">
                        <div>
                            <h6 class="slider-title">{{ $slider->judul }}</h6>
                            <p class="text-muted mb-0" style="font-size: 0.9rem; line-height: 1.4;">
                                {{ Str::limit($slider->deskripsi, 60) }}
                            </p>
                        </div>
                        
                        <div class="mt-3">
                            <a href="/admin/slider/{{ $slider->id }}/edit" class="btn-edit">
                                <i class="bi bi-pencil-square"></i>
                                Edit Slider
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @else
        <div class="empty-state">
            <i class="bi bi-images"></i>
            <h4>Belum Ada Slider</h4>
            <p>Tambahkan slider pertama untuk menampilkan konten di halaman depan website desa</p>
            <a href="/admin/slider/create" class="btn btn-primary">
                <i class="bi bi-plus-circle me-2"></i>
                Tambah Slider
            </a>
        </div>
    @endif
</div>

<!-- Copyright Footer -->
<div class="mt-5 pt-4 border-top">
    <div class="text-center text-muted">
        <small>&copy; 2025 Portal Desa. All rights reserved.</small>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add animation to cards on scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry, index) => {
            if (entry.isIntersecting) {
                setTimeout(() => {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }, index * 100);
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);
    
    // Initially hide cards and observe them
    document.querySelectorAll('.slider-card').forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        card.style.transition = 'all 0.6s ease';
        observer.observe(card);
    });

    // Add loading state to buttons
    document.querySelectorAll('.btn-edit').forEach(btn => {
        btn.addEventListener('click', function() {
            this.innerHTML = '<i class="bi bi-hourglass-split me-2"></i>Loading...';
            this.style.pointerEvents = 'none';
        });
    });
});
</script>

@endsection