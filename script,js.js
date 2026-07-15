document.addEventListener('DOMContentLoaded', () => {

    /* ---------- Mobile menu toggle ---------- */
    const menuToggle = document.getElementById('menuToggle');
    const navMenu = document.getElementById('navMenu');

    if (menuToggle && navMenu) {
        menuToggle.addEventListener('click', () => {
            navMenu.classList.toggle('show');
        });

        // Close menu after clicking a link (mobile)
        navMenu.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                navMenu.classList.remove('show');
            });
        });
    }

    /* ---------- Highlight active nav link on scroll ---------- */
    const sections = document.querySelectorAll('section[id]');
    const navLinks = document.querySelectorAll('nav a');

    window.addEventListener('scroll', () => {
        let current = '';
        sections.forEach(section => {
            const sectionTop = section.offsetTop - 100;
            if (window.scrollY >= sectionTop) {
                current = section.getAttribute('id');
            }
        });

        navLinks.forEach(link => {
            link.classList.remove('active');
            if (link.getAttribute('href') === `#${current}`) {
                link.classList.add('active');
            }
        });
    });

    /* ---------- Booking form ---------- */
    const bookingForm = document.querySelector('.booking form');
    if (bookingForm) {
        bookingForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const name = bookingForm.querySelector('[name="name"]').value.trim();
            const email = bookingForm.querySelector('[name="email"]').value.trim();
            const phone = bookingForm.querySelector('[name="phone"]').value.trim();

            if (!name || !email || !phone) {
                alert('Please fill in your name, email, and phone number.');
                return;
            }

            alert(`Thanks, ${name}! Your booking request has been received. We'll contact you shortly.`);
            bookingForm.reset();
        });
    }

    /* ---------- Login form ---------- */
    const loginForm = document.querySelector('.login form');
    if (loginForm) {
        loginForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const email = loginForm.querySelector('input[type="email"]').value.trim();
            const password = loginForm.querySelector('input[type="password"]').value.trim();

            if (!email || !password) {
                alert('Please enter both email and password.');
                return;
            }

            alert('Login successful! (Connect this to your backend for real authentication.)');
            loginForm.reset();
        });
    }

});