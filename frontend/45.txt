<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login | Golden Acres</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"/>
  <link rel="stylesheet" href="css/style.css" />
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f5f5f5;
    }

    .header, .footer {
      background: #fff;
      box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }

    .header .flex, .footer .flex {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 1rem 2rem;
      max-width: 1200px;
      margin: auto;
    }

    .header a.logo {
      font-size: 1.5rem;
      font-weight: 600;
      color: #333;
      text-decoration: none;
    }

    .header ul, .header .menu ul {
      list-style: none;
      display: flex;
      gap: 1rem;
    }

    .header li a {
      text-decoration: none;
      color: #333;
      font-weight: 500;
    }

    .form-container {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 80vh;
    }

    form#login-form {
      background: #fff;
      padding: 2rem;
      border-radius: 10px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
      width: 100%;
      max-width: 400px;
    }

    form h3 {
      text-align: center;
      margin-bottom: 1.5rem;
      font-size: 1.5rem;
      color: #333;
    }

    .box {
      width: 100%;
      padding: 0.8rem;
      margin: 0.5rem 0;
      border: 1px solid #ccc;
      border-radius: 6px;
    }

    .btn {
      width: 100%;
      background: #0078d7;
      color: #fff;
      padding: 0.8rem;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-size: 1rem;
      transition: background 0.3s;
    }

    .btn:hover {
      background: #005bb5;
    }

    form p {
      margin-top: 1rem;
      text-align: center;
    }

    form p a {
      color: #0078d7;
      text-decoration: none;
      font-weight: 500;
    }

    .error-message {
      margin-top: 1rem;
      color: red;
      text-align: center;
      font-size: 0.9rem;
    }

    .footer {
      background: #fff;
      padding: 2rem 0;
      border-top: 1px solid #ddd;
      font-size: 0.9rem;
    }

    .footer .box {
      display: flex;
      flex-direction: column;
      gap: 0.5rem;
    }

    .footer .credit {
      text-align: center;
      margin-top: 1rem;
      color: #888;
    }

    @media (max-width: 768px) {
      .header .flex, .footer .flex {
        flex-direction: column;
        gap: 1rem;
      }
    }
  </style>
  <script src="js/auth.js" defer></script>
</head>
<body>

  <header class="header">
    <div class="flex">
      <a href="index.html" class="logo"><i class="fas fa-house"></i> Golden Acres</a>
      <ul>
        <li><a href="index.html">Buy</a></li>
        <li><a href="add-land.html">Sell</a></li>
        <li><a href="about.html">About</a></li>
        <li><a href="contact.html">Contact</a></li>
      </ul>
    </div>
  </header>

  <section class="form-container">
    <form id="login-form">
      <h3>Welcome Back</h3>
      <input type="email" id="email" name="email" placeholder="Enter your email" class="box" required />
      <input type="password" id="password" name="password" placeholder="Enter your password" class="box" required />
      <input type="submit" value="Login Now" class="btn" />
      <p>New user? <a href="register.html">Sign Up</a></p>
      <div id="error-message" class="error-message" style="display:none;"></div>
    </form>
  </section>

  <footer class="footer">
    <div class="flex">
      <div class="box">
        <a href="tel:8050027829"><i class="fas fa-phone"></i> 8050027829</a>
        <a href="mailto:goldenacres@gmail.com"><i class="fas fa-envelope"></i> goldenacres@gmail.com</a>
        <a href="#"><i class="fas fa-map-marker-alt"></i> Udupi, Karnataka, India</a>
      </div>

      <div class="box">
        <a href="index.html">Home</a>
        <a href="listings.html">Listings</a>
        <a href="about.html">About</a>
        <a href="contact.html">Contact</a>
      </div>

      <div class="box">
        <a href="#"><i class="fab fa-facebook"></i> Facebook</a>
        <a href="#"><i class="fab fa-twitter"></i> Twitter</a>
        <a href="#"><i class="fab fa-linkedin"></i> LinkedIn</a>
        <a href="#"><i class="fab fa-instagram"></i> Instagram</a>
      </div>
    </div>
    <div class="credit">© 2025 Golden Acres | All rights reserved.</div>
  </footer>

  <script src="js/script.js"></script>
</body>
</html>
