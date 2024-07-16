<?php
include 'db_connection.php';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$unique_id = $_GET['unique_id'];
$sql = "SELECT a.patient_first_name, a.patient_last_name, p.key_therapies,p.diseases, p.medication_prescribed, p.notes , p.notes2, p.patient_image
        FROM appointments a
        LEFT JOIN prescription p ON a.unique_id = p.unique_id
        WHERE a.unique_id = '$unique_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Base URL for images
    $baseURL = 'http://localhost/BloomWithUs/uploads/'; // Replace with your actual base URL

    // Append image URL to the result if an image exists
    if (!empty($row['patient_image'])) {
        $row['patient_image'] = $baseURL . $row['patient_image'];
    }

    echo json_encode($row);
} else {
    echo json_encode([
        'patient_first_name' => '',
        'patient_last_name' => '',
        'key_therapies' => '',
        'diseases'=>'',
        'medication_prescribed' => '',
        'notes' => '',
        'notes2' => '',
        'patient_image' => ''
    ]);
}

$conn->close();
?>
