

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// Course carousel navigation (mobile)
document.addEventListener('DOMContentLoaded', () => {
    const carousel = document.querySelector('.overflow-x-auto.snap-x');
    const prevBtn = document.getElementById('courseCarouselPrev');
    const nextBtn = document.getElementById('courseCarouselNext');

    if (!carousel || !prevBtn || !nextBtn) return;

    const scrollAmount = 320; // approx width of one course card + gap on mobile

    prevBtn.addEventListener('click', () => {
        carousel.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
    });

    nextBtn.addEventListener('click', () => {
        carousel.scrollBy({ left: scrollAmount, behavior: 'smooth' });
    });

    // Hide/show buttons based on scroll position
    carousel.addEventListener('scroll', () => {
        const maxScroll = carousel.scrollWidth - carousel.clientWidth;
        prevBtn.style.opacity = carousel.scrollLeft > 10 ? '1' : '0.5';
        prevBtn.disabled = carousel.scrollLeft <= 10;
        nextBtn.style.opacity = maxScroll - carousel.scrollLeft > 10 ? '1' : '0.5';
        nextBtn.disabled = maxScroll - carousel.scrollLeft <= 10;
    });

    // Initialize button states
    const maxScroll = carousel.scrollWidth - carousel.clientWidth;
    prevBtn.disabled = true;
    prevBtn.style.opacity = '0.5';
    nextBtn.disabled = maxScroll <= 10;
    if (maxScroll <= 10) nextBtn.style.opacity = '0.5';
});
