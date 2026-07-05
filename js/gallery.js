/**
 * Gallery JavaScript
 * Image gallery with lightbox functionality
 */

class Gallery {
    constructor() {
        this.images = document.querySelectorAll('[data-gallery]');
        this.currentIndex = 0;
        this.lightbox = null;

        if (this.images.length === 0) return;

        this.init();
    }

    init() {
        this.createLightbox();
        this.attachListeners();
    }

    createLightbox() {
        this.lightbox = document.createElement('div');
        this.lightbox.className = 'lightbox';
        this.lightbox.innerHTML = `
            <span class="lightbox-close">&times;</span>
            <img src="" alt="" class="lightbox-image">
            <div class="lightbox-info">
                <p class="lightbox-caption"></p>
                <p class="lightbox-counter"><span class="current">1</span>/<span class="total">1</span></p>
            </div>
            <button class="lightbox-btn lightbox-prev">&#10094;</button>
            <button class="lightbox-btn lightbox-next">&#10095;</button>
        `;
        document.body.appendChild(this.lightbox);

        // Event listeners
        this.lightbox.querySelector('.lightbox-close').addEventListener('click', () => this.close());
        this.lightbox.querySelector('.lightbox-prev').addEventListener('click', () => this.prev());
        this.lightbox.querySelector('.lightbox-next').addEventListener('click', () => this.next());
        this.lightbox.addEventListener('click', (e) => {
            if (e.target === this.lightbox) this.close();
        });

        // Keyboard navigation
        document.addEventListener('keydown', (e) => {
            if (!this.lightbox.classList.contains('active')) return;
            if (e.key === 'ArrowLeft') this.prev();
            if (e.key === 'ArrowRight') this.next();
            if (e.key === 'Escape') this.close();
        });
    }

    attachListeners() {
        this.images.forEach((img, index) => {
            img.addEventListener('click', (e) => {
                e.preventDefault();
                this.open(index);
            });
        });
    }

    open(index) {
        this.currentIndex = index;
        this.show();
    }

    show() {
        const img = this.images[this.currentIndex];
        const src = img.getAttribute('data-gallery') || img.src;
        const caption = img.getAttribute('data-caption') || img.alt || '';

        this.lightbox.querySelector('.lightbox-image').src = src;
        this.lightbox.querySelector('.lightbox-caption').textContent = caption;
        this.lightbox.querySelector('.current').textContent = this.currentIndex + 1;
        this.lightbox.querySelector('.total').textContent = this.images.length;
        this.lightbox.classList.add('active');
    }

    close() {
        this.lightbox.classList.remove('active');
    }

    next() {
        this.currentIndex = (this.currentIndex + 1) % this.images.length;
        this.show();
    }

    prev() {
        this.currentIndex = (this.currentIndex - 1 + this.images.length) % this.images.length;
        this.show();
    }
}

// Lightbox styles
const style = document.createElement('style');
style.textContent = `
    .lightbox {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.9);
        animation: fadeIn 0.3s ease;
    }
    .lightbox.active {
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .lightbox-image {
        max-width: 90%;
        max-height: 80vh;
        object-fit: contain;
        animation: scaleIn 0.3s ease;
    }
    .lightbox-close {
        position: absolute;
        top: 30px;
        right: 30px;
        color: white;
        font-size: 40px;
        cursor: pointer;
        transition: transform 0.3s ease;
    }
    .lightbox-close:hover {
        transform: scale(1.2);
    }
    .lightbox-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(255, 255, 255, 0.3);
        border: none;
        color: white;
        font-size: 30px;
        cursor: pointer;
        padding: 15px 20px;
        transition: background 0.3s ease;
    }
    .lightbox-btn:hover {
        background: rgba(255, 255, 255, 0.5);
    }
    .lightbox-prev {
        left: 20px;
    }
    .lightbox-next {
        right: 20px;
    }
    .lightbox-info {
        position: absolute;
        bottom: 30px;
        left: 50%;
        transform: translateX(-50%);
        color: white;
        text-align: center;
        background: rgba(0, 0, 0, 0.7);
        padding: 15px 30px;
        border-radius: 5px;
    }
    .lightbox-caption {
        margin: 0 0 10px 0;
        font-size: 16px;
    }
    .lightbox-counter {
        margin: 0;
        font-size: 14px;
        opacity: 0.8;
    }
    @media (max-width: 768px) {
        .lightbox-btn {
            padding: 10px 15px;
            font-size: 20px;
        }
        .lightbox-close {
            font-size: 30px;
        }
    }
`;
document.head.appendChild(style);

// Initialize gallery on page load
document.addEventListener('DOMContentLoaded', function() {
    new Gallery();
});
