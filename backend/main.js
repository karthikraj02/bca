document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('add-land-form');
    const successMessage = document.getElementById('success-message');

    if (form) {
        form.addEventListener('submit', async (e) => {
            e.preventDefault();

            const formData = new FormData(form);
            const response = await fetch('backend/add-land.php', {
                method: 'POST',
                body: formData
            });

            const result = await response.json();

            if (result.status === 'success') {
                successMessage.style.display = 'block';
                form.reset();
            } else {
                alert(result.message);
            }
        });
    }
});
