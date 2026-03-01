<?php
header('Content-Type: application/json');
require_once 'db.php';

try {
    // Fetch trainings with their latest active offer (if any)
    $stmt = $pdo->prepare("
        SELECT t.*, c.name as category, o.discount_type, o.discount_value, o.start_date as offer_start, o.end_date as offer_end
        FROM trainings t
        LEFT JOIN classifications c ON t.classification_id = c.id
        LEFT JOIN offers o ON t.id = o.training_id 
            AND NOW() BETWEEN o.start_date AND o.end_date
        ORDER BY t.created_at DESC
    ");
    $stmt->execute();
    $trainings = $stmt->fetchAll();

    echo json_encode($trainings);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
