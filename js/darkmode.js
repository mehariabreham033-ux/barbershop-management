/**
 * Dark Mode JavaScript
 * Theme toggle and persistence
 */

class DarkMode {
    constructor() {
        this.theme = localStorage.getItem('theme') || this.getSystemTheme();
        this.toggle = document.getElementById('themeToggle');
        
        this.init();
    }

    init() {
        this.setTheme(this.theme);
        
        if (this.toggle) {
            this.toggle.addEventListener('click', () => this.toggleTheme());
        }

        // Listen for system theme changes
        if (window.matchMedia) {
            window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
                if (!localStorage.getItem('theme')) {
                    this.setTheme(e.matches ? 'dark' : 'light');
                }
            });
        }
    }

    getSystemTheme() {
        if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
            return 'dark';
        }
        return 'light';
    }

    setTheme(theme) {
        const body = document.body;
        const html = document.documentElement;
        
        this.theme = theme;
        localStorage.setItem('theme', theme);

        if (theme === 'dark') {
            body.classList.add('dark-mode');
            html.style.colorScheme = 'dark';
            if (this.toggle) this.toggle.textContent = '☀️';
        } else {
            body.classList.remove('dark-mode');
            html.style.colorScheme = 'light';
            if (this.toggle) this.toggle.textContent = '🌙';
        }
    }

    toggleTheme() {
        const newTheme = this.theme === 'dark' ? 'light' : 'dark';
        this.setTheme(newTheme);
    }
}

// Initialize dark mode on page load
document.addEventListener('DOMContentLoaded', function() {
    new DarkMode();
});
