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

@keyframes menuSlideIn {
    0% {
        transform: translateY(50px) scale(0.9);
        opacity: 0;
    }
    100% {
        transform: translateY(0) scale(1);
        opacity: 1;
    }
}

/* Menu item hover effects */
.mobile-menu-content ul li a:hover {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
    color: white !important;
    transform: translateY(-3px) scale(1.02) !important;
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3) !important;
    border-color: rgba(102, 126, 234, 0.5) !important;
}

/* Special styling for login button */
.mobile-menu-content ul li:last-child a:hover {
    background: linear-gradient(135deg, #764ba2 0%, #667eea 100%) !important;
    transform: translateY(-3px) scale(1.05) !important;
    box-shadow: 0 10px 30px rgba(102, 126, 234, 0.5) !important;
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
<div class="mobile-menu-overlay" id="mobile-menu-overlay">
    <div class="mobile-menu-content" style="
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.98) 100%) !important;
        padding: 40px 30px !important;
        border-radius: 25px !important;
        max-width: 380px !important;
        width: 90% !important;
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.5) !important;
        backdrop-filter: blur(20px) !important;
        border: 1px solid rgba(255, 255, 255, 0.3) !important;
        transform: translateY(50px) scale(0.9) !important;
        transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1) !important;
    ">
        <ul style="list-style: none; margin: 0; padding: 0;">
            <li><a href="/" style="display: block; padding: 18px 30px; color: #333; text-decoration: none; border-radius: 15px; transition: all 0.3s ease; font-weight: 600; font-size: 17px; margin: 8px 0; border: 1px solid rgba(102, 126, 234, 0.1);">🏠 Beranda</a></li>
            <li><a href="/wilayah" style="display: block; padding: 18px 30px; color: #333; text-decoration: none; border-radius: 15px; transition: all 0.3s ease; font-weight: 600; font-size: 17px; margin: 8px 0; border: 1px solid rgba(102, 126, 234, 0.1);">🗺️ Wilayah</a></li>
            <li><a href="/sejarah" style="display: block; padding: 18px 30px; color: #333; text-decoration: none; border-radius: 15px; transition: all 0.3s ease; font-weight: 600; font-size: 17px; margin: 8px 0; border: 1px solid rgba(102, 126, 234, 0.1);">📚 Sejarah</a></li>
            <li><a href="/visi-misi" style="display: block; padding: 18px 30px; color: #333; text-decoration: none; border-radius: 15px; transition: all 0.3s ease; font-weight: 600; font-size: 17px; margin: 8px 0; border: 1px solid rgba(102, 126, 234, 0.1);">🎯 Visi & Misi</a></li>
            <li><a href="/perangkat-desa" style="display: block; padding: 18px 30px; color: #333; text-decoration: none; border-radius: 15px; transition: all 0.3s ease; font-weight: 600; font-size: 17px; margin: 8px 0; border: 1px solid rgba(102, 126, 234, 0.1);">👥 Perangkat Desa</a></li>
            <li><a href="/peta-desa" style="display: block; padding: 18px 30px; color: #333; text-decoration: none; border-radius: 15px; transition: all 0.3s ease; font-weight: 600; font-size: 17px; margin: 8px 0; border: 1px solid rgba(102, 126, 234, 0.1);">🗺️ Peta Desa</a></li>
            <li><a href="/pengumuman" style="display: block; padding: 18px 30px; color: #333; text-decoration: none; border-radius: 15px; transition: all 0.3s ease; font-weight: 600; font-size: 17px; margin: 8px 0; border: 1px solid rgba(102, 126, 234, 0.1);">📢 Pengumuman</a></li>
            <li><a href="/berita" style="display: block; padding: 18px 30px; color: #333; text-decoration: none; border-radius: 15px; transition: all 0.3s ease; font-weight: 600; font-size: 17px; margin: 8px 0; border: 1px solid rgba(102, 126, 234, 0.1);">📰 Berita</a></li>
            <li><a href="/gallery" style="display: block; padding: 18px 30px; color: #333; text-decoration: none; border-radius: 15px; transition: all 0.3s ease; font-weight: 600; font-size: 17px; margin: 8px 0; border: 1px solid rgba(102, 126, 234, 0.1);">🖼️ Gallery</a></li>
            <li><a href="{{ route('infografis.penduduk') }}" style="display: block; padding: 18px 30px; color: #333; text-decoration: none; border-radius: 15px; transition: all 0.3s ease; font-weight: 600; font-size: 17px; margin: 8px 0; border: 1px solid rgba(102, 126, 234, 0.1);">👥 Infografis Penduduk</a></li>
            <li><a href="{{ route('infografis.apbdes') }}" style="display: block; padding: 18px 30px; color: #333; text-decoration: none; border-radius: 15px; transition: all 0.3s ease; font-weight: 600; font-size: 17px; margin: 8px 0; border: 1px solid rgba(102, 126, 234, 0.1);">💰 Infografis APBDes</a></li>
            <li><a href="{{ route('infografis.stunting') }}" style="display: block; padding: 18px 30px; color: #333; text-decoration: none; border-radius: 15px; transition: all 0.3s ease; font-weight: 600; font-size: 17px; margin: 8px 0; border: 1px solid rgba(102, 126, 234, 0.1);">👶 Infografis Stunting</a></li>
            <li><a href="{{ route('infografis.bansos') }}" style="display: block; padding: 18px 30px; color: #333; text-decoration: none; border-radius: 15px; transition: all 0.3s ease; font-weight: 600; font-size: 17px; margin: 8px 0; border: 1px solid rgba(102, 126, 234, 0.1);">🤝 Infografis Bansos</a></li>
            <li><a href="{{ route('idm.index') }}" style="display: block; padding: 18px 30px; color: #333; text-decoration: none; border-radius: 15px; transition: all 0.3s ease; font-weight: 600; font-size: 17px; margin: 8px 0; border: 1px solid rgba(102, 126, 234, 0.1);">📊 IDM</a></li>
            <li><a href="{{ route('infografis.sdgs') }}" style="display: block; padding: 18px 30px; color: #333; text-decoration: none; border-radius: 15px; transition: all 0.3s ease; font-weight: 600; font-size: 17px; margin: 8px 0; border: 1px solid rgba(102, 126, 234, 0.1);">🌍 SDGs</a></li>
            <li><a href="/umkm" style="display: block; padding: 18px 30px; color: #333; text-decoration: none; border-radius: 15px; transition: all 0.3s ease; font-weight: 600; font-size: 17px; margin: 8px 0; border: 1px solid rgba(102, 126, 234, 0.1);">🏪 UMKM</a></li>
            <li><a href="/layanan" style="display: block; padding: 18px 30px; color: #333; text-decoration: none; border-radius: 15px; transition: all 0.3s ease; font-weight: 600; font-size: 17px; margin: 8px 0; border: 1px solid rgba(102, 126, 234, 0.1);">🛠️ Layanan</a></li>
            <li><a href="/kontak" style="display: block; padding: 18px 30px; color: #333; text-decoration: none; border-radius: 15px; transition: all 0.3s ease; font-weight: 600; font-size: 17px; margin: 8px 0; border: 1px solid rgba(102, 126, 234, 0.1);">📞 Kontak Kami</a></li>
            <li><a href="/login" style="display: block; padding: 18px 30px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; text-decoration: none; border-radius: 15px; transition: all 0.3s ease; font-weight: 600; font-size: 17px; margin: 8px 0; text-align: center; box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);">🔐 Masuk</a></li>
        </ul>
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

})();
</script>
