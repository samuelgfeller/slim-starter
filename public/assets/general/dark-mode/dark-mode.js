// Script for dark mode with black & white toggle button

// Get the toggle element
const toggleButton = document.querySelector('#dark-theme-toggle');

if (toggleButton) {
    // Add event listener to the toggle switch for theme switching
    toggleButton.addEventListener('click', switchTheme, false);

    // Retrieve the current theme from localStorage
    const currentTheme = localStorage.getItem('theme') ? localStorage.getItem('theme') : null;

    // Set the theme based on the stored value from localStorage
    if (currentTheme) {
        // Set the data-theme attribute on the html element
        document.documentElement.setAttribute('data-theme', currentTheme);

        // Check the toggle switch if the current theme is 'dark'
        if (currentTheme === 'dark') {
            toggleButton.classList.add('dark-theme-enabled');
        }
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

    // Make ajax call to change value in database
    // let userId = document.getElementById('user-id').value;
    // submitUpdate({theme: theme}, `users/${userId}`)
    //     .then(r => {
    //     }).catch(errorMsg => {
    //     displayFlashMessage('error', 'Failed to change the theme in the database.')
    // });
}


