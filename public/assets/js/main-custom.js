// ===================================
// JAVASCRIPT PUSAT PORTAL DESA
// File untuk semua interaktivitas website
// ===================================

document.addEventListener('DOMContentLoaded', function () {
    // Initialize all functions
    initNavbarScroll();
    initCounterAnimation();
    initSmoothScrolling();
    initCarouselAutoHeight();
    initPreloader();

    console.log('Portal Desa JavaScript initialized');
});

// ===================================
// NAVBAR SCROLL EFFECT
// ===================================
function initNavbarScroll() {
    const header = document.getElementById('header');
    const heroSection = document.getElementById('hero');

    if (!header) return;

    // Set initial transparent state for hero section
    if (heroSection) {
        header.classList.add('transparent', 'header-transparent');
    }

    // Throttled scroll handler for performance
    let ticking = false;

    function updateHeader() {
        const scrolled = window.pageYOffset;
        const heroHeight = heroSection ? heroSection.offsetHeight - 120 : 400;

        if (scrolled > heroHeight) {
            // Scrolled past hero - solid navbar for readability
            header.classList.add('scrolled', 'header-scrolled');
            header.classList.remove('transparent', 'header-transparent');
        } else {
            // Still in hero section - keep transparent
            header.classList.remove('scrolled', 'header-scrolled');
            if (heroSection) {
                header.classList.add('transparent', 'header-transparent');
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

    window.addEventListener('scroll', requestTick, { passive: true });

    // Initial call
    updateHeader();
}

// ===================================
// COUNTER ANIMATION
// ===================================
function initCounterAnimation() {
    const counters = document.querySelectorAll('.stat-number[data-count]');

    if (counters.length === 0) return;

    // Intersection Observer for triggering animation when visible
    const observerOptions = {
        threshold: 0.5,
        rootMargin: '0px 0px -100px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                animateCounter(entry.target);
                observer.unobserve(entry.target); // Animate only once
            }
        });
    }, observerOptions);

    // Observe all counters
    counters.forEach(counter => observer.observe(counter));

    function animateCounter(counter) {
        const target = parseInt(counter.getAttribute('data-count'));
        const duration = 2500; // 2.5 seconds
        const increment = target / (duration / 16); // 60fps
        let current = 0;

        counter.classList.add('counting');

        const timer = setInterval(() => {
            current += increment;

            if (current >= target) {
                counter.textContent = formatNumber(target);
                clearInterval(timer);
                counter.classList.remove('counting');
            } else {
                counter.textContent = formatNumber(Math.floor(current));
            }
        }, 16);
    }

    function formatNumber(num) {
        return num.toLocaleString('id-ID');
    }
}

// ===================================
// SMOOTH SCROLLING
// ===================================
function initSmoothScrolling() {
    // Handle smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const targetId = this.getAttribute('href');
            const target = document.querySelector(targetId);

            if (target) {
                e.preventDefault();
                const offsetTop = target.offsetTop - 80; // Offset for fixed navbar

                window.scrollTo({
                    top: offsetTop,
                    behavior: 'smooth'
                });

                // Update URL without jumping
                history.pushState(null, null, targetId);
            }
        });
    });
}

// ===================================
// CAROUSEL AUTO HEIGHT
// ===================================
function initCarouselAutoHeight() {
    const carousel = document.getElementById('heroCarousel');
    if (!carousel) return;

    // Ensure carousel items are full height
    const carouselItems = carousel.querySelectorAll('.carousel-item');
    carouselItems.forEach(item => {
        item.style.minHeight = '100vh';
    });

    // Handle window resize
    window.addEventListener('resize', debounce(() => {
        carouselItems.forEach(item => {
            item.style.minHeight = '100vh';
        });
    }, 250));
}

// ===================================
// PRELOADER
// ===================================
function initPreloader() {
    const preloader = document.querySelector('.preloader');

    if (preloader) {
        // Hide preloader after page load
        window.addEventListener('load', () => {
            setTimeout(() => {
                preloader.classList.add('fade-out');
                setTimeout(() => {
                    preloader.remove();
                }, 500);
            }, 500);
        });
    }
}

// ===================================
// CARD HOVER EFFECTS
// ===================================
function initCardEffects() {
    const cards = document.querySelectorAll('.news-card .card, .stat-card, .icon-box');

    cards.forEach(card => {
        card.addEventListener('mouseenter', function () {
            this.style.transform = 'translateY(-10px) scale(1.02)';
        });

        card.addEventListener('mouseleave', function () {
            this.style.transform = 'translateY(0) scale(1)';
        });
    });
}

// ===================================
// SCROLL ANIMATIONS
// ===================================
function initScrollAnimations() {
    const animatedElements = document.querySelectorAll('.fade-in-up, .slide-in-left');

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0) translateX(0)';
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    });

    animatedElements.forEach(el => {
        el.style.opacity = '0';
        if (el.classList.contains('fade-in-up')) {
            el.style.transform = 'translateY(30px)';
        } else if (el.classList.contains('slide-in-left')) {
            el.style.transform = 'translateX(-30px)';
        }
        observer.observe(el);
    });
}

// ===================================
// UTILITY FUNCTIONS
// ===================================

// Debounce function for performance
function debounce(func, wait, immediate) {
    let timeout;
    return function executedFunction() {
        const context = this;
        const args = arguments;

        const later = function () {
            timeout = null;
            if (!immediate) func.apply(context, args);
        };

        const callNow = immediate && !timeout;
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);

        if (callNow) func.apply(context, args);
    };
}

// Throttle function for scroll events
function throttle(func, limit) {
    let inThrottle;
    return function () {
        const args = arguments;
        const context = this;
        if (!inThrottle) {
            func.apply(context, args);
            inThrottle = true;
            setTimeout(() => inThrottle = false, limit);
        }
    };
}

// Get current scroll position
function getScrollPosition() {
    return window.pageYOffset || document.documentElement.scrollTop;
}

// Check if element is in viewport
function isInViewport(element, offset = 0) {
    const rect = element.getBoundingClientRect();
    return (
        rect.top >= offset &&
        rect.left >= 0 &&
        rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) - offset &&
        rect.right <= (window.innerWidth || document.documentElement.clientWidth)
    );
}

// Format numbers with Indonesian locale
function formatIndonesianNumber(num) {
    return new Intl.NumberFormat('id-ID').format(num);
}

// ===================================
// LAZY LOADING IMAGES
// ===================================
function initLazyLoading() {
    const images = document.querySelectorAll('img[data-src]');

    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.src = img.dataset.src;
                img.classList.remove('lazy');
                observer.unobserve(img);
            }
        });
    });

    images.forEach(img => imageObserver.observe(img));
}

// ===================================
// FORM ENHANCEMENTS
// ===================================
function initFormEnhancements() {
    const forms = document.querySelectorAll('form');

    forms.forEach(form => {
        // Add loading state to submit buttons
        form.addEventListener('submit', function () {
            const submitBtn = this.querySelector('[type="submit"]');
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Memproses...';
            }
        });

        // Enhanced input focus effects
        const inputs = form.querySelectorAll('input, textarea, select');
        inputs.forEach(input => {
            input.addEventListener('focus', function () {
                this.parentNode.classList.add('focused');
            });

            input.addEventListener('blur', function () {
                if (this.value === '') {
                    this.parentNode.classList.remove('focused');
                }
            });
        });
    });
}

// ===================================
// MOBILE OPTIMIZATIONS
// ===================================
function initMobileOptimizations() {
    // Touch-friendly hover effects for mobile
    if ('ontouchstart' in window) {
        document.body.classList.add('touch-device');

        // Remove hover effects on touch devices
        const hoverElements = document.querySelectorAll('.stat-card, .news-card .card, .icon-box');
        hoverElements.forEach(element => {
            element.addEventListener('touchstart', function () {
                this.classList.add('touch-active');
            });

            element.addEventListener('touchend', function () {
                setTimeout(() => {
                    this.classList.remove('touch-active');
                }, 300);
            });
        });
    }

    // Optimize carousel for mobile
    const carousel = document.getElementById('heroCarousel');
    if (carousel) {
        // Add swipe support (if needed)
        let startX, startY, endX, endY;

        carousel.addEventListener('touchstart', e => {
            startX = e.touches[0].clientX;
            startY = e.touches[0].clientY;
        });

        carousel.addEventListener('touchend', e => {
            endX = e.changedTouches[0].clientX;
            endY = e.changedTouches[0].clientY;

            const diffX = startX - endX;
            const diffY = startY - endY;

            // Only trigger if horizontal swipe is more significant than vertical
            if (Math.abs(diffX) > Math.abs(diffY) && Math.abs(diffX) > 50) {
                if (diffX > 0) {
                    // Swipe left - next slide
                    $('#heroCarousel').carousel('next');
                } else {
                    // Swipe right - previous slide
                    $('#heroCarousel').carousel('prev');
                }
            }
        });
    }
}

// ===================================
// PERFORMANCE MONITORING
// ===================================
function initPerformanceMonitoring() {
    // Log performance metrics
    window.addEventListener('load', () => {
        setTimeout(() => {
            const perfData = performance.getEntriesByType('navigation')[0];
            console.log('Page Load Performance:', {
                'DOM Content Loaded': perfData.domContentLoadedEventEnd - perfData.domContentLoadedEventStart,
                'Load Complete': perfData.loadEventEnd - perfData.loadEventStart,
                'Total Load Time': perfData.loadEventEnd - perfData.fetchStart
            });
        }, 0);
    });
}

// ===================================
// ERROR HANDLING
// ===================================
window.addEventListener('error', function (e) {
    console.warn('JavaScript Error:', e.error);
    // Could send to logging service in production
});

// ===================================
// INITIALIZATION
// ===================================
// Additional initialization after DOM is ready
document.addEventListener('DOMContentLoaded', function () {
    // Initialize additional features
    initCardEffects();
    initScrollAnimations();
    initLazyLoading();
    initFormEnhancements();
    initMobileOptimizations();
    initPerformanceMonitoring();
});

// Export functions for use in other scripts
window.PortalDesa = {
    formatNumber: formatIndonesianNumber,
    isInViewport: isInViewport,
    debounce: debounce,
    throttle: throttle
};
