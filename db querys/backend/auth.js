document.addEventListener('DOMContentLoaded', () => {
    const loginForm = document.getElementById('login-form');
    const registerForm = document.getElementById('register-form');

    if (loginForm) {
        loginForm.addEventListener('submit', async function (e) {
            e.preventDefault();
            const formData = new FormData(loginForm);
            const response = await fetch('backend/login.php', {
                method: 'POST',
                body: formData
            });
            const result = await response.json();
            showMessage(result);
        });
    }

    if (registerForm) {
        registerForm.addEventListener('submit', async function (e) {
            e.preventDefault();
            const formData = new FormData(registerForm);
            const response = await fetch('backend/register.php', {
                method: 'POST',
                body: formData
            });
            const result = await response.json();
            showMessage(result);
        });
    }

    function showMessage(result) {
        const errorDiv = document.getElementById('error-message');
        errorDiv.style.display = 'block';
        errorDiv.style.color = result.status === 'success' ? 'green' : 'red';
        errorDiv.textContent = result.message;

        if (result.status === 'success') {
            setTimeout(() => window.location.href = 'login.html', 1500);
        }
    }
});
