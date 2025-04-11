<?php
$host = 'http://sql12.freesqldatabase.com';
$db   = 'sql12772517';
$user = 'sql12772517';
$pass = 'EQugmHgGej';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $conn = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    die("Kết nối thất bại: " . $e->getMessage());
}
?>
