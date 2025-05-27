<?php
require 'db.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $location = $_POST['location'] ?? '';
    $price = $_POST['price'] ?? '';
    $description = $_POST['description'] ?? '';

    // Validate inputs
    if (!$title || !$location || !$price || !$description) {
        echo json_encode(['status' => 'error', 'message' => 'All fields are required.']);
        exit;
    }

    // Insert into database
    $stmt = $pdo->prepare("INSERT INTO land_listings (title, location, price, description) VALUES (?, ?, ?, ?)");
    $success = $stmt->execute([$title, $location, $price, $description]);

    if ($success) {
        echo json_encode(['status' => 'success', 'message' => 'Land listing added successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to add listing.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request.']);
}
?>
