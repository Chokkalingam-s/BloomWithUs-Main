<?php
session_start();

$host = 'localhost';
include 'db_connection.php';

// Create connection
$mysqli = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($mysqli->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Connection failed: ' . $mysqli->connect_error]);
    exit();
}

// Set charset to utf8mb4
$mysqli->set_charset('utf8mb4');

$uniqueId = $_GET['unique_id']; 

// Fetch medicine data for a specific unique_id
$stmt = $mysqli->prepare("SELECT * FROM medicines WHERE unique_id = ?");
$stmt->bind_param('s', $uniqueId);
$stmt->execute();
$result = $stmt->get_result();
$medicines = $result->fetch_all(MYSQLI_ASSOC);

// Return JSON response
header('Content-Type: application/json');
echo json_encode(['success' => true, 'data' => $medicines]);

// Close statement and connection
$stmt->close();
$mysqli->close();
?>
