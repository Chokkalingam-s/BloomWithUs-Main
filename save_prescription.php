<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bloom";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collect form data
$unique_id = $_POST['unique_id'];
$medication_prescribed = isset($_POST['medication_prescribed']) ? $_POST['medication_prescribed'] : '';
$notes = isset($_POST['notes']) ? $_POST['notes'] : '';
$key_therapies = isset($_POST['key_therapies']) ? $_POST['key_therapies'] : '';
$diseases = isset($_POST['diseases']) ? $_POST['diseases'] : '';
$doctor_name = $_POST['doctor_name'];
$time_duration = $_POST['time_duration'];
$medicine_took = $_POST['medicine_took'];

if (!empty($_FILES['prescription_image']['name'])) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["prescription_image"]["name"]);
    move_uploaded_file($_FILES["prescription_image"]["tmp_name"], $target_file);
    $prescription_image = $target_file;
} else {
    $prescription_image = NULL;
}

// Check if prescription exists for the unique_id
$sql_check = "SELECT * FROM prescription WHERE unique_id = '$unique_id'";
$result_check = $conn->query($sql_check);

if ($result_check->num_rows > 0) {
    // Update existing prescription
    $sql_update = "UPDATE prescription SET 
                    key_therapies = '$key_therapies', 
                    medication_prescribed = '$medication_prescribed', 
                    notes = '$notes',
                    diseases = '$diseases'
                   WHERE unique_id = '$unique_id'";

    if ($conn->query($sql_update) === TRUE) {
        echo "Prescription updated successfully";
    } else {
        echo "Error updating prescription: " . $conn->error;
    }
} else {
    // Insert new prescription
    $sql_insert = "INSERT INTO prescription (unique_id, patient_first_name, patient_last_name, key_therapies, medication_prescribed, notes, diseases)
                   VALUES ('$unique_id', 
                           (SELECT patient_first_name FROM appointments WHERE unique_id = '$unique_id' LIMIT 1), 
                           (SELECT patient_last_name FROM appointments WHERE unique_id = '$unique_id' LIMIT 1), 
                           '$key_therapies', '$medication_prescribed', '$notes', '$diseases')";

    if ($conn->query($sql_insert) === TRUE) {
        echo "New prescription saved successfully";
    } else {
        echo "Error creating prescription: " . $conn->error;
    }
}

// Check if a row with the unique_id already exists
$sql_check = "SELECT unique_id FROM old_prescriptions WHERE unique_id = ?";
$stmt_check = $conn->prepare($sql_check);
$stmt_check->bind_param("s", $unique_id);
$stmt_check->execute();
$result_check = $stmt_check->get_result();

if ($result_check->num_rows > 0) {
    // Update existing prescription
    $sql_update = "UPDATE old_prescriptions SET 
                    doctor_name = ?, 
                    time_duration = ?, 
                    medicine_took = ?, 
                    prescription_image = ?
                   WHERE unique_id = ?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("sssss", $doctor_name, $time_duration, $medicine_took, $prescription_image, $unique_id);

    if ($stmt_update->execute()) {
        echo "!";
    } else {

    }
} else {
    // Insert new prescription
    $sql_insert = "INSERT INTO old_prescriptions (unique_id, doctor_name, time_duration, medicine_took, prescription_image)
                   VALUES (?, ?, ?, ?, ?)";
    $stmt_insert = $conn->prepare($sql_insert);
    $stmt_insert->bind_param("sssss", $unique_id, $doctor_name, $time_duration, $medicine_took, $prescription_image);

    if ($stmt_insert->execute()) {
        echo "!";
    } else {

    }
}

// Close the statements
$stmt_check->close();
if (isset($stmt_update)) $stmt_update->close();
if (isset($stmt_insert)) $stmt_insert->close();
?>