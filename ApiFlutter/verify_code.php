<?php
session_start();
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $code = $_POST['code'] ?? '';
    $email = $_POST['email'] ?? '';

    if (isset($_SESSION['verification_code'], $_SESSION['verification_email'])) {
        if ($code == $_SESSION['verification_code'] && $email == $_SESSION['verification_email']) {
            echo json_encode(['success' => true, 'message' => 'Xác minh thành công']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Sai mã hoặc email không khớp']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Không tìm thấy mã xác minh']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Yêu cầu không hợp lệ']);
}
?>
