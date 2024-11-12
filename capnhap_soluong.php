<?php
session_start();
include 'database.php';

// Kiểm tra nếu người dùng chưa đăng nhập
if (!isset($_SESSION["user_id"])) {
    header("Location: dangnhap.php");
    exit;
}

$user_id = $_SESSION["user_id"];

// Kiểm tra các tham số cần thiết trong URL
if (isset($_GET["sanpham_id"]) && isset($_GET["action"])) {
    $sanpham_id = $_GET["sanpham_id"];
    $action = $_GET["action"];

    // Lấy số lượng hiện tại của sản phẩm trong giỏ hàng
    $stmt = $conn->prepare("SELECT so_luong FROM gio_hang WHERE user_id = ? AND sanpham_id = ?");
    $stmt->bind_param("ii", $user_id, $sanpham_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row) {
        $so_luong = $row["so_luong"];

        // Cập nhật số lượng dựa trên hành động (tăng hoặc giảm)
        if ($action == "increase") {
            $so_luong++;
        } elseif ($action == "decrease" && $so_luong > 1) {
            $so_luong--;
        }

        // Cập nhật lại số lượng trong cơ sở dữ liệu
        $stmt = $conn->prepare("UPDATE gio_hang SET so_luong = ? WHERE user_id = ? AND sanpham_id = ?");
        $stmt->bind_param("iii", $so_luong, $user_id, $sanpham_id);
        $stmt->execute();
    }
}

// Chuyển hướng trở lại trang giỏ hàng sau khi cập nhật
header("Location: giohang.php");
exit;
?>
