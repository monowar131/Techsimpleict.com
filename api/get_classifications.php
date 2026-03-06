<?php
header('Content-Type: application/json');
require_once 'db.php';

try {
    $stmt = $pdo->query("SELECT * FROM classifications");
    echo json_encode($stmt->fetchAll());
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
