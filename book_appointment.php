<?php
header('Content-Type: application/json');

include 'db_connection.php';
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'error' => 'Connection failed: ' . $conn->connect_error]);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get data from POST request
    $uniqueId = $_POST['unique_id'] ?? null;
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
    $emergencyStatus = isset($_POST['emergency']) ? 1 : 0;

    if ($uniqueId) {
        // Fetch existing details from the database
        $sql = "SELECT * FROM appointments WHERE unique_id = '$uniqueId'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        if ($row) {
            // Prepare data for new row
            $firstName = $row['first_name'];
            $lastName = $row['last_name'];
            $patientFirstName = $row['patient_first_name'];
            $patientLastName = $row['patient_last_name'];
            $relation = $row['relation_to_patient'];
            $profession = $row['profession'];
            $dob = $row['dob'];
            $age = $row['age'];
            $gender = $row['gender'];
            $phoneNumber = $row['phone_number'];
            $patientNumber = $row['patient_number'];
            $email = $row['email'];

            // Insert new row into the appointments table
            $sql = "INSERT INTO appointments 
                    (first_name, last_name, patient_first_name, patient_last_name, relation_to_patient, appointment_date, time_slot, profession, dob, age, gender, phone_number, patient_number, email, unique_id, emergency)
                    VALUES 
                    ('$firstName', '$lastName', '$patientFirstName', '$patientLastName', '$relation', '$appointmentDate', '$timeSlot', '$profession', '$dob', '$age', '$gender', '$phoneNumber', '$patientNumber', '$email', '$uniqueId' , '$emergencyStatus')";

            // Perform SQL query
            if (mysqli_query($conn, $sql)) {
                echo json_encode(['success' => true, 'appointmentID' => $uniqueId]);
            } else {
                echo json_encode(['success' => false, 'error' => 'Database Error: ' . mysqli_error($conn)]);
            }
        } else {
            echo json_encode(['success' => false, 'error' => 'No existing record found for the provided unique_id.']);
        }
    } else {
        // Handle case where unique_id is not provided
                // Generate new unique ID
                
       // Convert patient first name, last name, and gender to initials
$firstNameInitial = strtoupper(substr($patientFirstName, 0, 1));
$lastNameInitial = strtoupper(substr($patientLastName, 0, 1));
$genderInitial = strtoupper(substr($gender, 0, 1));
$bookingDate = date('dmy', strtotime($appointmentDate)); // Convert to DDMMYY
$timeSlotArray = explode(' ', $timeSlot, 4); // Split into a maximum of 2 elements
$firstElement = $timeSlotArray[0];


// Create unique ID
$uniqueId = $firstNameInitial . $lastNameInitial . $genderInitial . '-' . $bookingDate . '-' . $firstElement;

        
                // Insert new record
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
