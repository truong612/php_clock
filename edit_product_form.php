<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Sản Phẩm - Admin</title>
    <style>
        /* Reset mặc định */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff;
            color: #333;
        }

        /* Container chính */
        .admin-container {
            display: flex;
            padding: 20px;
            justify-content: center;
        }

        /* Nội dung chính */
        .admin-content {
            width: 100%;
            max-width: 700px;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        .admin-content h1 {
            font-size: 2rem;
            color: #4CAF50;
            margin-bottom: 20px;
            text-align: center;
        }

        /* Form sửa sản phẩm */
        .product-form {
            display: flex;
            flex-direction: column;
        }

        .product-form label {
            margin-top: 15px;
            color: #4CAF50;
            font-weight: bold;
        }

        .product-form input[type="text"],
        .product-form input[type="number"],
        .product-form textarea,
        .product-form select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-top: 5px;
            font-size: 1rem;
        }

        .product-form input[type="file"] {
            margin-top: 5px;
        }

        /* Hình ảnh hiện tại */
        .product-form p {
            margin-top: 10px;
            color: #555;
        }

        .product-form img {
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-top: 5px;
            width: 100px;
            height: 100px;
            object-fit: cover;
        }

        /* Nút Lưu thay đổi */
        .submit-btn {
            margin-top: 20px;
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            font-size: 1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            display: block;
            width: 100%;
        }

        .submit-btn:hover {
            background-color: #388E3C;
        }
    </style>
</head>
<body>
    <?php include 'header_admin.php'; ?>
    <h1 style="text-align:center;">Sửa Thông Tin Sản Phẩm</h1>
    <div class="admin-container">
        <?php
        include 'database.php';
        if (isset($_GET['sanpham_id'])) {
            $sanpham_id = $_GET['sanpham_id'];
            $sql = "SELECT * FROM sanpham WHERE sanpham_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $sanpham_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $product = $result->fetch_assoc();
            $stmt->close();
        }
        ?>

        <form action="edit_product_process.php" method="POST" enctype="multipart/form-data" class="product-form">
            <input type="hidden" name="sanpham_id" value="<?php echo htmlspecialchars($product['sanpham_id']); ?>">

            <label for="ten_san_pham">Tên sản phẩm:</label>
            <input type="text" id="ten_san_pham" name="ten_san_pham"
                value="<?php echo htmlspecialchars($product['ten_san_pham']); ?>" required>

            <label for="gia">Giá:</label>
            <input type="number" id="gia" name="gia" value="<?php echo htmlspecialchars($product['gia']); ?>" required>

            <label for="mo_ta">Mô tả:</label>
            <textarea id="mo_ta" name="mo_ta" rows="4"
                required><?php echo htmlspecialchars($product['mo_ta']); ?></textarea>

            <label for="images">Hình ảnh (Nếu muốn thay đổi):</label>
            <input type="file" id="images" name="images" accept="image/*">
            <p>Hình ảnh hiện tại: <img src="<?php echo htmlspecialchars($product['images']); ?>" alt="Product Image"></p>

            <label for="soluong">Số lượng:</label>
            <input type="number" id="soluong" name="soluong" value="<?php echo htmlspecialchars($product['soluong']); ?>" required>

            <label for="hangmoi">Hàng mới:</label>
            <select id="hangmoi" name="hangmoi">
                <option value="1" <?php if ($product['hangmoi'] == 1) echo 'selected'; ?>>Có</option>
                <option value="0" <?php if ($product['hangmoi'] == 0) echo 'selected'; ?>>Không</option>
            </select>

            <label for="hangbanchay">Hàng bán chạy:</label>
            <select id="hangbanchay" name="hangbanchay">
                <option value="1" <?php if ($product['hangbanchay'] == 1) echo 'selected'; ?>>Có</option>
                <option value="0" <?php if ($product['hangbanchay'] == 0) echo 'selected'; ?>>Không</option>
            </select>

            <label for="hanggiamgia">Hàng giảm giá:</label>
            <select id="hanggiamgia" name="hanggiamgia">
                <option value="1" <?php if ($product['hanggiamgia'] == 1) echo 'selected'; ?>>Có</option>
                <option value="0" <?php if ($product['hanggiamgia'] == 0) echo 'selected'; ?>>Không</option>
            </select>

            <label for="gioitinh">Giới tính:</label>
            <select id="gioitinh" name="gioitinh">
                <option value="1" <?php if ($product['gioitinh'] == 1) echo 'selected'; ?>>Nam</option>
                <option value="0" <?php if ($product['gioitinh'] == 0) echo 'selected'; ?>>Nữ</option>
                
            </select>
            <label for="giamgia">Giảm Giá (%):</label>
            <input type="number" name="giamgia" max="100" min="0" value="<?php echo htmlspecialchars($product['giamgia']); ?>" required>

            <button type="submit" class="submit-btn">Lưu thay đổi</button>
        </form>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html>
