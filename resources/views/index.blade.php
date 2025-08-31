@extends('layouts.main')

@section('content')
<section id="hero">
  <div class="hero-container">
    <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">

      <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

      <div class="carousel-inner" role="listbox">
        @foreach ($sliders as $key => $slider)
        <div class="carousel-item{{ $key === 0 ? ' active' : '' }}" style="background-image: url({{ asset('storage/' . $slider->img_slider) }});">
          <div class="carousel-container">
            <div class="carousel-content container">
              <h2 class="animate__animated animate__fadeInDown">{{ $slider->judul }}</h2>
              <p class="animate__animated animate__fadeInUp">{{ $slider->deskripsi }}</p>
            </div>
          </div>
        </div>
        @endforeach
      </div>

    </div>
  </div>
</section><!-- End Hero -->

<!-- ======= Statistik Penduduk Section ======= -->
<section id="stats" class="stats-section">
    <div class="container">
        <div class="section-title">
            <h2>Statistik Penduduk Desa</h2>
            <p>Data terkini mengenai kependudukan dan demografis warga desa kami</p>
        </div>
        <div class="row">
            <!-- Total Penduduk -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <span class="stat-number" data-count="{{ $totalPenduduk ?? 2456 }}">0</span>
                    <div class="stat-label">Total Penduduk</div>
                </div>
            </div>
            
            <!-- Kepala Keluarga -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-home"></i>
                    </div>
                    <span class="stat-number" data-count="{{ $totalKK ?? 687 }}">0</span>
                    <div class="stat-label">Kepala Keluarga</div>
                </div>
            </div>
            
            <!-- Laki-laki -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-male"></i>
                    </div>
                    <span class="stat-number" data-count="{{ $lakiLaki ?? 1289 }}">0</span>
                    <div class="stat-label">Laki-laki</div>
                </div>
            </div>
            
            <!-- Perempuan -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-female"></i>
                    </div>
                    <span class="stat-number" data-count="{{ $perempuan ?? 1167 }}">0</span>
                    <div class="stat-label">Perempuan</div>
                </div>
            </div>
        </div>
        
        <div class="row justify-content-center">
            <!-- Penduduk Produktif -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-briefcase"></i>
                    </div>
                    <span class="stat-number" data-count="{{ $usiaProduktif ?? 1865 }}">0</span>
                    <div class="stat-label">Usia Produktif</div>
                </div>
            </div>
            
            <!-- Lansia -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-wheelchair"></i>
                    </div>
                    <span class="stat-number" data-count="{{ $lansia ?? 198 }}">0</span>
                    <div class="stat-label">Lansia (60+)</div>
                </div>
            </div>
            
            <!-- Balita -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-baby"></i>
                    </div>
                    <span class="stat-number" data-count="{{ $balita ?? 165 }}">0</span>
                    <div class="stat-label">Balita (0-4)</div>
                </div>
            </div>
            
            <!-- Petani -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-seedling"></i>
                    </div>
                    <span class="stat-number" data-count="{{ $petani ?? 428 }}">0</span>
                    <div class="stat-label">Petani</div>
                </div>
            </div>
        </div>
    </div>
</section><!-- End Statistik Penduduk Section -->

<!-- ======= Statistik Stunting Section ======= -->
<section id="stunting-stats" class="stunting-stats-section">
    <div class="container">
        <div class="section-title">
            <h2>Data Status Gizi Balita</h2>
            <p>Monitoring dan evaluasi status gizi balita untuk pencegahan stunting</p>
        </div>
        
        <div class="row justify-content-center">
            <!-- Total Balita Dipantau -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-card stunting-card">
                    <div class="stat-icon">
                        <i class="fas fa-child"></i>
                    </div>
                    <span class="stat-number" data-count="{{ $totalBalitaStunting ?? 150 }}">0</span>
                    <div class="stat-label">Total Balita Dipantau</div>
                </div>
            </div>
            
            <!-- Balita Normal -->
            <div class="col-lg-2 col-md-6 mb-4">
                <div class="stat-card stunting-normal">
                    <div class="stat-icon">
                        <i class="fas fa-smile"></i>
                    </div>
                    <span class="stat-number" data-count="{{ $balitaNormal ?? 120 }}">0</span>
                    <div class="stat-label">Balita Normal</div>
                </div>
            </div>
            
            <!-- Balita Stunting -->
            <div class="col-lg-2 col-md-6 mb-4">
                <div class="stat-card stunting-danger">
                    <div class="stat-icon">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <span class="stat-number" data-count="{{ $balitaStunting ?? 15 }}">0</span>
                    <div class="stat-label">Balita Stunting</div>
                </div>
            </div>
            
            <!-- Balita Kurus -->
            <div class="col-lg-2 col-md-6 mb-4">
                <div class="stat-card stunting-warning">
                    <div class="stat-icon">
                        <i class="fas fa-arrow-down"></i>
                    </div>
                    <span class="stat-number" data-count="{{ $balitaKurus ?? 10 }}">0</span>
                    <div class="stat-label">Balita Kurus</div>
                </div>
            </div>
            
            <!-- Balita Gemuk -->
            <div class="col-lg-2 col-md-6 mb-4">
                <div class="stat-card stunting-info">
                    <div class="stat-icon">
                        <i class="fas fa-arrow-up"></i>
                    </div>
                    <span class="stat-number" data-count="{{ $balitaGemuk ?? 5 }}">0</span>
                    <div class="stat-label">Balita Gemuk</div>
                </div>
            </div>
        </div>
        
        <div class="row justify-content-center mt-4">
            <div class="col-lg-8">
                <div class="stunting-info-card">
                    <h4>Informasi Penting</h4>
                    <p>Data status gizi balita ini diperbarui secara berkala berdasarkan hasil pemantauan di Posyandu dan Puskesmas. 
                    Untuk informasi lebih detail, silakan kunjungi halaman 
                    <a href="{{ route('infografis.stunting') }}" class="btn-link">Infografis Stunting</a>.</p>
                </div>
            </div>
        </div>
    </div>
</section><!-- End Statistik Stunting Section -->

<!-- ======= Services Section ======= -->
<section id="services" class="services">
  <div class="container" data-aos="fade-up">
    <div class="section-title">
      <h2>Layanan Desa</h2>
      <p>Akses mudah ke berbagai layanan dan informasi desa</p>
    </div>

    <div class="row justify-content-center">
      <div class="col-lg-4 col-md-4 mb-4" data-aos="fade-up" data-aos-delay="100">
        <div class="icon-box">
          <div class="icon"><i class="bi bi-geo-alt-fill"></i></div>
          <h4 class="title"><a href="/peta-desa">Peta Desa</a></h4>
        </div>
      </div>
      
      <div class="col-lg-4 col-md-4 mb-4" data-aos="fade-up" data-aos-delay="200">
        <div class="icon-box">
          <div class="icon"><i class="bi bi-shop"></i></div>
          <h4 class="title"><a href="/umkm">UMKM Desa</a></h4>
        </div>
      </div>
      
      <div class="col-lg-4 col-md-4 mb-4" data-aos="fade-up" data-aos-delay="300">
        <div class="icon-box">
          <div class="icon"><i class="bi bi-chat-square-text-fill"></i></div>
          <h4 class="title"><a href="/kontak">Pengaduan</a></h4>
        </div>
      </div>
    </div>
    
  </div>
</section>

<!-- ======= Video Section ======= -->
<section id="services" class="services mx-4">
  <div class="container" data-aos="fade-up">
    <div class="section-title">
      <h2>Video Profile</h2>
    </div>

    <div class="row">
      <div class="col-lg-10 mx-auto">
        <iframe width="100%" height="500" src="{{ $videoProfil->url_video }}" frameborder="0" allowfullscreen></iframe>
      </div>
    </div>
  </div>
</section>


<section class="counts section-bg">
  <div class="container">

    <div class="section-title">
      <h2>Berita Desa</h2>
    </div>

    <div class="row">

      @foreach ($beritas as $berita)
            <div class="col-lg-4 col-md-6 mb-3" data-aos="fade-up">
                <div class="count-box news-card">
                    <div class="card">
                        <img src="{{ asset('storage/' . $berita->gambar) }}" alt="Gambar Berita" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">{{ $berita->judul }}</h5>
                            <p class="card-text">{{ $berita->excerpt }}</p>
                            <div class="news-date">{{ $berita->created_at->diffForHumans() }}</div>
                        </div>
                        <div class="card-footer">
                          <a href="/berita/{{ $berita->slug }}" type="button" class="btn btn-link float-end">Selengkapnya</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

     
      <div class="button" style="text-align: center">
        <a class="btn btn-primary mx-auto" href="/berita" role="button">Lihat Semua</a>
      </div>
      
    </div>

  </div>
</section>
@endsection