<?php
        session_start();

?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang web bán đồng hồ</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/x-icon" href="/images/favicon.ico">
</head>
<body>
    
    
    <!-- Banner -->
    <header>
        
        <div class="header-content">
            
            <img src="./images/logo1.jpg" style="width:80px;height: 80px;border-radius: 50%;border: 3px solid white;" alt="Logo" class="logo">
            <nav class="header-nav">
                <a href="index.php">Trang chủ</a>
                <a href="donghonam.php">Đồng hồ nam</a>
                <a href="donghonu.php">Đồng hồ nữ</a>
                
                <a href="lienhe.php">Liên hệ</a>
                <!-- <a href="thuonghieu.php">Thương hiệu</a> -->
                <div class="menu_th">
                    <a href="#">Thương hiệu</a>
                    <div class="dropdown">
                        <a href="Bulova.php">Bulova</a>
                        <a href="Citizen.php">Citizen</a>
                        <a href="Ferrari.php">Ferrari</a>
                        <a href="Lacoste.php">Lacoste</a>
                        <a href="TommyHilfiger.php">Tommy Hilfiger</a>
                        <a href="Coach.php">Coach</a>                        
                    </div>
                </div>
                <a href="gioithieu.php">Giới thiệu</a>
                <a href="giohang.php">Giỏ hàng</a>
                <!-- <a href="dangnhap.php">Đăng nhập</a>
                <a href="dangky.php">Đăng kí</a> -->
            </nav>
            <div class="user-info">
                <?php if (isset($_SESSION["ten_dang_nhap"])): ?>
                    <p>Xin chào, <?php echo htmlspecialchars($_SESSION["ten_dang_nhap"]); ?>!</p>
                    <a href="dangxuat.php">Đăng Xuất</a>
                <?php else: ?>
                    <a href="dangnhap.php">Đăng Nhập</a> | 
                    <a href="dangky.php">Đăng Ký</a>
                <?php endif; ?>
            </div>

        </div>
        
    </header>
    <a href="index.php" style="width:100%;height: auto;"><img src="./images/banner-trang-chu.jpg" alt="Banner hình ảnh" class="banner-image"> </a>
    
</body>
</html>
