<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa thông tin user - Admin</title>
    <style>
        /* Reset mặc định */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff; /* Màu nền sáng nhẹ */
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
    <h1 style="text-align:center;">Sửa Thông Tin người dùng</h1>
    <div class="admin-container">
        
            

            <?php
            include 'database.php';
            if (isset($_GET['user_id'])) {
                $user_id = $_GET['user_id'];
                $sql = "SELECT * FROM users WHERE user_id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $user_id);
                $stmt->execute();
                $result = $stmt->get_result();
                $users = $result->fetch_assoc();
                $stmt->close();
            }
            ?>

            <form action="edit_user_process.php" method="POST" class="product-form">
                <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($users['user_id']); ?>">

                <label for="ten_tai_khoan">Tên tài khoản:</label>
                <input type="text" id="ten_tai_khoan" name="ten_tai_khoan"
                    value="<?php echo htmlspecialchars($users['ten_tai_khoan']); ?>" required>

                <label for="ten_dang_nhap">Tên đăng nhập:</label>
                <input type="text" id="ten_dang_nhap" name="ten_dang_nhap"
                    value="<?php echo htmlspecialchars($users['ten_dang_nhap']); ?>" required>

                <label for="mat_khau">Mật khẩu:</label>
                <input type="text" id="mat_khau" name="mat_khau"
                    value="<?php echo htmlspecialchars($users['mat_khau']); ?>" required>

                <label for="email">Email:</label>
                <input type="text" id="email" name="email"
                    value="<?php echo htmlspecialchars($users['email']); ?>" required>

                <label for="sdt">SĐT:</label>
                <input type="text" id="sdt" name="sdt"
                    value="<?php echo htmlspecialchars($users['sdt']); ?>" required>

                <label for="dia_chi">Địa chỉ:</label>
                <input type="text" id="dia_chi" name="dia_chi"
                    value="<?php echo htmlspecialchars($users['dia_chi']); ?>" required>
                <button type="submit" class="submit-btn">Lưu thay đổi</button>
            </form>
       
    </div>

    <?php include 'footer.php'; ?>
</body>

</html>
