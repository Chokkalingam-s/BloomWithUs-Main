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

// Prepare and execute query
$stmt = $mysqli->prepare("SELECT * FROM therapies WHERE unique_id = ?");
if ($stmt === false) {
    echo json_encode(['success' => false, 'message' => 'Prepare failed: ' . $mysqli->error]);
    exit();
}

$stmt->bind_param('s', $uniqueId);
$stmt->execute();
$result = $stmt->get_result();

if ($result === false) {
    echo json_encode(['success' => false, 'message' => 'Query failed: ' . $stmt->error]);
    exit();
}

$therapies = $result->fetch_all(MYSQLI_ASSOC);

// Return JSON response
header('Content-Type: application/json');
echo json_encode(['success' => true, 'data' => $therapies]);

// Clean up
$stmt->close();
$mysqli->close();
?>
