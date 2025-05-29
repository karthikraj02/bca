<?php
session_start();
include('../config/db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Basic validation (add more as needed)
    if (!empty($email) && !empty($password)) {
        // Prepare and execute statement to get user data
        $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user) {
            // Assuming password is hashed, verify it
            if (password_verify($password, $user['password'])) {
                // Login success: set session variables
                $_SESSION['user'] = $user['email'];
                $_SESSION['username'] = $user['name']; // <-- Set profile name here

                // Redirect to dashboard or homepage
                header("Location: userdashboard.php");
                exit();
            } else {
                $error = "Invalid email or password.";
            }
        } else {
            $error = "Invalid email or password.";
        }
    } else {
        $error = "Please enter email and password.";
    }
}
?>

<!-- Your login form HTML below here -->
