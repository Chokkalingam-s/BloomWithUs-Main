<?php
session_start();

include 'db_connection.php';

$conn = new mysqli($servername, $db_username, $db_password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch user input
$user = $_POST['username'];
$pass = $_POST['password'];

// Prepare and execute
$sql = "SELECT password FROM crmlogin WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->bind_result($stored_password);
    $stmt->fetch();

    // Direct password comparison
    if ($pass === $stored_password) {
        $_SESSION['username'] = $user;
        header("Location: admin_dashboard.php");
        exit();
    } else {
        echo "<script>alert('Incorrect password.'); window.location.href='login.php';</script>";
    }
} else {
    echo "<script>alert('Username not found.'); window.location.href='login.php';</script>";
}

$stmt->close();
$conn->close();
?>
