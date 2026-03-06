<?php
header('Content-Type: application/json');
require_once '../db.php';
require_once 'auth_check.php';

checkAdminAuth();

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    $stmt = $pdo->query("SELECT r.*, t.title as training_title FROM registrations r JOIN trainings t ON r.training_id = t.id ORDER BY r.registration_date DESC");
    echo json_encode($stmt->fetchAll());
} else {
    echo json_encode(['error' => 'Method not allowed']);
}
?>
