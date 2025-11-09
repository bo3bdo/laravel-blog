// Dark Mode Toggle with localStorage persistence
(function () {
    const getTheme = () => {
        // Check localStorage first
        const stored = localStorage.getItem('theme');
        if (stored) {
            return stored;
        }
        // Check system preference
        if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
            return 'dark';
        }
        return 'light';
    };

    const setTheme = (theme) => {
        // Remove both classes first
        document.documentElement.classList.remove('light', 'dark');
        // Add the new theme class
        document.documentElement.classList.add(theme);
        // Save to localStorage
        localStorage.setItem('theme', theme);
    };

    const updateToggleIcon = (theme) => {
        const toggle = document.getElementById('theme-toggle');
        if (!toggle) {
            return;
        }

        const sunIcon = toggle.querySelector('.sun-icon');
        const moonIcon = toggle.querySelector('.moon-icon');

        if (theme === 'dark') {
            // Dark mode: show sun icon (to switch to light)
            sunIcon?.classList.remove('hidden');
            moonIcon?.classList.add('hidden');
        } else {
            // Light mode: show moon icon (to switch to dark)
            sunIcon?.classList.add('hidden');
            moonIcon?.classList.remove('hidden');
        }
    };

    const initTheme = () => {
        const theme = getTheme();
        setTheme(theme);
        updateToggleIcon(theme);
    };

    const toggleTheme = () => {
        const currentTheme = document.documentElement.classList.contains('dark') ? 'dark' : 'light';
        const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
        setTheme(newTheme);
        updateToggleIcon(newTheme);
    };

    // Initialize on page load
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initTheme);
    } else {
        initTheme();
    }

    // Listen for system theme changes (only if user hasn't set a preference)
    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
        if (!localStorage.getItem('theme')) {
            const newTheme = e.matches ? 'dark' : 'light';
            setTheme(newTheme);
            updateToggleIcon(newTheme);
        }
    });

    // Expose toggle function globally
    window.toggleTheme = toggleTheme;
})();

