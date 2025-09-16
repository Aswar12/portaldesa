<!-- ======= Header ======= -->
<!-- Load CSS files -->
<link rel="stylesheet" href="{{ asset('assets/css/hamburger.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/header.css') }}">

<!-- Emergency CSS for hamburger - highest priority -->
<style>
/* ABSOLUTE EMERGENCY HAMBURGER STYLES */
#hamburger-btn,
.hamburger-btn {
    display: none !important; /* Hidden by default */
    position: absolute !important;
    top: 50% !important;
    right: 15px !important;
    transform: translateY(-50%) !important;
    width: 48px !important;
    height: 48px !important;
    background: #2A52BE !important; /* Match with website theme */
    border: none !important;
    border-radius: 8px !important;
    cursor: pointer !important;
    z-index: 99999 !important;
    transition: all 0.3s ease !important;
    box-shadow: 0 2px 8px rgba(42, 82, 190, 0.2) !important;
    flex-direction: column !important;
    justify-content: center !important;
    align-items: center !important;
    padding: 0 !important;
    font-size: 0 !important;
    visibility: visible !important;
    opacity: 1 !important;
    pointer-events: auto !important;
    backdrop-filter: blur(10px) !important;
    transform: scale(1) !important;
}

#hamburger-btn:hover,
.hamburger-btn:hover {
    transform: scale(1.1) rotate(5deg) !important;
    box-shadow: 0 12px 40px rgba(102, 126, 234, 0.6) !important;
    background: linear-gradient(135deg, #764ba2 0%, #667eea 100%) !important;
    border-color: #ffffff !important;
}

#hamburger-btn:active,
.hamburger-btn:active {
    transform: scale(0.95) !important;
    transition: all 0.1s ease !important;
}

/* Show ONLY on mobile */
@media screen and (max-width: 991px) {
    #hamburger-btn,
    .hamburger-btn {
        display: flex !important;
        animation: hamburgerBounceIn 0.6s cubic-bezier(0.4, 0, 0.2, 1) !important;
    }
}

/* Hamburger bounce in animation */
@keyframes hamburgerBounceIn {
    0% {
        transform: scale(0) rotate(180deg) !important;
        opacity: 0 !important;
    }
    50% {
        transform: scale(1.2) rotate(-10deg) !important;
        opacity: 0.8 !important;
    }
    100% {
        transform: scale(1) rotate(0deg) !important;
        opacity: 1 !important;
    }
}

.hamburger-line {
    display: block !important;
    width: 28px !important;
    height: 3px !important;
    background: linear-gradient(90deg, #ffffff 0%, rgba(255, 255, 255, 0.8) 100%) !important;
    margin: 4px 0 !important;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1) !important;
    border-radius: 2px !important;
    position: relative !important;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2) !important;
}

/* Hamburger animation states */
#hamburger-btn.active .hamburger-line:nth-child(1),
.hamburger-btn.active .hamburger-line:nth-child(1) {
    transform: rotate(45deg) translate(8px, 8px) !important;
    background: #ff6b6b !important;
}

#hamburger-btn.active .hamburger-line:nth-child(2),
.hamburger-btn.active .hamburger-line:nth-child(2) {
    opacity: 0 !important;
    transform: translateX(20px) !important;
}

#hamburger-btn.active .hamburger-line:nth-child(3),
.hamburger-btn.active .hamburger-line:nth-child(3) {
    transform: rotate(-45deg) translate(8px, -8px) !important;
    background: #ff6b6b !important;
}

/* Pulse animation for active state */
#hamburger-btn.active,
.hamburger-btn.active {
    animation: hamburgerPulse 1.5s infinite !important;
}

@keyframes hamburgerPulse {
    0%, 100% {
        box-shadow: 0 8px 32px rgba(102, 126, 234, 0.4) !important;
    }
    50% {
        box-shadow: 0 8px 32px rgba(102, 126, 234, 0.8) !important;
    }
}

/* Hide on desktop - extra specificity */
@media screen and (min-width: 992px) {
    #hamburger-btn,
    .hamburger-btn {
        display: none !important;
        visibility: hidden !important;
        opacity: 0 !important;
        pointer-events: none !important;
    }
}

/* Hide any conflicting elements */
.mobile-nav-toggle,
.mobile-nav-toggle.bi,
.mobile-nav-toggle.bi-list,
.mobile-nav-toggle.bi-x {
    display: none !important;
    visibility: hidden !important;
    opacity: 0 !important;
    pointer-events: none !important;
}

/* Remove borders from navbar */
#topbar {
    border-bottom: none !important;
}

#header {
    border: none !important;
    box-shadow: none !important;
}

.navbar {
    border: none !important;
}

.navbar ul {
    border: none !important;
}

/* Super cool hamburger animations */
@keyframes hamburgerBounceIn {
    0% {
        transform: scale(0) rotate(180deg);
        opacity: 0;
    }
    50% {
        transform: scale(1.2) rotate(-10deg);
        opacity: 0.8;
    }
    100% {
        transform: scale(1) rotate(0deg);
        opacity: 1;
    }
}

@keyframes hamburgerPulse {
    0%, 100% {
        box-shadow: 0 8px 32px rgba(102, 126, 234, 0.4);
    }
    50% {
        box-shadow: 0 8px 32px rgba(102, 126, 234, 0.8);
    }
}

/* Super cool mobile menu styles */
.mobile-menu-overlay.active .mobile-menu-content {
    transform: translateY(0) scale(1) !important;
    animation: menuSlideIn 0.5s cubic-bezier(0.4, 0, 0.2, 1) !important;
}

.mobile-menu-overlay.active {
    opacity: 1 !important;
    visibility: visible !important;
}

.mobile-menu-overlay.active .mobile-menu-content {
    right: 0 !important;
}

/* Remove borders from desktop navbar */
@media screen and (min-width: 992px) {
    .navbar ul {
        border: none !important;
    }
    .navbar ul li a {
        border: none !important;
    }
    .dropdown-menu {
        border: none !important;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1) !important;
    }
}

/* Menu item hover effects */
.mobile-menu-content ul li a:hover {
    background: #f8f9fa !important;
    color: #2A52BE !important;
}

.mobile-menu-content ul li a.active {
    color: #2A52BE !important;
    background: #f8f9fa !important;
}

/* Collapsible Menu Groups */
.menu-group-header {
    position: relative;
    transition: all 0.3s ease;
}

.menu-group-header:hover {
    background: linear-gradient(90deg, #e8f4f8 0%, transparent 100%) !important;
    transform: translateX(5px);
}

.menu-group-content {
    overflow: hidden;
    transition: all 0.3s ease;
}

.menu-group-content a {
    position: relative;
    transition: all 0.3s ease;
}

.menu-group-content a:hover {
    background: #e8f4f8 !important;
    color: #2A52BE !important;
    transform: translateX(10px);
    padding-left: 40px !important;
}

/* Smooth animations for menu toggle */
.toggle-icon {
    transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
}

/* Enhanced mobile menu styling */
.mobile-menu-content ul li {
    margin: 0 !important;
    padding: 0 !important;
}

.mobile-menu-content ul li a {
    margin: 0 !important;
    border-radius: 8px !important;
    margin: 2px 0 !important;
}

.mobile-menu-content ul li a:hover {
    transform: translateX(5px) !important;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1) !important;
}

/* Special styling for login button */
.mobile-menu-content a[href="/login"] {
    margin: 0 !important;
    box-shadow: 0 4px 20px rgba(102, 126, 234, 0.4) !important;
}

.mobile-menu-content a[href="/login"]:hover {
    transform: translateY(-2px) !important;
    box-shadow: 0 6px 25px rgba(102, 126, 234, 0.6) !important;
}

/* Hide on desktop - extra specificity */
@media screen and (min-width: 992px) {
    #hamburger-btn,
    .hamburger-btn {
        display: none !important;
        visibility: hidden !important;
        opacity: 0 !important;
        pointer-events: none !important;
    }
}

/* Hide any conflicting elements */
.mobile-nav-toggle,
.mobile-nav-toggle.bi,
.mobile-nav-toggle.bi-list,
.mobile-nav-toggle.bi-x {
    display: none !important;
    visibility: hidden !important;
    opacity: 0 !important;
    pointer-events: none !important;
}

/* Remove borders from navbar */
#topbar {
    border-bottom: none !important;
}

#header {
    border: none !important;
    box-shadow: none !important;
}

.navbar {
    border: none !important;
}

.navbar ul {
    border: none !important;
}

/* Super cool hamburger animations */
@keyframes hamburgerBounceIn {
    0% {
        transform: scale(0) rotate(180deg);
        opacity: 0;
    }
    50% {
        transform: scale(1.2) rotate(-10deg);
        opacity: 0.8;
    }
    100% {
        transform: scale(1) rotate(0deg);
        opacity: 1;
    }
}

@keyframes hamburgerPulse {
    0%, 100% {
        box-shadow: 0 8px 32px rgba(102, 126, 234, 0.4);
    }
    50% {
        box-shadow: 0 8px 32px rgba(102, 126, 234, 0.8);
    }
}

/* Super cool mobile menu styles */
.mobile-menu-overlay.active .mobile-menu-content {
    transform: translateY(0) scale(1) !important;
    animation: menuSlideIn 0.5s cubic-bezier(0.4, 0, 0.2, 1) !important;
}

.mobile-menu-overlay.active {
    opacity: 1 !important;
    visibility: visible !important;
}

.mobile-menu-overlay.active .mobile-menu-content {
    right: 0 !important;
}

/* Remove borders from desktop navbar */
@media screen and (min-width: 992px) {
    .navbar ul {
        border: none !important;
    }
    .navbar ul li a {
        border: none !important;
    }
    .dropdown-menu {
        border: none !important;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1) !important;
    }
}

/* Menu item hover effects */
.mobile-menu-content ul li a:hover {
    background: #f8f9fa !important;
    color: #2A52BE !important;
}

.mobile-menu-content ul li a.active {
    color: #2A52BE !important;
    background: #f8f9fa !important;
}

/* Special styling for login button */
.mobile-menu-content ul li:last-child a {
    margin: 20px 0;
    background: #2A52BE !important;
    color: white !important;
    padding: 12px 20px !important;
    border-radius: 6px !important;
    text-align: center !important;
}

.mobile-menu-content ul li:last-child a:hover {
    opacity: 0.9 !important;
}

/* Login Button - Fixed at bottom with enhanced visibility */
        .mobile-menu-content ul li:last-child {
            display: block !important;
            padding: 15px 20px !important;
            background: linear-gradient(135deg, #f8f9ff 0%, #ffffff 100%) !important;
            border-top: 2px solid #667eea !important;
            border-radius: 10px 10px 0 0 !important;
            margin-top: 10px !important;
            text-align: center !important;
        }

        .mobile-menu-content ul li:last-child a {
            display: inline-block !important;
            padding: 12px 20px !important;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
            color: white !important;
            text-decoration: none !important;
            border-radius: 10px !important;
            transition: all 0.3s ease !important;
            font-weight: 600 !important;
            font-size: 16px !important;
            text-align: center !important;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3) !important;
            margin: 0 15px !important;
            position: relative !important;
            overflow: hidden !important;
        }

        .mobile-menu-content ul li:last-child a span {
            position: relative !important;
            z-index: 2 !important;
        }

        .mobile-menu-content ul li:last-child a div {
            position: absolute !important;
            top: 0 !important;
            left: -100% !important;
            width: 100% !important;
            height: 100% !important;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent) !important;
            transition: left 0.5s ease !important;
            z-index: 1 !important;
        }

        .mobile-menu-content ul li:last-child a:hover div {
            left: 0 !important;
        }

        .mobile-menu-content ul li:last-child a:hover {
            opacity: 0.9 !important;
        }

/* Enhanced Login Button Styling */
.mobile-menu-content .login-admin-section {
    flex-shrink: 0;
    padding: 10px 0 15px 0; /* Minimal padding for cleaner look */
    border-top: 2px solid #667eea;
    margin-top: 10px;
    background: linear-gradient(135deg, #f8f9ff 0%, #ffffff 100%);
    border-radius: 8px 8px 0 0;
    position: fixed; /* Changed to fixed for better visibility */
    bottom: 0;
    left: 0;
    right: 0;
    z-index: 100; /* Higher z-index for better visibility */
    box-shadow: 0 -2px 15px rgba(102, 126, 234, 0.2);
    margin-bottom: 0; /* Remove margin bottom */
}

.mobile-menu-content .login-admin-button {
    display: block;
    padding: 15px 25px; /* Slightly larger padding for better touch target */
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); /* More vibrant gradient */
    color: white;
    text-decoration: none;
    border-radius: 12px; /* Slightly more rounded */
    transition: all 0.3s ease;
    font-weight: 700; /* Bolder font */
    font-size: 17px; /* Slightly larger font */
    text-align: center;
    box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4); /* More visible shadow */
    margin: 0 20px; /* More margin for better spacing */
    position: relative;
    overflow: hidden;
    border: 2px solid rgba(255, 255, 255, 0.3); /* More visible border */
    width: calc(100% - 40px); /* Full width minus margins */
    box-sizing: border-box; /* Include padding and border in width calculation */
}

.mobile-menu-content .login-admin-button:hover {
    transform: translateY(-3px) scale(1.05); /* More dramatic hover effect */
    box-shadow: 0 12px 35px rgba(102, 126, 234, 0.7);
    background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
}

.mobile-menu-content .login-admin-button span {
    position: relative;
    z-index: 2;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
}

.mobile-menu-content .login-admin-button::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
    transition: left 0.8s ease;
    z-index: 1;
}

.mobile-menu-content .login-admin-button:hover::before {
    left: 100%;
}

.mobile-menu-content .login-admin-subtitle {
    text-align: center;
    margin-top: 12px;
    font-size: 13px;
    color: #6c757d;
    font-weight: 600;
    opacity: 0.9;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

@keyframes loginButtonGlow {
    0% {
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.5);
        transform: scale(1);
    }
    100% {
        box-shadow: 0 8px 30px rgba(102, 126, 234, 0.8);
        transform: scale(1.02);
    }
}

/* Ensure login button is always visible with proper spacing */
.mobile-menu-content {
    padding-bottom: 30px !important; /* Normal padding since login button is now in menu */
}
</style>

<header id="header" class="d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">
        <div class="logo me-auto">
            <h1><a href="/">
                    <img src="{{ asset('storage/' . $logo->logo) }}" alt="Logo"
                         style="width: 55px; height: 55px; object-fit: cover; object-position: center; border-radius: 8px;">
                </a></h1>
        </div>

        <!-- Super Cool Hamburger Button -->
        <button class="hamburger-btn" id="hamburger-btn" aria-label="Toggle navigation"
                style="
                    display: none !important;
                    position: fixed !important;
                    top: 20px !important;
                    right: 20px !important;
                    width: 60px !important;
                    height: 60px !important;
                    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
                    border: 3px solid rgba(255, 255, 255, 0.9) !important;
                    border-radius: 50% !important;
                    cursor: pointer !important;
                    z-index: 99999 !important;
                    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1) !important;
                    box-shadow: 0 8px 32px rgba(102, 126, 234, 0.4) !important;
                    flex-direction: column !important;
                    justify-content: center !important;
                    align-items: center !important;
                    padding: 0 !important;
                    font-size: 0 !important;
                    visibility: visible !important;
                    opacity: 1 !important;
                    pointer-events: auto !important;
                    backdrop-filter: blur(10px) !important;
                ">
            <span class="hamburger-line" style="
                display: block !important;
                width: 28px !important;
                height: 3px !important;
                background: linear-gradient(90deg, #ffffff 0%, rgba(255, 255, 255, 0.8) 100%) !important;
                margin: 4px 0 !important;
                transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1) !important;
                border-radius: 2px !important;
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2) !important;
            "></span>
            <span class="hamburger-line" style="
                display: block !important;
                width: 28px !important;
                height: 3px !important;
                background: linear-gradient(90deg, #ffffff 0%, rgba(255, 255, 255, 0.8) 100%) !important;
                margin: 4px 0 !important;
                transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1) !important;
                border-radius: 2px !important;
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2) !important;
            "></span>
            <span class="hamburger-line" style="
                display: block !important;
                width: 28px !important;
                height: 3px !important;
                background: linear-gradient(90deg, #ffffff 0%, rgba(255, 255, 255, 0.8) 100%) !important;
                margin: 4px 0 !important;
                transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1) !important;
                border-radius: 2px !important;
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2) !important;
            "></span>
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
<div class="mobile-menu-overlay" id="mobile-menu-overlay" style="
    position: fixed;
    top: 0;
    right: 0;
    bottom: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(5px);
    z-index: 9999;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
">
    <div class="mobile-menu-content" style="
        position: fixed;
        top: 0;
        right: -100%;
        height: 100vh;
        width: 320px;
        background: #ffffff !important;
        padding: 80px 20px 20px !important;
        overflow-y: auto !important;
        transition: right 0.3s ease !important;
        box-shadow: -2px 0 10px rgba(0, 0, 0, 0.1) !important;
        display: flex;
        flex-direction: column;
    ">
        <!-- Main Navigation - Compact -->
        <div style="flex: 1; overflow-y: auto;">
            <ul style="list-style: none; margin: 0; padding: 0;">

                <!-- Beranda -->
                <li><a href="/" style="display: block; padding: 15px 20px; color: #333; text-decoration: none; transition: all 0.3s ease; font-weight: 600; font-size: 16px; border-bottom: 1px solid #f0f0f0; background: linear-gradient(90deg, #f8f9ff 0%, transparent 100%);">
                    <i class="fas fa-home" style="margin-right: 10px; color: #667eea;"></i>Beranda
                </a></li>

                <!-- Profil Desa - Collapsible -->
                <li style="border-bottom: 1px solid #f0f0f0;">
                    <div class="menu-group-header" onclick="toggleMenuGroup(this)" style="display: block; padding: 15px 20px; color: #333; text-decoration: none; transition: all 0.3s ease; font-weight: 600; font-size: 16px; cursor: pointer; background: linear-gradient(90deg, #fff8f8 0%, transparent 100%);">
                        <i class="fas fa-building" style="margin-right: 10px; color: #dc3545;"></i>Profil Desa <span class="toggle-icon" style="float: right; transition: transform 0.3s ease;">▼</span>
                    </div>
                    <div class="menu-group-content" style="display: none; background: #fafafa; padding: 0;">
                        <a href="/wilayah" style="display: block; padding: 12px 30px; color: #666; text-decoration: none; transition: all 0.3s ease; font-size: 14px; border-bottom: 1px solid #f0f0f0;"><i class="fas fa-map-marked-alt" style="margin-right: 8px;"></i>Wilayah</a>
                        <a href="/sejarah" style="display: block; padding: 12px 30px; color: #666; text-decoration: none; transition: all 0.3s ease; font-size: 14px; border-bottom: 1px solid #f0f0f0;"><i class="fas fa-book" style="margin-right: 8px;"></i>Sejarah</a>
                        <a href="/visi-misi" style="display: block; padding: 12px 30px; color: #666; text-decoration: none; transition: all 0.3s ease; font-size: 14px; border-bottom: 1px solid #f0f0f0;"><i class="fas fa-bullseye" style="margin-right: 8px;"></i>Visi & Misi</a>
                        <a href="/perangkat-desa" style="display: block; padding: 12px 30px; color: #666; text-decoration: none; transition: all 0.3s ease; font-size: 14px; border-bottom: 1px solid #f0f0f0;"><i class="fas fa-users" style="margin-right: 8px;"></i>Perangkat Desa</a>
                        <a href="/peta-desa" style="display: block; padding: 12px 30px; color: #666; text-decoration: none; transition: all 0.3s ease; font-size: 14px;"><i class="fas fa-map" style="margin-right: 8px;"></i>Peta Desa</a>
                    </div>
                </li>

                <!-- Informasi - Collapsible -->
                <li style="border-bottom: 1px solid #f0f0f0;">
                    <div class="menu-group-header" onclick="toggleMenuGroup(this)" style="display: block; padding: 15px 20px; color: #333; text-decoration: none; transition: all 0.3s ease; font-weight: 600; font-size: 16px; cursor: pointer; background: linear-gradient(90deg, #f8fff8 0%, transparent 100%);">
                        <i class="fas fa-info-circle" style="margin-right: 10px; color: #28a745;"></i>Informasi <span class="toggle-icon" style="float: right; transition: transform 0.3s ease;">▼</span>
                    </div>
                    <div class="menu-group-content" style="display: none; background: #fafafa; padding: 0;">
                        <a href="/pengumuman" style="display: block; padding: 12px 30px; color: #666; text-decoration: none; transition: all 0.3s ease; font-size: 14px; border-bottom: 1px solid #f0f0f0;"><i class="fas fa-bullhorn" style="margin-right: 8px;"></i>Pengumuman</a>
                        <a href="/berita" style="display: block; padding: 12px 30px; color: #666; text-decoration: none; transition: all 0.3s ease; font-size: 14px; border-bottom: 1px solid #f0f0f0;"><i class="fas fa-newspaper" style="margin-right: 8px;"></i>Berita</a>
                        <a href="/gallery" style="display: block; padding: 12px 30px; color: #666; text-decoration: none; transition: all 0.3s ease; font-size: 14px;"><i class="fas fa-images" style="margin-right: 8px;"></i>Gallery</a>
                    </div>
                </li>

                <!-- Infografis - Collapsible -->
                <li style="border-bottom: 1px solid #f0f0f0;">
                    <div class="menu-group-header" onclick="toggleMenuGroup(this)" style="display: block; padding: 15px 20px; color: #333; text-decoration: none; transition: all 0.3s ease; font-weight: 600; font-size: 16px; cursor: pointer; background: linear-gradient(90deg, #fff8ff 0%, transparent 100%);">
                        <i class="fas fa-chart-bar" style="margin-right: 10px; color: #6f42c1;"></i>Infografis <span class="toggle-icon" style="float: right; transition: transform 0.3s ease;">▼</span>
                    </div>
                    <div class="menu-group-content" style="display: none; background: #fafafa; padding: 0;">
                        <a href="{{ route('infografis.penduduk') }}" style="display: block; padding: 12px 30px; color: #666; text-decoration: none; transition: all 0.3s ease; font-size: 14px; border-bottom: 1px solid #f0f0f0;"><i class="fas fa-users" style="margin-right: 8px;"></i>Penduduk</a>
                        <a href="{{ route('infografis.apbdes') }}" style="display: block; padding: 12px 30px; color: #666; text-decoration: none; transition: all 0.3s ease; font-size: 14px; border-bottom: 1px solid #f0f0f0;"><i class="fas fa-money-bill-wave" style="margin-right: 8px;"></i>APBDes</a>
                        <a href="{{ route('infografis.stunting') }}" style="display: block; padding: 12px 30px; color: #666; text-decoration: none; transition: all 0.3s ease; font-size: 14px; border-bottom: 1px solid #f0f0f0;"><i class="fas fa-child" style="margin-right: 8px;"></i>Stunting</a>
                        <a href="{{ route('infografis.bansos') }}" style="display: block; padding: 12px 30px; color: #666; text-decoration: none; transition: all 0.3s ease; font-size: 14px; border-bottom: 1px solid #f0f0f0;"><i class="fas fa-hand-holding-heart" style="margin-right: 8px;"></i>Bansos</a>
                        <a href="{{ route('idm.index') }}" style="display: block; padding: 12px 30px; color: #666; text-decoration: none; transition: all 0.3s ease; font-size: 14px; border-bottom: 1px solid #f0f0f0;"><i class="fas fa-chart-line" style="margin-right: 8px;"></i>IDM</a>
                        <a href="{{ route('infografis.sdgs') }}" style="display: block; padding: 12px 30px; color: #666; text-decoration: none; transition: all 0.3s ease; font-size: 14px;"><i class="fas fa-globe" style="margin-right: 8px;"></i>SDGs</a>
                    </div>
                </li>

                <!-- Single Items -->
                <li><a href="/umkm" style="display: block; padding: 15px 20px; color: #333; text-decoration: none; transition: all 0.3s ease; font-weight: 600; font-size: 16px; border-bottom: 1px solid #f0f0f0; background: linear-gradient(90deg, #fff8f8 0%, transparent 100%);">
                    <i class="fas fa-store" style="margin-right: 10px; color: #fd7e14;"></i>UMKM
                </a></li>

                <li><a href="/layanan" style="display: block; padding: 15px 20px; color: #333; text-decoration: none; transition: all 0.3s ease; font-weight: 600; font-size: 16px; border-bottom: 1px solid #f0f0f0; background: linear-gradient(90deg, #f8f8ff 0%, transparent 100%);">
                    <i class="fas fa-tools" style="margin-right: 10px; color: #17a2b8;"></i>Layanan
                </a></li>

                <li><a href="/kontak" style="display: block; padding: 15px 20px; color: #333; text-decoration: none; transition: all 0.3s ease; font-weight: 600; font-size: 16px; border-bottom: 1px solid #f0f0f0; background: linear-gradient(90deg, #f8fff8 0%, transparent 100%);">
                    <i class="fas fa-phone" style="margin-right: 10px; color: #6c757d;"></i>Kontak Kami
                </a></li>

                <!-- Login Button moved here with 60px top padding -->
                <li style="padding-top: 60px; border-bottom: none;">
                    <a href="/login" class="login-admin-button" style="display: block; padding: 15px 20px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; text-decoration: none; border-radius: 12px; transition: all 0.3s ease; font-weight: 700; font-size: 17px; text-align: center; box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4); margin: 0 20px; border: 2px solid rgba(255, 255, 255, 0.3);">
                        <i class="fas fa-sign-in-alt" style="margin-right: 8px;"></i>Masuk
                    </a>
                </li>

            </ul>
        </div>
    </div>
</div>

<!-- Load JavaScript files -->
<script src="{{ asset('assets/js/header.js') }}"></script>
<script src="{{ asset('assets/js/hamburger.js') }}"></script>

<!-- Emergency hamburger visibility script - runs immediately -->
<script>
(function() {
    'use strict';

    // Function to force hamburger visibility with cool design
    function showHamburger() {
        // Only show on mobile
        if (window.innerWidth > 991) {
            console.log('💻 Desktop mode - hamburger hidden');
            return false;
        }

        var hamburger = document.getElementById('hamburger-btn');
        if (hamburger) {
            hamburger.style.cssText = `
                display: flex !important;
                position: fixed !important;
                top: 20px !important;
                right: 20px !important;
                width: 60px !important;
                height: 60px !important;
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
                border: 3px solid rgba(255, 255, 255, 0.9) !important;
                border-radius: 50% !important;
                cursor: pointer !important;
                z-index: 99999 !important;
                transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1) !important;
                box-shadow: 0 8px 32px rgba(102, 126, 234, 0.4) !important;
                visibility: visible !important;
                opacity: 1 !important;
                pointer-events: auto !important;
                flex-direction: column !important;
                justify-content: center !important;
                align-items: center !important;
                padding: 0 !important;
                font-size: 0 !important;
                backdrop-filter: blur(10px) !important;
                animation: hamburgerBounceIn 0.6s cubic-bezier(0.4, 0, 0.2, 1) !important;
            `;

            // Style the lines too
            var lines = hamburger.getElementsByClassName('hamburger-line');
            for (var i = 0; i < lines.length; i++) {
                lines[i].style.cssText = `
                    display: block !important;
                    width: 28px !important;
                    height: 3px !important;
                    background: linear-gradient(90deg, #ffffff 0%, rgba(255, 255, 255, 0.8) 100%) !important;
                    margin: 4px 0 !important;
                    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1) !important;
                    border-radius: 2px !important;
                    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2) !important;
                `;
            }

            console.log('🚨 EMERGENCY: Super cool hamburger forced visible on mobile!');
            return true;
        }
        return false;
    }

    // Try to show hamburger immediately
    if (!showHamburger()) {
        // If not found, wait for DOM to be ready
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', showHamburger);
        } else {
            // DOM is already ready
            showHamburger();
        }
    }

    // Also try after a short delay
    setTimeout(showHamburger, 100);
    setTimeout(showHamburger, 500);
    setTimeout(showHamburger, 1000);

    // Try on window load as well
    window.addEventListener('load', showHamburger);

    // Try on resize
    window.addEventListener('resize', showHamburger);

    // Function to toggle menu groups
    function toggleMenuGroup(header) {
        const content = header.nextElementSibling;
        const icon = header.querySelector('.toggle-icon');

        if (content.style.display === 'none' || content.style.display === '') {
            content.style.display = 'block';
            icon.style.transform = 'rotate(180deg)';
            header.style.background = 'linear-gradient(90deg, #e8f4f8 0%, transparent 100%)';
        } else {
            content.style.display = 'none';
            icon.style.transform = 'rotate(0deg)';
            header.style.background = '';
        }
    }

    // Make toggleMenuGroup globally available
    window.toggleMenuGroup = toggleMenuGroup;

    // Enhanced login button visibility
    function ensureLoginButtonVisible() {
        const loginSection = document.querySelector('.login-admin-section');
        const mobileMenu = document.querySelector('.mobile-menu-content');

        if (loginSection && mobileMenu) {
            // Ensure login button is always at the bottom
            loginSection.style.position = 'absolute';
            loginSection.style.bottom = '0';
            loginSection.style.left = '0';
            loginSection.style.right = '0';
            loginSection.style.background = 'white';
            loginSection.style.borderTop = '3px solid #667eea';
            loginSection.style.zIndex = '10';

            // Add extra padding to menu content to prevent overlap
            mobileMenu.style.paddingBottom = '140px';
        }
    }

    // Call on menu open
    function onMenuOpen() {
        setTimeout(ensureLoginButtonVisible, 100);
        setTimeout(ensureLoginButtonVisible, 500);
    }

    // Add event listener for menu toggle
    var hamburgerBtn = document.getElementById('hamburger-btn');
    if (hamburgerBtn) {
        hamburgerBtn.addEventListener('click', function() {
            setTimeout(onMenuOpen, 300);
        });
    }

    // Initial call
    ensureLoginButtonVisible();
})();
</script>
