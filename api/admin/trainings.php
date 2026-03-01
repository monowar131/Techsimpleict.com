<?php
header('Content-Type: application/json');
require_once '../db.php';
require_once 'auth_check.php';

checkAdminAuth();

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        $stmt = $pdo->query("SELECT t.*, c.name as category FROM trainings t LEFT JOIN classifications c ON t.classification_id = c.id");
        echo json_encode($stmt->fetchAll());
        break;

    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        $stmt = $pdo->prepare("INSERT INTO trainings (title, description, price, instructor, schedule, deadline, classification_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $data['title'],
            $data['description'],
            $data['price'],
            $data['instructor'],
            $data['schedule'],
            $data['deadline'],
            $data['classification_id']
        ]);
        echo json_encode(['success' => true, 'id' => $pdo->lastInsertId()]);
        break;

    case 'PUT':
        $data = json_decode(file_get_contents('php://input'), true);
        $stmt = $pdo->prepare("UPDATE trainings SET title = ?, description = ?, price = ?, instructor = ?, schedule = ?, deadline = ?, classification_id = ? WHERE id = ?");
        $stmt->execute([
            $data['title'],
            $data['description'],
            $data['price'],
            $data['instructor'],
            $data['schedule'],
            $data['deadline'],
            $data['classification_id'],
            $data['id']
        ]);
        echo json_encode(['success' => true]);
        break;

    case 'DELETE':
        $id = $_GET['id'] ?? null;
        if ($id) {
            $stmt = $pdo->prepare("DELETE FROM trainings WHERE id = ?");
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
