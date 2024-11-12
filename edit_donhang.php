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
    <h1 style="text-align:center;">Sửa Thông Tin đơn hàng</h1>
    <div class="admin-container">
        <?php
        include 'database.php';
        if (isset($_GET['user_id'])) {
            $user_id = $_GET['user_id'];
            $ten = $_GET['ten'];
            $sql = "SELECT * FROM don_hang WHERE user_id = ? AND ten = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("is", $user_id,$ten);
            $stmt->execute();
            $result = $stmt->get_result();
            $product = $result->fetch_assoc();
            $stmt->close();
        }
        ?>

        <form action="edit_donhang_process.php" method="POST" class="product-form">
            <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($product['user_id']); ?>">
            <input type="hidden" name="order_id" value="<?php echo htmlspecialchars($product['order_id']); ?>">
            <label for="ten">Tên</label>
            <input type="text" id="ten" name="ten" value="<?php echo htmlspecialchars($product['ten']); ?>" required>

            <label for="sdt">SĐT:</label>
            <input type="number" id="sdt" name="sdt" value="<?php echo htmlspecialchars($product['sdt']); ?>" required>

            <label for="diachi">Địa chỉ:</label>
            <textarea id="diachi" name="diachi" rows="4" required><?php echo htmlspecialchars($product['diachi']); ?></textarea>

            <label for="tongtien">Tổng tiền</label>
            <input type="number" id="tongtien" name="tongtien" value="<?php echo htmlspecialchars($product['tongtien']); ?>"  required>

            <label for="tensanpham">Tên sản phẩm</label>
            <input type="text" id="tensanpham" name="tensanpham" value="<?php echo htmlspecialchars($product['tensanpham']); ?>"  required>

            <button type="submit" class="submit-btn">Lưu thay đổi</button>
        </form>

    </div>

    <?php include 'footer.php'; ?>
</body>
</html>
