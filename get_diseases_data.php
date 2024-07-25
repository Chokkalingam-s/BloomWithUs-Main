<?php
header('Content-Type: application/json');

include 'db_connection.php';
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed']);
    exit();
}

// Fetch diseases from the appointments table
$query = "SELECT diseases FROM prescription";
$result = $conn->query($query);

$diseaseCounts = [];
$knownDiseases = [
    'Major Depressive Disorder (MDD)',
    'Generalized Anxiety Disorder (GAD)',
    'Panic Disorder',
    'Social Anxiety Disorder',
    'Post-Traumatic Stress Disorder (PTSD)',
    'Obsessive-Compulsive Disorder (OCD)',
    'Acute Stress Disorder'
];

// Initialize known diseases count
foreach ($knownDiseases as $disease) {
    $diseaseCounts[$disease] = 0;
}
$diseaseCounts['Others'] = 0;

while ($row = $result->fetch_assoc()) {
    $disease = $row['diseases'];
    if (in_array($disease, $knownDiseases)) {
        $diseaseCounts[$disease]++;
    } else {
        $diseaseCounts['Others']++;
    }
}

$labels = array_keys($diseaseCounts);
$data = array_values($diseaseCounts);

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
