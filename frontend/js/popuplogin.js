<script>
    // Login Modal Handling
    document.addEventListener('DOMContentLoaded', () => {
      const loginTriggers = document.querySelectorAll('.login-trigger');
      const loginModal = document.getElementById('loginModal');
      const overlay = document.getElementById('loginOverlay');

      // Show modal
      loginTriggers.forEach(trigger => {
        trigger.addEventListener('click', (e) => {
          e.preventDefault();
          loginModal.classList.add('active');
          overlay.classList.add('active');
        });
      });
  

      // Hide modal
      overlay.addEventListener('click', () => {
        loginModal.classList.remove('active');
        overlay.classList.remove('active');
      });

      // Close on ESC key
      document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
          loginModal.classList.remove('active');
          overlay.classList.remove('active');
        }
      });
    });
  </script>