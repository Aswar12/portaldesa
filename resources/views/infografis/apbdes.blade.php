@extends('layouts.main')

@section('content')
<style>
.hero-section {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    position: relative;
    overflow: hidden;
    padding: 80px 0;
    color: white;
    margin-top: 80px; /* Add top margin to account for fixed header */
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
    z-index: 100000; /* Higher than header z-index */
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

/* Budget Navigation */
.budget-nav {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 15px;
    margin: 40px 0;
}

.budget-nav-item {
    background: white;
    border: 2px solid #e9ecef;
    border-radius: 15px;
    padding: 15px 25px;
    text-decoration: none;
    color: #495057;
    font-weight: 600;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.budget-nav-item::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(102, 126, 234, 0.1), transparent);
    transition: left 0.5s;
}

.budget-nav-item:hover::before {
    left: 100%;
}

.budget-nav-item:hover {
    color: #667eea;
    border-color: #667eea;
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.2);
}

.budget-nav-item.active {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border-color: #667eea;
}

/* Stats Cards */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
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

.stats-card.income {
    background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
    color: white;
}

.stats-card.expense {
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    color: white;
}

.stats-card.financing {
    background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
    color: white;
}

.stats-label {
    font-size: 0.9rem;
    margin-bottom: 10px;
    text-transform: uppercase;
    font-weight: 600;
    letter-spacing: 1px;
    opacity: 0.9;
}

.stats-value {
    font-size: 2rem;
    font-weight: 900;
    margin: 15px 0;
}

.stats-description {
    font-size: 0.9rem;
    line-height: 1.5;
    opacity: 0.9;
}

/* Progress Bar */
.progress-container {
    background: rgba(255,255,255,0.2);
    border-radius: 10px;
    height: 20px;
    margin-top: 15px;
    overflow: hidden;
}

.progress-bar-custom {
    background: rgba(255,255,255,0.8);
    height: 100%;
    border-radius: 10px;
    transition: width 1s ease;
    position: relative;
}

.progress-bar-custom::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
    background: linear-gradient(45deg, transparent 33%, rgba(255,255,255,0.3) 33%, rgba(255,255,255,0.3) 66%, transparent 66%);
    background-size: 20px 20px;
    animation: shimmer 1s linear infinite;
}

@keyframes shimmer {
    0% { background-position: -20px 0; }
    100% { background-position: 20px 0; }
}

/* Chart Section */
.chart-section {
    background: white;
    border-radius: 20px;
    padding: 40px;
    margin: 40px 0;
    box-shadow: 0 15px 35px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.chart-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 5px;
    background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
    border-radius: 20px 20px 0 0;
}

.chart-section:hover {
    transform: translateY(-5px);
    box-shadow: 0 25px 45px rgba(0,0,0,0.12);
}

.section-title {
    text-align: center;
    margin-bottom: 40px;
    position: relative;
}

.section-title h3 {
    font-size: 1.8rem;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
}

.section-title .subtitle {
    color: #6c757d;
    font-size: 1rem;
    font-style: italic;
    margin: 0;
}

.chart-container {
    position: relative;
    height: 400px;
    margin: 20px 0;
    padding: 20px;
    background: #fafafa;
    border-radius: 15px;
    border: 2px solid #f0f0f0;
}

.chart-legend {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 20px;
    margin-top: 20px;
    padding-top: 20px;
    border-top: 2px solid #f0f0f0;
}

.legend-item {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 0.9rem;
    font-weight: 600;
}

.legend-color {
    width: 16px;
    height: 16px;
    border-radius: 50%;
    box-shadow: 0 2px 4px rgba(0,0,0,0.2);
}

.chart-stats {
    background: #f8f9fa;
    border-radius: 15px;
    padding: 20px;
    margin-top: 30px;
    border: 2px solid #e9ecef;
}

.chart-stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
}

.stat-item {
    text-align: center;
    padding: 15px;
    background: white;
    border-radius: 10px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    transition: all 0.3s ease;
}

.stat-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.stat-value {
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 5px;
}

.stat-label {
    font-size: 0.9rem;
    color: #6c757d;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.no-data-message {
    text-align: center;
    padding: 60px 20px;
    color: #999;
    font-size: 1.1rem;
    background: #f8f9fa;
    border-radius: 15px;
    border: 2px dashed #dee2e6;
}

.no-data-message i {
    font-size: 3rem;
    margin-bottom: 20px;
    color: #ccc;
}

/* Responsive */
@media (max-width: 768px) {
    .hero-section { padding: 60px 0; }
    .nav-pills, .budget-nav { flex-direction: column; align-items: center; }
    .nav-pill, .budget-nav-item { width: 100%; justify-content: center; margin: 5px 0; }
    .stats-grid { grid-template-columns: 1fr; }
    .stats-value { font-size: 1.5rem; }
    .section-title h3 { font-size: 1.5rem; }
    .chart-section { padding: 25px 15px; }
    .chart-container { height: 300px; }
    .chart-stats-grid { grid-template-columns: 1fr; }
}

/* Loading Animation */
.chart-loading {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 300px;
    flex-direction: column;
    color: #999;
}

.loading-spinner {
    width: 40px;
    height: 40px;
    border: 4px solid #f3f3f3;
    border-top: 4px solid #667eea;
    border-radius: 50%;
    animation: spin 1s linear infinite;
    margin-bottom: 15px;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.chart-section {
    animation: fadeInUp 0.6s ease-out;
}

.chart-section:nth-child(1) { animation-delay: 0.1s; }
.chart-section:nth-child(2) { animation-delay: 0.2s; }
.chart-section:nth-child(3) { animation-delay: 0.3s; }

/* Pulse animation for stats */
.stats-card {
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.02); }
    100% { transform: scale(1); }
}
</style>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container position-relative" style="z-index: 100001;">
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
            <a href="{{ route('infografis.apbdes') }}" class="nav-pill active">
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

    <!-- APBDes Header -->
    <div class="text-center mb-5">
        <h2 class="display-4 fw-bold text-primary mb-4">APBDes {{ $currentYear }}</h2>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <p class="lead" style="font-size: 1.2rem; line-height: 1.8; color: #6c757d;">
                    Anggaran Pendapatan dan Belanja Desa merupakan rencana keuangan tahunan 
                    yang menggambarkan estimasi <strong>Pendapatan</strong>, <strong>Belanja</strong>, 
                    dan <strong>Pembiayaan</strong> desa.
                </p>
            </div>
        </div>
    </div>

    <!-- Budget Navigation -->
    <div class="budget-nav">
        <a href="#" class="budget-nav-item active" data-tab="overview">
            <i class="fas fa-chart-pie me-2"></i>Overview
        </a>
        <a href="#" class="budget-nav-item" data-tab="pendapatan">
            <i class="fas fa-arrow-up me-2"></i>Pendapatan
        </a>
        <a href="#" class="budget-nav-item" data-tab="belanja">
            <i class="fas fa-arrow-down me-2"></i>Belanja
        </a>
        <a href="#" class="budget-nav-item" data-tab="pembiayaan">
            <i class="fas fa-balance-scale me-2"></i>Pembiayaan
        </a>
    </div>

    <!-- Main Stats Grid -->
    <div class="stats-grid">
        <div class="stats-card featured">
            <div class="stats-label">Total Anggaran</div>
            <div class="stats-value">Rp {{ number_format($totalAnggaran ?? 0, 0, ',', '.') }}</div>
            <div class="stats-description">Anggaran keseluruhan {{ $currentYear ?? date('Y') }}</div>
        </div>

        <div class="stats-card income">
            <div class="stats-label">Pendapatan</div>
            <div class="stats-value">Rp {{ number_format($totalPendapatan ?? 0, 0, ',', '.') }}</div>
            <div class="stats-description">
                {{ ($totalAnggaran ?? 0) > 0 ? number_format((($totalPendapatan ?? 0)/($totalAnggaran ?? 1))*100, 1) : 0 }}% dari total anggaran
            </div>
        </div>

        <div class="stats-card expense">
            <div class="stats-label">Belanja</div>
            <div class="stats-value">Rp {{ number_format($totalBelanja ?? 0, 0, ',', '.') }}</div>
            <div class="stats-description">
                {{ ($totalAnggaran ?? 0) > 0 ? number_format((($totalBelanja ?? 0)/($totalAnggaran ?? 1))*100, 1) : 0 }}% dari total anggaran
            </div>
        </div>

        <div class="stats-card financing">
            <div class="stats-label">Pembiayaan</div>
            <div class="stats-value">Rp {{ number_format($totalPembiayaan ?? 0, 0, ',', '.') }}</div>
            <div class="stats-description">
                {{ ($totalAnggaran ?? 0) > 0 ? number_format((($totalPembiayaan ?? 0)/($totalAnggaran ?? 1))*100, 1) : 0 }}% dari total anggaran
            </div>
        </div>

        <div class="stats-card">
            <div class="stats-label">Total Realisasi</div>
            <div class="stats-value">Rp {{ number_format($totalRealisasi ?? 0, 0, ',', '.') }}</div>
            <div class="stats-description">
                Realisasi {{ number_format($persentaseRealisasi ?? 0, 1) }}%
                <div class="progress-container">
                    <div class="progress-bar-custom" style="width: {{ min($persentaseRealisasi ?? 0, 100) }}%"></div>
                </div>
            </div>
        </div>

        <div class="stats-card">
            <div class="stats-label">Sisa Anggaran</div>
            <div class="stats-value">Rp {{ number_format($totalAnggaran - $totalRealisasi, 0, ',', '.') }}</div>
            <div class="stats-description">
                {{ number_format(100 - $persentaseRealisasi, 1) }}% belum terealisasi
            </div>
        </div>
    </div>

    <!-- Chart Sections -->
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="chart-section">
                <div class="section-title">
                    <h3><i class="fas fa-chart-pie"></i>Komposisi Anggaran</h3>
                    <p class="subtitle">Pembagian anggaran berdasarkan kategori</p>
                </div>
                <div class="chart-container">
                    <canvas id="budgetCompositionChart"></canvas>
                </div>
                <div class="chart-stats">
                    <div class="chart-stats-grid">
                        <div class="stat-item">
                            <div class="stat-value" style="color: #667eea;">{{ number_format((($totalPendapatan ?? 0)/($totalAnggaran ?? 1))*100, 1) }}%</div>
                            <div class="stat-label">Pendapatan</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value" style="color: #764ba2;">{{ number_format((($totalBelanja ?? 0)/($totalAnggaran ?? 1))*100, 1) }}%</div>
                            <div class="stat-label">Belanja</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value" style="color: #5a7fd8;">{{ number_format((($totalPembiayaan ?? 0)/($totalAnggaran ?? 1))*100, 1) }}%</div>
                            <div class="stat-label">Pembiayaan</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-6 mb-4">
            <div class="chart-section">
                <div class="section-title">
                    <h3><i class="fas fa-chart-bar"></i>Anggaran vs Realisasi</h3>
                    <p class="subtitle">Perbandingan target anggaran dengan realisasi</p>
                </div>
                <div class="chart-container">
                    <canvas id="realizationChart"></canvas>
                </div>
                <div class="chart-stats">
                    <div class="chart-stats-grid">
                        <div class="stat-item">
                            <div class="stat-value" style="color: #667eea;">Rp {{ number_format($totalAnggaran ?? 0, 0, ',', '.') }}</div>
                            <div class="stat-label">Total Anggaran</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value" style="color: #764ba2;">Rp {{ number_format($totalRealisasi ?? 0, 0, ',', '.') }}</div>
                            <div class="stat-label">Total Realisasi</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value" style="color: #5a7fd8;">{{ number_format($persentaseRealisasi ?? 0, 1) }}%</div>
                            <div class="stat-label">Persentase</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Historical Data Chart -->
    @if($historicalData->count() > 0)
    <div class="chart-section">
        <div class="section-title">
            <h3><i class="fas fa-chart-line"></i>Tren Anggaran 5 Tahun Terakhir</h3>
            <p class="subtitle">Perkembangan anggaran dan realisasi dari tahun ke tahun</p>
        </div>
        <div class="chart-container" style="height: 300px;">
            <canvas id="historicalChart"></canvas>
        </div>
        <div class="chart-legend">
            <div class="legend-item">
                <div class="legend-color" style="background: #667eea;"></div>
                <span>Anggaran</span>
            </div>
            <div class="legend-item">
                <div class="legend-color" style="background: #43e97b;"></div>
                <span>Realisasi</span>
            </div>
        </div>
    </div>
    @else
    <div class="chart-section">
        <div class="section-title">
            <h3><i class="fas fa-chart-line"></i>Tren Anggaran Historis</h3>
            <p class="subtitle">Data historis belum tersedia</p>
        </div>
        <div class="no-data-message">
            <i class="fas fa-chart-line"></i>
            <p>Data historis anggaran belum tersedia untuk menampilkan tren.</p>
            <small>Tambahkan data anggaran untuk tahun-tahun sebelumnya untuk melihat tren perkembangan.</small>
        </div>
    </div>
    @endif
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
<script>
// Memastikan halaman sudah dimuat sepenuhnya
document.addEventListener('DOMContentLoaded', function() {
    
    // Show loading state
    document.querySelectorAll('.chart-container').forEach(container => {
        container.innerHTML = `
            <div class="chart-loading">
                <div class="loading-spinner"></div>
                <p>Memuat grafik...</p>
            </div>
        `;
    });
    
    // Delay untuk efek loading
    setTimeout(function() {
        initializeCharts();
    }, 500);
    
    function initializeCharts() {
        // Restore canvas elements
        document.getElementById('budgetCompositionChart').parentElement.innerHTML = '<canvas id="budgetCompositionChart"></canvas>';
        document.getElementById('realizationChart').parentElement.innerHTML = '<canvas id="realizationChart"></canvas>';
        @if(isset($historicalData) && $historicalData->count() > 1)
        document.getElementById('historicalChart').parentElement.innerHTML = '<canvas id="historicalChart"></canvas>';
        @endif
        
        // Debug: Log data yang diterima
        console.log('Data APBDes:', {
            totalAnggaran: {{ $totalAnggaran ?? 0 }},
            totalRealisasi: {{ $totalRealisasi ?? 0 }},
            anggaranPendapatan: {{ $anggaranPendapatan ?? 0 }},
            anggaranBelanja: {{ $anggaranBelanja ?? 0 }},
            anggaranPembiayaan: {{ $anggaranPembiayaan ?? 0 }}
        });

        initBudgetCompositionChart();
        initRealizationChart();
        @if(isset($historicalData) && $historicalData->count() > 1)
        initHistoricalChart();
        @endif
    }

    function initBudgetCompositionChart() {

    function initBudgetCompositionChart() {
        // Budget Composition Chart
        const compositionCanvas = document.getElementById('budgetCompositionChart');
        if (compositionCanvas) {
            const compositionCtx = compositionCanvas.getContext('2d');
            
            // Check if there's data to display
            const pendapatanValue = {{ $totalPendapatan ?? 0 }};
            const belanjaValue = {{ $totalBelanja ?? 0 }};
            const pembiayaanValue = {{ $totalPembiayaan ?? 0 }};
            
            if (pendapatanValue > 0 || belanjaValue > 0 || pembiayaanValue > 0) {
                // Create gradient colors
                const gradient1 = compositionCtx.createRadialGradient(0, 0, 0, 0, 0, 200);
                gradient1.addColorStop(0, '#43e97b');
                gradient1.addColorStop(1, '#38d16a');

                const gradient2 = compositionCtx.createRadialGradient(0, 0, 0, 0, 0, 200);
                gradient2.addColorStop(0, '#f093fb');
                gradient2.addColorStop(1, '#d678e8');

                const gradient3 = compositionCtx.createRadialGradient(0, 0, 0, 0, 0, 200);
                gradient3.addColorStop(0, '#fa709a');
                gradient3.addColorStop(1, '#e85d87');

                const compositionChart = new Chart(compositionCtx, {
                    type: 'doughnut',
                    data: {
                        labels: ['Pendapatan', 'Belanja', 'Pembiayaan'],
                        datasets: [{
                            data: [pendapatanValue, belanjaValue, pembiayaanValue],
                            backgroundColor: [gradient1, gradient2, gradient3],
                            borderColor: ['#43e97b', '#f093fb', '#fa709a'],
                            borderWidth: 4,
                            hoverBorderWidth: 6,
                            hoverBorderColor: '#ffffff',
                            cutout: '60%'
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false // We'll use custom legend below
                            },
                            tooltip: {
                                backgroundColor: 'rgba(0,0,0,0.9)',
                                titleColor: 'white',
                                titleFont: {
                                    size: 16,
                                    weight: 'bold'
                                },
                                bodyColor: 'white',
                                bodyFont: {
                                    size: 14
                                },
                                borderColor: '#667eea',
                                borderWidth: 2,
                                cornerRadius: 15,
                                padding: 15,
                                callbacks: {
                                    label: function(context) {
                                        const total = {{ $totalAnggaran ?? 0 }};
                                        const value = context.parsed || 0;
                                        const percentage = total > 0 ? ((value / total) * 100).toFixed(1) : 0;
                                        return `${context.label}: Rp ${value.toLocaleString('id-ID')} (${percentage}%)`;
                                    },
                                    afterLabel: function(context) {
                                        return `Kontribusi: ${context.label} terhadap total anggaran`;
                                    }
                                }
                            }
                        },
                        animation: {
                            animateRotate: true,
                            duration: 2000,
                            easing: 'easeInOutQuart'
                        },
                        elements: {
                            arc: {
                                borderRadius: 8
                            }
                        }
                    }
                });
            } else {
                // Display no data message
                const centerX = compositionCanvas.width / 2;
                const centerY = compositionCanvas.height / 2;
                
                compositionCtx.font = '20px Arial';
                compositionCtx.fillStyle = '#ccc';
                compositionCtx.textAlign = 'center';
                compositionCtx.fillText('📊', centerX, centerY - 20);
                
                compositionCtx.font = '16px Arial';
                compositionCtx.fillStyle = '#999';
                compositionCtx.textAlign = 'center';
                compositionCtx.fillText('Tidak ada data anggaran', centerX, centerY + 10);
            }
        }
    }

    function initRealizationChart() {

    // Realization Chart
    const realizationCanvas = document.getElementById('realizationChart');
    if (realizationCanvas) {
        const realizationCtx = realizationCanvas.getContext('2d');
        const totalAnggaranValue = {{ $totalAnggaran ?? 0 }};
        const totalRealisasiValue = {{ $totalRealisasi ?? 0 }};
        
        if (totalAnggaranValue > 0 || totalRealisasiValue > 0) {
            // Create gradients
            const gradient1 = realizationCtx.createLinearGradient(0, 0, 0, 300);
            gradient1.addColorStop(0, 'rgba(102, 126, 234, 0.9)');
            gradient1.addColorStop(1, 'rgba(102, 126, 234, 0.6)');

            const gradient2 = realizationCtx.createLinearGradient(0, 0, 0, 300);
            gradient2.addColorStop(0, 'rgba(67, 233, 123, 0.9)');
            gradient2.addColorStop(1, 'rgba(67, 233, 123, 0.6)');

            const realizationChart = new Chart(realizationCtx, {
                type: 'bar',
                data: {
                    labels: ['Anggaran vs Realisasi'],
                    datasets: [{
                        label: 'Anggaran',
                        data: [totalAnggaranValue],
                        backgroundColor: gradient1,
                        borderColor: '#667eea',
                        borderWidth: 3,
                        borderRadius: {
                            topLeft: 15,
                            topRight: 15
                        },
                        borderSkipped: false,
                        barThickness: 80
                    }, {
                        label: 'Realisasi',
                        data: [totalRealisasiValue],
                        backgroundColor: gradient2,
                        borderColor: '#43e97b',
                        borderWidth: 3,
                        borderRadius: {
                            topLeft: 15,
                            topRight: 15
                        },
                        borderSkipped: false,
                        barThickness: 80
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false // We'll use custom legend in stats
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0,0,0,0.9)',
                            titleColor: 'white',
                            titleFont: {
                                size: 16,
                                weight: 'bold'
                            },
                            bodyColor: 'white',
                            bodyFont: {
                                size: 14
                            },
                            borderColor: '#667eea',
                            borderWidth: 2,
                            cornerRadius: 15,
                            padding: 15,
                            callbacks: {
                                label: function(context) {
                                    return `${context.dataset.label}: Rp ${context.parsed.y.toLocaleString('id-ID')}`;
                                },
                                afterLabel: function(context) {
                                    if (context.dataset.label === 'Realisasi') {
                                        const percentage = totalAnggaranValue > 0 ? ((totalRealisasiValue / totalAnggaranValue) * 100).toFixed(1) : 0;
                                        return `Persentase Realisasi: ${percentage}%`;
                                    }
                                    return '';
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0,0,0,0.05)',
                                lineWidth: 1,
                                drawBorder: false
                            },
                            border: {
                                display: false
                            },
                            ticks: {
                                font: {
                                    size: 12,
                                    weight: '500'
                                },
                                color: '#666',
                                padding: 10,
                                callback: function(value) {
                                    if (value >= 1000000000) {
                                        return 'Rp ' + (value / 1000000000).toFixed(1) + 'B';
                                    } else if (value >= 1000000) {
                                        return 'Rp ' + (value / 1000000).toFixed(0) + 'M';
                                    } else if (value >= 1000) {
                                        return 'Rp ' + (value / 1000).toFixed(0) + 'K';
                                    }
                                    return 'Rp ' + value.toLocaleString('id-ID');
                                }
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            },
                            border: {
                                display: false
                            },
                            ticks: {
                                font: {
                                    size: 14,
                                    weight: '600'
                                },
                                color: '#333',
                                padding: 15
                            }
                        }
                    },
                    animation: {
                        duration: 2000,
                        easing: 'easeInOutQuart'
                    }
                });
        } else {
            // Display no data message
            const centerX = realizationCanvas.width / 2;
            const centerY = realizationCanvas.height / 2;
            
            realizationCtx.font = '20px Arial';
            realizationCtx.fillStyle = '#ccc';
            realizationCtx.textAlign = 'center';
            realizationCtx.fillText('📈', centerX, centerY - 20);
            
            realizationCtx.font = '16px Arial';
            realizationCtx.fillStyle = '#999';
            realizationCtx.textAlign = 'center';
            realizationCtx.fillText('Tidak ada data realisasi', centerX, centerY + 10);
        }
    }

    // Historical Chart (jika ada data)
    @if(isset($historicalData) && $historicalData->count() > 0)
    const historicalCanvas = document.getElementById('historicalChart');
    if (historicalCanvas) {
        const historicalCtx = historicalCanvas.getContext('2d');
        
        // Prepare data
        const years = @json($historicalData->pluck('tahun'));
        const anggaranData = @json($historicalData->pluck('anggaran'));
        const realisasiData = @json($historicalData->pluck('realisasi'));
        
        console.log('Historical Data:', { years, anggaranData, realisasiData });
        
        // Create beautiful gradients
        const gradient1 = historicalCtx.createLinearGradient(0, 0, 0, 300);
        gradient1.addColorStop(0, 'rgba(102, 126, 234, 0.6)');
        gradient1.addColorStop(0.5, 'rgba(102, 126, 234, 0.3)');
        gradient1.addColorStop(1, 'rgba(102, 126, 234, 0.05)');
        
        const gradient2 = historicalCtx.createLinearGradient(0, 0, 0, 300);
        gradient2.addColorStop(0, 'rgba(67, 233, 123, 0.6)');
        gradient2.addColorStop(0.5, 'rgba(67, 233, 123, 0.3)');
        gradient2.addColorStop(1, 'rgba(67, 233, 123, 0.05)');
        
        const historicalChart = new Chart(historicalCtx, {
            type: 'line',
            data: {
                labels: years,
                datasets: [{
                    label: 'Anggaran',
                    data: anggaranData,
                    borderColor: '#667eea',
                    backgroundColor: gradient1,
                    borderWidth: 4,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#667eea',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 4,
                    pointRadius: 8,
                    pointHoverRadius: 12,
                    pointHoverBorderWidth: 6,
                    pointHoverBackgroundColor: '#667eea',
                    pointHoverBorderColor: '#fff'
                }, {
                    label: 'Realisasi',
                    data: realisasiData,
                    borderColor: '#43e97b',
                    backgroundColor: gradient2,
                    borderWidth: 4,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#43e97b',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 4,
                    pointRadius: 8,
                    pointHoverRadius: 12,
                    pointHoverBorderWidth: 6,
                    pointHoverBackgroundColor: '#43e97b',
                    pointHoverBorderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false // Using custom legend
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0,0,0,0.9)',
                        titleColor: 'white',
                        titleFont: {
                            size: 16,
                            weight: 'bold'
                        },
                        bodyColor: 'white',
                        bodyFont: {
                            size: 14
                        },
                        borderColor: '#667eea',
                        borderWidth: 2,
                        cornerRadius: 15,
                        padding: 15,
                        mode: 'index',
                        intersect: false,
                        callbacks: {
                            title: function(context) {
                                return `Tahun ${context[0].label}`;
                            },
                            label: function(context) {
                                return `${context.dataset.label}: Rp ${context.parsed.y.toLocaleString('id-ID')}`;
                            },
                            afterBody: function(context) {
                                if (context.length >= 2) {
                                    const anggaran = context.find(c => c.dataset.label === 'Anggaran');
                                    const realisasi = context.find(c => c.dataset.label === 'Realisasi');
                                    if (anggaran && realisasi && anggaran.parsed.y > 0) {
                                        const percentage = ((realisasi.parsed.y / anggaran.parsed.y) * 100).toFixed(1);
                                        return [``, `Persentase Realisasi: ${percentage}%`];
                                    }
                                }
                                return '';
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0,0,0,0.03)',
                            lineWidth: 1,
                            drawBorder: false
                        },
                        border: {
                            display: false
                        },
                        ticks: {
                            font: {
                                size: 12,
                                weight: '500'
                            },
                            color: '#666',
                            padding: 10,
                            callback: function(value) {
                                if (value >= 1000000000) {
                                    return 'Rp ' + (value / 1000000000).toFixed(1) + 'B';
                                } else if (value >= 1000000) {
                                    return 'Rp ' + (value / 1000000).toFixed(0) + 'M';
                                } else if (value >= 1000) {
                                    return 'Rp ' + (value / 1000).toFixed(0) + 'K';
                                }
                                return 'Rp ' + value.toLocaleString('id-ID');
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        border: {
                            display: false
                        },
                        ticks: {
                            font: {
                                size: 12,
                                weight: '600'
                            },
                            color: '#333',
                            padding: 15
                        }
                    }
                },
                animation: {
                    duration: 2500,
                    easing: 'easeInOutQuart'
                },
                interaction: {
                    intersect: false,
                    mode: 'index'
                }
            }
        });
    }
    @endif

    // Budget Navigation
    document.querySelectorAll('.budget-nav-item').forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Remove active class from all items
            document.querySelectorAll('.budget-nav-item').forEach(nav => nav.classList.remove('active'));
            
            // Add active class to clicked item
            this.classList.add('active');
            
            // Here you could add functionality to show/hide different sections
            // based on the selected tab
        });
    });
    
});
</script>

@endsection
