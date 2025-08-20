@extends('layouts.main')

@section('content')
<style>
.hero-section {
    background: linear-gradient(135deg, #ff6b6b 0%, #ee5a24 100%);
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
    color: #ff6b6b;
    background: #fff5f5;
    border-color: #ff6b6b;
    text-decoration: none;
    transform: translateY(-2px);
}

.nav-pill.active {
    background: linear-gradient(135deg, #ff6b6b 0%, #ee5a24 100%);
    color: white;
    border-color: #ff6b6b;
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
    background: linear-gradient(90deg, #ff6b6b, #ee5a24);
}

.stats-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
}

.stats-card.featured {
    background: linear-gradient(135deg, #ff6b6b 0%, #ee5a24 100%);
    color: white;
}

.stats-card.featured::before {
    background: rgba(255,255,255,0.3);
}

.stats-card.danger {
    background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
    color: white;
}

.stats-card.warning {
    background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%);
    color: white;
}

.stats-card.success {
    background: linear-gradient(135deg, #27ae60 0%, #16a085 100%);
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
.stats-card.danger .stats-label,
.stats-card.warning .stats-label,
.stats-card.success .stats-label {
    color: rgba(255,255,255,0.8);
}

.stats-value {
    font-size: 2.5rem;
    font-weight: 900;
    margin: 15px 0;
    color: #2c3e50;
}

.stats-card.featured .stats-value,
.stats-card.danger .stats-value,
.stats-card.warning .stats-value,
.stats-card.success .stats-value {
    color: white;
}

.stats-description {
    font-size: 0.9rem;
    color: #6c757d;
    line-height: 1.5;
}

.stats-card.featured .stats-description,
.stats-card.danger .stats-description,
.stats-card.warning .stats-description,
.stats-card.success .stats-description {
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

/* Legend */
.legend {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 20px;
    margin-top: 20px;
}

.legend-item {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 0.9rem;
    color: #6c757d;
}

.legend-color {
    width: 16px;
    height: 16px;
    border-radius: 4px;
}

/* Alert */
.alert-stunting {
    background: linear-gradient(135deg, #fff5f5 0%, #ffe8e8 100%);
    border: 1px solid #ff6b6b;
    border-radius: 15px;
    padding: 20px;
    margin: 30px 0;
}

.alert-stunting .alert-icon {
    color: #ff6b6b;
    font-size: 1.5rem;
    margin-bottom: 10px;
}

.alert-stunting .alert-title {
    color: #e74c3c;
    font-weight: 700;
    margin-bottom: 10px;
}

.alert-stunting .alert-text {
    color: #c0392b;
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
                    <i class="fas fa-child me-3"></i>
                    INFOGRAFIS STUNTING
                </h1>
                <p class="lead mb-4" style="font-size: 1.3rem; line-height: 1.6;">
                    Pemantauan status gizi balita dan upaya pencegahan stunting di wilayah desa
                </p>
                <div class="d-flex align-items-center">
                    <i class="fas fa-info-circle me-2"></i>
                    <span>Data terkini periode {{ date('Y') }}</span>
                </div>
            </div>
            <div class="col-lg-6 text-center">
                <div style="font-size: 8rem; opacity: 0.3;">
                    <i class="fas fa-chart-pie"></i>
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
            <a href="{{ route('infografis.stunting') }}" class="nav-pill active">
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

    <!-- Stunting Header -->
    <div class="text-center mb-5">
        <h2 class="display-4 fw-bold text-danger mb-4">DATA STUNTING</h2>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <p class="lead" style="font-size: 1.2rem; line-height: 1.8; color: #6c757d;">
                    Monitoring dan evaluasi status gizi balita untuk mencegah stunting berdasarkan data 
                    <strong>Posyandu</strong> dan <strong>Puskesmas</strong>.
                </p>
            </div>
        </div>
    </div>

    <!-- Alert Info -->
    <div class="alert-stunting">
        <div class="text-center">
            <i class="fas fa-exclamation-triangle alert-icon"></i>
            <div class="alert-title h5">Perhatian Khusus Stunting</div>
            <p class="alert-text mb-0">
                Persentase stunting saat ini <strong>{{ $persentaseStunting }}%</strong> 
                @if($persentaseStunting > $targetNasional)
                    masih di atas target nasional ({{ $targetNasional }}%). Perlu penanganan intensif!
                @else
                    sudah mencapai target nasional ({{ $targetNasional }}%). Pertahankan capaian ini!
                @endif
            </p>
        </div>
    </div>

    <!-- Main Stats Grid -->
    <div class="stats-grid">
        <div class="stats-card featured">
            <div class="stats-label">Total Balita</div>
            <div class="stats-value">{{ number_format($totalBalita) }}</div>
            <div class="stats-description">Jumlah balita yang dipantau</div>
        </div>

        <div class="stats-card danger">
            <div class="stats-label">Stunting Berat</div>
            <div class="stats-value">{{ number_format($stuntingBerat) }}</div>
            <div class="stats-description">{{ $totalBalita > 0 ? number_format(($stuntingBerat/$totalBalita)*100, 1) : 0 }}% dari total balita</div>
        </div>

        <div class="stats-card warning">
            <div class="stats-label">Stunting Sedang</div>
            <div class="stats-value">{{ number_format($stuntingSedang) }}</div>
            <div class="stats-description">{{ $totalBalita > 0 ? number_format(($stuntingSedang/$totalBalita)*100, 1) : 0 }}% dari total balita</div>
        </div>

        <div class="stats-card" style="background: linear-gradient(135deg, #ff9500 0%, #ff6348 100%); color: white;">
            <div class="stats-label" style="color: rgba(255,255,255,0.8);">Stunting Ringan</div>
            <div class="stats-value" style="color: white;">{{ number_format($stuntingRingan) }}</div>
            <div class="stats-description" style="color: rgba(255,255,255,0.9);">{{ $totalBalita > 0 ? number_format(($stuntingRingan/$totalBalita)*100, 1) : 0 }}% dari total balita</div>
        </div>

        <div class="stats-card success">
            <div class="stats-label">Balita Normal</div>
            <div class="stats-value">{{ number_format($normalBalita) }}</div>
            <div class="stats-description">{{ $totalBalita > 0 ? number_format(($normalBalita/$totalBalita)*100, 1) : 0 }}% dari total balita</div>
        </div>

        <div class="stats-card" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
            <div class="stats-label" style="color: rgba(255,255,255,0.8);">Target Nasional</div>
            <div class="stats-value" style="color: white;">{{ $targetNasional }}%</div>
            <div class="stats-description" style="color: rgba(255,255,255,0.9);">Standar pemerintah</div>
        </div>
    </div>

    <!-- Progress Chart -->
    <div class="chart-container">
        <div class="chart-header">
            <h3 class="chart-title">Distribusi Status Gizi Balita</h3>
            <p class="chart-subtitle">Perbandingan kategori status gizi balita di desa</p>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="progress-container">
                    <div class="progress-label">
                        <span><i class="fas fa-circle text-success me-2"></i>Normal</span>
                        <span>{{ number_format($normalBalita) }} balita</span>
                    </div>
                    <div class="progress">
                        <div class="progress-bar bg-success" style="width: {{ $totalBalita > 0 ? ($normalBalita/$totalBalita)*100 : 0 }}%"></div>
                    </div>
                </div>

                <div class="progress-container">
                    <div class="progress-label">
                        <span><i class="fas fa-circle me-2" style="color: #ff9500;"></i>Stunting Ringan</span>
                        <span>{{ number_format($stuntingRingan) }} balita</span>
                    </div>
                    <div class="progress">
                        <div class="progress-bar" style="background-color: #ff9500; width: {{ $totalBalita > 0 ? ($stuntingRingan/$totalBalita)*100 : 0 }}%"></div>
                    </div>
                </div>

                <div class="progress-container">
                    <div class="progress-label">
                        <span><i class="fas fa-circle text-warning me-2"></i>Stunting Sedang</span>
                        <span>{{ number_format($stuntingSedang) }} balita</span>
                    </div>
                    <div class="progress">
                        <div class="progress-bar bg-warning" style="width: {{ $totalBalita > 0 ? ($stuntingSedang/$totalBalita)*100 : 0 }}%"></div>
                    </div>
                </div>

                <div class="progress-container">
                    <div class="progress-label">
                        <span><i class="fas fa-circle text-danger me-2"></i>Stunting Berat</span>
                        <span>{{ number_format($stuntingBerat) }} balita</span>
                    </div>
                    <div class="progress">
                        <div class="progress-bar bg-danger" style="width: {{ $totalBalita > 0 ? ($stuntingBerat/$totalBalita)*100 : 0 }}%"></div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="text-center">
                    <div style="font-size: 4rem; margin: 30px 0;">
                        @if($persentaseStunting <= $targetNasional)
                            <i class="fas fa-check-circle text-success"></i>
                        @else
                            <i class="fas fa-exclamation-triangle text-warning"></i>
                        @endif
                    </div>
                    <h4 class="mb-3">Persentase Stunting</h4>
                    <div class="display-6 fw-bold mb-3" 
                         style="color: {{ $persentaseStunting <= $targetNasional ? '#27ae60' : '#e74c3c' }};">
                        {{ $persentaseStunting }}%
                    </div>
                    <p class="text-muted">
                        @if($persentaseStunting <= $targetNasional)
                            <i class="fas fa-thumbs-up me-2"></i>Sudah mencapai target nasional
                        @else
                            <i class="fas fa-arrow-down me-2"></i>Perlu diturunkan {{ number_format($persentaseStunting - $targetNasional, 1) }}%
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Historical Trends -->
    <div class="chart-container">
        <div class="chart-header">
            <h3 class="chart-title">Tren Stunting 5 Tahun Terakhir</h3>
            <p class="chart-subtitle">Perkembangan persentase stunting dari tahun ke tahun</p>
        </div>

        <div class="row">
            @foreach($historicalData as $data)
            <div class="col-md mb-3">
                <div class="text-center p-3 rounded" 
                     style="background: {{ $data['persentase'] <= $targetNasional ? '#d4edda' : '#f8d7da' }}; 
                            border: 1px solid {{ $data['persentase'] <= $targetNasional ? '#c3e6cb' : '#f1b0b7' }};">
                    <div class="h6 mb-2" style="color: #6c757d;">{{ $data['tahun'] }}</div>
                    <div class="h4 fw-bold mb-2" 
                         style="color: {{ $data['persentase'] <= $targetNasional ? '#155724' : '#721c24' }};">
                        {{ $data['persentase'] }}%
                    </div>
                    <small class="text-muted">
                        @if($loop->index > 0 && isset($historicalData[$loop->index - 1]))
                            @php
                                $prev = $historicalData[$loop->index - 1]['persentase'];
                                $change = $data['persentase'] - $prev;
                            @endphp
                            @if($change > 0)
                                <i class="fas fa-arrow-up text-danger"></i> +{{ number_format($change, 1) }}%
                            @elseif($change < 0)
                                <i class="fas fa-arrow-down text-success"></i> {{ number_format($change, 1) }}%
                            @else
                                <i class="fas fa-minus text-muted"></i> 0%
                            @endif
                        @endif
                    </small>
                </div>
            </div>
            @endforeach
        </div>

        <div class="row mt-4">
            <div class="col-lg-8 mx-auto">
                <div class="text-center p-4 rounded" style="background: #f8f9fa; border: 1px solid #dee2e6;">
                    <h5 class="mb-3">Analisis Tren</h5>
                    @php
                        $firstYear = $historicalData[0]['persentase'] ?? 0;
                        $lastYear = end($historicalData)['persentase'] ?? 0;
                        $totalChange = $lastYear - $firstYear;
                    @endphp
                    <p class="mb-0">
                        Dalam 5 tahun terakhir, persentase stunting 
                        @if($totalChange > 0)
                            <strong class="text-danger">meningkat {{ number_format($totalChange, 1) }}%</strong>
                        @elseif($totalChange < 0)
                            <strong class="text-success">menurun {{ number_format(abs($totalChange), 1) }}%</strong>
                        @else
                            <strong class="text-muted">stagnan</strong>
                        @endif
                        dari {{ $firstYear }}% menjadi {{ $lastYear }}%.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Items -->
    <div class="row">
        <div class="col-lg-6">
            <div class="chart-container">
                <h4 class="text-danger mb-4">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    Program Prioritas
                </h4>
                <div class="list-group list-group-flush">
                    <div class="list-group-item border-0 px-0">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <i class="fas fa-seedling text-success fa-2x"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-1">Perbaikan Gizi</h6>
                                <p class="mb-0 text-muted">Program pemberian makanan tambahan dan suplementasi</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="list-group-item border-0 px-0">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <i class="fas fa-user-md text-primary fa-2x"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-1">Pemantauan Rutin</h6>
                                <p class="mb-0 text-muted">Penimbangan dan pengukuran berkala di Posyandu</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="list-group-item border-0 px-0">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <i class="fas fa-graduation-cap text-warning fa-2x"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-1">Edukasi Orang Tua</h6>
                                <p class="mb-0 text-muted">Penyuluhan gizi dan pola asuh yang benar</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-6">
            <div class="chart-container">
                <h4 class="text-info mb-4">
                    <i class="fas fa-lightbulb me-2"></i>
                    Tips Pencegahan
                </h4>
                <div class="list-group list-group-flush">
                    <div class="list-group-item border-0 px-0">
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <span class="badge bg-success rounded-pill">1</span>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <p class="mb-0">Berikan ASI eksklusif selama 6 bulan pertama</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="list-group-item border-0 px-0">
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <span class="badge bg-success rounded-pill">2</span>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <p class="mb-0">Berikan MPASI yang bergizi seimbang</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="list-group-item border-0 px-0">
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <span class="badge bg-success rounded-pill">3</span>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <p class="mb-0">Rutin kontrol ke Posyandu dan Puskesmas</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="list-group-item border-0 px-0">
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <span class="badge bg-success rounded-pill">4</span>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <p class="mb-0">Jaga kebersihan lingkungan dan sanitasi</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Extra spacing at bottom -->
<div class="py-5"></div>
@endsection
