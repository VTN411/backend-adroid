<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'config.php'; // Kết nối PDO trong $conn

header('Content-Type: application/json');

$type = isset($_GET['type']) ? $_GET['type'] : null;

// Lấy dữ liệu nhân viên từ DB theo loại (nếu có)
if ($type && in_array($type, ['Văn Phòng', 'Kế Toán'])) {
    $stmt = $conn->prepare("SELECT * FROM nhanvien WHERE type = ?");
    $stmt->execute([$type]);
} else {
    $stmt = $conn->prepare("SELECT * FROM nhanvien");
    $stmt->execute();
}

$nhanvien = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($nhanvien);
?>
