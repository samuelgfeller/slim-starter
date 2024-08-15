// Script for dark mode with black & white toggle button

// Get the toggle element
const toggleButton = document.querySelector('#dark-theme-toggle');

if (toggleButton) {
    // Add event listener to the toggle switch for theme switching
    toggleButton.addEventListener('click', switchTheme, false);

    // Retrieve the current theme from localStorage
    const currentTheme = getCurrentTheme();

    // Set the data-theme attribute on the html element
    document.documentElement.setAttribute('data-theme', currentTheme);

    // Check the toggle switch if the current theme is 'dark'
    if (currentTheme === 'dark') {
        toggleButton.classList.add('dark-theme-enabled');
    }
}

/**
 * Handle theme switching with localstorage
 *
 * @param e
 */
function switchTheme(e) {
    let theme;
    // Check the current theme and switch to the opposite theme
    if (document.documentElement.getAttribute('data-theme') === 'dark') {
        theme = 'light';
        toggleButton.classList.remove('dark-theme-enabled');
    } else {
        theme = 'dark';
        toggleButton.classList.add('dark-theme-enabled');
    }
    // Set html data-attribute and local storage entry
    document.documentElement.setAttribute('data-theme', theme);
    localStorage.setItem('theme', theme);
}

function getCurrentTheme() {
    // Check if the user has set a theme in the local storage
    if (localStorage.getItem("theme") !== null) {
        return localStorage.getItem("theme");
    }
    // Check if the user has set a global system preference for dark mode
    if (window.matchMedia("(prefers-color-scheme: dark)").matches) {
        // Set the theme to dark mode in localstorage for faster loading in layout
        localStorage.setItem("theme", "dark");
        return "dark";
    }
    // Default to light mode
    return "light";
}