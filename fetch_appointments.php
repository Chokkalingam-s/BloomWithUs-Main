<?php
header('Content-Type: application/json');

include 'db_connection.php';
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if (isset($_GET['date'])) {
    $date = $_GET['date'];
    $query = "SELECT *,
       CASE
           WHEN time_slot LIKE '10:00 AM%' THEN 1
           WHEN time_slot LIKE '10:30 AM%' THEN 2
           WHEN time_slot LIKE '11:00 AM%' THEN 3
           WHEN time_slot LIKE '11:30 AM%' THEN 4
           WHEN time_slot LIKE '12:00 PM%' THEN 5
           WHEN time_slot LIKE '12:30 PM%' THEN 6
           WHEN time_slot LIKE '01:00 PM%' THEN 7
           WHEN time_slot LIKE '02:00 PM%' THEN 8
           WHEN time_slot LIKE '02:30 PM%' THEN 9
           WHEN time_slot LIKE '03:00 PM%' THEN 10
           WHEN time_slot LIKE '03:30 PM%' THEN 11
           WHEN time_slot LIKE '04:00 PM%' THEN 12
           WHEN time_slot LIKE '04:30 PM%' THEN 13
           WHEN time_slot LIKE '05:00 PM%' THEN 14
           WHEN time_slot LIKE '05:30 PM%' THEN 15
           ELSE 999
       END AS slot_order
FROM appointments
WHERE appointment_date = '$date'
ORDER BY slot_order ASC;
";

    $result = mysqli_query($conn, $query);

    if ($result) {
        $appointments = array();

        while ($row = mysqli_fetch_assoc($result)) {
            $appointments[] = array(
                'unique_id' => $row['unique_id'],
                'time_slot' => $row['time_slot'],
                'first_name' => $row['first_name'],
                'last_name' => $row['last_name'],
                 'emergency'=> $row['emergency']
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