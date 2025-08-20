@extends('layouts.main')

@section('content')
<style>
.hero-section {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
    font-weight: 500;
    white-space: nowrap;
}

.nav-pill:hover {
    color: #495057;
    background: #e9ecef;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.nav-pill.active {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border-color: #667eea;
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
}

.nav-pill i {
    margin-right: 8px;
    font-size: 1.1em;
}

/* Stats Cards */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 25px;
    margin: 40px 0;
}

.stats-card {
    background: white;
    border-radius: 20px;
    padding: 30px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    transition: all 0.4s ease;
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
    background: linear-gradient(90deg, #667eea, #764ba2);
}

.stats-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
}

.stats-card.featured {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}

.stats-card.featured::before {
    background: rgba(255,255,255,0.3);
}

.stats-label {
    font-size: 0.9rem;
    color: #6c757d;
    margin-bottom: 10px;
    text-transform: uppercase;
    font-weight: 600;
    letter-spacing: 1px;
}

.stats-card.featured .stats-label {
    color: rgba(255,255,255,0.8);
}

.stats-value {
    font-size: 2.5rem;
    font-weight: 900;
    margin: 15px 0;
    color: #2c3e50;
}

.stats-card.featured .stats-value {
    color: white;
}

.stats-description {
    font-size: 0.9rem;
    color: #6c757d;
    line-height: 1.5;
}

.stats-card.featured .stats-description {
    color: rgba(255,255,255,0.9);
}

/* Chart Section */
.chart-section {
    background: white;
    border-radius: 20px;
    padding: 40px;
    margin: 40px 0;
    box-shadow: 0 15px 35px rgba(0,0,0,0.08);
    position: relative;
    overflow: hidden;
}

.chart-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.chart-container {
    position: relative;
    margin-top: 30px;
    padding: 25px;
    background: #fafbfc;
    border-radius: 15px;
    border: 1px solid #e9ecef;
    min-height: 450px;
}

.chart-container canvas {
    max-width: 100%;
    height: 400px !important;
    width: 100% !important;
}

/* Responsive Design */
@media (max-width: 992px) {
    .stats-grid {
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
    }
    
    .chart-container {
        padding: 20px;
        min-height: 350px;
    }
    
    .chart-container canvas {
        height: 300px !important;
    }
}

@media (max-width: 768px) {
    .nav-pills {
        justify-content: stretch;
        flex-direction: column;
        align-items: center;
    }
    
    .nav-pill {
        width: 100%;
        max-width: 300px;
        justify-content: center;
        margin-bottom: 10px;
    }
    
    .stats-grid {
        grid-template-columns: 1fr;
        gap: 15px;
    }
    
    .chart-section, .table-section {
        padding: 25px 20px;
        margin: 25px 0;
    }
    
    .chart-container {
        padding: 15px;
        min-height: 300px;
    }
    
    .chart-container canvas {
        height: 250px !important;
    }
    
    .section-title h3 {
        font-size: 1.5rem;
    }
}

.section-title {
    text-align: center;
    margin-bottom: 40px;
}

.section-title h3 {
    font-size: 2rem;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 10px;
}

.section-title .subtitle {
    color: #6c757d;
    font-size: 1.1rem;
}

/* Table Section */
.table-section {
    background: white;
    border-radius: 20px;
    padding: 40px;
    margin: 40px 0;
    box-shadow: 0 15px 35px rgba(0,0,0,0.08);
    position: relative;
    overflow: hidden;
}

.table-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.table-responsive {
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    border: 2px solid #e9ecef;
    margin-top: 25px;
}

.table {
    margin-bottom: 0;
    font-size: 0.95rem;
    font-family: 'system-ui', -apple-system, sans-serif;
}

.table thead th {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: none;
    padding: 20px 15px;
    font-weight: 700;
    text-transform: uppercase;
    font-size: 0.85rem;
    letter-spacing: 1px;
    text-align: center;
    white-space: nowrap;
    position: relative;
}

.table thead th:first-child {
    width: 8%;
    min-width: 60px;
}

.table thead th:nth-child(2) {
    width: 42%;
    text-align: left;
    padding-left: 25px;
}

.table thead th:nth-child(3) {
    width: 15%;
    min-width: 100px;
}

.table thead th:last-child {
    width: 35%;
    min-width: 120px;
}

.table tbody td {
    padding: 18px 15px;
    border-color: #f1f3f4;
    vertical-align: middle;
    font-size: 0.9rem;
    line-height: 1.5;
    font-weight: 500;
}

.table tbody td:first-child {
    text-align: center;
    font-weight: 700;
    color: #495057;
    background-color: #f8f9fa;
    font-size: 1rem;
}

.table tbody td:nth-child(2) {
    padding-left: 25px;
    font-weight: 600;
    color: #2c3e50;
}

.table tbody td:nth-child(3) {
    text-align: center;
}

.table tbody td:last-child {
    text-align: center;
    font-weight: 700;
    font-size: 1rem;
    color: #2c3e50;
}

.table tbody tr:hover {
    background-color: rgba(102, 126, 234, 0.08);
    transition: all 0.3s ease;
    transform: scale(1.01);
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.15);
}

.table tbody tr:nth-child(even) {
    background-color: #fafbfc;
}

.table tbody tr:nth-child(even):hover {
    background-color: rgba(102, 126, 234, 0.1);
}

.indicator-badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 10px 16px;
    border-radius: 25px;
    font-size: 0.8rem;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 1px;
    min-width: 65px;
    white-space: nowrap;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    transition: all 0.3s ease;
}

.indicator-badge:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0,0,0,0.2);
}

.indicator-badge.iks {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    border: 2px solid rgba(255,255,255,0.2);
}

.indicator-badge.ike {
    background: linear-gradient(135deg, #f093fb, #f5576c);
    color: white;
    border: 2px solid rgba(255,255,255,0.2);
}

.indicator-badge.ikl {
    background: linear-gradient(135deg, #43e97b, #38f9d7);
    color: white;
    border: 2px solid rgba(255,255,255,0.2);
}

.score-cell {
    font-weight: 800;
    font-size: 1.1rem;
    text-align: center;
    color: #2c3e50;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-radius: 8px;
    padding: 8px 12px;
    display: inline-block;
    min-width: 80px;
    box-shadow: inset 0 2px 4px rgba(0,0,0,0.1);
}

.table .text-center {
    text-align: center !important;
}

.table .fw-bold {
    font-weight: 700 !important;
}

.rowspan-cell {
    background: linear-gradient(135deg, #f8f9fa, #e9ecef) !important;
    font-weight: 700;
    font-size: 1.1rem;
    color: #495057;
    border-right: 3px solid #667eea;
}

.category-cell {
    background: rgba(102, 126, 234, 0.05) !important;
    font-weight: 600;
}

.indicator-description {
    font-size: 0.9rem;
    line-height: 1.3;
    padding: 8px 12px;
}

.status-badge {
    padding: 6px 12px;
    border-radius: 15px;
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: capitalize;
    white-space: nowrap;
}

.summary-stats {
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    border-radius: 15px;
    padding: 25px;
    margin: 30px 0;
    border-left: 5px solid #667eea;
}

.summary-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 20px;
    text-align: center;
}

.summary-item {
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.summary-number {
    font-size: 2rem;
    font-weight: 900;
    color: #667eea;
    display: block;
}

.summary-label {
    font-size: 0.9rem;
    color: #6c757d;
    font-weight: 600;
    margin-top: 5px;
}

.summary-desc {
    font-size: 0.8rem;
    color: #868e96;
    margin-top: 3px;
}

/* Responsive */
@media (max-width: 768px) {
    .hero-section { padding: 60px 0; }
    .nav-pills { flex-direction: column; align-items: center; }
    .nav-pill { width: 100%; justify-content: center; margin: 5px 0; }
    .stats-grid { grid-template-columns: 1fr; }
    .stats-value { font-size: 2rem; }
    .section-title h3 { font-size: 1.5rem; }
    .table-section { padding: 20px; }
    .table thead th, .table tbody td { padding: 12px 10px; font-size: 0.9rem; }
}

/* Loading indicator */
.loading-indicator {
    display: none;
    text-align: center;
    padding: 20px;
    color: #6c757d;
}

.loading-indicator.show {
    display: block;
}

.loading-spinner {
    display: inline-block;
    width: 20px;
    height: 20px;
    border: 2px solid #f3f3f3;
    border-top: 2px solid #667eea;
    border-radius: 50%;
    animation: spin 1s linear infinite;
    margin-right: 10px;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
</style>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container position-relative" style="z-index: 2;">
        <div class="text-center">
            <h1 class="display-3 fw-bold mb-4">
                INFOGRAFIS DESA {{ strtoupper(config('app.desa_name', 'PORTAL DESA')) }}
            </h1>
            <p class="lead mb-0" style="font-size: 1.2rem;">
                Informasi Data dan Statistik Pembangunan Desa
            </p>
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
            <a href="{{ route('infografis.bansos') }}" class="nav-pill">
                <i class="fas fa-hand-holding-heart"></i>Bansos
            </a>
            <a href="{{ route('idm.index') }}" class="nav-pill active">
                <i class="fas fa-chart-line"></i>IDM
            </a>
            <a href="{{ route('infografis.sdgs') }}" class="nav-pill">
                <i class="fas fa-globe"></i>SDGs
            </a>
        </div>
    </div>

    <!-- IDM Header -->
    <div class="text-center mb-4">
        <h2 class="display-4 fw-bold text-primary mb-4">IDM</h2>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <p class="lead" style="font-size: 1.2rem; line-height: 1.8; color: #6c757d;">
                    Indeks Desa Membangun (IDM) merupakan indeks komposit yang dibentuk dari tiga indeks, 
                    yaitu <strong>Indeks Ketahanan Sosial</strong>, <strong>Indeks Ketahanan Ekonomi</strong>, 
                    dan <strong>Indeks Ketahanan Ekologi/Lingkungan</strong>.
                </p>
            </div>
        </div>
    </div>

    <!-- Admin Management Link -->
    @auth
        @if(auth()->user()->role === 'admin')
        <div class="container mb-4">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="alert alert-primary border-0 shadow-sm">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <i class="fas fa-cog me-2"></i>
                                <strong>Admin:</strong> Kelola data IDM, aktifkan/nonaktifkan tampilan
                            </div>
                            <a href="/admin/idm" class="btn btn-primary btn-sm">
                                <i class="fas fa-edit me-1"></i>Kelola IDM
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    @endauth

    <!-- Main Stats Grid -->
    <div class="stats-grid">
        <div class="stats-card featured">
            <div class="stats-label">SKOR IDM {{ $currentIdm->tahun ?? date('Y') }}</div>
            <div class="stats-value">{{ number_format($currentIdm->skor_idm, 4) }}</div>
            <div class="stats-description">Indeks Desa Membangun</div>
        </div>

        <div class="stats-card featured">
            <div class="stats-label">STATUS IDM {{ $currentIdm->tahun ?? date('Y') }}</div>
            <div class="stats-value" style="font-size: 2rem;">{{ $currentIdm->status_idm }}</div>
            <div class="stats-description">{{ $currentIdm->status_description ?? 'Status pencapaian desa' }}</div>
        </div>

        <div class="stats-card">
            <div class="stats-label">Target Status</div>
            <div class="stats-value" style="font-size: 2rem;">{{ $currentIdm->target_status }}</div>
            <div class="stats-description">Status yang ingin dicapai</div>
        </div>

        <div class="stats-card">
            <div class="stats-label">Skor Minimal</div>
            <div class="stats-value">{{ number_format($currentIdm->skor_minimal, 4) }}</div>
            <div class="stats-description">Skor minimum untuk target</div>
        </div>

        <div class="stats-card">
            <div class="stats-label">Penambahan</div>
            <div class="stats-value">{{ number_format($currentIdm->penambahan, 4) }}</div>
            <div class="stats-description">Skor yang perlu ditambah</div>
        </div>

        <div class="stats-card">
            <div class="stats-label">Skor IKS</div>
            <div class="stats-value">{{ number_format($currentIdm->skor_iks, 4) }}</div>
            <div class="stats-description">Indeks Ketahanan Sosial</div>
        </div>

        <div class="stats-card">
            <div class="stats-label">Skor IKE</div>
            <div class="stats-value">{{ number_format($currentIdm->skor_ike, 4) }}</div>
            <div class="stats-description">Indeks Ketahanan Ekonomi</div>
        </div>

        <div class="stats-card">
            <div class="stats-label">Skor IKL</div>
            <div class="stats-value">{{ number_format($currentIdm->skor_ikl, 4) }}</div>
            <div class="stats-description">Indeks Ketahanan Lingkungan</div>
        </div>
    </div>

    <!-- Chart Section -->
    @if($historicalData->count() > 0)
    <div class="chart-section">
        <div class="section-title">
            <h3><i class="fas fa-chart-line me-3"></i>Skor IDM Tahun ke Tahun</h3>
            <p class="subtitle">Tren perkembangan Indeks Desa Membangun dari waktu ke waktu</p>
        </div>
        <div class="chart-container">
            <canvas id="idmChart" style="height: 400px; max-height: 400px;"></canvas>
        </div>
    </div>
    @else
    <div class="chart-section">
        <div class="section-title">
            <h3><i class="fas fa-chart-line me-3"></i>Skor IDM Tahun ke Tahun</h3>
            <p class="subtitle">Tren perkembangan Indeks Desa Membangun dari waktu ke waktu</p>
        </div>
        <div class="alert alert-info text-center py-5" style="border-radius: 15px; border: none; background: linear-gradient(135deg, #e3f2fd 0%, #f3e5f5 100%);">
            <i class="fas fa-info-circle fa-3x mb-3" style="color: #2196f3;"></i>
            <h4 style="color: #1976d2; margin-bottom: 15px;">Data Historis Belum Tersedia</h4>
            <p style="color: #555; margin-bottom: 0; font-size: 1.1rem;">
                Grafik tren IDM akan ditampilkan setelah data historis tersedia di sistem.
            </p>
        </div>
    </div>
    @endif

    <!-- Tabel Indikator IDM -->
    <div class="table-section">
        <div class="section-title">
            <h3><i class="fas fa-table me-3"></i>Tabel Indikator IDM</h3>
            <p class="subtitle">Detail indikator pembentuk Indeks Desa Membangun</p>
        </div>

        <!-- Summary Statistics -->
        <div class="summary-stats">
            <h5 class="text-center mb-4 fw-bold">
                <i class="fas fa-chart-bar me-2"></i>Ringkasan Indikator
            </h5>
            <div class="summary-grid">
                <div class="summary-item">
                    <span class="summary-number">27</span>
                    <div class="summary-label">Total Indikator</div>
                    <div class="summary-desc">Indikator IDM</div>
                </div>
                <div class="summary-item">
                    <span class="summary-number">3</span>
                    <div class="summary-label">Indikator Terpenuhi</div>
                    <div class="summary-desc">Indikator</div>
                </div>
                <div class="summary-item">
                    <span class="summary-number">11.1%</span>
                    <div class="summary-label">Persentase</div>
                    <div class="summary-desc">Pencapaian</div>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th width="8%">No</th>
                        <th width="12%">Kategori</th>
                        <th width="50%">Indikator</th>
                        <th width="15%">Skor</th>
                        <th width="15%">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- IKS Indicators -->
                    <tr>
                        <td rowspan="12" class="text-center fw-bold rowspan-cell">1</td>
                        <td rowspan="12" class="text-center category-cell">
                            <span class="indicator-badge iks">IKS</span>
                        </td>
                        <td class="indicator-description">Tersedia fasilitas kesehatan</td>
                        <td class="score-cell">{{ number_format($currentIdm->skor_iks, 4) }}</td>
                        <td class="text-center">
                            <span class="badge status-badge bg-{{ $currentIdm->skor_iks > 0.7 ? 'success' : ($currentIdm->skor_iks > 0.5 ? 'warning' : 'danger') }}">
                                {{ $currentIdm->skor_iks > 0.7 ? 'Baik' : ($currentIdm->skor_iks > 0.5 ? 'Sedang' : 'Kurang') }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td class="indicator-description">Tersedia tenaga kesehatan</td>
                        <td class="score-cell text-muted">-</td>
                        <td class="text-center">
                            <span class="badge status-badge bg-secondary">Belum Tersedia</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="indicator-description">Tersedia fasilitas pendidikan SD/sederajat</td>
                        <td class="score-cell text-muted">-</td>
                        <td class="text-center">
                            <span class="badge status-badge bg-secondary">Belum Tersedia</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="indicator-description">Tersedia fasilitas pendidikan SMP/sederajat</td>
                        <td class="score-cell text-muted">-</td>
                        <td class="text-center">
                            <span class="badge status-badge bg-secondary">Belum Tersedia</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="indicator-description">Tersedia fasilitas pendidikan SMA/sederajat</td>
                        <td class="score-cell text-muted">-</td>
                        <td class="text-center">
                            <span class="badge status-badge bg-secondary">Belum Tersedia</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="indicator-description">Tersedia guru pendidikan SD</td>
                        <td class="score-cell text-muted">-</td>
                        <td class="text-center">
                            <span class="badge status-badge bg-secondary">Belum Tersedia</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="indicator-description">Tersedia guru pendidikan SMP</td>
                        <td class="score-cell text-muted">-</td>
                        <td class="text-center">
                            <span class="badge status-badge bg-secondary">Belum Tersedia</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="indicator-description">Tersedia guru pendidikan SMA</td>
                        <td class="score-cell text-muted">-</td>
                        <td class="text-center">
                            <span class="badge status-badge bg-secondary">Belum Tersedia</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="indicator-description">Tersedia sarana olahraga</td>
                        <td class="score-cell text-muted">-</td>
                        <td class="text-center">
                            <span class="badge status-badge bg-secondary">Belum Tersedia</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="indicator-description">Tersedia sarana ibadah</td>
                        <td class="score-cell text-muted">-</td>
                        <td class="text-center">
                            <span class="badge status-badge bg-secondary">Belum Tersedia</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="indicator-description">Tersedia sarana rekreasi</td>
                        <td class="score-cell text-muted">-</td>
                        <td class="text-center">
                            <span class="badge status-badge bg-secondary">Belum Tersedia</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="indicator-description">Akses ke pusat pemerintahan</td>
                        <td class="score-cell text-muted">-</td>
                        <td class="text-center">
                            <span class="badge status-badge bg-secondary">Belum Tersedia</span>
                        </td>
                    </tr>

                    <!-- IKE Indicators -->
                    <tr>
                        <td rowspan="8" class="text-center fw-bold rowspan-cell">2</td>
                        <td rowspan="8" class="text-center category-cell">
                            <span class="indicator-badge ike">IKE</span>
                        </td>
                        <td class="indicator-description">Tersedia lembaga keuangan</td>
                        <td class="score-cell">{{ number_format($currentIdm->skor_ike, 4) }}</td>
                        <td class="text-center">
                            <span class="badge status-badge bg-{{ $currentIdm->skor_ike > 0.7 ? 'success' : ($currentIdm->skor_ike > 0.5 ? 'warning' : 'danger') }}">
                                {{ $currentIdm->skor_ike > 0.7 ? 'Baik' : ($currentIdm->skor_ike > 0.5 ? 'Sedang' : 'Kurang') }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td class="indicator-description">Tersedia toko/warung kelontong</td>
                        <td class="score-cell text-muted">-</td>
                        <td class="text-center">
                            <span class="badge status-badge bg-secondary">Belum Tersedia</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="indicator-description">Tersedia kedai/warung makan</td>
                        <td class="score-cell text-muted">-</td>
                        <td class="text-center">
                            <span class="badge status-badge bg-secondary">Belum Tersedia</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="indicator-description">Tersedia penjahit</td>
                        <td class="score-cell text-muted">-</td>
                        <td class="text-center">
                            <span class="badge status-badge bg-secondary">Belum Tersedia</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="indicator-description">Tersedia pangkas rambut</td>
                        <td class="score-cell text-muted">-</td>
                        <td class="text-center">
                            <span class="badge status-badge bg-secondary">Belum Tersedia</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="indicator-description">Tersedia bengkel</td>
                        <td class="score-cell text-muted">-</td>
                        <td class="text-center">
                            <span class="badge status-badge bg-secondary">Belum Tersedia</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="indicator-description">Akses distribusi/logistik</td>
                        <td class="score-cell text-muted">-</td>
                        <td class="text-center">
                            <span class="badge status-badge bg-secondary">Belum Tersedia</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="indicator-description">Akses ke pusat ekonomi</td>
                        <td class="score-cell text-muted">-</td>
                        <td class="text-center">
                            <span class="badge status-badge bg-secondary">Belum Tersedia</span>
                        </td>
                    </tr>

                    <!-- IKL Indicators -->
                    <tr>
                        <td rowspan="7" class="text-center fw-bold rowspan-cell">3</td>
                        <td rowspan="7" class="text-center category-cell">
                            <span class="indicator-badge ikl">IKL</span>
                        </td>
                        <td class="indicator-description">Kualitas air minum</td>
                        <td class="score-cell">{{ number_format($currentIdm->skor_ikl, 4) }}</td>
                        <td class="text-center">
                            <span class="badge status-badge bg-{{ $currentIdm->skor_ikl > 0.7 ? 'success' : ($currentIdm->skor_ikl > 0.5 ? 'warning' : 'danger') }}">
                                {{ $currentIdm->skor_ikl > 0.7 ? 'Baik' : ($currentIdm->skor_ikl > 0.5 ? 'Sedang' : 'Kurang') }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td class="indicator-description">Akses ke sumber air minum layak</td>
                        <td class="score-cell text-muted">-</td>
                        <td class="text-center">
                            <span class="badge status-badge bg-secondary">Belum Tersedia</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="indicator-description">Tersedia fasilitas buang air besar</td>
                        <td class="score-cell text-muted">-</td>
                        <td class="text-center">
                            <span class="badge status-badge bg-secondary">Belum Tersedia</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="indicator-description">Tersedia tempat pembuangan sampah</td>
                        <td class="score-cell text-muted">-</td>
                        <td class="text-center">
                            <span class="badge status-badge bg-secondary">Belum Tersedia</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="indicator-description">Tersedia saluran pembuangan limbah</td>
                        <td class="score-cell text-muted">-</td>
                        <td class="text-center">
                            <span class="badge status-badge bg-secondary">Belum Tersedia</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="indicator-description">Tersedia penerangan jalan umum</td>
                        <td class="score-cell text-muted">-</td>
                        <td class="text-center">
                            <span class="badge status-badge bg-secondary">Belum Tersedia</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="indicator-description">Kualitas jalan di desa</td>
                        <td class="score-cell text-muted">-</td>
                        <td class="text-center">
                            <span class="badge status-badge bg-secondary">Belum Tersedia</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
                        <td>Tersedia sarana rekreasi</td>
                        <td class="score-cell">-</td>
                        <td><span class="badge bg-secondary">Belum tersedia</span></td>
                    </tr>
                    <tr>
                        <td>Akses ke pusat pemerintahan</td>
                        <td class="score-cell">-</td>
                        <td><span class="badge bg-secondary">Belum tersedia</span></td>
                    </tr>

                    <!-- IKE Indicators -->
                    <tr>
                        <td rowspan="8" class="text-center fw-bold">2</td>
                        <td rowspan="8"><span class="indicator-badge ike">IKE</span></td>
                        <td>Tersedia lembaga keuangan</td>
                        <td class="score-cell">{{ number_format($currentIdm->skor_ike, 4) }}</td>
                        <td><span class="badge bg-{{ $currentIdm->skor_ike > 0.7 ? 'success' : ($currentIdm->skor_ike > 0.5 ? 'warning' : 'danger') }}">
                            {{ $currentIdm->skor_ike > 0.7 ? 'Baik' : ($currentIdm->skor_ike > 0.5 ? 'Sedang' : 'Kurang') }}
                        </span></td>
                    </tr>
                    <tr>
                        <td>Tersedia toko/warung kelontong</td>
                        <td class="score-cell">-</td>
                        <td><span class="badge bg-secondary">Belum tersedia</span></td>
                    </tr>
                    <tr>
                        <td>Tersedia kedai/warung makan</td>
                        <td class="score-cell">-</td>
                        <td><span class="badge bg-secondary">Belum tersedia</span></td>
                    </tr>
                    <tr>
                        <td>Tersedia penjahit</td>
                        <td class="score-cell">-</td>
                        <td><span class="badge bg-secondary">Belum tersedia</span></td>
                    </tr>
                    <tr>
                        <td>Tersedia pangkas rambut</td>
                        <td class="score-cell">-</td>
                        <td><span class="badge bg-secondary">Belum tersedia</span></td>
                    </tr>
                    <tr>
                        <td>Tersedia bengkel</td>
                        <td class="score-cell">-</td>
                        <td><span class="badge bg-secondary">Belum tersedia</span></td>
                    </tr>
                    <tr>
                        <td>Akses distribusi/logistik</td>
                        <td class="score-cell">-</td>
                        <td><span class="badge bg-secondary">Belum tersedia</span></td>
                    </tr>
                    <tr>
                        <td>Akses ke pusat ekonomi</td>
                        <td class="score-cell">-</td>
                        <td><span class="badge bg-secondary">Belum tersedia</span></td>
                    </tr>

                    <!-- IKL Indicators -->
                    <tr>
                        <td rowspan="7" class="text-center fw-bold">3</td>
                        <td rowspan="7"><span class="indicator-badge ikl">IKL</span></td>
                        <td>Kualitas air minum</td>
                        <td class="score-cell">{{ number_format($currentIdm->skor_ikl, 4) }}</td>
                        <td><span class="badge bg-{{ $currentIdm->skor_ikl > 0.7 ? 'success' : ($currentIdm->skor_ikl > 0.5 ? 'warning' : 'danger') }}">
                            {{ $currentIdm->skor_ikl > 0.7 ? 'Baik' : ($currentIdm->skor_ikl > 0.5 ? 'Sedang' : 'Kurang') }}
                        </span></td>
                    </tr>
                    <tr>
                        <td>Akses ke sumber air minum layak</td>
                        <td class="score-cell">-</td>
                        <td><span class="badge bg-secondary">Belum tersedia</span></td>
                    </tr>
                    <tr>
                        <td>Tersedia fasilitas buang air besar</td>
                        <td class="score-cell">-</td>
                        <td><span class="badge bg-secondary">Belum tersedia</span></td>
                    </tr>
                    <tr>
                        <td>Tersedia tempat pembuangan sampah</td>
                        <td class="score-cell">-</td>
                        <td><span class="badge bg-secondary">Belum tersedia</span></td>
                    </tr>
                    <tr>
                        <td>Tersedia saluran pembuangan limbah</td>
                        <td class="score-cell">-</td>
                        <td><span class="badge bg-secondary">Belum tersedia</span></td>
                    </tr>
                    <tr>
                        <td>Tersedia penerangan jalan umum</td>
                        <td class="score-cell">-</td>
                        <td><span class="badge bg-secondary">Belum tersedia</span></td>
                    </tr>
                    <tr>
                        <td>Kualitas jalan di desa</td>
                        <td class="score-cell">-</td>
                        <td><span class="badge bg-secondary">Belum tersedia</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <div class="mt-4">
            <div class="row">
                <div class="col-md-4 text-center">
                    <div class="p-3 bg-light rounded">
                        <h5 class="text-primary mb-2">Total Indikator</h5>
                        <span class="h3 fw-bold">27</span>
                        <p class="text-muted mb-0">Indikator IDM</p>
                    </div>
                </div>
                <div class="col-md-4 text-center">
                    <div class="p-3 bg-light rounded">
                        <h5 class="text-success mb-2">Indikator Terpenuhi</h5>
                        <span class="h3 fw-bold">3</span>
                        <p class="text-muted mb-0">Indikator</p>
                    </div>
                </div>
                <div class="col-md-4 text-center">
                    <div class="p-3 bg-light rounded">
                        <h5 class="text-warning mb-2">Persentase</h5>
                        <span class="h3 fw-bold">{{ number_format((3/27)*100, 1) }}%</span>
                        <p class="text-muted mb-0">Pencapaian</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@if($historicalData->count() > 1)
<script>
const ctx = document.getElementById('idmChart').getContext('2d');

// Create gradient
const gradient = ctx.createLinearGradient(0, 0, 0, 400);
gradient.addColorStop(0, 'rgba(102, 126, 234, 0.3)');
gradient.addColorStop(1, 'rgba(102, 126, 234, 0.05)');

const idmChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: {!! json_encode($chartData['years']) !!},
        datasets: [{
            label: 'Skor IDM',
            data: {!! json_encode($chartData['scores']) !!},
            borderColor: '#667eea',
            backgroundColor: gradient,
            borderWidth: 4,
            fill: true,
            tension: 0.4,
            pointBackgroundColor: '#667eea',
            pointBorderColor: '#fff',
            pointBorderWidth: 3,
            pointRadius: 8,
            pointHoverRadius: 12
        }, {
            label: 'IKS (Indeks Ketahanan Sosial)',
            data: {!! json_encode($chartData['iks']) !!},
            borderColor: '#f093fb',
            backgroundColor: 'rgba(240, 147, 251, 0.1)',
            borderWidth: 3,
            fill: false,
            tension: 0.4,
            pointBackgroundColor: '#f093fb',
            pointBorderColor: '#fff',
            pointBorderWidth: 2,
            pointRadius: 6
        }, {
            label: 'IKE (Indeks Ketahanan Ekonomi)',
            data: {!! json_encode($chartData['ike']) !!},
            borderColor: '#43e97b',
            backgroundColor: 'rgba(67, 233, 123, 0.1)',
            borderWidth: 3,
            fill: false,
            tension: 0.4,
            pointBackgroundColor: '#43e97b',
            pointBorderColor: '#fff',
            pointBorderWidth: 2,
            pointRadius: 6
        }, {
            label: 'IKL (Indeks Ketahanan Lingkungan)',
            data: {!! json_encode($chartData['ikl']) !!},
            borderColor: '#38f9d7',
            backgroundColor: 'rgba(56, 249, 215, 0.1)',
            borderWidth: 3,
            fill: false,
            tension: 0.4,
            pointBackgroundColor: '#38f9d7',
            pointBorderColor: '#fff',
            pointBorderWidth: 2,
            pointRadius: 6
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        layout: {
            padding: {
                top: 20,
                bottom: 10,
                left: 10,
                right: 10
            }
        },
        plugins: {
            legend: {
                position: 'top',
                align: 'center',
                labels: {
                    usePointStyle: true,
                    padding: 25,
                    font: {
                        size: 14,
                        weight: '600',
                        family: 'system-ui, -apple-system, sans-serif'
                    },
                    boxWidth: 12,
                    boxHeight: 12
                }
            },
            tooltip: {
                backgroundColor: 'rgba(0,0,0,0.9)',
                titleColor: 'white',
                bodyColor: 'white',
                borderColor: '#667eea',
                borderWidth: 2,
                cornerRadius: 12,
                displayColors: true,
                padding: 12,
                titleFont: {
                    size: 14,
                    weight: 'bold'
                },
                bodyFont: {
                    size: 13
                },
                callbacks: {
                    label: function(context) {
                        return context.dataset.label + ': ' + context.parsed.y.toFixed(4);
                    }
                }
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                max: 1,
                grid: {
                    color: 'rgba(102, 126, 234, 0.1)',
                    lineWidth: 1,
                    drawBorder: true
                },
                border: {
                    color: '#e9ecef',
                    width: 1
                },
                ticks: {
                    font: {
                        size: 12,
                        weight: '500',
                        family: 'system-ui, -apple-system, sans-serif'
                    },
                    color: '#6c757d',
                    padding: 10,
                    callback: function(value) {
                        return value.toFixed(2);
                    }
                }
            },
            x: {
                grid: {
                    color: 'rgba(102, 126, 234, 0.1)',
                    lineWidth: 1,
                    drawBorder: true
                },
                border: {
                    color: '#e9ecef',
                    width: 1
                },
                ticks: {
                    font: {
                        size: 12,
                        weight: '600',
                        family: 'system-ui, -apple-system, sans-serif'
                    },
                    color: '#495057',
                    padding: 10
                }
            }
        },
        elements: {
            point: {
                radius: 6,
                hoverRadius: 10,
                hoverBorderWidth: 3,
                borderWidth: 2
            },
            line: {
                tension: 0.4,
                borderWidth: 3
            }
        },
        interaction: {
            intersect: false,
            mode: 'index'
        },
        animation: {
            duration: 2000,
            easing: 'easeInOutQuart',
            delay: (context) => {
                return context.datasetIndex * 200 + context.dataIndex * 50;
            }
        }
    }
});
</script>
@endif

<script>
// Simple smooth scroll for better UX
document.addEventListener('DOMContentLoaded', function() {
    // Add any general page initialization here if needed
});
</script>

@endsection
