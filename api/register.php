<?php
header('Content-Type: application/json');
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['error' => 'Invalid request method']);
    exit;
}

$training_id = $_POST['training_id'] ?? null;
$full_name = $_POST['full_name'] ?? null;
$email = $_POST['email'] ?? null;
$phone = $_POST['phone'] ?? null;

if (!$training_id || !$full_name || !$email || !$phone) {
    echo json_encode(['error' => 'Required fields missing']);
    exit;
}

try {
    // Check deadline
    $stmt = $pdo->prepare("SELECT deadline FROM trainings WHERE id = ?");
    $stmt->execute([$training_id]);
    $training = $stmt->fetch();

    if (!$training) {
        echo json_encode(['error' => 'Training not found']);
        exit;
    }

    if (strtotime($training['deadline']) < time()) {
        echo json_encode(['error' => 'Registration deadline has passed']);
        exit;
    }

    // Insert registration
    $stmt = $pdo->prepare("INSERT INTO registrations (training_id, full_name, email, phone) VALUES (?, ?, ?, ?)");
    $stmt->execute([$training_id, $full_name, $email, $phone]);

    echo json_encode(['success' => true, 'message' => 'Registration successful']);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
