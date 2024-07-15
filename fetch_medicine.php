<?php
session_start();


$host = 'localhost';
include 'db_connection.php';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $uniqueId = $_GET['unique_id']; 

    // Fetch medicine data for a specific unique_id
    $stmt = $pdo->prepare("SELECT * FROM medicines WHERE unique_id = :unique_id");
    $stmt->execute(['unique_id' => $uniqueId]);
    $medicines = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Return JSON response
    header('Content-Type: application/json');
    echo json_encode(['success' => true, 'data' => $medicines]);
    exit();
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
    exit();
}
?>
