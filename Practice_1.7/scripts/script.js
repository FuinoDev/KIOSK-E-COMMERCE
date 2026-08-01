document.addEventListener('DOMContentLoaded', function () {
    // Select all input fields and relevant DOM elements
    const inputs = document.querySelectorAll('.login__input');
    const eye = document.getElementById('login-eye');
    const passwordInput = document.getElementById('password');

    // Dynamic input label behavior
    inputs.forEach(input => {
        input.addEventListener('focus', function () {
            if (this.nextElementSibling) {
                this.nextElementSibling.classList.add('login__label-active');
            }
        });

        input.addEventListener('blur', function () {
            if (this.value === '' && this.nextElementSibling) {
                this.nextElementSibling.classList.remove('login__label-active');
            }
        });
    });

    // Toggle password visibility
    if (eye && passwordInput) {
        eye.addEventListener('click', function () {
            const isPasswordVisible = passwordInput.type === 'password';
            passwordInput.type = isPasswordVisible ? 'text' : 'password';

            // Toggle eye icon classes
            this.classList.toggle('ri-eye-line', isPasswordVisible);
            this.classList.toggle('ri-eye-off-line', !isPasswordVisible);
        });
    }
});
