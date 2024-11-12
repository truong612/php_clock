<?php
include 'database.php'; // Kết nối tới cơ sở dữ liệu

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $order_id = $_GET['order_id'];
    
    // Câu lệnh SQL để xóa sản phẩm
    $sql = "DELETE FROM don_hang WHERE order_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $order_id);

    if ($stmt->execute()) {
        // Chuyển hướng về trang xóa sản phẩm với thông báo thành công
        header("Location: donhang.php");
        exit();
    } else {
        echo "Lỗi: " . $stmt->error;
    
    }

    $stmt->close();
}
$conn->close();
?>