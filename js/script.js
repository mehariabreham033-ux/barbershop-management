/**
 * Main JavaScript File
 * Common functions and initialization
 */

// DOM Ready
document.addEventListener('DOMContentLoaded', function() {
    initializeApp();
});

function initializeApp() {
    // Hide loader
    hideLoader();
    
    // Initialize components
    initializeNavbar();
    initializeBackToTop();
    initializeThemeToggle();
    initializeFormValidation();
    initializeAjaxForms();
    initializeNewsletterForm();
}

// Hide Loader
function hideLoader() {
    const loader = document.getElementById('loader');
    if (loader) {
        loader.classList.add('hidden');
    }
}

// Navbar Toggle
function initializeNavbar() {
    const navToggle = document.getElementById('navToggle');
    const navMenu = document.getElementById('navMenu');
    const navLinks = document.querySelectorAll('.nav-link');

    if (navToggle) {
        navToggle.addEventListener('click', function() {
            this.classList.toggle('active');
            navMenu.classList.toggle('active');
        });
    }

    // Close menu on link click
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            if (!this.parentElement.classList.contains('dropdown')) {
                if (navToggle) navToggle.classList.remove('active');
                if (navMenu) navMenu.classList.remove('active');
            }
        });
    });

    // Handle dropdown on mobile
    const dropdowns = document.querySelectorAll('.dropdown');
    dropdowns.forEach(dropdown => {
        const link = dropdown.querySelector('a');
        if (link) {
            link.addEventListener('click', function(e) {
                if (window.innerWidth <= 768) {
                    e.preventDefault();
                    const content = dropdown.querySelector('.dropdown-content');
                    if (content) {
                        content.style.display = content.style.display === 'block' ? 'none' : 'block';
                    }
                }
            });
        }
    });
}

// Back to Top Button
function initializeBackToTop() {
    const backToTop = document.getElementById('backToTop');
    
    if (!backToTop) return;

    window.addEventListener('scroll', function() {
        if (window.pageYOffset > 300) {
            backToTop.classList.add('show');
        } else {
            backToTop.classList.remove('show');
        }
    });

    backToTop.addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
}

// Theme Toggle
function initializeThemeToggle() {
    const themeToggle = document.getElementById('themeToggle');
    const htmlElement = document.documentElement;
    const body = document.body;

    // Check saved preference
    const savedTheme = localStorage.getItem('theme') || 'light';
    setTheme(savedTheme);

    if (themeToggle) {
        themeToggle.addEventListener('click', function() {
            const currentTheme = body.classList.contains('dark-mode') ? 'light' : 'dark';
            setTheme(currentTheme);
        });
    }

    function setTheme(theme) {
        if (theme === 'dark') {
            body.classList.add('dark-mode');
            htmlElement.style.colorScheme = 'dark';
            localStorage.setItem('theme', 'dark');
            if (themeToggle) themeToggle.textContent = '☀️';
        } else {
            body.classList.remove('dark-mode');
            htmlElement.style.colorScheme = 'light';
            localStorage.setItem('theme', 'light');
            if (themeToggle) themeToggle.textContent = '🌙';
        }
    }
}

// Form Validation
function initializeFormValidation() {
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            if (!validateForm(this)) {
                e.preventDefault();
            }
        });
    });
}

function validateForm(form) {
    const inputs = form.querySelectorAll('input, textarea, select');
    let isValid = true;

    inputs.forEach(input => {
        if (!validateInput(input)) {
            isValid = false;
        }
    });

    return isValid;
}

function validateInput(input) {
    const value = input.value.trim();
    
    // Check required
    if (input.hasAttribute('required') && !value) {
        showError(input, 'This field is required');
        return false;
    }

    // Check email
    if (input.type === 'email' && value && !isValidEmail(value)) {
        showError(input, 'Please enter a valid email');
        return false;
    }

    // Check phone
    if (input.type === 'tel' && value && !isValidPhone(value)) {
        showError(input, 'Please enter a valid phone number');
        return false;
    }

    // Check min length
    if (input.hasAttribute('minlength') && value.length < parseInt(input.getAttribute('minlength'))) {
        showError(input, `Minimum ${input.getAttribute('minlength')} characters required`);
        return false;
    }

    clearError(input);
    return true;
}

function showError(input, message) {
    clearError(input);
    const errorDiv = document.createElement('div');
    errorDiv.className = 'error-message';
    errorDiv.textContent = message;
    input.parentNode.appendChild(errorDiv);
    input.classList.add('input-error');
}

function clearError(input) {
    const errorDiv = input.parentNode.querySelector('.error-message');
    if (errorDiv) {
        errorDiv.remove();
    }
    input.classList.remove('input-error');
}

function isValidEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}

function isValidPhone(phone) {
    const re = /^[+]?[(]?[0-9]{1,4}[)]?[-\s.]?[(]?[0-9]{1,4}[)]?[-\s.]?[0-9]{1,9}$/;
    return re.test(phone);
}

// AJAX Forms
function initializeAjaxForms() {
    const ajaxForms = document.querySelectorAll('[data-ajax="true"]');
    ajaxForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            submitFormAjax(this);
        });
    });
}

function submitFormAjax(form) {
    if (!validateForm(form)) {
        return;
    }

    const formData = new FormData(form);
    const url = form.getAttribute('action');

    fetch(url, {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showMessage(data.message, 'success');
            form.reset();
            
            // Execute callback if provided
            if (form.dataset.callback) {
                window[form.dataset.callback](data);
            }
        } else {
            showMessage(data.message, 'error');
        }
    })
    .catch(error => {
        showMessage('An error occurred. Please try again.', 'error');
        console.error('Error:', error);
    });
}

// Show Message
function showMessage(message, type = 'info') {
    const messageDiv = document.createElement('div');
    messageDiv.className = `alert alert-${type}`;
    messageDiv.textContent = message;
    messageDiv.style.position = 'fixed';
    messageDiv.style.top = '100px';
    messageDiv.style.right = '20px';
    messageDiv.style.zIndex = '9999';
    messageDiv.style.maxWidth = '400px';
    
    document.body.appendChild(messageDiv);
    
    setTimeout(() => {
        messageDiv.remove();
    }, 5000);
}

// Newsletter Form
function initializeNewsletterForm() {
    const form = document.getElementById('newsletterForm');
    if (!form) return;

    form.addEventListener('submit', function(e) {
        e.preventDefault();
        const email = this.querySelector('input[type="email"]').value;
        
        if (isValidEmail(email)) {
            showMessage('Thank you for subscribing!', 'success');
            this.reset();
        } else {
            showMessage('Please enter a valid email', 'error');
        }
    });
}

// Utility Functions
function formatDate(date) {
    return new Date(date).toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    });
}

function formatTime(time) {
    return new Date(`2000-01-01 ${time}`).toLocaleTimeString('en-US', {
        hour: '2-digit',
        minute: '2-digit',
        hour12: true
    });
}

function formatCurrency(amount) {
    return new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'USD'
    }).format(amount);
}

// CSRF Token
function getCSRFToken() {
    const token = document.querySelector('meta[name="csrf-token"]');
    return token ? token.getAttribute('content') : '';
}

// Export functions for use in other scripts
window.showMessage = showMessage;
window.validateForm = validateForm;
window.formatDate = formatDate;
window.formatTime = formatTime;
window.formatCurrency = formatCurrency;
window.getCSRFToken = getCSRFToken;
