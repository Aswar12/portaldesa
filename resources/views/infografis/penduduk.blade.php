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

/* Responsive */
@media (max-width: 768px) {
    .hero-section { padding: 60px 0; }
    .nav-pills { flex-direction: column; align-items: center; }
    .nav-pill { width: 100%; justify-content: center; margin: 5px 0; }
    .stats-grid { grid-template-columns: 1fr; }
    .stats-value { font-size: 2rem; }
    .section-title h3 { font-size: 1.5rem; }
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
            <a href="{{ route('infografis.penduduk') }}" class="nav-pill active">
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
            <a href="{{ route('idm.index') }}" class="nav-pill">
                <i class="fas fa-chart-line"></i>IDM
            </a>
            <a href="{{ route('infografis.sdgs') }}" class="nav-pill">
                <i class="fas fa-globe"></i>SDGs
            </a>
        </div>
    </div>

    <!-- Penduduk Header -->
    <div class="text-center mb-5">
        <h2 class="display-4 fw-bold text-primary mb-4">DATA PENDUDUK</h2>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <p class="lead" style="font-size: 1.2rem; line-height: 1.8; color: #6c757d;">
                    Statistik dan demografi penduduk desa berdasarkan data terkini dari 
                    <strong>Badan Pusat Statistik</strong> dan <strong>Catatan Sipil Desa</strong>.
                </p>
            </div>
        </div>
    </div>

    <!-- Main Stats Grid -->
    <div class="stats-grid">
        <div class="stats-card featured">
            <div class="stats-label">Total Penduduk</div>
            <div class="stats-value">{{ number_format($totalPenduduk) }}</div>
            <div class="stats-description">Jumlah total penduduk</div>
        </div>

        <div class="stats-card">
            <div class="stats-label">Laki-Laki</div>
            <div class="stats-value">{{ number_format($lakiLaki) }}</div>
            <div class="stats-description">{{ $totalPenduduk > 0 ? number_format(($lakiLaki/$totalPenduduk)*100, 1) : 0 }}% dari total penduduk</div>
        </div>

        <div class="stats-card">
            <div class="stats-label">Perempuan</div>
            <div class="stats-value">{{ number_format($perempuan) }}</div>
            <div class="stats-description">{{ $totalPenduduk > 0 ? number_format(($perempuan/$totalPenduduk)*100, 1) : 0 }}% dari total penduduk</div>
        </div>

        <div class="stats-card">
            <div class="stats-label">Kepala Keluarga</div>
            <div class="stats-value">{{ number_format(ceil($totalPenduduk / 4)) }}</div>
            <div class="stats-description">Jumlah kepala keluarga</div>
        </div>

        <div class="stats-card">
            <div class="stats-label">Bayi (0-1 th)</div>
            <div class="stats-value">{{ number_format($bayi) }}</div>
            <div class="stats-description">Bayi usia 0-1 tahun</div>
        </div>

        <div class="stats-card">
            <div class="stats-label">Balita (1-4 th)</div>
            <div class="stats-value">{{ number_format($balita) }}</div>
            <div class="stats-description">Balita usia 1-4 tahun</div>
        </div>

        <div class="stats-card">
            <div class="stats-label">Anak (5-17 th)</div>
            <div class="stats-value">{{ number_format($anakAnak) }}</div>
            <div class="stats-description">Anak usia 5-17 tahun</div>
        </div>

        <div class="stats-card">
            <div class="stats-label">Dewasa (18-59 th)</div>
            <div class="stats-value">{{ number_format($dewasa) }}</div>
            <div class="stats-description">Dewasa usia 18-59 tahun</div>
        </div>

        <div class="stats-card">
            <div class="stats-label">Lansia (60+ th)</div>
            <div class="stats-value">{{ number_format($lansia) }}</div>
            <div class="stats-description">Lansia usia 60+ tahun</div>
        </div>
    </div>

    <!-- Chart Sections -->
    <div class="row">
        <!-- Gender Composition Chart -->
        <div class="col-lg-6 mb-4">
            <div class="chart-section">
                <div class="section-title">
                    <h3><i class="fas fa-chart-pie me-3 text-primary"></i>Komposisi Jenis Kelamin</h3>
                    <p class="subtitle">Perbandingan penduduk berdasarkan jenis kelamin</p>
                </div>
                <div style="position: relative; height: 300px; width: 100%;">
                    <canvas id="genderChart"></canvas>
                </div>
                <div class="mt-3">
                    <div class="row text-center">
                        <div class="col-6">
                            <div class="p-3 rounded" style="background: rgba(102, 126, 234, 0.1); border: 2px solid #667eea;">
                                <div class="h4 fw-bold text-primary">{{ number_format($lakiLaki) }}</div>
                                <div class="small text-muted">Laki-laki</div>
                                <div class="small fw-bold" style="color: #667eea;">{{ $totalPenduduk > 0 ? number_format(($lakiLaki/$totalPenduduk)*100, 1) : 0 }}%</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-3 rounded" style="background: rgba(240, 147, 251, 0.1); border: 2px solid #f093fb;">
                                <div class="h4 fw-bold" style="color: #f093fb;">{{ number_format($perempuan) }}</div>
                                <div class="small text-muted">Perempuan</div>
                                <div class="small fw-bold" style="color: #f093fb;">{{ $totalPenduduk > 0 ? number_format(($perempuan/$totalPenduduk)*100, 1) : 0 }}%</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Age Composition Chart -->
        <div class="col-lg-6 mb-4">
            <div class="chart-section">
                <div class="section-title">
                    <h3><i class="fas fa-chart-bar me-3 text-success"></i>Komposisi Usia</h3>
                    <p class="subtitle">Distribusi penduduk berdasarkan kelompok usia</p>
                </div>
                <div style="position: relative; height: 300px; width: 100%;">
                    <canvas id="ageChart"></canvas>
                </div>
                <div class="mt-3">
                    <div class="row text-center">
                        <div class="col">
                            <div class="p-2 rounded mb-2" style="background: rgba(67, 233, 123, 0.1); border-left: 3px solid #43e97b;">
                                <div class="h6 fw-bold mb-1" style="color: #43e97b;">{{ number_format($bayi) }}</div>
                                <div class="small text-muted">Bayi (0-1 th)</div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="p-2 rounded mb-2" style="background: rgba(56, 249, 215, 0.1); border-left: 3px solid #38f9d7;">
                                <div class="h6 fw-bold mb-1" style="color: #38f9d7;">{{ number_format($balita) }}</div>
                                <div class="small text-muted">Balita (1-4 th)</div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="p-2 rounded mb-2" style="background: rgba(102, 126, 234, 0.1); border-left: 3px solid #667eea;">
                                <div class="h6 fw-bold mb-1" style="color: #667eea;">{{ number_format($anakAnak) }}</div>
                                <div class="small text-muted">Anak (5-17 th)</div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="p-2 rounded mb-2" style="background: rgba(240, 147, 251, 0.1); border-left: 3px solid #f093fb;">
                                <div class="h6 fw-bold mb-1" style="color: #f093fb;">{{ number_format($dewasa) }}</div>
                                <div class="small text-muted">Dewasa (18-59 th)</div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="p-2 rounded mb-2" style="background: rgba(250, 112, 154, 0.1); border-left: 3px solid #fa709a;">
                                <div class="h6 fw-bold mb-1" style="color: #fa709a;">{{ number_format($lansia) }}</div>
                                <div class="small text-muted">Lansia (60+ th)</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- RT Distribution Chart -->
    <div class="row">
        <div class="col-12">
            <div class="chart-section">
                <div class="section-title text-center">
                    <h3><i class="fas fa-map-marker-alt me-3 text-info"></i>Distribusi Penduduk Berdasarkan RT</h3>
                    <p class="subtitle">Sebaran penduduk laki-laki dan perempuan di setiap Rukun Tetangga (RT)</p>
                </div>

                <!-- Summary Cards RT -->
                <div class="row justify-content-center mb-4">
                    <div class="col-lg-8">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="card border-primary shadow-sm" style="border-width: 2px;">
                                    <div class="card-body text-center py-3">
                                        <h5 class="card-title fw-bold text-primary mb-1">{{ $rtChartData->count() }}</h5>
                                        <p class="card-text text-muted mb-0" style="font-size: 0.9rem;">Total RT</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card border-info shadow-sm" style="border-width: 2px;">
                                    <div class="card-body text-center py-3">
                                        <h5 class="card-title fw-bold text-info mb-1">{{ number_format($rtChartData->sum('laki_laki')) }}</h5>
                                        <p class="card-text text-muted mb-0" style="font-size: 0.9rem;">Laki-laki</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card border-danger shadow-sm" style="border-width: 2px;">
                                    <div class="card-body text-center py-3">
                                        <h5 class="card-title fw-bold text-danger mb-1">{{ number_format($rtChartData->sum('perempuan')) }}</h5>
                                        <p class="card-text text-muted mb-0" style="font-size: 0.9rem;">Perempuan</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Single Bar Chart for All RTs -->
                <div class="row">
                    <div class="col-12">
                        <div class="card shadow-sm">
                            <div class="card-header text-center" style="background: linear-gradient(135deg, #17a2b8, #138496); color: white;">
                                <h5 class="mb-0">
                                    <i class="fas fa-chart-bar me-2"></i>Grafik Distribusi Penduduk per RT
                                </h5>
                                <small class="opacity-90">Data perbandingan laki-laki dan perempuan di setiap RT</small>
                            </div>
                            <div class="card-body p-4">
                                @if($rtChartData->isEmpty())
                                    <div class="text-center py-5">
                                        <div class="alert alert-info" role="alert">
                                            <i class="fas fa-info-circle me-2"></i>
                                            <strong>Belum ada data RT yang tersedia</strong><br>
                                            Data akan ditampilkan setelah ada informasi alamat RT di database.
                                        </div>
                                    </div>
                                @else
                                    <div style="position: relative; height: 400px;">
                                        <canvas id="rtBarChart"></canvas>
                                    </div>
                                    
                                    <!-- Legend untuk RT Chart -->
                                    <div class="row justify-content-center mt-4">
                                        <div class="col-lg-6">
                                            <div class="d-flex justify-content-center align-items-center gap-4">
                                                <div class="d-flex align-items-center">
                                                    <div style="width: 20px; height: 20px; background: rgba(52, 144, 220, 0.8); border-radius: 3px; margin-right: 8px;"></div>
                                                    <span class="fw-bold text-primary">👨 Laki-laki</span>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <div style="width: 20px; height: 20px; background: rgba(231, 81, 90, 0.8); border-radius: 3px; margin-right: 8px;"></div>
                                                    <span class="fw-bold text-danger">👩 Perempuan</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Data Table for detailed numbers -->
                                    <div class="row mt-4">
                                        <div class="col-12">
                                            <div class="table-responsive">
                                                <table class="table table-hover table-sm">
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th class="text-center fw-bold">RT</th>
                                                            <th class="text-center fw-bold text-primary">👨 Laki-laki</th>
                                                            <th class="text-center fw-bold text-danger">👩 Perempuan</th>
                                                            <th class="text-center fw-bold text-success">👥 Total</th>
                                                            <th class="text-center fw-bold">Persentase</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($rtChartData as $rt => $data)
                                                        <tr>
                                                            <td class="text-center fw-bold">{{ $rt }}</td>
                                                            <td class="text-center text-primary">{{ number_format($data['laki_laki']) }}</td>
                                                            <td class="text-center text-danger">{{ number_format($data['perempuan']) }}</td>
                                                            <td class="text-center fw-bold text-success">{{ number_format($data['total']) }}</td>
                                                            <td class="text-center">
                                                                <div class="progress" style="height: 20px;">
                                                                    <div class="progress-bar bg-info" role="progressbar" 
                                                                         style="width: {{ $rtChartData->sum('total') > 0 ? round(($data['total'] / $rtChartData->sum('total')) * 100, 1) : 0 }}%">
                                                                        {{ $rtChartData->sum('total') > 0 ? round(($data['total'] / $rtChartData->sum('total')) * 100, 1) : 0 }}%
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot class="table-dark">
                                                        <tr>
                                                            <th class="text-center">TOTAL</th>
                                                            <th class="text-center text-info">{{ number_format($rtChartData->sum('laki_laki')) }}</th>
                                                            <th class="text-center" style="color: #dc3545;">{{ number_format($rtChartData->sum('perempuan')) }}</th>
                                                            <th class="text-center text-success">{{ number_format($rtChartData->sum('total')) }}</th>
                                                            <th class="text-center">100%</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Job/Profession Chart -->
    <div class="row">
        <div class="col-12">
            <div class="chart-section">
                <div class="section-title text-center">
                    <h3><i class="fas fa-briefcase me-3 text-warning"></i>Komposisi Pekerjaan</h3>
                    <p class="subtitle">Data lengkap pekerjaan penduduk yang bekerja di desa</p>
                    
                    <!-- Info Cards -->
                    <div class="row justify-content-center mb-4">
                        <div class="col-lg-9">
                            <div class="row g-3">
                                <!-- Total Penduduk Card -->
                                <div class="col-md-4">
                                    <div class="card border-dark shadow-sm" style="border-width: 2px;">
                                        <div class="card-body text-center py-3">
                                            <h5 class="card-title fw-bold text-dark mb-1">{{ number_format($totalPenduduk) }}</h5>
                                            <p class="card-text text-muted mb-0" style="font-size: 0.9rem;">Total Penduduk</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Penduduk Bekerja Card -->
                                <div class="col-md-4">
                                    <div class="card border-success shadow-sm" style="border-width: 2px;">
                                        <div class="card-body text-center py-3">
                                            <h5 class="card-title fw-bold text-success mb-1">{{ number_format($pekerjaanData->sum('jumlah')) }}</h5>
                                            <p class="card-text text-muted mb-0" style="font-size: 0.9rem;">Penduduk Bekerja</p>
                                            <small class="text-muted" style="font-size: 0.8rem;">
                                                ({{ $totalPenduduk > 0 ? number_format(($pekerjaanData->sum('jumlah')/$totalPenduduk)*100, 1) : 0 }}%)
                                            </small>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Belum/Tidak Bekerja Card -->
                                <div class="col-md-4">
                                    <div class="card border-warning shadow-sm" style="border-width: 2px;">
                                        <div class="card-body text-center py-3">
                                            <h5 class="card-title fw-bold text-warning mb-1">{{ number_format($totalPenduduk - $pekerjaanData->sum('jumlah')) }}</h5>
                                            <p class="card-text text-muted mb-0" style="font-size: 0.9rem;">Belum/Tidak Bekerja</p>
                                            <small class="text-muted" style="font-size: 0.8rem;">
                                                ({{ $totalPenduduk > 0 ? number_format((($totalPenduduk - $pekerjaanData->sum('jumlah'))/$totalPenduduk)*100, 1) : 0 }}%)
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Additional Info -->
                            <div class="row justify-content-center mt-3">
                                <div class="col-md-10">
                                    <div class="card border-secondary" style="border-width: 1px;">
                                        <div class="card-body py-2">
                                            <small class="text-muted text-center d-block">
                                                <i class="fas fa-info-circle me-1"></i>
                                                <strong>Kategori Belum/Tidak Bekerja:</strong> Anak-anak, pelajar, ibu rumah tangga, lansia, pengangguran
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h5 class="text-center mb-4 text-warning"><i class="fas fa-chart-bar me-2"></i>Detail Komposisi Pekerjaan</h5>
                </div>
                
                <!-- Main Content: Chart and Table -->
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header bg-warning text-white text-center">
                                <h6 class="mb-0"><i class="fas fa-chart-bar me-2"></i>Grafik Komposisi Pekerjaan</h6>
                            </div>
                            <div class="card-body">
                                <div style="position: relative; height: 500px; width: 100%;">
                                    <canvas id="jobChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <!-- Detailed Job Table -->
                        <div class="card">
                            <div class="card-header bg-info text-white text-center">
                                <h6 class="mb-0"><i class="fas fa-table me-2"></i>Tabel Detail Data</h6>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive" style="max-height: 500px; overflow-y: auto;">
                                    <table class="table table-striped table-hover mb-0">
                                        <thead class="table-info sticky-top">
                                            <tr>
                                                <th scope="col" class="text-center" style="font-size: 14px;">No</th>
                                                <th scope="col" style="font-size: 14px;">Pekerjaan</th>
                                                <th scope="col" class="text-center" style="font-size: 14px;">Jumlah</th>
                                                <th scope="col" class="text-center" style="font-size: 14px;">%</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($pekerjaanData as $index => $pekerjaan)
                                            <tr>
                                                <td class="text-center fw-bold" style="font-size: 13px;">{{ $index + 1 }}</td>
                                                <td style="font-size: 13px;">
                                                    <i class="fas fa-briefcase me-1 text-warning"></i>{{ $pekerjaan->pekerjaan ?: 'Tidak Diketahui' }}
                                                </td>
                                                <td class="text-center">
                                                    <span class="badge bg-primary" style="font-size: 12px;">{{ number_format($pekerjaan->jumlah) }}</span>
                                                </td>
                                                <td class="text-center">
                                                    <span class="fw-bold text-warning" style="font-size: 12px;">{{ $pekerjaanData->sum('jumlah') > 0 ? number_format(($pekerjaan->jumlah/$pekerjaanData->sum('jumlah'))*100, 1) : 0 }}%</span>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @if($pekerjaanData->isEmpty())
                                            <tr>
                                                <td colspan="4" class="text-center text-muted py-3">
                                                    <small><i class="fas fa-info-circle me-2"></i>Tidak ada data pekerjaan</small>
                                                </td>
                                            </tr>
                                            @endif
                                        </tbody>
                                        <tfoot class="table-light sticky-bottom">
                                            <tr>
                                                <th colspan="2" class="text-end"><small style="font-size: 13px;">Total:</small></th>
                                                <th class="text-center">
                                                    <span class="badge bg-success" style="font-size: 12px;">{{ number_format($pekerjaanData->sum('jumlah')) }}</span>
                                                </th>
                                                <th class="text-center"><small class="fw-bold text-success" style="font-size: 12px;">100%</small></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Summary Statistics Chart -->
    <div class="row">
        <div class="col-12">
            <div class="chart-section">
                <div class="section-title">
                    <h3><i class="fas fa-chart-area me-3 text-info"></i>Ringkasan Demografis</h3>
                    <p class="subtitle">Visualisasi komprehensif data demografis penduduk</p>
                </div>
                <div class="row">
                    <div class="col-lg-8">
                        <div style="position: relative; height: 350px; width: 100%;">
                            <canvas id="summaryChart"></canvas>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="h5 mb-4 text-center">Statistik Kunci</div>
                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center p-3 rounded" style="background: linear-gradient(45deg, #667eea, #764ba2); color: white;">
                                <div>
                                    <div class="h6 mb-1">Rasio Jenis Kelamin</div>
                                    <small>Laki-laki : Perempuan</small>
                                </div>
                                <div class="h4 fw-bold">
                                    {{ $perempuan > 0 ? number_format($lakiLaki / $perempuan * 100, 0) : 0 }} : 100
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center p-3 rounded" style="background: linear-gradient(45deg, #43e97b, #38f9d7); color: white;">
                                <div>
                                    <div class="h6 mb-1">Usia Produktif</div>
                                    <small>(18-59 tahun)</small>
                                </div>
                                <div class="h4 fw-bold">
                                    {{ $totalPenduduk > 0 ? number_format(($dewasa/$totalPenduduk)*100, 1) : 0 }}%
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center p-3 rounded" style="background: linear-gradient(45deg, #fa709a, #f093fb); color: white;">
                                <div>
                                    <div class="h6 mb-1">Dependency Ratio</div>
                                    <small>Beban tanggungan</small>
                                </div>
                                <div class="h4 fw-bold">
                                    {{ $dewasa > 0 ? number_format((($bayi + $balita + $anakAnak + $lansia)/$dewasa)*100, 0) : 0 }}%
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.3.0/dist/chart.umd.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.2.0/dist/chartjs-plugin-datalabels.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Register datalabels plugin globally
    Chart.register(ChartDataLabels);
    
    // Set datalabels to be disabled by default
    Chart.defaults.plugins.datalabels = {
        display: false
    };
    
    // Gender Chart
    const genderCtx = document.getElementById('genderChart');
    if (genderCtx) {
        const genderChart = new Chart(genderCtx, {
            type: 'doughnut',
            data: {
                labels: ['Laki-laki', 'Perempuan'],
                datasets: [{
                    data: [{{ $lakiLaki }}, {{ $perempuan }}],
                    backgroundColor: [
                        '#667eea',
                        '#f093fb'
                    ],
                    borderColor: [
                        '#667eea',
                        '#f093fb'
                    ],
                    borderWidth: 3,
                    hoverOffset: 10
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '40%',
                plugins: {
                    datalabels: {
                        display: false // Disable datalabels for this chart
                    },
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20,
                            font: {
                                size: 14,
                                weight: '600'
                            },
                            usePointStyle: true,
                            pointStyle: 'circle'
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0,0,0,0.8)',
                        titleColor: 'white',
                        bodyColor: 'white',
                        borderColor: '#667eea',
                        borderWidth: 2,
                        cornerRadius: 10,
                        callbacks: {
                            label: function(context) {
                                const total = {{ $totalPenduduk }};
                                const percentage = total > 0 ? ((context.parsed / total) * 100).toFixed(1) : 0;
                                return context.label + ': ' + context.parsed.toLocaleString() + ' (' + percentage + '%)';
                            }
                        }
                    }
                },
                animation: {
                    animateRotate: true,
                    animateScale: true,
                    duration: 2000
                }
            }
        });
    }

    // Age Chart
    const ageCtx = document.getElementById('ageChart');
    if (ageCtx) {
        const ageChart = new Chart(ageCtx, {
            type: 'bar',
            data: {
                labels: ['Bayi\n(0-1 th)', 'Balita\n(1-4 th)', 'Anak\n(5-17 th)', 'Dewasa\n(18-59 th)', 'Lansia\n(60+ th)'],
                datasets: [{
                    label: 'Jumlah Penduduk',
                    data: [{{ $bayi }}, {{ $balita }}, {{ $anakAnak }}, {{ $dewasa }}, {{ $lansia }}],
                    backgroundColor: [
                        '#43e97b',
                        '#38f9d7', 
                        '#667eea',
                        '#f093fb',
                        '#fa709a'
                    ],
                    borderColor: [
                        '#43e97b',
                        '#38f9d7',
                        '#667eea',
                        '#f093fb',
                        '#fa709a'
                    ],
                    borderWidth: 2,
                    borderRadius: 8,
                    borderSkipped: false,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    datalabels: {
                        display: false // Disable datalabels for age chart
                    },
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0,0,0,0.8)',
                        titleColor: 'white',
                        bodyColor: 'white',
                        borderColor: '#667eea',
                        borderWidth: 2,
                        cornerRadius: 10,
                        callbacks: {
                            label: function(context) {
                                const total = {{ $totalPenduduk }};
                                const percentage = total > 0 ? ((context.parsed.y / total) * 100).toFixed(1) : 0;
                                return 'Jumlah: ' + context.parsed.y.toLocaleString() + ' (' + percentage + '%)';
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0,0,0,0.1)',
                            lineWidth: 1
                        },
                        ticks: {
                            font: {
                                size: 12,
                                weight: '500'
                            },
                            color: '#666',
                            callback: function(value) {
                                return value.toLocaleString();
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: {
                                size: 11,
                                weight: '500'
                            },
                            color: '#666'
                        }
                    }
                },
                animation: {
                    duration: 2000,
                    easing: 'easeOutBounce'
                }
            }
        });
    }

    // RT Bar Chart (Single grouped bar chart for all RTs)
    @if(!$rtChartData->isEmpty())
    const rtCtx = document.getElementById('rtBarChart').getContext('2d');
    const rtData = @json($rtChartData);
    
    // Prepare data for grouped bar chart
    const rtLabels = Object.keys(rtData);
    const maleData = rtLabels.map(rt => rtData[rt].laki_laki);
    const femaleData = rtLabels.map(rt => rtData[rt].perempuan);
    
    const rtBarChart = new Chart(rtCtx, {
        type: 'bar',
        data: {
            labels: rtLabels,
            datasets: [
                {
                    label: '👨 Laki-laki',
                    data: maleData,
                    backgroundColor: 'rgba(52, 144, 220, 0.8)',
                    borderColor: 'rgba(52, 144, 220, 1)',
                    borderWidth: 1,
                    borderRadius: 4,
                    borderSkipped: false,
                },
                {
                    label: '👩 Perempuan',
                    data: femaleData,
                    backgroundColor: 'rgba(231, 81, 90, 0.8)',
                    borderColor: 'rgba(231, 81, 90, 1)',
                    borderWidth: 1,
                    borderRadius: 4,
                    borderSkipped: false,
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                title: {
                    display: false
                },
                legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        usePointStyle: true,
                        font: {
                            size: 12,
                            weight: 'bold'
                        },
                        padding: 20
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    titleColor: 'white',
                    bodyColor: 'white',
                    borderColor: 'rgba(255, 255, 255, 0.2)',
                    borderWidth: 1,
                    cornerRadius: 8,
                    callbacks: {
                        title: function(context) {
                            return context[0].label;
                        },
                        label: function(context) {
                            const total = maleData[context.dataIndex] + femaleData[context.dataIndex];
                            const percentage = total > 0 ? ((context.parsed.y / total) * 100).toFixed(1) : 0;
                            return context.dataset.label + ': ' + context.parsed.y.toLocaleString() + ' (' + percentage + '%)';
                        },
                        afterBody: function(context) {
                            const index = context[0].dataIndex;
                            const total = maleData[index] + femaleData[index];
                            return ['', 'Total: ' + total.toLocaleString() + ' orang'];
                        }
                    }
                }
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Rukun Tetangga (RT)',
                        font: {
                            size: 14,
                            weight: 'bold'
                        }
                    },
                    grid: {
                        display: false
                    },
                    ticks: {
                        font: {
                            size: 11,
                            weight: 'bold'
                        }
                    }
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Jumlah Penduduk',
                        font: {
                            size: 14,
                            weight: 'bold'
                        }
                    },
                    grid: {
                        color: 'rgba(0, 0, 0, 0.1)',
                        drawBorder: false
                    },
                    ticks: {
                        font: {
                            size: 11
                        },
                        callback: function(value) {
                            return value.toLocaleString();
                        }
                    }
                }
            },
            interaction: {
                intersect: false,
                mode: 'index'
            },
            animation: {
                duration: 1000,
                easing: 'easeInOutQuart'
            }
        }
    });
    @endif

    // Job Chart
    const jobCtx = document.getElementById('jobChart');
    if (jobCtx) {
        const jobData = [
            @foreach($pekerjaanData->take(10) as $pekerjaan)
            {
                label: '{{ $pekerjaan->pekerjaan ?: "Tidak Diketahui" }}',
                value: {{ $pekerjaan->jumlah }}
            },
            @endforeach
        ];

        const jobChart = new Chart(jobCtx, {
            type: 'bar',
            data: {
                labels: jobData.map(item => item.label),
                datasets: [{
                    label: 'Jumlah Orang',
                    data: jobData.map(item => item.value),
                    backgroundColor: [
                        '#ff6b6b', '#4ecdc4', '#45b7d1', '#f39c12', '#9b59b6',
                        '#2ecc71', '#e74c3c', '#3498db', '#f1c40f', '#8e44ad'
                    ],
                    borderColor: [
                        '#ff6b6b', '#4ecdc4', '#45b7d1', '#f39c12', '#9b59b6',
                        '#2ecc71', '#e74c3c', '#3498db', '#f1c40f', '#8e44ad'
                    ],
                    borderWidth: 2,
                    borderRadius: 6
                }]
            },
            plugins: [ChartDataLabels], // Enable datalabels plugin only for this chart
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        right: 100 // Ruang untuk label di sisi kanan
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0,0,0,0.8)',
                        titleColor: 'white',
                        bodyColor: 'white',
                        borderColor: '#667eea',
                        borderWidth: 2,
                        cornerRadius: 10,
                        callbacks: {
                            label: function(context) {
                                const total = {{ $pekerjaanData->sum('jumlah') }};
                                const percentage = total > 0 ? ((context.parsed.x / total) * 100).toFixed(1) : 0;
                                return 'Jumlah: ' + context.parsed.x.toLocaleString() + ' orang (' + percentage + '%)';
                            }
                        }
                    },
                    datalabels: {
                        anchor: 'end',
                        align: 'right',
                        color: '#333',
                        font: {
                            size: 12,
                            weight: 'bold'
                        },
                        formatter: function(value, context) {
                            return value.toLocaleString() + ' orang';
                        },
                        backgroundColor: 'rgba(255,255,255,0.9)',
                        borderColor: '#ddd',
                        borderRadius: 6,
                        borderWidth: 1,
                        padding: {
                            top: 4,
                            bottom: 4,
                            left: 8,
                            right: 8
                        }
                    }
                },
                scales: {
                    x: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0,0,0,0.1)',
                            lineWidth: 1
                        },
                        ticks: {
                            font: {
                                size: 12,
                                weight: '500'
                            },
                            color: '#666',
                            callback: function(value) {
                                return value.toLocaleString();
                            }
                        }
                    },
                    y: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: {
                                size: 11,
                                weight: '500'
                            },
                            color: '#666',
                            maxTicksLimit: 10
                        }
                    }
                },
                animation: {
                    duration: 2000,
                    easing: 'easeOutCubic'
                }
            }
        });
    }

    // Summary Chart (Radar/Line Chart)
    const summaryCtx = document.getElementById('summaryChart');
    if (summaryCtx) {
        const summaryChart = new Chart(summaryCtx, {
            type: 'radar',
            data: {
                labels: ['Laki-laki', 'Perempuan', 'Anak & Balita', 'Usia Produktif', 'Lansia', 'Total Penduduk'],
                datasets: [{
                    label: 'Distribusi Penduduk',
                    data: [
                        {{ $totalPenduduk > 0 ? round(($lakiLaki/$totalPenduduk)*100) : 0 }},
                        {{ $totalPenduduk > 0 ? round(($perempuan/$totalPenduduk)*100) : 0 }},
                        {{ $totalPenduduk > 0 ? round((($bayi + $balita + $anakAnak)/$totalPenduduk)*100) : 0 }},
                        {{ $totalPenduduk > 0 ? round(($dewasa/$totalPenduduk)*100) : 0 }},
                        {{ $totalPenduduk > 0 ? round(($lansia/$totalPenduduk)*100) : 0 }},
                        100
                    ],
                    backgroundColor: 'rgba(102, 126, 234, 0.2)',
                    borderColor: '#667eea',
                    borderWidth: 3,
                    pointBackgroundColor: '#667eea',
                    pointBorderColor: '#ffffff',
                    pointBorderWidth: 2,
                    pointRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    datalabels: {
                        display: false // Disable datalabels for summary radar chart
                    },
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0,0,0,0.8)',
                        titleColor: 'white',
                        bodyColor: 'white',
                        borderColor: '#667eea',
                        borderWidth: 2,
                        cornerRadius: 10,
                        callbacks: {
                            label: function(context) {
                                return context.label + ': ' + context.parsed.r + '%';
                            }
                        }
                    }
                },
                scales: {
                    r: {
                        beginAtZero: true,
                        max: 100,
                        ticks: {
                            stepSize: 20,
                            font: {
                                size: 11
                            },
                            color: '#666'
                        },
                        grid: {
                            color: 'rgba(0,0,0,0.1)'
                        },
                        angleLines: {
                            color: 'rgba(0,0,0,0.1)'
                        },
                        pointLabels: {
                            font: {
                                size: 12,
                                weight: '500'
                            },
                            color: '#333'
                        }
                    }
                },
                animation: {
                    duration: 2000,
                    easing: 'easeOutElastic'
                }
            }
        });
    }

    // Add some interactivity
    setTimeout(() => {
        const charts = document.querySelectorAll('.chart-section');
        charts.forEach(chart => {
            chart.style.opacity = '0';
            chart.style.transform = 'translateY(30px)';
            chart.style.transition = 'all 0.8s ease';
            
            setTimeout(() => {
                chart.style.opacity = '1';
                chart.style.transform = 'translateY(0)';
            }, 500);
        });
    }, 100);
});
</script>

@endsection
