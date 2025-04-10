<?php
$host = 'sql302.infinityfree.com';
$db   = 'if0_38720797_quanlynhanvien';
$user = 'if0_38720797';
$pass = 'Z5ZXvd4wj3';
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
