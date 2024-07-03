$(document).ready(function () {
    const emailInput = $('#__email');
    const passwordInput = $('#__pass');
    const submitButton = $('#submit-btn');
    const emailError = emailInput.next();
    const passwordError = passwordInput.next();

    function validateEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }

    function validateForm() {
        let isValid = true;

        if (!validateEmail(emailInput.val())) {
            emailError.text('Please enter a valid email address');
            isValid = false;
        } else {
            emailError.text('');
        }

        if (passwordInput.val().length < 6) {
            passwordError.text('Password must be at least 6 characters long');
            isValid = false;
        } else {
            passwordError.text('');
        }

        return isValid;
    }

    function checkFormValidity() {
        if (validateEmail(emailInput.val()) && passwordInput.val().length >= 6) {
            submitButton.removeAttr('disabled');
        } else {
            submitButton.attr('disabled', 'disabled');
        }
    }

    emailInput.on('input', checkFormValidity);
    passwordInput.on('input', checkFormValidity);
});
