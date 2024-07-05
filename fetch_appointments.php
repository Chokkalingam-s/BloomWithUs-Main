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

// Check if date parameter is set
if (isset($_GET['date'])) {
    $date = $_GET['date'];

    // Query to fetch appointments for the specified date
    $query = "SELECT * FROM appointments WHERE appointment_date = '$date' ORDER BY time_slot ASC";

    $result = mysqli_query($conn, $query);

    if ($result) {
        $appointments = array();

        while ($row = mysqli_fetch_assoc($result)) {
            $appointments[] = array(
                'unique_id' => $row['unique_id'],
                'time_slot' => $row['time_slot']
                // Add more fields as needed
            );
        }

        // Return JSON response
        echo json_encode($appointments);
    } else {
        echo json_encode(array('message' => 'No appointments found'));
    }

    // Free result set
    mysqli_free_result($result);

    // Close connection
    mysqli_close($conn);
} else {
    echo json_encode(array('message' => 'Date parameter is missing'));
}

?>

