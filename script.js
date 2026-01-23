// Hero parallax zoom effect
const heroParallax = document.getElementById('hero-parallax');

// Hamburger menu toggle
const hamburger = document.querySelector('.hamburger');
const navLinks = document.querySelector('.nav-links');

if (hamburger) {
    hamburger.addEventListener('click', function() {
        hamburger.classList.toggle('active');
        navLinks.classList.toggle('active');
    });
    
    // Close menu when clicking on a nav link
    document.querySelectorAll('.nav-link, .btn-apply').forEach(link => {
        link.addEventListener('click', function() {
            hamburger.classList.remove('active');
            navLinks.classList.remove('active');
        });
    });
}

window.addEventListener('scroll', function() {
    const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
    const windowHeight = window.innerHeight;
    
    // Parallax zoom effect for hero (zooms in as you scroll down)
    if (scrollTop < windowHeight) {
        const scale = 1 + (scrollTop / windowHeight) * 0.5;
        heroParallax.style.transform = `scale(${scale})`;
    }
});

// Smooth scrolling for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});

// Intersection Observer for fade-in animations
const fadeObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('visible');
        }
    });
}, {
    threshold: 0.1,
    rootMargin: '0px 0px -100px 0px'
});

// Observe all sections with fade-section class
document.querySelectorAll('.fade-section').forEach(section => {
    fadeObserver.observe(section);
});

// Click hero to scroll to next section
const hero = document.querySelector('.hero');
hero.addEventListener('click', function() {
    document.querySelector('#mission').scrollIntoView({
        behavior: 'smooth',
        block: 'start'
    });
});

// Make cursor pointer on hero
hero.style.cursor = 'pointer';