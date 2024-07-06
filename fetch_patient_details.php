<?php
include 'db_connection.php';

$uniqueId = $_GET['unique_id'];
$conn = openConnection();

$sql = "SELECT * FROM appointments WHERE unique_id = '$uniqueId'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo json_encode($result->fetch_assoc());
} else {
    echo json_encode([]);
}

closeConnection($conn);
?>
