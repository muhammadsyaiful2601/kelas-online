

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('change', (event) => {
    const input = event.target.closest('[data-image-preview-input]');
    if (!input || !input.files?.[0]) return;

    const preview = document.getElementById(input.dataset.imagePreviewInput);
    if (!preview) return;

    const file = input.files[0];
    if (!file.type.startsWith('image/')) {
        input.value = '';
        preview.classList.add('hidden');
        return;
    }

    preview.src = URL.createObjectURL(file);
    preview.classList.remove('hidden');
});

// Course carousel navigation (mobile)
document.addEventListener('DOMContentLoaded', () => {
    const carousel = document.querySelector('.overflow-x-auto.snap-x');
    const prevBtn = document.getElementById('courseCarouselPrev');
    const nextBtn = document.getElementById('courseCarouselNext');

    if (!carousel || !prevBtn || !nextBtn) return;

    let scrollAmount = window.innerWidth * 0.9; // one card width (90% of viewport)

    // Recalculate on resize
    window.addEventListener('resize', () => {
        scrollAmount = window.innerWidth * 0.9;
    });

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
