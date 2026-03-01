<?php
header('Content-Type: application/json');
require_once 'db.php';

if (!isset($_GET['id'])) {
    echo json_encode(['error' => 'Missing ID']);
    exit;
}

$id = $_GET['id'];

try {
    $stmt = $pdo->prepare("
        SELECT t.*, c.name as category, o.discount_type, o.discount_value, o.start_date as offer_start, o.end_date as offer_end
        FROM trainings t
        LEFT JOIN classifications c ON t.classification_id = c.id
        LEFT JOIN offers o ON t.id = o.training_id 
            AND NOW() BETWEEN o.start_date AND o.end_date
        WHERE t.id = ?
    ");
    $stmt->execute([$id]);
    $training = $stmt->fetch();

    if ($training) {
        echo json_encode($training);
    } else {
        echo json_encode(['error' => 'Training not found']);
    }
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
