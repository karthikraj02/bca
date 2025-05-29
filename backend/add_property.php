<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'real_estate');
if ($conn->connect_error) {
    die('Connection Failed : ' . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();
    if (!isset($_SESSION['user_id'])) {
        echo 'Unauthorized.';
        exit;
    }
    $user_id = $_SESSION['user_id'];
    $title = $conn->real_escape_string($_POST['title']);
    $description = $conn->real_escape_string($_POST['description']);
    $type = $conn->real_escape_string($_POST['type']);
    $offer = $conn->real_escape_string($_POST['offer']);
    $bhk = isset($_POST['bhk']) ? intval($_POST['bhk']) : null;
    $location = $conn->real_escape_string($_POST['location']);
    $price = intval($_POST['price']);
    $is_paid = isset($_POST['is_paid']) ? 1 : 0;
    // For simplicity, images are handled as a comma-separated string of filenames
    $images = isset($_POST['images']) ? $conn->real_escape_string($_POST['images']) : '';

    $sql = "INSERT INTO properties (user_id, title, description, type, offer, bhk, location, price, images, is_paid) VALUES ($user_id, '$title', '$description', '$type', '$offer', $bhk, '$location', $price, '$images', $is_paid)";
    if ($conn->query($sql) === TRUE) {
        echo 'Property listed successfully.';
    } else {
        echo 'Error: ' . $conn->error;
    }
}
$conn->close();
