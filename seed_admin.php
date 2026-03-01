<?php
require_once 'api/db.php';

$username = 'admin';
$password = 'admin123';
$email = 'admin@techsimpleict.com';
$hash = password_hash($password, PASSWORD_DEFAULT);

try {
    $stmt = $pdo->prepare("INSERT INTO admins (username, password_hash, email) VALUES (?, ?, ?)");
    $stmt->execute([$username, $hash, $email]);
    echo "Admin user created successfully!\n";
    echo "Username: $username\n";
    echo "Password: $password\n";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>
