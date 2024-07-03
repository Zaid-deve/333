// Wait for the document to be ready
$(document).ready(function() {

    // Function to validate email
    function validateEmail(email) {
        // Basic regex for email validation
        const re = /\S+@\S+\.\S+/;
        return re.test(email);
    }

    // Function to validate password
    function validatePassword(password) {
        // Password length validation example
        return password.length >= 8;
    }

    // Function to handle form validation
    function validateForm() {
        // Fetch input values
        const email = $('#email').val();
        const password = $('#password').val();
        const confirmPassword = $('#confirmPassword').val();

        // Reset any previous errors
        $('#emailError').text('');
        $('#passwordError').text('');
        $('#confirmPasswordError').text('');

        let valid = true;

        // Validate email
        if (!validateEmail(email)) {
            $('#emailError').text('Please enter a valid email address.');
            valid = false;
        }

        // Validate password
        if (!validatePassword(password)) {
            $('#passwordError').text('Password must be at least 8 characters long.');
            valid = false;
        }

        // Confirm password match
        if (password !== confirmPassword) {
            $('#confirmPasswordError').text('Passwords do not match.');
            valid = false;
        }

        // Enable/disable submit button based on validation
        $('#submit-btn').prop('disabled', !valid);

        return valid;
    }

    // Submit form handler
    $('#signupForm').submit(function(event) {
        // Validate form before submission
        if (!validateForm()) {
            // Prevent form submission if validation fails
            event.preventDefault();
        }
    });

    // Optional: You can add additional event listeners or form validations as needed

});
