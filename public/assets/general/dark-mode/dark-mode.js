const currentTheme = getCurrentTheme();

// Set the data-theme attribute on the html element
document.documentElement.setAttribute('data-theme', currentTheme);

// Get the toggle element
const toggleButton = document.querySelector('#dark-theme-toggle');

setToggleIcon(currentTheme);

function switchTheme() {
    let theme;
    // Check the current theme and switch to the opposite theme
    if (document.documentElement.getAttribute('data-theme') === 'dark') {
        theme = 'light';
        setToggleIcon('light');
    } else {
        theme = 'dark';
        setToggleIcon('dark');
    }
    // Set html data-attribute and local storage entry
    document.documentElement.setAttribute('data-theme', theme);
    localStorage.setItem('theme', theme);
    // Dispatch theme change event for other scripts to listen to i.e. code highlighting
    // document.dispatchEvent(new CustomEvent('themeChange', { detail: { theme: theme } }));
}


if (toggleButton) {
    // Add event listener to the toggle switch for theme switching
    toggleButton.addEventListener('click', switchTheme, false);

    // Check the toggle switch if the current theme is 'dark'
    if (currentTheme === 'dark') {
        toggleButton.classList.add('dark-theme-enabled');
    }
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


function setToggleIcon(theme) {
    if (theme === 'dark') {
        document.getElementById('moon').style.display = 'none';
        document.getElementById('sun').style.display = null;
    } else {
        document.getElementById('moon').style.display = null;
        document.getElementById('sun').style.display = 'none';
    }
}