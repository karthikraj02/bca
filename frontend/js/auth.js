document.getElementById('login-form').addEventListener('submit', async (e) => {
    e.preventDefault();
    
    const formData = new FormData(e.target);
    const errorDiv = document.getElementById('error-message');
    
    try {
        const response = await fetch('path/to/your/register.php', {
            method: 'POST',
            body: formData
        });
        
        const result = await response.json();
        
        if (result.status === 'success') {
            errorDiv.style.display = 'none';
            if (result.redirect) {
                window.location.href = result.redirect;
            }
        } else {
            errorDiv.textContent = result.message;
            errorDiv.style.display = 'block';
        }
    } catch (error) {
        errorDiv.textContent = 'Network error - please try again';
        errorDiv.style.display = 'block';
    }
});