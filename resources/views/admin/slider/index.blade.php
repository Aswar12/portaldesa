@extends('admin.layouts.main')

@section('content')
<style>
    .slider-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 15px;
        overflow: hidden;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        height: 400px;
        box-shadow: 0 8px 30px rgba(102, 126, 234, 0.3);
    }

    .slider-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(102, 126, 234, 0.4);
    }

    .slider-image {
        width: 100%;
        height: 250px;
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
        background: linear-gradient(45deg, rgba(0,0,0,0.3), transparent);
        z-index: 1;
    }

    .slider-overlay {
        position: absolute;
        top: 15px;
        right: 15px;
        z-index: 2;
    }

    .slider-badge {
        background: rgba(255, 255, 255, 0.9);
        color: #667eea;
        padding: 0.5rem 1rem;
        border-radius: 25px;
        font-size: 0.85rem;
        font-weight: 600;
        backdrop-filter: blur(10px);
    }

    .slider-content {
        padding: 1.5rem;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        height: 150px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .slider-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: #1a202c;
        margin-bottom: 0.5rem;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .btn-edit {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        border: none;
        color: white;
        padding: 0.7rem 1.5rem;
        border-radius: 25px;
        font-weight: 600;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-edit:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(240, 147, 251, 0.4);
        color: white;
        text-decoration: none;
    }

    .page-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 2rem;
        border-radius: 15px;
        color: white;
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
    }

    .page-header::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 200px;
        height: 200px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        transform: translate(50px, -50px);
    }

    .page-header h5 {
        margin: 0;
        font-size: 1.8rem;
        font-weight: 700;
        position: relative;
        z-index: 1;
    }

    .btn-preview {
        background: rgba(255, 255, 255, 0.2);
        border: 2px solid rgba(255, 255, 255, 0.3);
        color: white;
        padding: 0.7rem 1.5rem;
        border-radius: 25px;
        font-weight: 600;
        transition: all 0.3s ease;
        text-decoration: none;
        backdrop-filter: blur(10px);
    }

    .btn-preview:hover {
        background: rgba(255, 255, 255, 1);
        color: #667eea;
        text-decoration: none;
        transform: translateY(-2px);
    }

    .empty-state {
        text-align: center;
        padding: 3rem;
        color: #64748b;
    }

    .empty-state i {
        font-size: 4rem;
        margin-bottom: 1rem;
        opacity: 0.5;
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
                <p class="mt-2 mb-0 opacity-75">Kelola gambar slider untuk halaman depan website</p>
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
            <p>Tambahkan slider pertama untuk menampilkan konten di halaman depan</p>
            <a href="/admin/slider/create" class="btn btn-primary">
                <i class="bi bi-plus-circle me-2"></i>
                Tambah Slider
            </a>
        </div>
    @endif
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