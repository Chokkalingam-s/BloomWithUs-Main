<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $unique_id = $_POST['unique_id'];
    $medicineName = $_POST['medicine_name'];
    $timesPerDay = $_POST['times_per_day'];
    $doseMg = $_POST['dose_mg'];
    $sos = $_POST['sos'];

    include 'db_connection.php';
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "DELETE FROM medicines WHERE unique_id = ? AND medicine_name = ? AND times_per_day = ? AND dose_mg = ? AND sos = ?";

    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die('Prepare statement error: ' . $conn->error);
    }

    $stmt->bind_param("isiss", $unique_id, $medicineName, $timesPerDay, $doseMg, $sos);

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
