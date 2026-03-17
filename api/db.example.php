<?php
// COPY THIS FILE TO db.php AND FILL IN YOUR ACTUAL CREDENTIALS
// For InfinityFree: get these values from your vPanel > MySQL Databases page

$host = 'YOUR_MYSQL_HOST';       // e.g. sql123.epizy.com
$db   = 'YOUR_DATABASE_NAME';    // e.g. epiz_12345678_training
$user = 'YOUR_MYSQL_USERNAME';   // e.g. epiz_12345678
$pass = 'YOUR_MYSQL_PASSWORD';   // your vPanel password
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
