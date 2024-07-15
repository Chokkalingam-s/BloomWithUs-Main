<?php
// get_old_prescription.php
include 'db_connection.php';

if (isset($_GET['unique_id'])) {
    $unique_id = $_GET['unique_id'];
    $conn = new mysqli($servername, $db_username, $db_password, $dbname);
    // Query to fetch old prescription details
    $query = "SELECT * FROM old_prescriptions WHERE unique_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $unique_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $old_prescription = $result->fetch_assoc();
        echo json_encode($old_prescription);
    } else {
        echo json_encode(['message' => 'Old prescription not found']);
    }
}
?>