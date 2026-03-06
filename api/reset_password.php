<?php
header('Content-Type: application/json');
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['error' => 'Invalid request method']);
    exit;
}

$email = $_POST['email'] ?? null;
$new_password = $_POST['new_password'] ?? null;

if (!$email || !$new_password) {
    echo json_encode(['error' => 'Email and new password required']);
    exit;
}

try {
    // Check if user exists
    $stmt = $pdo->prepare("SELECT id FROM admins WHERE email = ?");
    $stmt->execute([$email]);
    if (!$stmt->fetch()) {
        echo json_encode(['error' => 'No account found with this email']);
        exit;
    }

    $hash = password_hash($new_password, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("UPDATE admins SET password_hash = ? WHERE email = ?");
    $stmt->execute([$hash, $email]);

    echo json_encode(['success' => true, 'message' => 'Password reset successfully']);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
