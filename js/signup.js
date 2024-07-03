$(document).ready(function () {
    const email = $('#email');
    const password = $('#password');
    const confirmPassword = $('#confirmPassword');
    const emailErr = email.next();
    const passErr = password.next();
    const cnfmpassErr = confirmPassword.next();

    function validateEmail(em) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(em);
    }

    function validatePassword(password) {
        return password.length >= 8;
    }

    function validateForm() {
        let valid = true;
        emailErr.text('')
        passErr.text('')
        cnfmpassErr.text('')

        // Validate email
        if (!validateEmail(email.val())) {
            emailErr.text('Please enter a valid email address.');
            valid = false;
        }

        // Validate password
        let passValid = validatePassword(password.val())
        if (!passValid) {
            passErr.text('Password must be at least 8 characters long.');
            valid = false;
        }

        // Confirm password match
        if (passValid && password.val() !== confirmPassword.val()) {
            cnfmpassErr.text('Passwords do not match.');
            valid = false;
        }

        return valid;
    }

    // Submit form handler
    $('#signupForm').submit(function (event) {
        if (!validateForm()) {
            event.preventDefault();
        }
    });
});
