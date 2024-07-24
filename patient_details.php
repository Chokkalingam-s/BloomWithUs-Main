<?php
header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);

if (isset($input['firstName'], $input['lastName'], $input['phoneNumber'])) {
    $firstName = $input['firstName'];
    $lastName = $input['lastName'];
    $phoneNumber = $input['phoneNumber'];

    try {
        $pdo = new PDO('mysql:host=localhost;dbname=bloom', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Fetch the unique_id
        $stmt = $pdo->prepare('SELECT unique_id FROM appointments WHERE patient_first_name = ? AND patient_last_name = ? AND patient_number = ?');
        $stmt->execute([$firstName, $lastName, $phoneNumber]);
        $row = $stmt->fetch();

        if ($row) {
            $unique_id = $row['unique_id'];

            // Fetch future appointments
            $stmt = $pdo->prepare('
                SELECT appointment_date, time_slot
                FROM appointments
                WHERE unique_id = ? AND appointment_date >= CURDATE()
                ORDER BY appointment_date ASC
            ');
            $stmt->execute([$unique_id]);
            $futureAppointments = $stmt->fetchAll(PDO::FETCH_ASSOC);

            echo json_encode([
                'unique_id' => $unique_id,
                'future_appointments' => $futureAppointments
            ]);
        } else {
            echo json_encode(['unique_id' => null, 'future_appointments' => []]);
        }
    } catch (PDOException $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'Invalid input']);
}
?>
