/* ===== HEADER SCROLL EFFECT JAVASCRIPT ===== */
/* Clean header transparency and scroll functionality */

document.addEventListener('DOMContentLoaded', function() {
    const header = document.getElementById('header');
    const heroSection = document.getElementById('hero');

    if (!header) {
        console.log('Header element not found, skipping scroll effects');
        return;
    }

    console.log('=== HEADER SCROLL EFFECT INITIALIZING ===');

    // Set initial completely transparent state for hero section
    if (heroSection) {
        header.classList.add('transparent', 'header-transparent');
        console.log('✅ Header set to transparent for hero section');
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
            console.log('📍 Header switched to scrolled state');
        } else {
            // In hero section - transparent glass effect
            header.classList.remove('scrolled', 'header-scrolled');
            header.classList.add('transparent', 'header-transparent');
            console.log('📍 Header switched to transparent state');
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

                console.log('🔗 Smooth scroll to:', targetId);
            }
        });
    });

    console.log('=== HEADER SCROLL EFFECT INITIALIZATION COMPLETE ===');
});
