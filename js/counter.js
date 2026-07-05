/**
 * Counter Animation JavaScript
 * Animated counters for statistics and numbers
 */

class Counter {
    constructor(element) {
        this.element = element;
        this.target = parseInt(element.getAttribute('data-target')) || 0;
        this.duration = parseInt(element.getAttribute('data-duration')) || 2000;
        this.currentValue = 0;
        this.isAnimating = false;
    }

    animate() {
        if (this.isAnimating) return;

        this.isAnimating = true;
        const increment = this.target / (this.duration / 50);
        const startTime = Date.now();

        const updateCounter = () => {
            const elapsed = Date.now() - startTime;
            const progress = Math.min(elapsed / this.duration, 1);
            this.currentValue = Math.floor(this.target * progress);
            
            this.element.textContent = this.formatNumber(this.currentValue);

            if (progress < 1) {
                requestAnimationFrame(updateCounter);
            } else {
                this.element.textContent = this.formatNumber(this.target);
                this.isAnimating = false;
            }
        };

        updateCounter();
    }

    formatNumber(num) {
        if (num >= 1000000) {
            return (num / 1000000).toFixed(1) + 'M';
        } else if (num >= 1000) {
            return (num / 1000).toFixed(1) + 'K';
        }
        return num.toString();
    }
}

// Initialize counters on page load
document.addEventListener('DOMContentLoaded', function() {
    const counters = document.querySelectorAll('[data-counter]');
    
    if (counters.length === 0) return;

    // Create Intersection Observer to trigger animation when counter comes into view
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting && !entry.target.classList.contains('animated')) {
                const counter = new Counter(entry.target);
                counter.animate();
                entry.target.classList.add('animated');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.5 });

    counters.forEach(counter => observer.observe(counter));
});
