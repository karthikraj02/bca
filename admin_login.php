<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'real_estate');
if ($conn->connect_error) {
    die('Connection Failed : ' . $conn->connect_error);
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['pass'];
    $sql = "SELECT * FROM users WHERE email='$email' AND role='admin'";
    $result = $conn->query($sql);
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            echo 'Admin login successful.';
        } else {
            echo 'Invalid password.';
        }
    } else {
        echo 'Admin user not found.';
    }
}
$conn->close();
