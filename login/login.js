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
 * The password input element
 * @var {HTMLElement} password
 */
const password = document.getElementById('password');
/**
 * The password toggle checkbox element
 * @var {HTMLElement} passwordToggleBox
 */
const passwordToggleBox = document.getElementById('passwordToggle');
/**
 * toggles visibility of the password between text and bullet points
 */
const PassToggle = () =>  {
    if (password.type === "password") {
        password.type = "text";
    } else {
        password.type = "password";
    }
}
/**
 * Attaches an event listener to the password toggle icon to toggle the visibility of the password
 */
passwordToggleBox.addEventListener('click', PassToggle);
/**
 * Displays error message on the input
 * @param {HTMLElement} item - the input element
 * @param {string} message - the error message
 */
const setError = (item, message) => {
    const inputControl = item.parentElement;
    const errorDisplay = inputControl.querySelector('.error');

    errorDisplay.innerText = message;
    inputControl.classList.add('error');
    inputControl.classList.remove('success');
}
/**
 * Removes error message and error status from the input
 * @param {HTMLElement} item - the input element
 */
const setSuccess = (item) => {
    const inputControl = item.parentElement;
    const errorDisplay = inputControl.querySelector('.error');

    errorDisplay.innerText = '';
    inputControl.classList.add('success');
    inputControl.classList.remove('error');
}
/**
 * Validates the input of the form when the form is submitted
 * @param {Event} e - the form submission event
 */
const check = (e) => {
    const usernameInFunc = username.value.trim();
    const passwordInFunc = password.value.trim();

    if (usernameInFunc === ''){
        setError(username, 'You need to write a name!');
        e.preventDefault();
    } else{
        setSuccess(username);
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
 * Attaches an event listener to the form to run the check function when the form is submitted
 */
form.addEventListener('submit', check);