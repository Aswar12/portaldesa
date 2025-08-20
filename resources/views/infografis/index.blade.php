@extends('layouts.main')

@section('content')
<style>
.hero-section {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    position: relative;
    overflow: hidden;
    padding: 100px 0;
    color: white;
}

.hero-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPGRlZnM+CjxwYXR0ZXJuIGlkPSJncmlkIiB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHBhdHRlcm5Vbml0cz0idXNlclNwYWNlT25Vc2UiPgo8cGF0aCBkPSJNIDAgMCBMIDAgNjAgTCA2MCA2MCBMIDYwIDAgTCAwIDAgeiIgZmlsbD0ibm9uZSIgc3Ryb2tlPSJyZ2JhKDI1NSwgMjU1LCAyNTUsIDAuMSkiIHN0cm9rZS13aWR0aD0iMSIvPgo8L3BhdHRlcm4+CjwvZGVmcz4KPHJlY3Qgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgZmlsbD0idXJsKCNncmlkKSIvPgo8L3N2Zz4=');
    opacity: 0.1;
}

/* Card Styles */
.infografis-card {
    background: white;
    border-radius: 20px;
    padding: 30px;
    margin-bottom: 30px;
    box-shadow: 0 15px 35px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
    border: 1px solid #f0f0f0;
    overflow: hidden;
    position: relative;
}

.infografis-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #667eea, #764ba2);
}

.infografis-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 25px 50px rgba(0,0,0,0.15);
}

.infografis-card.penduduk::before { background: linear-gradient(90deg, #667eea, #764ba2); }
.infografis-card.apbdes::before { background: linear-gradient(90deg, #28a745, #20c997); }
.infografis-card.stunting::before { background: linear-gradient(90deg, #ff6b6b, #ee5a24); }
.infografis-card.bansos::before { background: linear-gradient(90deg, #ffc107, #fd7e14); }
.infografis-card.idm::before { background: linear-gradient(90deg, #17a2b8, #138496); }
.infografis-card.sdgs::before { background: linear-gradient(90deg, #6f42c1, #e83e8c); }

.card-icon {
    font-size: 3rem;
    margin-bottom: 20px;
    opacity: 0.8;
}

.card-title {
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 15px;
    color: #2c3e50;
}

.card-description {
    color: #6c757d;
    line-height: 1.6;
    margin-bottom: 25px;
}

.card-button {
    display: inline-flex;
    align-items: center;
    padding: 12px 25px;
    border-radius: 25px;
    text-decoration: none;
    color: white;
    font-weight: 600;
    transition: all 0.3s ease;
    gap: 10px;
}

.card-button:hover {
    text-decoration: none;
    color: white;
    transform: translateX(5px);
}

.card-button.penduduk { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
.card-button.apbdes { background: linear-gradient(135deg, #28a745 0%, #20c997 100%); }
.card-button.stunting { background: linear-gradient(135deg, #ff6b6b 0%, #ee5a24 100%); }
.card-button.bansos { background: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%); }
.card-button.idm { background: linear-gradient(135deg, #17a2b8 0%, #138496 100%); }
.card-button.sdgs { background: linear-gradient(135deg, #6f42c1 0%, #e83e8c 100%); }

/* Info section */
.info-section {
    background: #f8f9fa;
    border-radius: 20px;
    padding: 40px;
    margin: 50px 0;
    text-align: center;
}

.info-icon {
    font-size: 4rem;
    color: #667eea;
    margin-bottom: 20px;
}

.info-title {
    font-size: 2rem;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 15px;
}

.info-description {
    color: #6c757d;
    line-height: 1.8;
    font-size: 1.1rem;
}

/* Responsive */
@media (max-width: 768px) {
    .hero-section {
        padding: 60px 0;
    }
    
    .infografis-card {
        padding: 20px;
        text-align: center;
    }
    
    .card-icon {
        font-size: 2.5rem;
    }
    
    .info-section {
        padding: 30px 20px;
    }
}
</style>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-3 fw-bold mb-4">
                    <i class="fas fa-chart-pie me-3"></i>
                    INFOGRAFIS DESA
                </h1>
                <p class="lead mb-4" style="font-size: 1.3rem; line-height: 1.6;">
                    Data dan statistik terkini mengenai berbagai aspek kehidupan di desa kami
                </p>
                <div class="d-flex align-items-center">
                    <i class="fas fa-info-circle me-2"></i>
                    <span>Data selalu diperbaharui secara berkala</span>
                </div>
            </div>
            <div class="col-lg-6 text-center">
                <div style="font-size: 8rem; opacity: 0.3;">
                    <i class="fas fa-chart-area"></i>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container">
    <!-- Header -->
    <div class="text-center mb-5" style="margin-top: 50px;">
        <h2 class="display-4 fw-bold text-primary mb-4">PILIH KATEGORI INFOGRAFIS</h2>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <p class="lead" style="font-size: 1.2rem; line-height: 1.8; color: #6c757d;">
                    Jelajahi berbagai data dan statistik desa dalam bentuk visualisasi yang mudah dipahami
                </p>
            </div>
        </div>
    </div>

    <!-- Infografis Cards Grid -->
    <div class="row">
        <!-- Penduduk -->
        <div class="col-lg-4 col-md-6">
            <div class="infografis-card penduduk">
                <div class="text-center">
                    <div class="card-icon" style="color: #667eea;">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3 class="card-title">Data Penduduk</h3>
                    <p class="card-description">
                        Statistik demografi penduduk desa berdasarkan jenis kelamin, usia, pekerjaan, 
                        dan berbagai kategori lainnya.
                    </p>
                    <a href="{{ route('infografis.penduduk') }}" class="card-button penduduk">
                        <span>Lihat Detail</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- APBDes -->
        <div class="col-lg-4 col-md-6">
            <div class="infografis-card apbdes">
                <div class="text-center">
                    <div class="card-icon" style="color: #28a745;">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                    <h3 class="card-title">APBDes</h3>
                    <p class="card-description">
                        Anggaran Pendapatan dan Belanja Desa dengan rincian pemasukan, pengeluaran, 
                        dan alokasi dana untuk berbagai program.
                    </p>
                    <a href="{{ route('infografis.apbdes') }}" class="card-button apbdes">
                        <span>Lihat Detail</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Stunting -->
        <div class="col-lg-4 col-md-6">
            <div class="infografis-card stunting">
                <div class="text-center">
                    <div class="card-icon" style="color: #ff6b6b;">
                        <i class="fas fa-child"></i>
                    </div>
                    <h3 class="card-title">Data Stunting</h3>
                    <p class="card-description">
                        Monitoring status gizi balita dan upaya pencegahan stunting di wilayah desa 
                        berdasarkan data Posyandu.
                    </p>
                    <a href="{{ route('infografis.stunting') }}" class="card-button stunting">
                        <span>Lihat Detail</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Bantuan Sosial -->
        <div class="col-lg-4 col-md-6">
            <div class="infografis-card bansos">
                <div class="text-center">
                    <div class="card-icon" style="color: #ffc107;">
                        <i class="fas fa-hand-holding-heart"></i>
                    </div>
                    <h3 class="card-title">Bantuan Sosial</h3>
                    <p class="card-description">
                        Data penerima dan distribusi bantuan sosial seperti PKH, BLT, dan program 
                        bantuan lainnya di desa.
                    </p>
                    <a href="{{ route('infografis.bansos') }}" class="card-button bansos">
                        <span>Lihat Detail</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- IDM -->
        <div class="col-lg-4 col-md-6">
            <div class="infografis-card idm">
                <div class="text-center">
                    <div class="card-icon" style="color: #17a2b8;">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3 class="card-title">Indeks Desa Membangun</h3>
                    <p class="card-description">
                        Status dan perkembangan Indeks Desa Membangun (IDM) sebagai tolok ukur 
                        kemajuan pembangunan desa.
                    </p>
                    <a href="{{ route('idm.index') }}" class="card-button idm">
                        <span>Lihat Detail</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- SDGs -->
        <div class="col-lg-4 col-md-6">
            <div class="infografis-card sdgs">
                <div class="text-center">
                    <div class="card-icon" style="color: #6f42c1;">
                        <i class="fas fa-globe"></i>
                    </div>
                    <h3 class="card-title">SDGs Desa</h3>
                    <p class="card-description">
                        Capaian Sustainable Development Goals (SDGs) di tingkat desa dan kontribusi 
                        terhadap tujuan pembangunan berkelanjutan.
                    </p>
                    <a href="{{ route('infografis.sdgs') }}" class="card-button sdgs">
                        <span>Lihat Detail</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Info Section -->
    <div class="info-section">
        <div class="info-icon">
            <i class="fas fa-info-circle"></i>
        </div>
        <h3 class="info-title">Informasi Penting</h3>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <p class="info-description">
                    Semua data yang ditampilkan dalam infografis ini berasal dari sumber resmi dan 
                    diperbaharui secara berkala. Untuk informasi lebih detail atau pertanyaan terkait 
                    data, silakan hubungi kantor desa atau tim pengelola data.
                </p>
            </div>
        </div>
        <div class="mt-4">
            <div class="row text-center">
                <div class="col-md-4">
                    <div class="mb-3">
                        <i class="fas fa-clock text-primary fa-2x"></i>
                    </div>
                    <h6>Update Berkala</h6>
                    <small class="text-muted">Data diperbaharui setiap bulan</small>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <i class="fas fa-shield-alt text-success fa-2x"></i>
                    </div>
                    <h6>Data Terpercaya</h6>
                    <small class="text-muted">Bersumber dari instansi resmi</small>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <i class="fas fa-eye text-info fa-2x"></i>
                    </div>
                    <h6>Mudah Dipahami</h6>
                    <small class="text-muted">Visualisasi yang user-friendly</small>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Extra spacing at bottom -->
<div class="py-5"></div>
@endsection
