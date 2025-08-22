<!-- ======= Header ======= -->
<style>
/* Modern Glass-Morphism Navbar */
#header {
  background: rgba(0, 0, 0, 0.02) !important;
  backdrop-filter: blur(30px) saturate(200%) !important;
  -webkit-backdrop-filter: blur(30px) saturate(200%) !important;
  border-bottom: 1px solid rgba(255, 255, 255, 0.08) !important;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03) !important;
  position: fixed !important;
  top: 0 !important;
  left: 0 !important;
  right: 0 !important;
  z-index: 9999 !important;
  transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1) !important;
}

/* Transparent state - completely integrated with slider */
#header.transparent,
#header.header-transparent {
  background: rgba(0, 0, 0, 0) !important;
  backdrop-filter: blur(25px) saturate(250%) !important;
  -webkit-backdrop-filter: blur(25px) saturate(250%) !important;
  border-bottom: 1px solid rgba(255, 255, 255, 0.05) !important;
  box-shadow: 0 2px 15px rgba(0, 0, 0, 0.02) !important;
}

/* Scrolled state - more solid for readability */
#header.header-scrolled,
#header.scrolled {
  background: rgba(255, 255, 255, 0.92) !important;
  backdrop-filter: blur(35px) saturate(180%) !important;
  -webkit-backdrop-filter: blur(35px) saturate(180%) !important;
  border-bottom: 1px solid rgba(0, 0, 0, 0.08) !important;
  box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12) !important;
}

/* Logo styling with square aspect ratio */
#header .logo img {
  width: 55px !important;
  height: 55px !important;
  object-fit: cover !important;
  object-position: center !important;
  border-radius: 8px !important;
  filter: drop-shadow(0 3px 8px rgba(0,0,0,0.4)) brightness(1.15) contrast(1.25) !important;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
  background: rgba(255, 255, 255, 0.1) !important;
  border: 2px solid rgba(255, 255, 255, 0.2) !important;
}

/* Logo in transparent state */
#header.transparent .logo img,
#header.header-transparent .logo img {
  filter: drop-shadow(0 4px 12px rgba(0,0,0,0.6)) brightness(1.2) contrast(1.35) !important;
  border: 2px solid rgba(255, 255, 255, 0.3) !important;
  background: rgba(255, 255, 255, 0.15) !important;
}

/* Logo hover effect */
#header .logo img:hover {
  transform: scale(1.05) !important;
  filter: drop-shadow(0 6px 20px rgba(0,0,0,0.5)) brightness(1.3) contrast(1.4) !important;
}

/* Navigation styling with elegant glass effect */
#navbar ul {
  background: rgba(255, 255, 255, 0.05) !important;
  backdrop-filter: blur(15px) !important;
  border-radius: 30px !important;
  padding: 8px 15px !important;
  border: 1px solid rgba(255, 255, 255, 0.12) !important;
  box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2) !important;
}

#navbar ul li a {
  color: #ffffff !important;
  font-weight: 600 !important;
  text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.8) !important;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
  padding: 12px 20px !important;
  margin: 0 4px !important;
  border-radius: 25px !important;
  position: relative !important;
}

#navbar ul li a:hover,
#navbar ul li a.active {
  color: #ffffff !important;
  background: rgba(255, 255, 255, 0.25) !important;
  backdrop-filter: blur(20px) !important;
  transform: translateY(-2px) scale(1.02) !important;
  box-shadow: 0 6px 20px rgba(255, 255, 255, 0.25), 
              inset 0 1px 0 rgba(255, 255, 255, 0.3) !important;
  text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.9) !important;
}

/* Dropdown menu styling */
#navbar ul li.dropdown ul {
  background: rgba(255, 255, 255, 0.96) !important;
  backdrop-filter: blur(30px) !important;
  border: 1px solid rgba(255, 255, 255, 0.3) !important;
  box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15) !important;
  border-radius: 15px !important;
  padding: 10px 0 !important;
  margin-top: 8px !important;
}

#navbar ul li.dropdown ul li a {
  color: #2c3e50 !important;
  text-shadow: none !important;
  padding: 12px 25px !important;
  border-radius: 0 !important;
  margin: 0 !important;
}

#navbar ul li.dropdown ul li a:hover {
  background: rgba(52, 152, 219, 0.1) !important;
  color: #3498db !important;
  transform: translateX(5px) !important;
}

/* Mobile navigation toggle */
.mobile-nav-toggle {
  color: #ffffff !important;
  background: rgba(255, 255, 255, 0.18) !important;
  backdrop-filter: blur(15px) !important;
  border-radius: 10px !important;
  padding: 10px !important;
  border: 2px solid rgba(255, 255, 255, 0.25) !important;
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2) !important;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
  font-size: 20px !important;
}

.mobile-nav-toggle:hover {
  background: rgba(255, 255, 255, 0.3) !important;
  transform: scale(1.1) rotate(90deg) !important;
  border-color: rgba(255, 255, 255, 0.4) !important;
}

/* Smooth scrolling effect for all links */
#navbar ul li a[href^="#"] {
  scroll-behavior: smooth !important;
}

/* Animation for page load */
@keyframes fadeInGlass {
  from {
    opacity: 0;
    backdrop-filter: blur(0px);
    transform: translateY(-20px);
  }
  to {
    opacity: 1;
    backdrop-filter: blur(30px);
    transform: translateY(0);
  }
}

#header {
  animation: fadeInGlass 0.8s ease-out !important;
}
</style>

<header id="header" class="d-flex align-items-center">
    <div class="container d-flex align-items-center">

        <div class="logo me-auto">
            <h1><a href="/">
                    <img src="{{ asset('storage/' . $logo->logo) }}" alt="Logo" 
                         style="width: 55px; height: 55px; object-fit: cover; object-position: center; border-radius: 8px;">
                </a></h1>
        </div>

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
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

    </div>
</header><!-- End Header -->

<script>
// Enhanced navbar scroll effect with seamless transparency
document.addEventListener('DOMContentLoaded', function() {
    const header = document.getElementById('header');
    const heroSection = document.getElementById('hero');
    
    // Set initial completely transparent state for hero section
    if (heroSection) {
        header.classList.add('transparent', 'header-transparent');
    }
    
    // Smooth scroll handling with improved performance
    let ticking = false;
    
    function updateHeader() {
        const scrolled = window.pageYOffset;
        const heroHeight = heroSection ? heroSection.offsetHeight - 120 : 400;
        
        if (scrolled > heroHeight) {
            // Scrolled past hero - solid navbar for readability
            header.classList.add('scrolled', 'header-scrolled');
            header.classList.remove('transparent', 'header-transparent');
            
            // Update navigation colors for light background
            const navLinks = header.querySelectorAll('#navbar ul li a');
            navLinks.forEach(link => {
                link.style.color = '#2c3e50';
                link.style.textShadow = 'none';
                
                // Update hover styles
                link.addEventListener('mouseenter', function() {
                    this.style.background = 'rgba(52, 152, 219, 0.1)';
                    this.style.color = '#3498db';
                });
                
                link.addEventListener('mouseleave', function() {
                    if (!this.classList.contains('active')) {
                        this.style.background = 'transparent';
                        this.style.color = '#2c3e50';
                    }
                });
            });
            
            // Update mobile toggle for light background
            const mobileToggle = header.querySelector('.mobile-nav-toggle');
            if (mobileToggle) {
                mobileToggle.style.color = '#2c3e50';
                mobileToggle.style.background = 'rgba(44, 62, 80, 0.1)';
                mobileToggle.style.borderColor = 'rgba(44, 62, 80, 0.2)';
            }
            
            // Update navbar container
            const navbarUl = header.querySelector('#navbar ul');
            if (navbarUl) {
                navbarUl.style.background = 'rgba(255, 255, 255, 0.9)';
                navbarUl.style.borderColor = 'rgba(0, 0, 0, 0.1)';
            }
            
        } else {
            // In hero section - transparent glass effect
            header.classList.remove('scrolled', 'header-scrolled');
            header.classList.add('transparent', 'header-transparent');
            
            // Update navigation colors for transparent background
            const navLinks = header.querySelectorAll('#navbar ul li a');
            navLinks.forEach(link => {
                link.style.color = '#ffffff';
                link.style.textShadow = '1px 1px 4px rgba(0, 0, 0, 0.8)';
                
                // Reset hover styles
                link.removeEventListener('mouseenter', function() {});
                link.removeEventListener('mouseleave', function() {});
            });
            
            // Reset mobile toggle for transparent background
            const mobileToggle = header.querySelector('.mobile-nav-toggle');
            if (mobileToggle) {
                mobileToggle.style.color = '#ffffff';
                mobileToggle.style.background = 'rgba(255, 255, 255, 0.18)';
                mobileToggle.style.borderColor = 'rgba(255, 255, 255, 0.25)';
            }
            
            // Reset navbar container
            const navbarUl = header.querySelector('#navbar ul');
            if (navbarUl) {
                navbarUl.style.background = 'rgba(255, 255, 255, 0.05)';
                navbarUl.style.borderColor = 'rgba(255, 255, 255, 0.12)';
            }
        }
        
        ticking = false;
    }
    
    function requestTick() {
        if (!ticking) {
            requestAnimationFrame(updateHeader);
            ticking = true;
        }
    }
    
    // Optimized scroll listener
    window.addEventListener('scroll', requestTick, { passive: true });
    
    // Trigger initial check
    updateHeader();
    
    // Smooth scrolling for anchor links
    const anchorLinks = document.querySelectorAll('a[href^="#"]');
    anchorLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            const targetId = this.getAttribute('href');
            const targetSection = document.querySelector(targetId);
            
            if (targetSection) {
                e.preventDefault();
                const headerHeight = header.offsetHeight;
                const targetPosition = targetSection.getBoundingClientRect().top + window.pageYOffset - headerHeight - 20;
                
                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });
    
    // Enhanced mobile menu toggle
    const mobileToggle = document.querySelector('.mobile-nav-toggle');
    if (mobileToggle) {
        mobileToggle.addEventListener('click', function() {
            const navbar = document.querySelector('#navbar');
            navbar.classList.toggle('navbar-mobile');
            
            // Animate the toggle icon
            if (navbar.classList.contains('navbar-mobile')) {
                this.innerHTML = '<i class="bi bi-x"></i>';
                this.style.transform = 'scale(1.1) rotate(90deg)';
            } else {
                this.innerHTML = '<i class="bi bi-list"></i>';
                this.style.transform = 'scale(1) rotate(0deg)';
            }
        });
    }
});
</script>
