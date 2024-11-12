<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>Tìm kiếm</title>
</head>
<body>
	<?php include 'header.php'; ?>
	
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
				session_start();
				// if (!isset($_SESSION["user_id"])) {
				//     header("Location: dangnhap.php");
				//     exit;
				// }

				include 'database.php'; // Kết nối đến cơ sở dữ liệu

				// Kiểm tra nếu người dùng gửi yêu cầu tìm kiếm
				$timkiem = "";
				if (isset($_GET['timkiem'])) {
				    $timkiem = trim($_GET['timkiem']);
				}

				// Truy vấn tìm kiếm sản phẩm theo tên
				$sql = "SELECT * FROM sanpham WHERE ten_san_pham LIKE ?";
				$stmt = $conn->prepare($sql);
				$search_param = "%" . $timkiem . "%";
				$stmt->bind_param("s", $search_param);
				$stmt->execute();
				$result = $stmt->get_result();
			?>

			 <?php
		        // Kiểm tra và hiển thị kết quả tìm kiếm
		        if ($result->num_rows > 0) {
		            while ($row = $result->fetch_assoc()) {
		                echo "<div class='product'>";
		                $image = $row['images'] ? $row['images'] : 'default_image.jpg';
		                echo "<img src='" . $image . "' width='200' height='200'>";
		                echo "<h2>" . htmlspecialchars($row["ten_san_pham"]) . "</h2>";
		                echo "<p>Giá: " . number_format(htmlspecialchars($row["gia"])) . " VND</p>";
		                
		                echo "<p>Còn: " . htmlspecialchars($row["soluong"]) . " Cái</p>";
		                echo "<a href='chitiet.php?sanpham_id=" . htmlspecialchars($row['sanpham_id']) . "'>View Details</a>";
		                echo "<a href='add_to_cart.php?sanpham_id=" . htmlspecialchars($row['sanpham_id']) . "'>Thêm vào giỏ hàng</a>";
		                echo "</div>";
		            }
		        } else {
		            echo "<p>Không tìm thấy sản phẩm nào phù hợp!</p>";
		        }

		        // Đóng kết nối
		        $stmt->close();
		        $conn->close();
		    ?>
        </section>
    </main>

 	<?php include 'footer.php'; ?>
</body>
</html>