<?php
$servername = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "bloom";

$username = "root";
$password = "";

function openConnection() {
    global $servername, $db_username, $db_password, $dbname;

    // Create connection
    $conn = new mysqli($servername, $db_username, $db_password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}

// Function to close the database connection
function closeConnection($conn) {
    $conn->close();
}
?>
