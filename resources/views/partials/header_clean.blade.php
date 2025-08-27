<!-- ======= Header ======= -->
<!-- Load CSS files -->
<link rel="stylesheet" href="{{ asset('css/hamburger.css') }}">
<link rel="stylesheet" href="{{ asset('css/header.css') }}">

<header id="header" class="d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">
        <div class="logo me-auto">
            <h1><a href="/">
                    <img src="{{ asset('storage/' . $logo->logo) }}" alt="Logo"
                         style="width: 55px; height: 55px; object-fit: cover; object-position: center; border-radius: 8px;">
                </a></h1>
        </div>

        <!-- Clean Hamburger Button -->
        <button class="hamburger-btn" id="hamburger-btn" aria-label="Toggle navigation">
            <span class="hamburger-line"></span>
            <span class="hamburger-line"></span>
            <span class="hamburger-line"></span>
        </button>

        <nav id="navbar" class="navbar">
            <ul>
                <li><a class="nav-link scrollto {{ request()->is('/') ? 'active' : '' }}" href="/">Beranda</a></li>
                <li class="dropdown"><a href="#"><span>Profil Desa</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        <li><a class="{{ request()->is('wilayah') ? 'active' : '' }}" href="/wilayah">Wilayah</a></li>
                        <li><a class="{{ request()->is('sejarah') ? 'active' : '' }}" href="/sejarah">Sejarah</a></li>
                        <li><a class="{{ request()->is('visi-misi') ? 'active' : '' }}" href="/visi-misi">Visi & Misi</a></li>
                        <li><a class="{{ request()->is('perangkat-desa') ? 'active' : '' }}" href="/perangkat-desa">Perangkat Desa</a></li>
                        <li><a class="{{ request()->is('peta-desa') ? 'active' : '' }}" href="/peta-desa">Peta Desa</a></li>
                    </ul>
                </li>
                <li class="dropdown"><a class="{{ request()->is('pengumuman*') || request()->is('berita*') || request()->is('gallery*') || request()->is('penduduk/dashboard') ? 'active' : '' }}" href="#"><span>Informasi</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        <li><a class="{{ request()->is('pengumuman*') ? 'active' : '' }}" href="/pengumuman">Pengumuman</a></li>
                        <li><a class="{{ request()->is('berita*') ? 'active' : '' }}" href="/berita">Berita</a></li>
                        <li><a class="{{ request()->is('gallery*') ? 'active' : '' }}" href="/gallery">Gallery</a></li>
                    </ul>
                </li>
                <li class="dropdown"><a class="{{ request()->is('idm*') || request()->is('infografis*') ? 'active' : '' }}" href="#"><span>Infografis</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        <li><a class="{{ request()->is('infografis/penduduk*') ? 'active' : '' }}" href="{{ route('infografis.penduduk') }}">
                            <i class="fas fa-users me-2"></i>Penduduk
                        </a></li>
                        <li><a class="{{ request()->is('infografis/apbdes*') ? 'active' : '' }}" href="{{ route('infografis.apbdes') }}">
                            <i class="fas fa-money-bill-wave me-2"></i>APBDes
                        </a></li>
                        <li><a class="{{ request()->is('infografis/stunting*') ? 'active' : '' }}" href="{{ route('infografis.stunting') }}">
                            <i class="fas fa-child me-2"></i>Stunting
                        </a></li>
                        <li><a class="{{ request()->is('infografis/bansos*') ? 'active' : '' }}" href="{{ route('infografis.bansos') }}">
                            <i class="fas fa-hand-holding-heart me-2"></i>Bansos
                        </a></li>
                        <li><a class="{{ request()->is('idm*') ? 'active' : '' }}" href="{{ route('idm.index') }}">
                            <i class="fas fa-chart-line me-2"></i>IDM
                        </a></li>
                        <li><a class="{{ request()->is('infografis/sdgs*') ? 'active' : '' }}" href="{{ route('infografis.sdgs') }}">
                            <i class="fas fa-globe me-2"></i>SDGs
                        </a></li>
                    </ul>
                </li>
                <li><a class="nav-link scrollto" href="/umkm">Umkm</a></li>
                <li><a class="nav-link scrollto" href="/layanan">Layanan</a></li>
                <li><a class="nav-link scrollto" href="/kontak">Kontak kami</a></li>
                <li>
                    <a href="/login" class="nav-link scrollto">Masuk</a>
                </li>
            </ul>
        </nav><!-- .navbar -->
    </div>
</header><!-- End Header -->

<!-- Mobile Menu Overlay -->
<div class="mobile-menu-overlay" id="mobile-menu-overlay">
    <div class="mobile-menu-content">
        <ul>
            <li><a href="/">Beranda</a></li>
            <li><a href="/wilayah">Wilayah</a></li>
            <li><a href="/sejarah">Sejarah</a></li>
            <li><a href="/visi-misi">Visi & Misi</a></li>
            <li><a href="/perangkat-desa">Perangkat Desa</a></li>
            <li><a href="/peta-desa">Peta Desa</a></li>
            <li><a href="/pengumuman">Pengumuman</a></li>
            <li><a href="/berita">Berita</a></li>
            <li><a href="/gallery">Gallery</a></li>
            <li><a href="{{ route('infografis.penduduk') }}">Infografis Penduduk</a></li>
            <li><a href="{{ route('infografis.apbdes') }}">Infografis APBDes</a></li>
            <li><a href="{{ route('infografis.stunting') }}">Infografis Stunting</a></li>
            <li><a href="{{ route('infografis.bansos') }}">Infografis Bansos</a></li>
            <li><a href="{{ route('idm.index') }}">IDM</a></li>
            <li><a href="{{ route('infografis.sdgs') }}">SDGs</a></li>
            <li><a href="/umkm">UMKM</a></li>
            <li><a href="/layanan">Layanan</a></li>
            <li><a href="/kontak">Kontak Kami</a></li>
            <li><a href="/login">Masuk</a></li>
        </ul>
    </div>
</div>

<!-- Load JavaScript files -->
<script src="{{ asset('js/header.js') }}"></script>
<script src="{{ asset('js/hamburger.js') }}"></script>
