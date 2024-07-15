<?php
header('Content-Type: application/json');

include 'db_connection.php';
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'error' => 'Connection failed: ' . $conn->connect_error]);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Process form submission
    $firstName = $_POST['reservationFirstName'] ?? '';
    $lastName = $_POST['reservationLastName'] ?? '';
    $patientFirstName = $_POST['reservationPatientFirstName'] ?? '';
    $patientLastName = $_POST['reservationPatientLastName'] ?? '';
    $relation = $_POST['reservationRelation'] ?? '';
    $appointmentDate = $_POST['reservationDate'] ?? '';
    $timeSlot = $_POST['reservationTimeSlot'] ?? '';
    $profession = $_POST['reservationProfession'] ?? '';
    $dob = $_POST['reservationDOB'] ?? '';
    $age = $_POST['reservationAge'] ?? '';
    $gender = $_POST['reservationGender'] ?? '';
    $phoneNumber = $_POST['reservationPhoneNumber'] ?? '';
    $patientNumber = $_POST['reservationPatientNumber'] ?? '';
    $email = $_POST['reservationEmail'] ?? '';
    $uniqueId = $_POST['reservationPatientId'] ?? '';
    $sql = "INSERT INTO appointments 
    (first_name, last_name, patient_first_name, patient_last_name, relation_to_patient, appointment_date, time_slot, profession, dob, age, gender, phone_number, patient_number, email, unique_id)
    VALUES 
    ('$firstName', '$lastName', '$patientFirstName', '$patientLastName', '$relation', '$appointmentDate', '$timeSlot', '$profession', '$dob', '$age', '$gender', '$phoneNumber', '$patientNumber', '$email', '$uniqueId')";

// Perform SQL query
if (mysqli_query($conn, $sql)) {
    echo json_encode(['success' => true, 'appointmentID' => $uniqueId , 'reservationDate' => $appointmentDate, 'reservationTimeSlot' => $timeSlot]);
} else {
echo json_encode(['success' => false, 'error' => 'Database Error: ' . mysqli_error($conn)]);
}
} 

mysqli_close($conn);
?>
