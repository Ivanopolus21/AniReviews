/**
 * The comment element
 * @var {HTMLElement} comment
 */
const comment = document.getElementById("comment");
/**
 * The form element
 * @var {HTMLElement} form
 */
const form = document.getElementById("form");
/**
 * Variable that takes the icon that toggles a theme
 * @var {HTMLElement} icon
 */
const icon = document.getElementById('switchIcon');
/**
 * Attach click event listeners to all images with the class "media_div" to display them in a lightbox
 */
document.querySelectorAll('.media_div img').forEach(image => {
    image.onclick = () => {
        document.querySelector('.pop-up-image').style.display = 'block';
        document.querySelector('.pop-up-image img').src = image.getAttribute('src');
    }
});
/**
 * Attach a click event listener to the lightbox close button to hide the lightbox
 */
document.querySelector('.pop-up-image span').onclick = () => {
    document.querySelector('.pop-up-image').style.display = 'none';
}
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
    document.cookie = "theme=" + localStorage.getItem('theme');
}
/**
 * Add click event listener to toggle theme
 */
icon.addEventListener('click', toggleTheme);
/**
 * Validate the form fields on submission
 *
 * @param {Event} e - The form submission event
 */
const check = (e) => {
    const trim_comment=comment.value.trim();
    if(trim_comment===""){
        alert("Please, write a comment!");
        e.preventDefault();
    }
}
/**
 * Add submit event listener to validate comment
 */
if (form) {
    form.addEventListener("submit", check);
}
