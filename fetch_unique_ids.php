<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bloom";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = $_GET['query'];
$sql = "SELECT DISTINCT unique_id FROM appointments WHERE unique_id LIKE '%$query%'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo '<a class="dropdown-item">' . $row['unique_id'] . '</a>';
    }
} else {
    echo '<a class="dropdown-item">No results</a>';
}

$conn->close();
?>
