<?php
session_start();
include 'database.php';

// Kiểm tra dữ liệu từ form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $user_id = $_POST["user_id"];
    $ten_khach_hang = $_POST["ten_khach_hang"];
    $so_dien_thoai = $_POST["so_dien_thoai"];
    $dia_chi = $_POST["dia_chi"];
    $tongtien = $_POST["tongtien"];
    $tensanpham = $_POST["tensanpham"];

    // Lưu dữ liệu vào bảng don_hang (nếu cần lưu cả user_id)
    $stmt = $conn->prepare("INSERT INTO don_hang (user_id, ten, sdt, diachi, tongtien, tensanpham) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssis", $user_id, $ten_khach_hang, $so_dien_thoai, $dia_chi, $tongtien, $tensanpham);
    
    if ($stmt->execute()) {
        $delete_stmt = $conn->prepare("DELETE FROM gio_hang WHERE user_id = ? AND id = ?");
        $delete_stmt->bind_param("ii", $user_id,$id);
        $delete_stmt->execute();
        $delete_stmt->close();
        $_SESSION['message'] = "Thanh toán thành công!";
        header("Location: giohang.php");
        exit();
    } else {
        $_SESSION['message'] = "Có lỗi xảy ra khi thanh toán. Vui lòng thử lại!";
        header("Location: thanhtoan.php");
        exit();
    }
    $stmt->close();
}

?>


