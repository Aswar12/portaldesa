@extends('layouts.main')

@section('content')
<style>
.hero-section {
    background: linear-gradient(135deg, #6f42c1 0%, #e83e8c 100%);
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
    color: #6f42c1;
    background: #f3e8ff;
    border-color: #6f42c1;
    text-decoration: none;
    transform: translateY(-2px);
}

.nav-pill.active {
    background: linear-gradient(135deg, #6f42c1 0%, #e83e8c 100%);
    color: white;
    border-color: #6f42c1;
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
    background: linear-gradient(90deg, #6f42c1, #e83e8c);
}

.stats-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
}

.stats-card.featured {
    background: linear-gradient(135deg, #6f42c1 0%, #e83e8c 100%);
    color: white;
}

.stats-card.featured::before {
    background: rgba(255,255,255,0.3);
}

.stats-card.tercapai {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    color: white;
}

.stats-card.berjalan {
    background: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%);
    color: white;
}

.stats-card.belum {
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
.stats-card.tercapai .stats-label,
.stats-card.berjalan .stats-label,
.stats-card.belum .stats-label {
    color: rgba(255,255,255,0.8);
}

.stats-value {
    font-size: 2.5rem;
    font-weight: 900;
    margin: 15px 0;
    color: #2c3e50;
}

.stats-card.featured .stats-value,
.stats-card.tercapai .stats-value,
.stats-card.berjalan .stats-value,
.stats-card.belum .stats-value {
    color: white;
}

.stats-description {
    font-size: 0.9rem;
    color: #6c757d;
    line-height: 1.5;
}

.stats-card.featured .stats-description,
.stats-card.tercapai .stats-description,
.stats-card.berjalan .stats-description,
.stats-card.belum .stats-description {
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

/* SDG Goals */
.sdg-goal {
    background: white;
    border-radius: 15px;
    padding: 20px;
    margin-bottom: 15px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
    border-left: 4px solid #6f42c1;
}

.sdg-goal:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.12);
}

.sdg-goal-header {
    display: flex;
    align-items: center;
    margin-bottom: 15px;
}

.sdg-goal-number {
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, #6f42c1 0%, #e83e8c 100%);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 900;
    font-size: 1.2rem;
    margin-right: 15px;
    flex-shrink: 0;
}

.sdg-goal-title {
    font-size: 1.1rem;
    font-weight: 700;
    color: #2c3e50;
    margin: 0;
    flex-grow: 1;
}

.sdg-goal-progress {
    margin-top: 15px;
}

.progress-label-sdg {
    display: flex;
    justify-content: space-between;
    margin-bottom: 8px;
    font-size: 0.9rem;
}

.progress-label-sdg .progress-text {
    color: #6c757d;
    font-weight: 600;
}

.progress-label-sdg .progress-percent {
    color: #2c3e50;
    font-weight: 700;
}

.progress {
    height: 10px;
    border-radius: 5px;
    background: #f8f9fa;
    overflow: hidden;
}

.progress-bar {
    border-radius: 5px;
    transition: width 1.5s ease-in-out;
}

.progress-bar-sdg {
    background: linear-gradient(90deg, #6f42c1, #e83e8c);
}

/* Progress indicator colors */
.progress-excellent { background: linear-gradient(90deg, #28a745, #20c997) !important; }
.progress-good { background: linear-gradient(90deg, #17a2b8, #138496) !important; }
.progress-fair { background: linear-gradient(90deg, #ffc107, #fd7e14) !important; }
.progress-poor { background: linear-gradient(90deg, #dc3545, #c82333) !important; }

/* Circle Progress */
.circle-progress {
    position: relative;
    width: 200px;
    height: 200px;
    margin: 0 auto 30px;
}

.circle-progress-inner {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
}

.circle-progress-value {
    font-size: 3rem;
    font-weight: 900;
    color: #6f42c1;
    line-height: 1;
}

.circle-progress-label {
    font-size: 0.9rem;
    color: #6c757d;
    text-transform: uppercase;
    font-weight: 600;
    letter-spacing: 1px;
}

/* Alert */
.alert-sdgs {
    background: linear-gradient(135deg, #f3e8ff 0%, #e8d5ff 100%);
    border: 1px solid #6f42c1;
    border-radius: 15px;
    padding: 20px;
    margin: 30px 0;
}

.alert-sdgs .alert-icon {
    color: #6f42c1;
    font-size: 1.5rem;
    margin-bottom: 10px;
}

.alert-sdgs .alert-title {
    color: #552c7e;
    font-weight: 700;
    margin-bottom: 10px;
}

.alert-sdgs .alert-text {
    color: #552c7e;
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
    
    .circle-progress {
        width: 150px;
        height: 150px;
    }
    
    .circle-progress-value {
        font-size: 2.5rem;
    }
}
</style>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-3 fw-bold mb-4">
                    <i class="fas fa-globe me-3"></i>
                    SDGs DESA
                </h1>
                <p class="lead mb-4" style="font-size: 1.3rem; line-height: 1.6;">
                    Capaian Sustainable Development Goals (SDGs) di tingkat desa
                </p>
                <div class="d-flex align-items-center">
                    <i class="fas fa-info-circle me-2"></i>
                    <span>Data pemantauan SDGs periode {{ date('Y') }}</span>
                </div>
            </div>
            <div class="col-lg-6 text-center">
                <div style="font-size: 8rem; opacity: 0.3;">
                    <i class="fas fa-leaf"></i>
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
            <a href="{{ route('infografis.bansos') }}" class="nav-pill">
                <i class="fas fa-hand-holding-heart"></i>Bansos
            </a>
            <a href="{{ route('idm.index') }}" class="nav-pill">
                <i class="fas fa-chart-line"></i>IDM
            </a>
            <a href="{{ route('infografis.sdgs') }}" class="nav-pill active">
                <i class="fas fa-globe"></i>SDGs
            </a>
        </div>
    </div>

    <!-- SDGs Header -->
    <div class="text-center mb-5">
        <h2 class="display-4 fw-bold mb-4" style="color: #6f42c1;">SUSTAINABLE DEVELOPMENT GOALS</h2>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <p class="lead" style="font-size: 1.2rem; line-height: 1.8; color: #6c757d;">
                    Pemantauan pencapaian 17 tujuan pembangunan berkelanjutan di tingkat desa sebagai 
                    kontribusi terhadap <strong>Agenda 2030</strong> global.
                </p>
            </div>
        </div>
    </div>

    <!-- Alert Info -->
    <div class="alert-sdgs">
        <div class="text-center">
            <i class="fas fa-globe-americas alert-icon"></i>
            <div class="alert-title h5">Capaian SDGs Desa</div>
            <p class="alert-text mb-0">
                Dari {{ number_format($totalIndikator) }} indikator SDGs, desa telah mencapai 
                <strong>{{ number_format($tercapai) }} indikator ({{ number_format(($tercapai/$totalIndikator)*100, 1) }}%)</strong> 
                dengan capaian keseluruhan <strong>{{ $persentaseCapaian }}%</strong>.
            </p>
        </div>
    </div>

    <!-- Main Stats Grid -->
    <div class="stats-grid">
        <div class="stats-card featured">
            <div class="stats-label">Total Indikator</div>
            <div class="stats-value">{{ number_format($totalIndikator) }}</div>
            <div class="stats-description">Indikator SDGs dipantau</div>
        </div>

        <div class="stats-card tercapai">
            <div class="stats-label">Tercapai</div>
            <div class="stats-value">{{ number_format($tercapai) }}</div>
            <div class="stats-description">{{ number_format(($tercapai/$totalIndikator)*100, 1) }}% dari total indikator</div>
        </div>

        <div class="stats-card berjalan">
            <div class="stats-label">Sedang Berjalan</div>
            <div class="stats-value">{{ number_format($sedangBerjalan) }}</div>
            <div class="stats-description">{{ number_format(($sedangBerjalan/$totalIndikator)*100, 1) }}% dari total indikator</div>
        </div>

        <div class="stats-card belum">
            <div class="stats-label">Belum Mulai</div>
            <div class="stats-value">{{ number_format($belumMulai) }}</div>
            <div class="stats-description">{{ number_format(($belumMulai/$totalIndikator)*100, 1) }}% dari total indikator</div>
        </div>
    </div>

    <!-- Overall Progress -->
    <div class="chart-container">
        <div class="chart-header">
            <h3 class="chart-title">Capaian Keseluruhan SDGs</h3>
            <p class="chart-subtitle">Persentase pencapaian tujuan pembangunan berkelanjutan</p>
        </div>

        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="circle-progress">
                    <div class="circle-progress-inner">
                        <div class="circle-progress-value">{{ $persentaseCapaian }}%</div>
                        <div class="circle-progress-label">Capaian SDGs</div>
                    </div>
                </div>
                <div class="text-center">
                    @if($persentaseCapaian >= 75)
                        <div class="h5 text-success mb-2">
                            <i class="fas fa-check-circle me-2"></i>Capaian Sangat Baik
                        </div>
                        <p class="text-muted mb-0">Desa menunjukkan komitmen tinggi terhadap SDGs</p>
                    @elseif($persentaseCapaian >= 50)
                        <div class="h5 text-info mb-2">
                            <i class="fas fa-thumbs-up me-2"></i>Capaian Baik
                        </div>
                        <p class="text-muted mb-0">Desa dalam jalur yang tepat untuk mencapai SDGs</p>
                    @elseif($persentaseCapaian >= 25)
                        <div class="h5 text-warning mb-2">
                            <i class="fas fa-exclamation-triangle me-2"></i>Perlu Peningkatan
                        </div>
                        <p class="text-muted mb-0">Diperlukan upaya lebih intensif</p>
                    @else
                        <div class="h5 text-danger mb-2">
                            <i class="fas fa-times-circle me-2"></i>Perlu Perhatian Khusus
                        </div>
                        <p class="text-muted mb-0">Membutuhkan program terobosan</p>
                    @endif
                </div>
            </div>

            <div class="col-lg-6">
                <div class="row text-center">
                    <div class="col-6 mb-3">
                        <div class="p-3 rounded" style="background: #d4edda; border: 1px solid #c3e6cb;">
                            <div class="h4 fw-bold text-success mb-2">{{ number_format($tercapai) }}</div>
                            <div class="small text-success">Indikator Tercapai</div>
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <div class="p-3 rounded" style="background: #fff3cd; border: 1px solid #ffeaa7;">
                            <div class="h4 fw-bold text-warning mb-2">{{ number_format($sedangBerjalan) }}</div>
                            <div class="small text-warning">Sedang Berjalan</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="p-3 rounded" style="background: #f8d7da; border: 1px solid #f1b0b7;">
                            <div class="h4 fw-bold text-danger mb-2">{{ number_format($belumMulai) }}</div>
                            <div class="small text-danger">Belum Mulai</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="p-3 rounded" style="background: #e8d5ff; border: 1px solid #d1b3ff;">
                            <div class="h4 fw-bold" style="color: #6f42c1; margin-bottom: 8px;">{{ number_format($totalIndikator) }}</div>
                            <div class="small" style="color: #6f42c1;">Total Indikator</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- SDG Goals Progress -->
    <div class="chart-container">
        <div class="chart-header">
            <h3 class="chart-title">Capaian per Tujuan SDGs</h3>
            <p class="chart-subtitle">Progress pencapaian 17 tujuan pembangunan berkelanjutan</p>
        </div>

        <div class="row">
            @foreach($goals as $goal)
            <div class="col-lg-6">
                <div class="sdg-goal">
                    <div class="sdg-goal-header">
                        <div class="sdg-goal-number">{{ $goal['no'] }}</div>
                        <h5 class="sdg-goal-title">{{ $goal['nama'] }}</h5>
                    </div>
                    <div class="sdg-goal-progress">
                        <div class="progress-label-sdg">
                            <span class="progress-text">Capaian</span>
                            <span class="progress-percent">{{ $goal['persentase'] }}%</span>
                        </div>
                        <div class="progress">
                            @if($goal['persentase'] >= 80)
                                <div class="progress-bar progress-excellent" style="width: {{ $goal['persentase'] }}%"></div>
                            @elseif($goal['persentase'] >= 60)
                                <div class="progress-bar progress-good" style="width: {{ $goal['persentase'] }}%"></div>
                            @elseif($goal['persentase'] >= 40)
                                <div class="progress-bar progress-fair" style="width: {{ $goal['persentase'] }}%"></div>
                            @else
                                <div class="progress-bar progress-poor" style="width: {{ $goal['persentase'] }}%"></div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        @if(count($goals) < 17)
        <div class="text-center mt-4">
            <p class="text-muted">
                <i class="fas fa-info-circle me-2"></i>
                Menampilkan {{ count($goals) }} dari 17 tujuan SDGs. Data lengkap sedang dalam proses pengumpulan.
            </p>
        </div>
        @endif
    </div>

    <!-- SDGs Information -->
    <div class="row">
        <div class="col-lg-4">
            <div class="chart-container">
                <h4 style="color: #6f42c1; margin-bottom: 20px;">
                    <i class="fas fa-lightbulb me-2"></i>
                    Tentang SDGs
                </h4>
                <p class="text-muted" style="line-height: 1.6;">
                    Sustainable Development Goals (SDGs) adalah 17 tujuan global yang diadopsi oleh 
                    semua negara anggota PBB pada tahun 2015 untuk mengakhiri kemiskinan, melindungi 
                    planet, dan memastikan kemakmuran bagi semua pada tahun 2030.
                </p>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="chart-container">
                <h4 style="color: #28a745; margin-bottom: 20px;">
                    <i class="fas fa-target me-2"></i>
                    Fokus Utama
                </h4>
                <ul class="list-unstyled">
                    <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Pengentasan kemiskinan</li>
                    <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Pendidikan berkualitas</li>
                    <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Kesehatan yang baik</li>
                    <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Kelestarian lingkungan</li>
                    <li class="mb-0"><i class="fas fa-check-circle text-success me-2"></i>Kemitraan global</li>
                </ul>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="chart-container">
                <h4 style="color: #dc3545; margin-bottom: 20px;">
                    <i class="fas fa-flag me-2"></i>
                    Tantangan
                </h4>
                <ul class="list-unstyled">
                    <li class="mb-2"><i class="fas fa-exclamation-triangle text-warning me-2"></i>Keterbatasan data</li>
                    <li class="mb-2"><i class="fas fa-exclamation-triangle text-warning me-2"></i>Koordinasi antar sektor</li>
                    <li class="mb-2"><i class="fas fa-exclamation-triangle text-warning me-2"></i>Sumber daya terbatas</li>
                    <li class="mb-2"><i class="fas fa-exclamation-triangle text-warning me-2"></i>Kesadaran masyarakat</li>
                    <li class="mb-0"><i class="fas fa-exclamation-triangle text-warning me-2"></i>Monitoring berkala</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Call to Action -->
    <div class="chart-container">
        <div class="text-center">
            <h4 class="mb-4" style="color: #6f42c1;">
                <i class="fas fa-hands-helping me-2"></i>
                Mari Bersama Wujudkan SDGs
            </h4>
            <p class="text-muted mb-4">
                Pencapaian SDGs membutuhkan partisipasi semua pihak. Mari bersama-sama berkontribusi 
                untuk pembangunan berkelanjutan di desa kita.
            </p>
            <div class="row justify-content-center">
                <div class="col-md-3">
                    <div class="p-3 rounded" style="background: #f8f9fa;">
                        <i class="fas fa-users fa-2x mb-2" style="color: #6f42c1;"></i>
                        <h6>Partisipasi Aktif</h6>
                        <small class="text-muted">Libatkan masyarakat</small>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="p-3 rounded" style="background: #f8f9fa;">
                        <i class="fas fa-chart-line fa-2x mb-2" style="color: #6f42c1;"></i>
                        <h6>Monitoring Rutin</h6>
                        <small class="text-muted">Evaluasi berkala</small>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="p-3 rounded" style="background: #f8f9fa;">
                        <i class="fas fa-handshake fa-2x mb-2" style="color: #6f42c1;"></i>
                        <h6>Kemitraan</h6>
                        <small class="text-muted">Kolaborasi lintas sektor</small>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="p-3 rounded" style="background: #f8f9fa;">
                        <i class="fas fa-seedling fa-2x mb-2" style="color: #6f42c1;"></i>
                        <h6>Berkelanjutan</h6>
                        <small class="text-muted">Jangka panjang</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Extra spacing at bottom -->
<div class="py-5"></div>
@endsection
