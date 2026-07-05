/**
 * Form Validation JavaScript
 * Client-side validation for all forms
 */

class FormValidator {
    constructor(formElement) {
        this.form = formElement;
        this.errors = {};
        this.init();
    }

    init() {
        this.form.addEventListener('submit', (e) => this.validate(e));
        this.attachInputListeners();
    }

    attachInputListeners() {
        const inputs = this.form.querySelectorAll('input, textarea, select');
        inputs.forEach(input => {
            input.addEventListener('blur', () => this.validateField(input));
            input.addEventListener('change', () => this.validateField(input));
        });
    }

    validate(e) {
        e.preventDefault();
        this.errors = {};

        const inputs = this.form.querySelectorAll('input, textarea, select');
        let isValid = true;

        inputs.forEach(input => {
            if (!this.validateField(input)) {
                isValid = false;
            }
        });

        if (isValid) {
            this.form.submit();
        }
    }

    validateField(input) {
        const value = input.value.trim();
        const fieldName = input.name || input.id;
        let isValid = true;

        // Clear previous error
        this.removeError(input);

        // Required validation
        if (input.required && !value) {
            this.addError(input, `${this.formatFieldName(fieldName)} is required`);
            isValid = false;
        }

        // Email validation
        if (input.type === 'email' && value && !this.isValidEmail(value)) {
            this.addError(input, 'Please enter a valid email address');
            isValid = false;
        }

        // Phone validation
        if (input.type === 'tel' && value && !this.isValidPhone(value)) {
            this.addError(input, 'Please enter a valid phone number');
            isValid = false;
        }

        // URL validation
        if (input.type === 'url' && value && !this.isValidURL(value)) {
            this.addError(input, 'Please enter a valid URL');
            isValid = false;
        }

        // Date validation
        if (input.type === 'date' && value) {
            const date = new Date(value);
            if (isNaN(date.getTime())) {
                this.addError(input, 'Please enter a valid date');
                isValid = false;
            }
        }

        // Min length
        if (input.minLength && value.length < input.minLength) {
            this.addError(input, `Minimum ${input.minLength} characters required`);
            isValid = false;
        }

        // Max length
        if (input.maxLength && value.length > input.maxLength) {
            this.addError(input, `Maximum ${input.maxLength} characters allowed`);
            isValid = false;
        }

        // Custom pattern
        if (input.pattern && value && !new RegExp(input.pattern).test(value)) {
            this.addError(input, `Invalid ${this.formatFieldName(fieldName)} format`);
            isValid = false;
        }

        // Number range
        if ((input.type === 'number' || input.type === 'range') && value) {
            if (input.min && Number(value) < Number(input.min)) {
                this.addError(input, `Minimum value is ${input.min}`);
                isValid = false;
            }
            if (input.max && Number(value) > Number(input.max)) {
                this.addError(input, `Maximum value is ${input.max}`);
                isValid = false;
            }
        }

        return isValid;
    }

    isValidEmail(email) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
    }

    isValidPhone(phone) {
        return /^[+]?[(]?[0-9]{1,4}[)]?[-\s.]?[(]?[0-9]{1,4}[)]?[-\s.]?[0-9]{1,9}$/.test(phone);
    }

    isValidURL(url) {
        try {
            new URL(url);
            return true;
        } catch (e) {
            return false;
        }
    }

    formatFieldName(name) {
        return name
            .replace(/[_-]/g, ' ')
            .replace(/\b\w/g, l => l.toUpperCase())
            .trim();
    }

    addError(input, message) {
        input.classList.add('input-error');
        
        const errorDiv = document.createElement('div');
        errorDiv.className = 'error-message';
        errorDiv.textContent = message;
        
        input.parentNode.appendChild(errorDiv);
    }

    removeError(input) {
        input.classList.remove('input-error');
        const errorDiv = input.parentNode.querySelector('.error-message');
        if (errorDiv) {
            errorDiv.remove();
        }
    }
}

// Initialize validators on page load
document.addEventListener('DOMContentLoaded', function() {
    const forms = document.querySelectorAll('form[data-validate="true"]');
    forms.forEach(form => {
        new FormValidator(form);
    });
});

// Error message styles
const style = document.createElement('style');
style.textContent = `
    .input-error {
        border-color: var(--error-color) !important;
    }
    .error-message {
        color: var(--error-color);
        font-size: var(--font-sm);
        margin-top: var(--spacing-xs);
        display: block;
    }
`;
document.head.appendChild(style);
