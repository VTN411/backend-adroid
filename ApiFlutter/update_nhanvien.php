<?php
header("Content-Type: application/json; charset=UTF-8");
include "config.php";

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data["msnv"], $data["ten"], $data["type"], $data["luong"])) {
    $msnv = $data["msnv"];
    $ten = $data["ten"];
    $type = $data["type"];
    $luong = $data["luong"];
    $email = isset($data["email"]) ? $data["email"] : null;

    $stmt = $conn->prepare("UPDATE nhanvien SET ten = ?, type = ?, luong = ?, email = ? WHERE msnv = ?");
    $stmt->execute([$ten, $type, $luong, $email, $msnv]);

    echo json_encode(["success" => true, "message" => "Cập nhật thành công"]);
} else {
    echo json_encode(["success" => false, "message" => "Thiếu dữ liệu cần cập nhật"]);
}
?>
