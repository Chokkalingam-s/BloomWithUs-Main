<?php
session_start();

// Database connection logic (adjust as per your setup)
$host = 'localhost';
$dbname = 'bloom';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Assuming you have a table named 'medicine' with fields 'medicine_name', 'times_per_day', 'dose', 'before_after_meal', 'sos'
    $uniqueId = $_GET['unique_id']; // Adjust as per your data flow

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
