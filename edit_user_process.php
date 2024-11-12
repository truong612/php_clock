<?php
include 'database.php';

// Kiểm tra nếu form đã được submit với dữ liệu cần thiết
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form và xử lý
    $user_id = $_POST['user_id'];
    $ten_tai_khoan = trim($_POST['ten_tai_khoan']);
    $ten_dang_nhap = trim($_POST['ten_dang_nhap']);
    $mat_khau = trim($_POST['mat_khau']);
    $email = trim($_POST['email']);
    $sdt = trim($_POST['sdt']);
    $dia_chi = trim($_POST['dia_chi']);
    
    // Kiểm tra mật khẩu và mã hóa nếu cần thiết
    

    // Câu lệnh SQL để cập nhật thông tin người dùng
    $sql = "UPDATE users SET 
            ten_tai_khoan = ?, 
            ten_dang_nhap = ?, 
            mat_khau = ?, 
            email = ?, 
            sdt = ?, 
            dia_chi = ? 
            WHERE user_id = ?";
    
    // Chuẩn bị và thực thi câu lệnh
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssi", $ten_tai_khoan, $ten_dang_nhap, $mat_khau, $email, $sdt, $dia_chi, $user_id);
    
    // Kiểm tra nếu việc cập nhật thành công
    if ($stmt->execute()) {
        echo "Cập nhật thông tin người dùng thành công!";
        header("Location: quanlinguoidung.php"); // Điều hướng về trang danh sách người dùng
        exit();
    } else {
        echo "Lỗi: Không thể cập nhật thông tin người dùng. Chi tiết lỗi: " . $stmt->error;
    }

    // Đóng statement và kết nối
    $stmt->close();
    $conn->close();
} else {
    echo "Dữ liệu không hợp lệ!";
}
?>
