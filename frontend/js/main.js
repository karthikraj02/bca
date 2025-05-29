// frontend/js/main.js (Property Fetching and Adding)
document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('add-land-form');
    if (form) {
        form.addEventListener('submit', async (event) => {
            event.preventDefault();
            const title = form.title.value.trim();
            const location = form.location.value.trim();
            const price = form.price.value.trim();
            const description = form.description.value.trim();

            if (!title || !location || !price || !description || isNaN(price) || price <= 0) {
                document.getElementById('error-message').style.display = 'block';
                setTimeout(() => {
                    document.getElementById('error-message').style.display = 'none';
                }, 3000);
                return;
            }

            try {
                const response = await fetch('http://localhost:3000/api/properties', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ title, location, price, description })
                });

                if (response.ok) {
                    form.reset();
                    document.getElementById('success-message').style.display = 'block';
                    setTimeout(() => {
                        document.getElementById('success-message').style.display = 'none';
                    }, 3000);
                }
            } catch (error) {
                console.error('Error adding land:', error);
            }
        });
    }
});
