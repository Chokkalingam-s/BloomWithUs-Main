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
    echo json_encode(['success' => false, 'error' => 'Connection failed: ' . $conn->connect_error]);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Process form submission
    $firstName = $_POST['first_name'] ?? '';
    $lastName = $_POST['last_name'] ?? '';
    $patientFirstName = $_POST['patient_first_name'] ?? '';
    $patientLastName = $_POST['patient_last_name'] ?? '';
    $relation = $_POST['relation_to_patient'] ?? '';
    $appointmentDate = $_POST['appointment_date'] ?? '';
    $timeSlot = $_POST['time_slot'] ?? '';
    $profession = $_POST['profession'] ?? '';
    $dob = $_POST['dob'] ?? '';
    $age = $_POST['age'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $phoneNumber = $_POST['phone_number'] ?? '';
    $patientNumber = $_POST['patient_number'] ?? '';
    $email = $_POST['email'] ?? '';

    // Generate unique ID
    $firstNameInitial = strtoupper(substr($firstName, 0, 1));
    $lastNameInitial = strtoupper(substr($lastName, 0, 1));
    $genderInitial = strtoupper(substr($gender, 0, 1));
    $bookingDate = date('d/m/Y', strtotime($appointmentDate));
    $uniqueId = $firstNameInitial . $lastNameInitial . $genderInitial . '-' . $bookingDate . '-' . str_replace(' ', '', $timeSlot);

    // SQL query to insert data into appointments table
    $sql = "INSERT INTO appointments 
            (first_name, last_name, patient_first_name, patient_last_name, relation_to_patient, appointment_date, time_slot, profession, dob, age, gender, phone_number, patient_number, email, unique_id)
            VALUES 
            ('$firstName', '$lastName', '$patientFirstName', '$patientLastName', '$relation', '$appointmentDate', '$timeSlot', '$profession', '$dob', '$age', '$gender', '$phoneNumber', '$patientNumber', '$email', '$uniqueId')";

    // Perform SQL query
    if (mysqli_query($conn, $sql)) {
        echo json_encode(['success' => true, 'appointmentID' => $uniqueId]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Database Error: ' . mysqli_error($conn)]);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['date'])) {
    // Fetch booked time slots for the given date
    $date = $_GET['date'];
    $sql = "SELECT time_slot FROM appointments WHERE appointment_date = '$date'";
    $result = $conn->query($sql);

    $bookedSlots = [];
    while ($row = $result->fetch_assoc()) {
        $bookedSlots[] = $row['time_slot'];
    }
    echo json_encode(['success' => true, 'bookedSlots' => $bookedSlots]);
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request']);
}

// Close connection
mysqli_close($conn);
?>