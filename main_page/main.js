/**
 * Variable that takes the icon that toggles a theme
 * @var {HTMLElement} icon
 */
const icon = document.getElementById('switchIcon');
/**
 * Toggles the theme of the website between light and dark
 */
function toggleTheme() {
    if (localStorage.getItem('theme') === 'dark') {
        localStorage.setItem('theme', 'light');
        document.body.classList.remove('dark-theme');
        document.getElementById('switchIcon').src = '../images/dark_theme.jpg';
    } else {
        localStorage.setItem('theme', 'dark');
        document.body.classList.add('dark-theme');
        document.getElementById('switchIcon').src = '../images/light_theme.jpg';
    }
    /**
     * Sets a cookie to remember the user's chosen theme
     */
    document.cookie = "theme=" + localStorage.getItem('theme');
}
/**
 * Adds an event listener that toggles the theme when the theme toggle icon is clicked
 */
icon.addEventListener('click', toggleTheme);