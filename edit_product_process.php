<?php
include 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sanpham_id = $_POST['sanpham_id'];
   
    $ten_san_pham = $_POST['ten_san_pham'];
    
    $gia = $_POST['gia'];
    
    $mo_ta = $_POST['mo_ta'];
    
    $soluong = $_POST['soluong'];
   
    $gioitinh = $_POST['gioitinh'];
    
    $hangmoi = $_POST['hangmoi'];
   
    $hangbanchay = $_POST['hangbanchay'];
    
    $hanggiamgia = $_POST['hanggiamgia'];

    $giamgia = $_POST['giamgia'];
    
    $hinhanh = $_FILES['images']['name'];
    $hinhanh_tmp = $_FILES['images']['tmp_name'];
    $target_dir = "images/"; 
    $hinhanh =  basename($hinhanh);
    $target_file = $target_dir . $hinhanh;
    move_uploaded_file($hinhanh_tmp, $target_file);

    

    // Cập nhật thông tin sản phẩm
    $sql = "UPDATE sanpham SET ten_san_pham = ?, gia = ?, mo_ta = ?,images =?, soluong = ?, hangmoi = ?, hangbanchay = ?, hanggiamgia = ? ,gioitinh = ? , giamgia = ? WHERE sanpham_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sissiiiiiid", $ten_san_pham, $gia, $mo_ta, $target_file, $soluong, $hangmoi, $hangbanchay, $hanggiamgia, $gioitinh,$giamgia, $sanpham_id);
    // sissiiiiiid

    if ($stmt->execute()) {
        echo "<alert>Cập nhật sản phẩm thành công!<alert>";
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Lỗi: " . $stmt->error;
    }
    $stmt->close();
}

$conn->close();
?>