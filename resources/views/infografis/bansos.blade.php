@extends('layouts.main')

@section('content')
<style>
.hero-section {
    background: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%);
    position: relative;
    overflow: hidden;
    padding: 80px 0;
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

/* Navigation Pills */
.infografis-nav {
    background: white;
    border-radius: 15px;
    padding: 25px;
    margin: -50px 0 40px 0;
    box-shadow: 0 15px 35px rgba(0,0,0,0.1);
    position: relative;
    z-index: 10;
}

.nav-pills {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 10px;
}

.nav-pill {
    display: inline-flex;
    align-items: center;
    padding: 12px 20px;
    border-radius: 25px;
    text-decoration: none;
    color: #6c757d;
    background: #f8f9fa;
    border: 2px solid transparent;
    transition: all 0.3s ease;
    font-weight: 600;
    gap: 8px;
}

.nav-pill:hover {
    color: #ffc107;
    background: #fff8e1;
    border-color: #ffc107;
    text-decoration: none;
    transform: translateY(-2px);
}

.nav-pill.active {
    background: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%);
    color: white;
    border-color: #ffc107;
}

/* Stats Grid */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 25px;
    margin-bottom: 50px;
}

.stats-card {
    background: white;
    border-radius: 20px;
    padding: 30px 25px;
    text-align: center;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.stats-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #ffc107, #fd7e14);
}

.stats-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
}

.stats-card.featured {
    background: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%);
    color: white;
}

.stats-card.featured::before {
    background: rgba(255,255,255,0.3);
}

.stats-card.pkh {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    color: white;
}

.stats-card.blt {
    background: linear-gradient(135deg, #007bff 0%, #6610f2 100%);
    color: white;
}

.stats-card.sembako {
    background: linear-gradient(135deg, #dc3545 0%, #e83e8c 100%);
    color: white;
}

.stats-label {
    font-size: 0.9rem;
    color: #6c757d;
    margin-bottom: 10px;
    text-transform: uppercase;
    font-weight: 600;
    letter-spacing: 1px;
}

.stats-card.featured .stats-label,
.stats-card.pkh .stats-label,
.stats-card.blt .stats-label,
.stats-card.sembako .stats-label {
    color: rgba(255,255,255,0.8);
}

.stats-value {
    font-size: 2.5rem;
    font-weight: 900;
    margin: 15px 0;
    color: #2c3e50;
}

.stats-card.featured .stats-value,
.stats-card.pkh .stats-value,
.stats-card.blt .stats-value,
.stats-card.sembako .stats-value {
    color: white;
}

.stats-description {
    font-size: 0.9rem;
    color: #6c757d;
    line-height: 1.5;
}

.stats-card.featured .stats-description,
.stats-card.pkh .stats-description,
.stats-card.blt .stats-description,
.stats-card.sembako .stats-description {
    color: rgba(255,255,255,0.9);
}

/* Chart Container */
.chart-container {
    background: white;
    border-radius: 20px;
    padding: 30px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    margin-bottom: 30px;
}

.chart-header {
    text-align: center;
    margin-bottom: 30px;
}

.chart-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 10px;
}

.chart-subtitle {
    color: #6c757d;
    font-size: 0.95rem;
}

/* Progress Bar */
.progress-container {
    margin: 20px 0;
}

.progress-label {
    display: flex;
    justify-content: space-between;
    margin-bottom: 8px;
    font-weight: 600;
    color: #2c3e50;
}

.progress {
    height: 12px;
    border-radius: 6px;
    background: #f8f9fa;
    overflow: hidden;
}

.progress-bar {
    border-radius: 6px;
    transition: width 1s ease-in-out;
}

/* Info Cards */
.info-card {
    background: white;
    border-radius: 15px;
    padding: 25px;
    margin-bottom: 20px;
    border-left: 4px solid #ffc107;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
}

.info-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
}

.info-card-header {
    display: flex;
    align-items: center;
    margin-bottom: 15px;
}

.info-card-icon {
    font-size: 2rem;
    margin-right: 15px;
    color: #ffc107;
}

.info-card-title {
    font-size: 1.2rem;
    font-weight: 700;
    color: #2c3e50;
    margin: 0;
}

.info-card-content {
    color: #6c757d;
    line-height: 1.6;
}

/* Alert */
.alert-bansos {
    background: linear-gradient(135deg, #fff3cd 0%, #ffeaa7 100%);
    border: 1px solid #ffc107;
    border-radius: 15px;
    padding: 20px;
    margin: 30px 0;
}

.alert-bansos .alert-icon {
    color: #ffc107;
    font-size: 1.5rem;
    margin-bottom: 10px;
}

.alert-bansos .alert-title {
    color: #856404;
    font-weight: 700;
    margin-bottom: 10px;
}

.alert-bansos .alert-text {
    color: #856404;
    line-height: 1.6;
}

/* Responsive */
@media (max-width: 768px) {
    .nav-pills {
        flex-direction: column;
        align-items: stretch;
    }
    
    .nav-pill {
        justify-content: center;
    }
    
    .stats-grid {
        grid-template-columns: 1fr;
    }
    
    .stats-value {
        font-size: 2rem;
    }
}
</style>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-3 fw-bold mb-4">
                    <i class="fas fa-hand-holding-heart me-3"></i>
                    BANTUAN SOSIAL
                </h1>
                <p class="lead mb-4" style="font-size: 1.3rem; line-height: 1.6;">
                    Data distribusi dan penerima bantuan sosial di wilayah desa
                </p>
                <div class="d-flex align-items-center">
                    <i class="fas fa-info-circle me-2"></i>
                    <span>Data terkini periode {{ date('Y') }}</span>
                </div>
            </div>
            <div class="col-lg-6 text-center">
                <div style="font-size: 8rem; opacity: 0.3;">
                    <i class="fas fa-handshake"></i>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container">
    <!-- Navigation Pills -->
    <div class="infografis-nav">
        <div class="nav-pills">
            <a href="{{ route('infografis.penduduk') }}" class="nav-pill">
                <i class="fas fa-users"></i>Penduduk
            </a>
            <a href="{{ route('infografis.apbdes') }}" class="nav-pill">
                <i class="fas fa-money-bill-wave"></i>APBDes
            </a>
            <a href="{{ route('infografis.stunting') }}" class="nav-pill">
                <i class="fas fa-child"></i>Stunting
            </a>
            <a href="{{ route('infografis.bansos') }}" class="nav-pill active">
                <i class="fas fa-hand-holding-heart"></i>Bansos
            </a>
            <a href="{{ route('idm.index') }}" class="nav-pill">
                <i class="fas fa-chart-line"></i>IDM
            </a>
            <a href="{{ route('infografis.sdgs') }}" class="nav-pill">
                <i class="fas fa-globe"></i>SDGs
            </a>
        </div>
    </div>

    <!-- Bansos Header -->
    <div class="text-center mb-5">
        <h2 class="display-4 fw-bold text-warning mb-4">DATA BANTUAN SOSIAL</h2>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <p class="lead" style="font-size: 1.2rem; line-height: 1.8; color: #6c757d;">
                    Pemantauan distribusi bantuan sosial untuk masyarakat berdasarkan data 
                    <strong>Dinas Sosial</strong> dan <strong>Pemerintah Desa</strong>.
                </p>
            </div>
        </div>
    </div>

    <!-- Alert Info -->
    <div class="alert-bansos">
        <div class="text-center">
            <i class="fas fa-info-circle alert-icon"></i>
            <div class="alert-title h5">Informasi Bantuan Sosial</div>
            <p class="alert-text mb-0">
                Total {{ number_format($totalPenerima) }} penerima bantuan sosial dengan total nominal 
                <strong>Rp {{ number_format($totalNominal) }}</strong> telah disalurkan pada tahun {{ date('Y') }}.
                Cakupan bantuan mencapai <strong>{{ number_format($cakupan, 1) }}%</strong> dari keluarga miskin yang terdata.
            </p>
        </div>
    </div>

    <!-- Main Stats Grid -->
    <div class="stats-grid">
        <div class="stats-card featured">
            <div class="stats-label">Total Penerima</div>
            <div class="stats-value">{{ number_format($totalPenerima) }}</div>
            <div class="stats-description">Keluarga penerima bantuan</div>
        </div>

        <div class="stats-card pkh">
            <div class="stats-label">PKH</div>
            <div class="stats-value">{{ number_format($pkh) }}</div>
            <div class="stats-description">Program Keluarga Harapan</div>
        </div>

        <div class="stats-card blt">
            <div class="stats-label">BLT</div>
            <div class="stats-value">{{ number_format($blt) }}</div>
            <div class="stats-description">Bantuan Langsung Tunai</div>
        </div>

        <div class="stats-card sembako">
            <div class="stats-label">Sembako</div>
            <div class="stats-value">{{ number_format($sembako) }}</div>
            <div class="stats-description">Bantuan Sembilan Bahan Pokok</div>
        </div>

        <div class="stats-card" style="background: linear-gradient(135deg, #17a2b8 0%, #138496 100%); color: white;">
            <div class="stats-label" style="color: rgba(255,255,255,0.8);">Total Nominal</div>
            <div class="stats-value" style="color: white; font-size: 1.8rem;">Rp {{ number_format($totalNominal/1000000) }}M</div>
            <div class="stats-description" style="color: rgba(255,255,255,0.9);">Total bantuan disalurkan</div>
        </div>

        <div class="stats-card" style="background: linear-gradient(135deg, #6f42c1 0%, #e83e8c 100%); color: white;">
            <div class="stats-label" style="color: rgba(255,255,255,0.8);">Cakupan</div>
            <div class="stats-value" style="color: white;">{{ number_format($cakupan, 1) }}%</div>
            <div class="stats-description" style="color: rgba(255,255,255,0.9);">Dari keluarga miskin</div>
        </div>
    </div>

    <!-- Distribution Chart -->
    <div class="chart-container">
        <div class="chart-header">
            <h3 class="chart-title">Distribusi Jenis Bantuan Sosial</h3>
            <p class="chart-subtitle">Perbandingan penerima berbagai jenis bantuan sosial</p>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="progress-container">
                    <div class="progress-label">
                        <span><i class="fas fa-circle text-success me-2"></i>Program Keluarga Harapan (PKH)</span>
                        <span>{{ number_format($pkh) }} penerima</span>
                    </div>
                    <div class="progress">
                        <div class="progress-bar bg-success" style="width: {{ $totalPenerima > 0 ? ($pkh/$totalPenerima)*100 : 0 }}%"></div>
                    </div>
                </div>

                <div class="progress-container">
                    <div class="progress-label">
                        <span><i class="fas fa-circle text-primary me-2"></i>Bantuan Langsung Tunai (BLT)</span>
                        <span>{{ number_format($blt) }} penerima</span>
                    </div>
                    <div class="progress">
                        <div class="progress-bar bg-primary" style="width: {{ $totalPenerima > 0 ? ($blt/$totalPenerima)*100 : 0 }}%"></div>
                    </div>
                </div>

                <div class="progress-container">
                    <div class="progress-label">
                        <span><i class="fas fa-circle text-danger me-2"></i>Bantuan Sembako</span>
                        <span>{{ number_format($sembako) }} penerima</span>
                    </div>
                    <div class="progress">
                        <div class="progress-bar bg-danger" style="width: {{ $totalPenerima > 0 ? ($sembako/$totalPenerima)*100 : 0 }}%"></div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="text-center">
                    <div style="font-size: 4rem; margin: 30px 0; color: #ffc107;">
                        <i class="fas fa-chart-pie"></i>
                    </div>
                    <h4 class="mb-3">Persentase Distribusi</h4>
                    <div class="row">
                        <div class="col-4">
                            <div class="small text-muted mb-1">PKH</div>
                            <div class="h5 fw-bold text-success">{{ $totalPenerima > 0 ? number_format(($pkh/$totalPenerima)*100, 1) : 0 }}%</div>
                        </div>
                        <div class="col-4">
                            <div class="small text-muted mb-1">BLT</div>
                            <div class="h5 fw-bold text-primary">{{ $totalPenerima > 0 ? number_format(($blt/$totalPenerima)*100, 1) : 0 }}%</div>
                        </div>
                        <div class="col-4">
                            <div class="small text-muted mb-1">Sembako</div>
                            <div class="h5 fw-bold text-danger">{{ $totalPenerima > 0 ? number_format(($sembako/$totalPenerima)*100, 1) : 0 }}%</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Historical Trends -->
    <div class="chart-container">
        <div class="chart-header">
            <h3 class="chart-title">Tren Bantuan Sosial 5 Tahun Terakhir</h3>
            <p class="chart-subtitle">Perkembangan jumlah penerima dan nominal bantuan</p>
        </div>

        <div class="row">
            @foreach($historicalData as $data)
            <div class="col mb-3">
                <div class="text-center p-3 rounded" style="background: #f8f9fa; border: 1px solid #dee2e6;">
                    <div class="h6 mb-2" style="color: #6c757d;">{{ $data['tahun'] }}</div>
                    <div class="h5 fw-bold mb-1" style="color: #ffc107;">{{ number_format($data['penerima']) }}</div>
                    <div class="small text-muted mb-2">Penerima</div>
                    <div class="h6 fw-bold" style="color: #28a745;">Rp {{ number_format($data['nominal']/1000000) }}M</div>
                    <div class="small text-muted">Nominal</div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="row mt-4">
            <div class="col-lg-8 mx-auto">
                <div class="text-center p-4 rounded" style="background: #f8f9fa; border: 1px solid #dee2e6;">
                    <h5 class="mb-3">Analisis Tren</h5>
                    @php
                        $firstYear = $historicalData[0] ?? null;
                        $lastYear = end($historicalData);
                        if ($firstYear && $lastYear) {
                            $penerimaChange = $lastYear['penerima'] - $firstYear['penerima'];
                            $nominalChange = $lastYear['nominal'] - $firstYear['nominal'];
                        } else {
                            $penerimaChange = 0;
                            $nominalChange = 0;
                        }
                    @endphp
                    <p class="mb-0">
                        Dalam 5 tahun terakhir, jumlah penerima bantuan sosial 
                        @if($penerimaChange > 0)
                            <strong class="text-success">meningkat {{ number_format($penerimaChange) }} keluarga</strong>
                        @elseif($penerimaChange < 0)
                            <strong class="text-danger">menurun {{ number_format(abs($penerimaChange)) }} keluarga</strong>
                        @else
                            <strong class="text-muted">stagnan</strong>
                        @endif
                        dengan peningkatan nominal sebesar <strong class="text-primary">Rp {{ number_format($nominalChange/1000000) }} juta</strong>.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Program Information -->
    <div class="row">
        <div class="col-lg-4">
            <div class="info-card">
                <div class="info-card-header">
                    <div class="info-card-icon">
                        <i class="fas fa-family"></i>
                    </div>
                    <h4 class="info-card-title">Program Keluarga Harapan (PKH)</h4>
                </div>
                <div class="info-card-content">
                    Bantuan tunai bersyarat untuk keluarga miskin dengan komponen kesehatan, pendidikan, dan kesejahteraan sosial.
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="info-card">
                <div class="info-card-header">
                    <div class="info-card-icon">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                    <h4 class="info-card-title">Bantuan Langsung Tunai (BLT)</h4>
                </div>
                <div class="info-card-content">
                    Bantuan tunai langsung untuk masyarakat terdampak pandemi dan kondisi ekonomi sulit lainnya.
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="info-card">
                <div class="info-card-header">
                    <div class="info-card-icon">
                        <i class="fas fa-shopping-basket"></i>
                    </div>
                    <h4 class="info-card-title">Bantuan Sembako</h4>
                </div>
                <div class="info-card-content">
                    Bantuan berupa sembilan bahan pokok untuk memenuhi kebutuhan dasar masyarakat kurang mampu.
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Information -->
    <div class="chart-container">
        <div class="text-center">
            <h4 class="mb-4">
                <i class="fas fa-phone text-warning me-2"></i>
                Informasi Lebih Lanjut
            </h4>
            <p class="text-muted mb-4">
                Untuk informasi lebih detail mengenai bantuan sosial atau pengaduan, 
                silakan hubungi kantor desa atau petugas yang bertanggung jawab.
            </p>
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="p-3 rounded" style="background: #f8f9fa;">
                        <i class="fas fa-building fa-2x text-warning mb-2"></i>
                        <h6>Kantor Desa</h6>
                        <small class="text-muted">Senin - Jumat, 08:00 - 15:00</small>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 rounded" style="background: #f8f9fa;">
                        <i class="fas fa-user-tie fa-2x text-warning mb-2"></i>
                        <h6>Petugas Bansos</h6>
                        <small class="text-muted">Konsultasi dan pendaftaran</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Extra spacing at bottom -->
<div class="py-5"></div>
@endsection
