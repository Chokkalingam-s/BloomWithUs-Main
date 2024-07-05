<?php
header('Content-Type: application/json');

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bloom";
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if unique_id parameter is set
if (isset($_GET['unique_id'])) {
    $unique_id = $_GET['unique_id'];

    // Query to fetch appointment details
    $query = "SELECT * FROM appointments WHERE unique_id = '$unique_id'";

    $result = mysqli_query($conn, $query);

    if ($result) {
        $appointment = mysqli_fetch_assoc($result);

        // Return JSON response
        echo json_encode($appointment);
    } else {
        echo json_encode(array('message' => 'Appointment not found'));
    }

    // Free result set
    mysqli_free_result($result);

    // Close connection
    mysqli_close($conn);
} else {
    echo json_encode(array('message' => 'Unique ID parameter is missing'));
}

?>