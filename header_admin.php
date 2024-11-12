<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang web bán đồng hồ</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <?php
        session_start();
    ?>
    <!-- Banner -->
    <header>
        
        <div class="header-content">
            <h1>ADMIN</h1>
            <nav class="header-nav">
                
                <a href="dashboard.php">Quản lí sản phẩm</a>
                <a href="add_product.php">Thêm sản phẩm</a>
                <a href="edit_product.php">Sửa sản phẩm</a>
                <a href="delete_product.php">Xoá sản phẩm</a>
                <a href="donhang.php">Đơn hàng</a>
                <a href="tin_nhan.php">Tin nhắn</a>
                <a href="quanlinguoidung.php">Quản lí người dùng</a>
                <a href="thongke_doanhthu.php">Thống kê doanh thu</a>
                
                <!-- <a href="dangnhap.php">Đăng nhập</a>
                <a href="dangky.php">Đăng kí</a> -->
            </nav>
            <div class="user-info">
                
                    <p>Xin chào ADMIN!</p>
                    <a href="dangxuat.php">Đăng Xuất</a>
               
            </div>
        </div>
    </header>
</body>
</html>
