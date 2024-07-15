<?php
header('Content-Type: application/json');

include 'db_connection.php';
$conn = new mysqli($servername, $username, $password, $dbname);
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

        // Query to fetch previous appointments
        $query_previous = "SELECT appointment_date, time_slot FROM appointments WHERE unique_id = '$unique_id' AND appointment_date < CURDATE() ORDER BY appointment_date DESC";
        $result_previous = mysqli_query($conn, $query_previous);
        $previous_appointments = [];
        while ($row = mysqli_fetch_assoc($result_previous)) {
            $previous_appointments[] = $row;
        }

        // Query to fetch future appointments
        $query_future = "SELECT appointment_date, time_slot FROM appointments WHERE unique_id = '$unique_id' AND appointment_date >= CURDATE() ORDER BY appointment_date ASC";
        $result_future = mysqli_query($conn, $query_future);
        $future_appointments = [];
        while ($row = mysqli_fetch_assoc($result_future)) {
            $future_appointments[] = $row;
        }

        // Adding previous and future appointments to the main appointment array
        $appointment['previous_appointments'] = $previous_appointments;
        $appointment['future_appointments'] = $future_appointments;

        // Return JSON response
        echo json_encode($appointment);
    } else {
        echo json_encode(array('message' => 'Appointment not found'));
    }

    mysqli_free_result($result);

    mysqli_close($conn);
} else {
    echo json_encode(array('message' => 'Unique ID parameter is missing'));
}
?>
