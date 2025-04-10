<?php
header('Content-Type: application/json');
require_once 'config.php'; // PDO connection in $conn

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $code = $_POST['code'] ?? '';

    // Kiểm tra mã xác minh trong DB
    $stmt = $conn->prepare("SELECT * FROM verifications WHERE email = ? AND code = ?");
    $stmt->execute([$email, $code]);

    if ($stmt->rowCount() === 0) {
        echo json_encode(['success' => false, 'message' => 'Email chưa được xác minh hoặc mã không đúng']);
        exit;
    }

    // Kiểm tra xem email đã tồn tại chưa
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);

    if ($stmt->rowCount() > 0) {
        echo json_encode(['success' => false, 'message' => 'Email đã được sử dụng']);
        exit;
    }

    // Mã hóa mật khẩu và lưu tài khoản
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO users (email, password) VALUES (?, ?)");

    if ($stmt->execute([$email, $hashedPassword])) {
        // Xóa mã xác minh sau khi tạo tài khoản thành công (tùy chọn)
        $delete = $conn->prepare("DELETE FROM verifications WHERE email = ?");
        $delete->execute([$email]);

        echo json_encode(['success' => true, 'message' => 'Đăng ký thành công']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Lỗi khi đăng ký']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Phương thức không hợp lệ']);
}
