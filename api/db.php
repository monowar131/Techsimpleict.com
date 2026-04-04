<?php
// Auto-detect environment: Use local credentials if testing on your computer, else use InfinityFree online
$serverName = $_SERVER['SERVER_NAME'] ?? '';
if ($serverName === 'localhost' || $serverName === '127.0.0.1' || php_sapi_name() === 'cli') {
    // Local XAMPP Credentials
    $host = 'localhost';
    $db   = 'training'; // Make sure this database exists in your local phpMyAdmin
    $user = 'root';
    $pass = '';
} else {
    // InfinityFree Credentials
    $host = 'sql101.infinityfree.com'; // IMPORTANT: Put your actual "MySQL Host Name" here (e.g. sql123.infinityfree.com)
    $db   = 'if0_41355285_training';
    $user = 'if0_41355285';
    $pass = 'Monowar131@';
}

$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
     $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
     throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
?>
