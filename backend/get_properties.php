<?php
header('Content-Type: application/json');
$conn = new mysqli('localhost', 'root', '', 'real_estate');
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(['error' => 'Database connection failed']);
    exit;
}
$where = [];
if (!empty($_GET['location'])) {
    $location = $conn->real_escape_string($_GET['location']);
    $where[] = "location LIKE '%$location%'";
}
if (!empty($_GET['type'])) {
    $type = $conn->real_escape_string($_GET['type']);
    $where[] = "type='$type'";
}
if (!empty($_GET['offer'])) {
    $offer = $conn->real_escape_string($_GET['offer']);
    $where[] = "offer='$offer'";
}
if (!empty($_GET['min_price'])) {
    $min = intval($_GET['min_price']);
    $where[] = "price >= $min";
}
if (!empty($_GET['max_price'])) {
    $max = intval($_GET['max_price']);
    $where[] = "price <= $max";
}
$where_sql = count($where) ? 'WHERE ' . implode(' AND ', $where) : '';
$sql = "SELECT * FROM properties $where_sql ORDER BY is_paid DESC, created_at DESC";
$result = $conn->query($sql);
$listings = [];
while ($row = $result->fetch_assoc()) {
    $row['images'] = explode(',', $row['images']);
    $listings[] = $row;
}
echo json_encode($listings);
$conn->close();
