<?php
// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve POST data
    $unique_id = $_POST['unique_id'];
    $medicineName = $_POST['medicine_name'];
    $timesPerDay = $_POST['times_per_day'];
    $doseMg = $_POST['dose_mg'];
    $sos = $_POST['sos'];

    include 'db_connection.php';

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL statement to delete the medicine record
    $sql = "DELETE FROM medicines WHERE unique_id = ? AND medicine_name = ? AND times_per_day = ? AND dose_mg = ? AND sos = ?";

    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die('Prepare statement error: ' . $conn->error);
    }

    $stmt->bind_param("isiss", $unique_id, $medicineName, $timesPerDay, $doseMg, $sos);

    // Execute the statement
    if ($stmt->execute()) {
        // Return success message to the AJAX call
        echo "success";
    } else {
        // Return error message to the AJAX call
        echo "error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    // Return error if request method is not POST
    echo "Invalid request method.";
}
?>
