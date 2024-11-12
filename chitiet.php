<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="style.css">
	<style type="text/css">
		/* Định dạng chung cho trang chi tiết */
		.product-details {
		    max-width: 800px;
		    margin: 20px auto;
		    padding: 20px;
		    border: 1px solid #ddd;
		    background-color: #f9f9f9;
		    border-radius: 8px;
		}

		.product-details h1 {
		    font-size: 28px;
		    color: #333;
		    margin-bottom: 10px;
		    text-align: center;
		}

		.product-details img {
		    display: block;
		    margin: 0 auto;
		    max-width: 100%;
		    height: auto;
		    border-radius: 8px;
		}

		.product-details p {
		    font-size: 18px;
		    color: #555;
		    line-height: 1.6;
		    margin: 15px 0;
		    text-align: center;
		}

		/* Định dạng giá sản phẩm */
		.product-details .price {
		    font-size: 24px;
		    font-weight: bold;
		    color: #e74c3c;
		    text-align: center;
		    margin-top: 10px;
		}

		/* Định dạng mô tả sản phẩm */
		.product-details .description {
		    font-size: 18px;
		    color: #333;
		    margin-top: 20px;
		    text-align: justify;
		}

	</style>
	<title>Chi Tiết Sản Phẩm</title>
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

        <?php
			include 'database.php';

			// Kiểm tra nếu có tham số 'id' trong URL
			if (isset($_GET['sanpham_id'])) {
			    $id = intval($_GET['sanpham_id']); // Chuyển đổi id thành số nguyên để đảm bảo an toàn

			    // Chuẩn bị truy vấn
			    $stmt = $conn->prepare("SELECT * FROM sanpham WHERE sanpham_id = ?");
			    $stmt->bind_param("i", $id);
			    $stmt->execute();
			    $result = $stmt->get_result();

			    // Kiểm tra và hiển thị thông tin chi tiết sản phẩm
			    if ($result->num_rows > 0) {
			        $row = $result->fetch_assoc();
			        ?>
			        <div class="product-details">
					    <h1><?php echo $row["ten_san_pham"]; ?></h1>
					    <img src="<?php echo $row['images']; ?>" width="300" height="300">
					    <p class="price">Giá: <?php echo number_format($row['gia']); ?> VND</p>
					    <p class="description">Mô tả: <?php echo $row["mo_ta"]; ?></p>
					</div>
			        <?php
			    } else {
			        echo "<p>Không tìm thấy sản phẩm!</p>";
			    }
			    
			    $stmt->close();
			} else {
			    echo "<p>Không có sản phẩm được chọn!</p>";
			}

			// Đóng kết nối
			$conn->close();
		?>

    </main>

	<?php include 'footer.php'; ?>
</body>
</html>
