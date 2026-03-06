<?php
header('Content-Type: application/json');
require_once '../db.php';
require_once 'auth_check.php';

checkAdminAuth();

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        $stmt = $pdo->query("SELECT o.*, t.title as training_title FROM offers o JOIN trainings t ON o.training_id = t.id");
        echo json_encode($stmt->fetchAll());
        break;

    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        $stmt = $pdo->prepare("INSERT INTO offers (training_id, discount_type, discount_value, start_date, end_date) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([
            $data['training_id'],
            $data['discount_type'],
            $data['discount_value'],
            $data['start_date'],
            $data['end_date']
        ]);
        echo json_encode(['success' => true, 'id' => $pdo->lastInsertId()]);
        break;

    case 'DELETE':
        $id = $_GET['id'] ?? null;
        if ($id) {
            $stmt = $pdo->prepare("DELETE FROM offers WHERE id = ?");
            $stmt->execute([$id]);
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['error' => 'Missing ID']);
        }
        break;

    default:
        echo json_encode(['error' => 'Method not allowed']);
        break;
}
?>
