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

    // FORCE HAMBURGER TO SHOW - Multiple approaches with cool design
    function forceHamburgerVisibility() {
        // Only show on mobile
        if (window.innerWidth > 991) {
            console.log('💻 Desktop mode - hamburger hidden');
            const hamburger = document.getElementById('hamburger-btn');
            if (hamburger) {
                hamburger.style.display = 'none';
            }
            return;
        }

        const hamburger = document.getElementById('hamburger-btn');
        if (hamburger) {
            // Apply super cool styles
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
            `;

            // Style the lines with gradient
            const lines = hamburger.getElementsByClassName('hamburger-line');
            for (let i = 0; i < lines.length; i++) {
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

            console.log('🚀 Super cool hamburger forced visible on mobile!');
        }
    }

    // Apply immediately
    forceHamburgerVisibility();

    // Apply again after delays
    setTimeout(forceHamburgerVisibility, 100);
    setTimeout(forceHamburgerVisibility, 500);
    setTimeout(forceHamburgerVisibility, 1000);

    // Apply on window resize
    window.addEventListener('resize', function () {
        setTimeout(forceHamburgerVisibility, 100);
    });

    // Also apply on orientation change (mobile)
    window.addEventListener('orientationchange', function () {
        setTimeout(forceHamburgerVisibility, 200);
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

    // Add ripple effect to hamburger button
    hamburgerBtn.addEventListener('click', function (e) {
        // Create ripple effect
        const ripple = document.createElement('span');
        ripple.style.cssText = `
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.4);
            transform: scale(0);
            animation: ripple 0.6s linear;
            pointer-events: none;
        `;

        const rect = this.getBoundingClientRect();
        const size = Math.max(rect.width, rect.height);
        const x = e.clientX - rect.left - size / 2;
        const y = e.clientY - rect.top - size / 2;

        ripple.style.width = ripple.style.height = size + 'px';
        ripple.style.left = x + 'px';
        ripple.style.top = y + 'px';

        this.appendChild(ripple);

        setTimeout(() => {
            ripple.remove();
        }, 600);
    });

    // Add ripple animation
    const style = document.createElement('style');
    style.textContent = `
        @keyframes ripple {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }
    `;
    document.head.appendChild(style);

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

// VERIFICATION SCRIPT - Check everything is working
function verifySetup() {
    const hamburger = document.getElementById('hamburger-btn');
    const mobileMenu = document.getElementById('mobile-menu-overlay');
    const navbar = document.getElementById('navbar');
    const isMobile = window.innerWidth <= 991;

    console.log('=== 🎨 SUPER COOL HAMBURGER VERIFICATION ===');
    console.log('📱 Screen width:', window.innerWidth + 'px');
    console.log('📱 Is mobile:', isMobile ? 'YES' : 'NO');
    console.log('🍔 Hamburger button:', hamburger ? '✅ FOUND' : '❌ NOT FOUND');
    console.log('📋 Mobile menu overlay:', mobileMenu ? '✅ FOUND' : '❌ NOT FOUND');
    console.log('🧭 Navbar:', navbar ? '✅ FOUND' : '❌ NOT FOUND');

    if (hamburger) {
        const style = window.getComputedStyle(hamburger);
        console.log('🎨 Hamburger computed style:', {
            display: style.display,
            visibility: style.visibility,
            opacity: style.opacity,
            position: style.position,
            zIndex: style.zIndex,
            background: style.background,
            borderRadius: style.borderRadius
        });

        if (isMobile) {
            console.log('✅ Hamburger should be VISIBLE on mobile');
        } else {
            console.log('✅ Hamburger should be HIDDEN on desktop');
        }
    }

    // Check if borders are removed
    const topbar = document.getElementById('topbar');
    const header = document.getElementById('header');
    if (topbar) {
        const topbarStyle = window.getComputedStyle(topbar);
        console.log('🗂️ Topbar border:', topbarStyle.borderBottom);
    }
    if (header) {
        const headerStyle = window.getComputedStyle(header);
        console.log('🗂️ Header border:', headerStyle.border);
        console.log('🗂️ Header box-shadow:', headerStyle.boxShadow);
    }

    console.log('=== 🎉 VERIFICATION COMPLETE ===');

    if (hamburger && isMobile) {
        console.log('🎊 SUCCESS: Super cool hamburger is ready on mobile!');
    } else if (!isMobile) {
        console.log('💻 SUCCESS: Hamburger hidden on desktop as expected!');
    }
}

// Run verification
setTimeout(verifySetup, 1500);
