<?php
include 'db_connection.php';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

header('Content-Type: application/json');

$query = "SELECT * FROM `doctor_achievements` WHERE 1";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode([
        'people_treated' => $row['people_treated'],
        'lectures_seminars' => $row['lectures_seminars'],
        'years_experience' => $row['years_experience']
    ]);
} else {
    echo json_encode([
        'people_treated' => 0,
        'lectures_seminars' => 0,
        'years_experience' => 0
    ]);
}

$conn->close();
?>
