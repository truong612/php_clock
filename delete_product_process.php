<?php
include 'database.php'; // Kết nối tới cơ sở dữ liệu

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $sanpham_id = $_GET['sanpham_id'];
    
    // Câu lệnh SQL để xóa sản phẩm
    $sql = "DELETE FROM sanpham WHERE sanpham_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $sanpham_id);

    if ($stmt->execute()) {
        // Chuyển hướng về trang xóa sản phẩm với thông báo thành công
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Lỗi: " . $stmt->error;
    
    }

    $stmt->close();
}
$conn->close();
?>