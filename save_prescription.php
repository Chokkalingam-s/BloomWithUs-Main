<?php
include 'db_connection.php';

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
$notes2 = isset($_POST['notes2']) ? $_POST['notes2'] : '';
$diseases = isset($_POST['diseases']) ? $_POST['diseases'] : '';
$doctor_name = $_POST['doctor_name'];
$time_duration = $_POST['time_duration'];
$medicine_took = $_POST['medicine_took'];

$medicine_table_data = isset($_POST['medicineData']) ? json_decode($_POST['medicineData'], true) : [];

foreach ($medicine_table_data as $medicine) {
    $medicine_name = $medicine['medicineName'];
    $times_per_day = $medicine['noOfTimes'];
    $dose_mg = intval($medicine['quantity']);
    $meal = $medicine['meal'];
    $sos = $medicine['sos'] ? 1 : 0;

    $stmt = $conn->prepare("INSERT INTO medicines (unique_id, medicine_name, times_per_day, dose_mg, before_after_meal, sos) 
                            VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssisss", $unique_id, $medicine_name, $times_per_day, $dose_mg, $meal, $sos);

    // Execute the query
    if ($stmt->execute()) {
        echo "";
    } else {
        echo json_encode(array('message' => 'Error: ' . $stmt->error));
    }

    // Close statement
    $stmt->close();
}

$therapies_table_data = isset($_POST['therapiesData']) ? json_decode($_POST['therapiesData'], true) : [];

foreach ($therapies_table_data as $therapies) {
    $therapies_name_array = $therapies['therapiesName'];
    $therapies_name = implode(', ', $therapies_name_array);
    $times_per_day = $therapies['noOfTimes'];
    $meal = $therapies['meal'];
    $sos = $therapies['sos'] ? 1 : 0;

    $stmt = $conn->prepare("INSERT INTO therapies (unique_id, therapies_name, times_per_day, before_after_meal, sos) 
                            VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssiss", $unique_id, $therapies_name, $times_per_day, $meal, $sos);

    // Execute the query
    if ($stmt->execute()) {
        echo "";
    } else {
        echo json_encode(array('message' => 'Error: ' . $stmt->error));
    }

    // Close statement
    $stmt->close();
}

if (!empty($_FILES['prescription_image']['name'])) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["prescription_image"]["name"]);
    move_uploaded_file($_FILES["prescription_image"]["tmp_name"], $target_file);
    $prescription_image = $target_file;
} else {
    $prescription_image = NULL;
}

$targetDir = "uploads/"; // Directory where images will be uploaded
$patientImage = ''; // Variable to store the image file name

if (!empty($_FILES['patient_image']['name'])) {
    $fileName = basename($_FILES['patient_image']['name']);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    // Allow certain file formats
    $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
    if (in_array($fileType, $allowTypes)) {
        // Upload file to server
        if (move_uploaded_file($_FILES['patient_image']['tmp_name'], $targetFilePath)) {
            $patientImage = $targetFilePath;
        } else {
            echo "Error uploading file.";
            exit();
        }
    } else {
        echo "File format not supported.";
        exit();
    }
}

// Check if prescription exists for the unique_id
$sql_check = "SELECT * FROM prescription WHERE unique_id = '$unique_id'";
$result_check = $conn->query($sql_check);

if ($result_check->num_rows > 0) {
    // Update existing prescription
    $sql_update = "UPDATE prescription SET 
                    medication_prescribed = '$medication_prescribed', 
                    notes = '$notes',
                    notes2 = '$notes2',
                    diseases = '$diseases'
                   WHERE unique_id = '$unique_id'";

    if ($conn->query($sql_update) === TRUE) {
        echo "Prescription updated successfully";
    } else {
        echo "Error updating prescription: " . $conn->error;
    }
} else {
    // Insert new prescription
    $sql_insert = "INSERT INTO prescription (unique_id, patient_first_name, patient_last_name, medication_prescribed, notes, diseases, notes2, patient_image)
                   VALUES ('$unique_id', 
                           (SELECT patient_first_name FROM appointments WHERE unique_id = '$unique_id' LIMIT 1), 
                           (SELECT patient_last_name FROM appointments WHERE unique_id = '$unique_id' LIMIT 1), 
                            '$medication_prescribed', '$notes', '$diseases', '$notes2', '$patientImage')";

    if ($conn->query($sql_insert) === TRUE) {
        echo "New prescription saved successfully";
    } else {
        echo "Error creating prescription: " . $conn->error;
    }
}

// Prepare the select query to check if the record exists
$select_query = "SELECT prescription_image FROM old_prescriptions WHERE unique_id = ?";
$stmt_select = $conn->prepare($select_query);
$stmt_select->bind_param("s", $unique_id);
$stmt_select->execute();
$stmt_select->store_result();
$stmt_select->bind_result($existing_prescription_image);
$record_exists = $stmt_select->num_rows > 0;
$stmt_select->fetch();
$stmt_select->close();

if ($record_exists) {
    // Update the record if it exists
    if ($prescription_image !== null) {
        $update_query = "UPDATE old_prescriptions SET doctor_name = ?, time_duration = ?, medicine_took = ?, prescription_image = ? WHERE unique_id = ?";
        $stmt_update = $conn->prepare($update_query);
        $stmt_update->bind_param("sssss", $doctor_name, $time_duration, $medicine_took, $prescription_image, $unique_id);
    } else {
        $update_query = "UPDATE old_prescriptions SET doctor_name = ?, time_duration = ?, medicine_took = ? WHERE unique_id = ?";
        $stmt_update = $conn->prepare($update_query);
        $stmt_update->bind_param("ssss", $doctor_name, $time_duration, $medicine_took, $unique_id);
    }
    $stmt_update->execute();

    if ($stmt_update->affected_rows > 0) {
        echo "!";
    } else {
        echo "!";
    }
    $stmt_update->close();
} else {
    // Insert the record if it doesn't exist
    $insert_query = "INSERT INTO old_prescriptions (unique_id, doctor_name, time_duration, medicine_took, prescription_image) VALUES (?, ?, ?, ?, ?)";
    $stmt_insert = $conn->prepare($insert_query);
    $stmt_insert->bind_param("sssss", $unique_id, $doctor_name, $time_duration, $medicine_took, $prescription_image);
    $stmt_insert->execute();

    if ($stmt_insert->affected_rows > 0) {
        echo "!";
    } else {
        echo "Error saving old prescription";
    }
    $stmt_insert->close();
}

$conn->close();
?>