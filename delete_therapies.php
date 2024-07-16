<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $unique_id = $_POST['unique_id'];
    $therapiesName = $_POST['therapies_name'];
    $timesPerDay = $_POST['times_per_day'];
    $sos = $_POST['sos'];

    include 'db_connection.php';
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "DELETE FROM therapies WHERE unique_id = ? AND therapies_name = ? AND times_per_day = ? AND sos = ?";

    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die('Prepare statement error: ' . $conn->error);
    }

    $stmt->bind_param("isis", $unique_id, $therapiesName, $timesPerDay, $sos);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
