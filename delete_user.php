<?php
include 'database.php'; // Kết nối tới cơ sở dữ liệu

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $user_id = $_GET['user_id'];
    
    // Câu lệnh SQL để xóa sản phẩm
    $sql = "DELETE FROM users WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $user_id);

    if ($stmt->execute()) {
        // Chuyển hướng về trang xóa sản phẩm với thông báo thành công
        header("Location: quanlinguoidung.php");
        exit();
    } else {
        echo "Lỗi: " . $stmt->error;
    
    }

    $stmt->close();
}
$conn->close();
?>