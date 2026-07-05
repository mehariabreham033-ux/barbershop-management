/**
 * Image Slider JavaScript
 * Carousel and gallery slider functionality
 */

class Slider {
    constructor(element, options = {}) {
        this.element = element;
        this.options = {
            autoplay: options.autoplay !== false,
            autoplayDelay: options.autoplayDelay || 5000,
            slideSpeed: options.slideSpeed || 500,
            loop: options.loop !== false,
            ...options
        };

        this.slides = this.element.querySelectorAll('.slide');
        this.currentIndex = 0;
        this.autoplayTimer = null;

        if (this.slides.length === 0) return;

        this.init();
    }

    init() {
        this.createControls();
        this.addEventListeners();
        if (this.options.autoplay) this.startAutoplay();
    }

    createControls() {
        const controlsDiv = document.createElement('div');
        controlsDiv.className = 'slider-controls';

        // Previous button
        const prevBtn = document.createElement('button');
        prevBtn.className = 'slider-btn slider-prev';
        prevBtn.innerHTML = '&#10094;';
        prevBtn.addEventListener('click', () => this.prev());
        controlsDiv.appendChild(prevBtn);

        // Next button
        const nextBtn = document.createElement('button');
        nextBtn.className = 'slider-btn slider-next';
        nextBtn.innerHTML = '&#10095;';
        nextBtn.addEventListener('click', () => this.next());
        controlsDiv.appendChild(nextBtn);

        this.element.appendChild(controlsDiv);

        // Dots
        const dotsDiv = document.createElement('div');
        dotsDiv.className = 'slider-dots';
        this.slides.forEach((_, index) => {
            const dot = document.createElement('span');
            dot.className = `dot ${index === 0 ? 'active' : ''}`;
            dot.addEventListener('click', () => this.goToSlide(index));
            dotsDiv.appendChild(dot);
        });
        this.element.appendChild(dotsDiv);
    }

    addEventListeners() {
        this.element.addEventListener('mouseenter', () => this.stopAutoplay());
        this.element.addEventListener('mouseleave', () => {
            if (this.options.autoplay) this.startAutoplay();
        });
    }

    showSlide(index) {
        this.slides.forEach((slide, i) => {
            slide.classList.toggle('active', i === index);
        });

        const dots = this.element.querySelectorAll('.dot');
        dots.forEach((dot, i) => {
            dot.classList.toggle('active', i === index);
        });
    }

    next() {
        this.currentIndex = (this.currentIndex + 1) % this.slides.length;
        this.showSlide(this.currentIndex);
    }

    prev() {
        this.currentIndex = (this.currentIndex - 1 + this.slides.length) % this.slides.length;
        this.showSlide(this.currentIndex);
    }

    goToSlide(index) {
        this.currentIndex = index;
        this.showSlide(this.currentIndex);
    }

    startAutoplay() {
        this.autoplayTimer = setInterval(() => this.next(), this.options.autoplayDelay);
    }

    stopAutoplay() {
        if (this.autoplayTimer) {
            clearInterval(this.autoplayTimer);
            this.autoplayTimer = null;
        }
    }
}

// Initialize sliders on page load
document.addEventListener('DOMContentLoaded', function() {
    const sliders = document.querySelectorAll('[data-slider]');
    sliders.forEach(slider => {
        new Slider(slider);
    });
});
