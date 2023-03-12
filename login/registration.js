/**
 * Validate the form fields on submission
 */
/**
 * The form element
 * @var {HTMLElement} form
 */
const form = document.getElementById('form');
/**
 * The username input element
 * @var {HTMLElement} username
 */
const username = document.getElementById('username');
/**
 * The email input element
 * @var {HTMLElement} email
 */
const email = document.getElementById('email');
/**
 * The password input element
 * @var {HTMLElement} password
 */
const password = document.getElementById('password');
/**
 * The email input element
 * @var {HTMLElement} email
 */
const birthday = document.getElementById('birthday');
/**
 * The password toggle checkbox element
 * @var {HTMLElement} passwordToggleBox
 */
const passwordToggleBox = document.getElementById('passwordToggle');
/**
 * Set the minimum and maximum allowable date for the birthday field
 */
birthday.min="1920-01-01";
birthday.max = new Date().toLocaleDateString('en-ca');
/**
 * Toggles the visibility of the password field
 */
const PassToggle = () =>  {
    if (password.type === "password") {
        password.type = "text";
    } else {
        password.type = "password";
    }
}
/**
 * Adds a click event listener for the password toggle checkbox
 */
passwordToggleBox.addEventListener('click', PassToggle);
/**
 * Display an error message for an input field
 *
 * @param {HTMLElement} item - The input field
 * @param {string} message - The error message
 */
const setError = (item, message) => {
    const inputControl = item.parentElement;
    const errorDisplay = inputControl.querySelector('.error');

    errorDisplay.innerText = message;
    inputControl.classList.add('error');
    inputControl.classList.remove('success');
}
/**
 * Remove the error message for an input field and mark it as valid
 *
 * @param {HTMLElement} item - The input field
 */
const setSuccess = (item) => {
    const inputControl = item.parentElement;
    const errorDisplay = inputControl.querySelector('.error');

    errorDisplay.innerText = '';
    inputControl.classList.add('success');
    inputControl.classList.remove('error');
}
/**
 * Check whether the input is a valid email address
 *
 * @param {string} mail - The email address to validate
 * @returns {boolean} - Returns true if the email is valid, false otherwise
 */
function ValidateEmail(mail) {
    return /[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/.test(mail);
}
/**
 * Validate the form fields on submission
 *
 * @param {Event} e - The form submission event
 */
const check = (e) => {
    const usernameInFunc = username.value.trim();
    const emailInFunc = email.value.trim();
    const passwordInFunc = password.value.trim();
    const birthdayInFunc = birthday.value;

    if (usernameInFunc === ''){
        setError(username, 'You need to write a name!');
        e.preventDefault();
    } else{
        setSuccess(username);
    }

    if (birthdayInFunc === ''){
        setError(birthday, 'You need to input your birthday!');
        e.preventDefault();
    } else{
        setSuccess(birthday);
    }

    if (emailInFunc === ''){
        setError(email, 'You need to write an email!');
        e.preventDefault();
    } else if (!ValidateEmail(emailInFunc)){
        setError(email, 'Your email is not valid!');
        e.preventDefault();
    } else {
        setSuccess(email);
    }

    if (passwordInFunc === ''){
        setError(password, 'You need to write a password!');
        e.preventDefault();
    } else if (passwordInFunc.length <= 7){
        setError(password, 'Your password must be longer that 8 char.!');
        e.preventDefault();
    } else{
        setSuccess(password);
    }
};
/**
 * Add a submit event listener for the form
 */
form.addEventListener('submit', check);