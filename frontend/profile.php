<?php
session_start();
include('../config/db.php');

if (!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit();
}

$email = $_SESSION['user'];
$stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

$profilePic = (!empty($user['profile_picture']) && file_exists("../uploads/" . $user['profile_picture'])) ? '../uploads/' . $user['profile_picture'] : '../assets/images/default_user.png';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Edit Profile - Golden Acres</title>
    <link rel="stylesheet" href="css/headerfooter.css" />
    <style>
        /* Profile page styles */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #e8edf3;
            margin: 0; padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
        }
        h2 {
            text-align: center;
            color: #0078d7;
            margin-bottom: 20px;
        }
        img.profile-pic {
            display: block;
            margin: 0 auto 20px auto;
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #0078d7;
        }
        label {
            display: block;
            font-weight: 600;
            color: #005ca8;
            margin-bottom: 6px;
        }
        input[type="text"],
        input[type="file"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 1rem;
        }
        button {
            background: #0078d7;
            color: white;
            border: none;
            padding: 14px;
            width: 100%;
            border-radius: 6px;
            cursor: pointer;
            font-size: 1.1rem;
        }
        button:hover {
            background: #005ea1;
        }
        .saved-properties-list {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    margin-top: 20px;
}

.property-card {
    background: #fff;
    border: 1px solid #ddd;
    padding: 15px;
    border-radius: 8px;
    width: 220px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.property-card img {
    border-radius: 6px;
    object-fit: cover;
    margin-bottom: 10px;
}

.property-card h3 {
    margin: 0 0 10px;
    font-size: 1.1rem;
}

.property-card p {
    margin: 5px 0;
    font-size: 0.9rem;
}

.property-card a {
    display: inline-block;
    margin-top: 10px;
    color: #0078d7;
    text-decoration: none;
    font-weight: 600;
}
.property-card a:hover {
    text-decoration: underline;
}

    </style>
</head>
<body>
    <!-- ===== Header ===== -->
  <header class="header">
    <div class="container">
      <a href="login.html" class="logo"><i class="fas fa-house"></i> Golden Acres</a>
      <input type="checkbox" id="menu-toggle">
      <label for="menu-toggle" class="mobile-icon"><i class="fas fa-bars"></i></label>
      <nav>
        <ul>
          <li><a href="login.html">Buy</a></li>
          <li><a href="add-land.html">Sell</a></li>
          <li><a href="#">Help <i class="fas fa-angle-down"></i></a>
            <ul>
              <li><a href="about.html">About Us</a></li>
              <li><a href="contact.html">Contact Us</a></li>
              <li><a href="contact.html#faq">FAQ</a></li>
            </ul>
          </li>
          <li><a href="#">Account <i class="fas fa-angle-down"></i></a>
            <ul>
              <li><a href="login.html">Login</a></li>
              <li><a href="register.html">Register</a></li>
              <li><a href="profile.html">Profile</a></li>
            </ul>
          </li>
        </ul>
      </nav>
    </div>
  </header>
    <div class="container">
        <h2>Edit Your Profile</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <img src="<?php echo htmlspecialchars($profilePic); ?>?v=<?php echo time(); ?>" alt="Profile Picture" class="profile-pic">

            <label for="profile_picture">Change Profile Picture</label>
            <input type="file" id="profile_picture" name="profile_picture" accept="image/*">

            <label for="name">Name</label>
            <input type="text" id="name" name="name" value=" " required>

            <label for="address">Address</label>
            <input type="text" id="address" name="address" value=" " required>

            <button type="submit">Update Profile</button>
        </form>
        <p style="text-align:center; margin-top:15px;">
            <a href="userdashboard.php" style="color:#0078d7; text-decoration:none;">Back to Dashboard</a>
        </p>
    </div>
    <h2>Saved Properties</h2>

<?php if (count($savedProperties) > 0): ?>
    <div class="saved-properties-list">
        <?php foreach ($savedProperties as $property): ?>
            <div class="property-card">
                <img src="<?php echo htmlspecialchars($property['image_path']); ?>" alt="Property Image" width="200" height="150">
                <h3><?php echo htmlspecialchars($property['title']); ?></h3>
                <p><i class="fas fa-map-marker-alt"></i> <?php echo htmlspecialchars($property['location']); ?></p>
                <p><i class="fas fa-tag"></i> ₹ <?php echo number_format($property['price']); ?></p>
                <a href="view_property.php?id=<?php echo $property['id']; ?>">View Details</a>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <p>You have not saved any properties yet.</p>
<?php endif; ?>

    <!-- ===== Footer ===== -->
  <footer class="footer">
    <div class="container">
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
        <a href="https://www.facebook.com/"><i class="fab fa-facebook"></i> Facebook</a>
        <a href="https://x.com/X."><i class="fab fa-twitter"></i> Twitter</a>
        <a href="https://www.linkedin.com/"><i class="fab fa-linkedin"></i> LinkedIn</a>
        <a href="https://www.instagram.com/"><i class="fab fa-instagram"></i> Instagram</a>
      </div>
    </div>
    <div class="credit">© 2025 Golden Acres | All rights reserved.</div>
  </footer>

    <script>
        // Profile picture preview
        document.getElementById('profile_picture').addEventListener('change', function(e) {
            const reader = new FileReader();
            reader.onload = function() {
                document.querySelector('.profile-pic').src = reader.result;
            }
            reader.readAsDataURL(e.target.files[0]);
        });
    </script>
</body>
</html>
