<?php
session_start();
header('Content-Type: application/json');
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['error' => 'Invalid request method']);
    exit;
}

// Accept email from POST data (FormData) or JSON body
$email = $_POST['email'] ?? $_POST['username'] ?? null;
$password = $_POST['password'] ?? null;

// Fallback: try reading JSON body if POST is empty
if (!$email || !$password) {
    $rawInput = file_get_contents('php://input');
    $jsonData = json_decode($rawInput, true);
    if ($jsonData) {
        $email = $jsonData['email'] ?? $jsonData['username'] ?? $email;
        $password = $jsonData['password'] ?? $password;
    }
}

if (!$email || !$password) {
    echo json_encode(['error' => 'Email and password required']);
    exit;
}

try {
    $stmt = $pdo->prepare("SELECT * FROM admins WHERE email = ?");
    $stmt->execute([$email]);
    $admin = $stmt->fetch();

    if ($admin && password_verify($password, $admin['password_hash'])) {
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['admin_username'] = $admin['username'];
        echo json_encode(['success' => true, 'message' => 'Login successful']);
    } else {
        echo json_encode(['error' => 'Invalid credentials']);
    }
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
