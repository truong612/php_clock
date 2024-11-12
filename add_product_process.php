<?php
include 'database.php'; // Kết nối tới cơ sở dữ liệu

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $sanpham_id = $_POST['sanpham_id'];
    $ten_san_pham = $_POST['ten_san_pham'];
    $gia = $_POST['gia'];
    $mo_ta = $_POST['mo_ta'];
    $soluong = $_POST['soluong'];
    echo "gt".$gioitinh = $_POST['gioitinh'];
    echo "hangmoi".$hangmoi = isset($_POST['hangmoi']) ? 1 : 0;
    echo "hangbanchay".$hangbanchay = isset($_POST['hangbanchay']) ? 1 : 0;
    echo "hanggiamgia".$hanggiamgia = isset($_POST['hanggiamgia']) ? 1 : 0;
    echo $giamgia = $_POST['giamgia'];
    // Xử lý hình ảnh
    $hinhanh = $_FILES['images']['name'];
    $hinhanh_tmp = $_FILES['images']['tmp_name'];
    $target_dir = "images/"; 
    $hinhanh =  basename($hinhanh);
    $target_file = $target_dir . $hinhanh;
    move_uploaded_file($hinhanh_tmp, $target_file);
   
        // Thực hiện câu lệnh SQL
        $sql = "INSERT INTO sanpham (sanpham_id, ten_san_pham, gia, mo_ta, images, soluong, hangmoi, hangbanchay, hanggiamgia,gioitinh,giamgia) 
                VALUES ('$sanpham_id', '$ten_san_pham', '$gia', '$mo_ta', '$target_file', '$soluong', '$hangmoi', '$hangbanchay', '$hanggiamgia','$gioitinh','$giamgia')";

        if (mysqli_query($conn, $sql)) {
            // Chuyển hướng về trang danh sách sản phẩm nếu thành công
            echo "<alert>Theem sản phẩm thành công!<alert>";
            header("Location: dashboard.php");
            exit();
        } else {
            echo "Lỗi: " . mysqli_error($conn);
        }
    
    

   
}

$conn->close();
?>
