<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    echo 'Unauthorized.';
    exit;
}
$conn = new mysqli('localhost', 'root', '', 'real_estate');
if ($conn->connect_error) {
    http_response_code(500);
    echo 'Database connection failed';
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $sql = "DELETE FROM properties WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo 'Property deleted successfully.';
    } else {
        echo 'Error: ' . $conn->error;
    }
} else {
    echo 'Invalid request.';
}
$conn->close();
