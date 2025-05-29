<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'real_estate');
if ($conn->connect_error) {
    die('Connection Failed : ' . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = password_hash($_POST['pass'], PASSWORD_DEFAULT);
    $role = isset($_POST['role']) ? $conn->real_escape_string($_POST['role']) : 'buyer';

    $check = $conn->query("SELECT * FROM users WHERE email='$email'");
    if ($check->num_rows > 0) {
        echo 'Email already registered.';
    } else {
        $sql = "INSERT INTO users (name, email, password, role) VALUES ('$name', '$email', '$password', '$role')";
        if ($conn->query($sql) === TRUE) {
            echo 'Registration successful.';
        } else {
            echo 'Error: ' . $conn->error;
        }
    }
}
$conn->close();
