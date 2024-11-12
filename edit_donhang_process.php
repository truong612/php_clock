<?php
include 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $order_id = $_POST['order_id'];
    $ten = $_POST['ten'];
    $sdt = $_POST['sdt'];
    $diachi = $_POST['diachi'];
    $tongtien = $_POST['tongtien'];
    $tensanpham = $_POST['tensanpham'];

    // Kiểm tra dữ liệu đầu vào
    if (!empty($ten) && !empty($sdt) && !empty($diachi)) {
        
        // Sử dụng prepared statement để cập nhật dữ liệu
        $stmt = $conn->prepare("UPDATE don_hang SET ten = ?, sdt = ?, diachi = ?, tongtien = ?, tensanpham = ? WHERE order_id = ?");
        $stmt->bind_param("sssisi", $ten, $sdt, $diachi, $tongtien, $tensanpham, $order_id);

        if ($stmt->execute()) {
            echo "<script>alert('Cập nhật thông tin đơn hàng thành công!'); window.location.href = 'donhang.php';</script>";
        } else {
            echo "<script>alert('Cập nhật không thành công: " . $stmt->error . "'); window.history.back();</script>";
        }
        $stmt->close();
    } else {
        echo "<script>alert('Vui lòng điền đầy đủ thông tin!'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('Phương thức không hợp lệ!'); window.history.back();</script>";
}

$conn->close();
?>
