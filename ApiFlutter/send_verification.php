<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'config.php'; // Kết nối PDO trong $conn
require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
    $email = $_POST['email'];
    $verificationCode = rand(100000, 999999); // tạo mã 6 số
    $expiryTime = date('Y-m-d H:i:s', strtotime('+10 minutes')); // Mã xác minh hết hạn sau 10 phút

    // Kiểm tra xem email có tồn tại trong cơ sở dữ liệu không
    $stmt = $conn->prepare("SELECT * FROM nhanvien WHERE email = ?");
    $stmt->execute([$email]);
    $nhanVien = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$nhanVien) {
        echo json_encode(['success' => false, 'message' => 'Email không tồn tại trong hệ thống.']);
        exit();
    }

    $mail = new PHPMailer(true);

    try {
        // Cấu hình gửi email
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'von391912@gmail.com'; // thay bằng Gmail của bạn
        $mail->Password = 'snoo smhl vhde pgxc'; // thay bằng App Password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('von391912@gmail.com', 'App QLNV');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'MA XAC MINH APP QLNV';
        $mail->Body = "<h3>Mã xác minh của bạn là: <strong>$verificationCode</strong></h3><p>Vui lòng nhập mã trong vòng 10 phút.</p>";

        $mail->send();

        // Lưu mã xác minh vào DB (REPLACE để ghi đè nếu đã có)
        $stmt = $conn->prepare("REPLACE INTO verifications (email, code, expiry_time) VALUES (?, ?, ?)");
        $stmt->execute([$email, $verificationCode, $expiryTime]);

        echo json_encode(['success' => true, 'message' => 'Đã gửi mã xác minh']);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Lỗi gửi email: ' . $mail->ErrorInfo]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Yêu cầu không hợp lệ']);
}
