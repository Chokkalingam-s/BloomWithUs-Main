<?php
header('Content-Type: application/json');

include 'db_connection.php';
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if POST parameters are set
if (isset($_POST['unique_id']) && isset($_POST['appointment_date']) && isset($_POST['cancel_remarks'])) {
    $unique_id = $_POST['unique_id'];
    $appointmentDate = $_POST['appointment_date'];
    $cancel_remarks = $_POST['cancel_remarks'];

    // Update query to set cancel_remarks and change emergency value
    $query = "UPDATE appointments SET cancel_remarks = ?, emergency = 78 WHERE unique_id = ? AND appointment_date = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('sss', $cancel_remarks, $unique_id, $appointmentDate);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update appointment']);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Missing parameters']);
}

$conn->close();
?>
