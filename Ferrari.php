<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>Ferrari</title>
</head>
<body>
	<?php include('header.php') ?>
	<main>
        <aside class="sidebar">
                <div class="timkiem">
                    <form action="timkiem.php" method="GET" style="display: flex; align-items: center; gap: 20px; border: 1px solid #ddd; padding: 15px; border-radius: 8px; background-color: #f9f9f9;width:100%;">
                        <input type="text" name="timkiem" size="30" placeholder="Tìm kiếm sản phẩm..." style="flex: 1; padding: 8px; border: 1px solid #ccc; border-radius: 5px;">
                        <button type="submit" style="padding: 15px; background-color: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer;font-size: 20px;">🔍</button>
                    </form>
                </div>
            <ul class="menu">
                
                <li><a href="hangmoi.php">Hàng Mới</a></li>
                <li><a href="hangbanchay.php">Hàng Bán Chạy</a></li>
                <li><a href="hanggiamgia.php">Hàng Giảm Giá</a></li>

            </ul>
        </aside>

        
        <section class="content">
            
            
            <?php
            include 'database.php';
            session_start();
            
            
            $user_id = $_SESSION["user_id"];
            // Truy vấn sản phẩm
            $sql = "SELECT * FROM sanpham Where ten_san_pham like '%Ferrari%'";
            $result = $conn->query($sql);

            // Kiểm tra và hiển thị sản phẩm
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {

                    echo "<div class='product'>";
                    echo "<img src='" . $row['images'] . "' width='200' height='200'>";
                    echo "<h2 class='text'>" . $row["ten_san_pham"] . "</h2>";
                    echo "<p>Giá: " . number_format($row['gia']) . " VND</p>";
                    echo "<p>Còn: " . $row["soluong"] . " Cái</p>";                   
                    echo "<a href='chitiet.php?sanpham_id=" . $row['sanpham_id'] . "'>View Details</a>";
                    echo "<a href='add_to_cart.php?sanpham_id={$row['sanpham_id']}'>Thêm vào giỏ hàng</a>";                    
                    echo "</div>";

                }
            } else {
                echo "<p>Không có sản phẩm nào!</p>";
            }

            // Đóng kết nối
            $conn->close();
            ?>
        </section>
    </main>
    <?php include('footer.php') ?>
</body>
</html>