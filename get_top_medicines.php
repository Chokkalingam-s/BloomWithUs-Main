<?php
header('Content-Type: application/json');

include 'db_connection.php';

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed']);
    exit();
}

// Query to get the top 5 most frequently used medicines
$query = "
    SELECT medicine_name, COUNT(*) as count
    FROM medicines
    GROUP BY medicine_name
    ORDER BY count DESC
    LIMIT 5
";
$result = $conn->query($query);

$labels = [];
$data = [];

while ($row = $result->fetch_assoc()) {
    $labels[] = $row['medicine_name'];
    $data[] = $row['count'];
}

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
                'rgba(153, 102, 255, 0.2)'
            ],
            'borderColor' => [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)'
            ],
            'borderWidth' => 1
        ]
    ]
]);

$conn->close();
?>
