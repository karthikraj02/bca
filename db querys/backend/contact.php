<?php
require 'db.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $number = $_POST['number'] ?? '';
    $message = $_POST['message'] ?? '';

    // Validate required fields
    if (!$name || !$email || !$number || !$message) {
        echo json_encode(['status' => 'error', 'message' => 'All fields are required.']);
        exit;
    }

    // Insert into database
    $stmt = $pdo->prepare("INSERT INTO contact_messages (name, email, phone, message) VALUES (?, ?, ?, ?)");
    $success = $stmt->execute([$name, $email, $number, $message]);

    if ($success) {
        echo json_encode(['status' => 'success', 'message' => 'Message sent s]()_
