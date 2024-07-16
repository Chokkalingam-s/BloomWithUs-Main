<?php
include 'db_connection.php';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$unique_id = $_GET['unique_id'];
$sql = "SELECT a.patient_first_name, a.patient_last_name, p.key_therapies,p.diseases, p.medication_prescribed, p.notes , p.notes2
        FROM appointments a
        LEFT JOIN prescription p ON a.unique_id = p.unique_id
        WHERE a.unique_id = '$unique_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode($row);
} else {
    echo json_encode([
        'patient_first_name' => '',
        'patient_last_name' => '',
        'key_therapies' => '',
        'diseases'=>'',
        'medication_prescribed' => '',
        'notes' => '',
        'notes2' => ''
    ]);
}

$conn->close();
?>
