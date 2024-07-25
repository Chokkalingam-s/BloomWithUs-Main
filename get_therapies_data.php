<?php
header('Content-Type: application/json');

include 'db_connection.php';

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed']);
    exit();
}

$query = "SELECT key_therapies FROM prescription";
$result = $conn->query($query);

$therapyCounts = [];
$knownTherapies = [
    'Cognitive behavioural therapy',
    'Relaxation therapy',
    'Behavioural therapy',
    'Art therapy',
    'Interpersonal therapy',
    'Emotion focused therapy',
    'Family therapy'
];

foreach ($knownTherapies as $therapy) {
    $therapyCounts[$therapy] = 0;
}
$therapyCounts['Others'] = 0;

while ($row = $result->fetch_assoc()) {
    $therapy = $row['key_therapies'];
    if (in_array($therapy, $knownTherapies)) {
        $therapyCounts[$therapy]++;
    } else {
        $therapyCounts['Others']++;
    }
}

$labels = array_keys($therapyCounts);
$data = array_values($therapyCounts);

echo json_encode([
    'labels' => $labels,
    'datasets' => [
        [
            'data' => $data,
            'backgroundColor' => [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(199, 199, 199, 0.2)',
                'rgba(83, 102, 255, 0.2)'
            ],
            'borderColor' => [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(199, 199, 199, 1)',
                'rgba(83, 102, 255, 1)'
            ],
            'borderWidth' => 1
        ]
    ]
]);

$conn->close();
?>
