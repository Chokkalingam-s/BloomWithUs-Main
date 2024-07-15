<?php
include 'db_connection.php';

if (isset($_GET['date'])) {
    $date = $_GET['date'];
    $conn = openConnection();
    $date = $conn->real_escape_string($date);
    $sql = "SELECT time_slot FROM appointments WHERE appointment_date = '$date'";
    $result = $conn->query($sql);

    $occupiedSlots = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $occupiedSlots[] = $row['time_slot'];
        }
    }

    echo json_encode($occupiedSlots);

    closeConnection($conn);
} else {
    echo json_encode([]);
}
?>
