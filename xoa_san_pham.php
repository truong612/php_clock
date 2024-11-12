<?php
session_start();
include 'database.php';

// Kiểm tra người dùng đã đăng nhập chưa
if (!isset($_SESSION["user_id"])) {
    header("Location: dangnhap.php");
    exit;
}

$user_id = $_SESSION["user_id"];

// Kiểm tra xem `sanpham_id` có được truyền vào không
if (isset($_GET['sanpham_id'])) {
    $sanpham_id = $_GET['sanpham_id'];
    
    // Xóa sản phẩm khỏi giỏ hàng
    $stmt = $conn->prepare("DELETE FROM gio_hang WHERE user_id = ? AND sanpham_id = ?");
    $stmt->bind_param("ii", $user_id, $sanpham_id);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Sản phẩm đã được xóa khỏi giỏ hàng.";
    } else {
        $_SESSION['message'] = "Xóa sản phẩm không thành công. Vui lòng thử lại.";
    }

    $stmt->close();
}

// Quay về trang giỏ hàng
header("Location: giohang.php");
exit;
?>
