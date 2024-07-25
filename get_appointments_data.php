<?php
header('Content-Type: application/json');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'db_connection.php';
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed']);
    exit();
}

$query = "SELECT YEAR(appointment_date) as year, MONTH(appointment_date) as month, COUNT(*) as appointments_count FROM appointments GROUP BY YEAR(appointment_date), MONTH(appointment_date)";
$result = $conn->query($query);

if (!$result) {
    echo json_encode(['success' => false, 'message' => 'Query failed: ' . $conn->error]);
    exit();
}

$labels = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
$data = [];
while ($row = $result->fetch_assoc()) {
    $year = $row['year'];
    $month = $row['month'] - 1; // Month index for Chart.js starts from 0 (January)
    $appointments_count = $row['appointments_count'];

    if (!isset($data[$year])) {
        $data[$year] = array_fill(0, 12, 0);
    }
    $data[$year][$month] = $appointments_count;
}

$datasets = [];
foreach ($data as $year => $appointments) {
    $datasets[] = [
        'label' => $year,
        'data' => $appointments,
        'backgroundColor' => 'rgba(' . rand(0, 255) . ',' . rand(0, 255) . ',' . rand(0, 255) . ', 0.2)',
        'borderColor' => 'rgba(' . rand(0, 255) . ',' . rand(0, 255) . ',' . rand(0, 255) . ', 1)',
        'borderWidth' => 1
    ];
}

echo json_encode([
    'labels' => $labels,
    'datasets' => $datasets
]);

$conn->close();
?>
