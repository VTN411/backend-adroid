<?php
header("Content-Type: application/json; charset=UTF-8");
include "config.php";

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data["msnv"])) {
    $msnv = $data["msnv"];

    $stmt = $conn->prepare("DELETE FROM nhanvien WHERE msnv = ?");
    $stmt->execute([$msnv]);

    echo json_encode(["success" => true, "message" => "Xóa thành công"]);
} else {
    echo json_encode(["success" => false, "message" => "Thiếu mã số nhân viên"]);
}
?>
<?php
header("Content-Type: application/json; charset=UTF-8");
include "config.php";

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data["msnv"])) {
    $msnv = $data["msnv"];

    $stmt = $conn->prepare("DELETE FROM nhanvien WHERE msnv = ?");
    $stmt->execute([$msnv]);

    echo json_encode(["success" => true, "message" => "Xóa thành công"]);
} else {
    echo json_encode(["success" => false, "message" => "Thiếu mã số nhân viên"]);
}
?>
