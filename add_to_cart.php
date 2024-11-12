<?php
session_start();
include 'database.php';

// Kiểm tra người dùng đã đăng nhập chưa
if (!isset($_SESSION["user_id"])) {
    header("Location: dangnhap.php");
    exit;
}

if (isset($_GET["sanpham_id"])) {
    $sanpham_id = $_GET["sanpham_id"];
    $user_id = $_SESSION["user_id"];

    // Kiểm tra sản phẩm đã có trong giỏ hàng chưa
    $stmt = $conn->prepare("SELECT * FROM gio_hang WHERE user_id = ? AND sanpham_id = ?");
    $stmt->bind_param("ii", $user_id, $sanpham_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Nếu sản phẩm đã có, tăng số lượng
        $stmt = $conn->prepare("UPDATE gio_hang SET so_luong = so_luong + 1 WHERE user_id = ? AND sanpham_id = ?");
        $stmt->bind_param("ii", $user_id, $sanpham_id);
    } else {
        // Nếu sản phẩm chưa có, thêm vào giỏ hàng
        $stmt = $conn->prepare("INSERT INTO gio_hang (user_id, sanpham_id, so_luong) VALUES (?, ?, 1)");
        $stmt->bind_param("ii", $user_id, $sanpham_id);
    }

    $stmt->execute();
    $stmt->close();
}

$conn->close();
header("Location: giohang.php");
exit;
?>
