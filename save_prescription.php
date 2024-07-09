<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bloom";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$unique_id = $_POST['unique_id'];
$medication_prescribed = isset($_POST['medication_prescribed']) ? $_POST['medication_prescribed'] : '';
$notes = isset($_POST['notes']) ? $_POST['notes'] : '';
$key_therapies = isset($_POST['key_therapies']) ? $_POST['key_therapies'] : '';

$sql = "INSERT INTO prescription (unique_id, patient_first_name, patient_last_name, key_therapies, medication_prescribed, notes)
        VALUES ('$unique_id', 
                (SELECT patient_first_name FROM appointments WHERE unique_id = '$unique_id' LIMIT 1), 
                (SELECT patient_last_name FROM appointments WHERE unique_id = '$unique_id' LIMIT 1), 
                '$key_therapies', '$medication_prescribed', '$notes')
        ON DUPLICATE KEY UPDATE 
            key_therapies = '$key_therapies', 
            medication_prescribed = '$medication_prescribed', 
            notes = '$notes'";

if ($conn->query($sql) === TRUE) {
    echo "Prescription saved successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
