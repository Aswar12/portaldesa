/* ===== HAMBURGER MENU JAVASCRIPT ===== */
/* Clean, conflict-free hamburger menu functionality */

document.addEventListener('DOMContentLoaded', function () {
    console.log('=== HAMBURGER MENU INITIALIZING ===');

    // Get elements
    const hamburgerBtn = document.getElementById('hamburger-btn');
    const mobileMenuOverlay = document.getElementById('mobile-menu-overlay');
    const navbar = document.getElementById('navbar');

    console.log('Elements found:', {
        hamburgerBtn: !!hamburgerBtn,
        mobileMenuOverlay: !!mobileMenuOverlay,
        navbar: !!navbar
    });

    // Initialize hamburger menu if elements exist
    if (hamburgerBtn && mobileMenuOverlay) {
        initializeHamburgerMenu(hamburgerBtn, mobileMenuOverlay);
    }

    // Initialize mobile navbar if elements exist
    if (hamburgerBtn && navbar) {
        initializeMobileNavbar(hamburgerBtn, navbar);
    }

    console.log('=== HAMBURGER MENU INITIALIZATION COMPLETE ===');
});

function initializeHamburgerMenu(hamburgerBtn, mobileMenuOverlay) {
    console.log('🔧 Initializing hamburger menu with overlay');

    // Add visual indicator that script is working
    hamburgerBtn.style.border = '3px solid #00ff00';
    setTimeout(() => {
        hamburgerBtn.style.border = '';
    }, 2000);

    // Toggle menu function
    function toggleMenu() {
        console.log('🔥 Hamburger clicked!');

        // Toggle classes
        hamburgerBtn.classList.toggle('active');
        mobileMenuOverlay.classList.toggle('active');
        document.body.classList.toggle('no-scroll');

        const isOpen = mobileMenuOverlay.classList.contains('active');
        console.log('Menu state:', isOpen ? 'OPEN' : 'CLOSED');
    }

    // Add click event listener
    hamburgerBtn.addEventListener('click', function (e) {
        e.preventDefault();
        e.stopPropagation();
        toggleMenu();
    });

    // Close menu when clicking on links
    const menuLinks = mobileMenuOverlay.querySelectorAll('a');
    menuLinks.forEach(link => {
        link.addEventListener('click', function () {
            hamburgerBtn.classList.remove('active');
            mobileMenuOverlay.classList.remove('active');
            document.body.classList.remove('no-scroll');
            console.log('Menu closed via link click');
        });
    });

    // Close menu when clicking outside
    mobileMenuOverlay.addEventListener('click', function (e) {
        if (e.target === this) {
            hamburgerBtn.classList.remove('active');
            mobileMenuOverlay.classList.remove('active');
            document.body.classList.remove('no-scroll');
            console.log('Menu closed via outside click');
        }
    });

    // Close on escape key
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && mobileMenuOverlay.classList.contains('active')) {
            hamburgerBtn.classList.remove('active');
            mobileMenuOverlay.classList.remove('active');
            document.body.classList.remove('no-scroll');
            console.log('Menu closed via ESC key');
        }
    });

    console.log('✅ Hamburger menu with overlay initialized successfully!');
}

function initializeMobileNavbar(hamburgerBtn, navbar) {
    console.log('🔧 Initializing mobile navbar');

    // Toggle mobile navbar function
    function toggleMobileNavbar() {
        console.log('🔥 Mobile navbar toggle clicked!');

        // Toggle classes
        hamburgerBtn.classList.toggle('active');
        navbar.classList.toggle('navbar-mobile');
        document.body.classList.toggle('no-scroll');

        const isOpen = navbar.classList.contains('navbar-mobile');
        console.log('Mobile navbar state:', isOpen ? 'OPEN' : 'CLOSED');

        // Force visibility for debugging
        if (isOpen) {
            navbar.style.display = 'flex';
            navbar.style.opacity = '1';
            navbar.style.visibility = 'visible';
            console.log('✅ Mobile navbar forced to show');
        }
    }

    // Add click event listener to hamburger
    hamburgerBtn.addEventListener('click', function (e) {
        e.preventDefault();
        e.stopPropagation();
        toggleMobileNavbar();
    });

    // Handle dropdown menus in mobile
    const dropdownLinks = navbar.querySelectorAll('.dropdown > a');
    dropdownLinks.forEach((link, index) => {
        link.addEventListener('click', function (e) {
            if (navbar.classList.contains('navbar-mobile')) {
                e.preventDefault();
                const dropdown = this.nextElementSibling;
                if (dropdown) {
                    dropdown.classList.toggle('dropdown-active');
                    console.log(`Dropdown ${index} toggled`);
                }
            }
        });
    });

    // Close menu when clicking on menu items
    const menuLinks = navbar.querySelectorAll('a');
    menuLinks.forEach(link => {
        link.addEventListener('click', function () {
            if (navbar.classList.contains('navbar-mobile')) {
                hamburgerBtn.classList.remove('active');
                navbar.classList.remove('navbar-mobile');
                document.body.classList.remove('no-scroll');
                console.log('Mobile navbar closed via menu item click');
            }
        });
    });

    // Close menu when clicking outside
    document.addEventListener('click', function (e) {
        if (!navbar.contains(e.target) && !hamburgerBtn.contains(e.target)) {
            hamburgerBtn.classList.remove('active');
            navbar.classList.remove('navbar-mobile');
            document.body.classList.remove('no-scroll');
            console.log('Mobile navbar closed via outside click');
        }
    });

    // Close menu on window resize
    window.addEventListener('resize', function () {
        if (window.innerWidth > 991) {
            hamburgerBtn.classList.remove('active');
            navbar.classList.remove('navbar-mobile');
            document.body.classList.remove('no-scroll');
            console.log('Mobile navbar closed via window resize');
        }
    });

    console.log('✅ Mobile navbar initialized successfully!');
}

/* ===== EMERGENCY FALLBACK SCRIPTS ===== */
/* These run after a delay to ensure everything is loaded */

// Force hamburger visibility
function forceHamburgerVisibility() {
    const hamburger = document.getElementById('hamburger-btn');
    if (hamburger && window.innerWidth <= 991) {
        hamburger.style.display = 'flex';
        hamburger.style.visibility = 'visible';
        hamburger.style.opacity = '1';
        hamburger.style.pointerEvents = 'auto';
        console.log('🚀 Emergency hamburger visibility forced!');
    }
}

// Run emergency scripts with delays
setTimeout(forceHamburgerVisibility, 100);
setTimeout(forceHamburgerVisibility, 500);
setTimeout(forceHamburgerVisibility, 1000);

// Run on window resize
window.addEventListener('resize', forceHamburgerVisibility);

// Monitoring script
function monitorHamburgerStatus() {
    const hamburger = document.getElementById('hamburger-btn');
    const mobileMenu = document.getElementById('mobile-menu-overlay');

    if (hamburger) {
        const computedStyle = window.getComputedStyle(hamburger);
        console.log('📊 Hamburger Status:', {
            display: computedStyle.display,
            visibility: computedStyle.visibility,
            opacity: computedStyle.opacity,
            zIndex: computedStyle.zIndex
        });
    } else {
        console.log('❌ Hamburger button not found!');
    }

    if (mobileMenu) {
        const computedStyle = window.getComputedStyle(mobileMenu);
        console.log('📊 Mobile Menu Status:', {
            display: computedStyle.display,
            position: computedStyle.position,
            zIndex: computedStyle.zIndex
        });
    }
}

// Start monitoring
setInterval(monitorHamburgerStatus, 5000); // Check every 5 seconds
setTimeout(monitorHamburgerStatus, 2000); // Initial check
