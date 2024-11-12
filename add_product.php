<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Sản Phẩm - Admin</title>
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
        }

        /* Sidebar quản lý */
        .admin-sidebar {
            width: 250px;
            background-color: #4CAF50; /* Màu xanh lá tươi sáng */
            color: white;
            padding: 20px;
        }

        .admin-sidebar h2 {
            font-size: 1.5rem;
            margin-bottom: 20px;
        }

        .admin-sidebar ul {
            list-style: none;
        }

        .admin-sidebar ul li {
            margin-bottom: 15px;
        }

        .admin-sidebar ul li a {
            color: white;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s;
        }

        .admin-sidebar ul li a:hover {
            color: #ffd700; /* Màu vàng nhấn khi hover */
        }

        /* Nội dung chính */
        .admin-content {
            flex-grow: 1;
            padding: 30px;
            background-color: #fff; /* Nền trắng sáng cho vùng nội dung */
        }

        .admin-content h1 {
            font-size: 2rem;
            color: #4CAF50;
            margin-bottom: 20px;
        }

        /* Form thêm sản phẩm */
        .product-form {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        .product-form label {
            display: block;
            margin-top: 10px;
            color: #4CAF50;
            font-weight: bold;
        }

        .product-form input[type="text"],
        .product-form input[type="number"],
        .product-form textarea {
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

        /* Checkbox nhóm */
        .checkbox-group {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 10px;
        }

        .checkbox-group label {
            display: flex;
            align-items: center;
            font-weight: normal;
            color: #333;
        }

        .checkbox-group input[type="checkbox"] {
            margin-right: 10px;
            transform: scale(1.2);
        }


        /* Nút Upload */
        .product-form button {
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

        .product-form button:hover {
            background-color: #388E3C;
        }

        /* Preview hình ảnh */
        .preview img {
            max-width: 100%;
            margin-top: 10px;
            border-radius: 5px;
            border: 2px solid #4CAF50; /* Viền xanh lá cho ảnh */
        }

        #gioitinh {
            width: 150px; /* Độ rộng của dropdown */
            padding: 8px; /* Khoảng cách bên trong */
            font-size: 16px; /* Kích thước chữ */
            border: 1px solid #ccc; /* Đường viền */
            border-radius: 5px; /* Bo góc */
            background-color: #f9f9f9; /* Màu nền */
            color: #333; /* Màu chữ */
            cursor: pointer; /* Hiển thị con trỏ khi hover */
        }

        /* CSS khi hover vào dropdown */
        #gioitinh:hover {
            background-color: #e0e0e0; /* Màu nền khi hover */
        }

        /* CSS cho option */
        #gioitinh option {
            padding: 5px; /* Khoảng cách bên trong của các option */
            font-size: 16px;
        }

        /* CSS cho option đã chọn */
        #gioitinh option[selected] {
            font-weight: bold; /* Chữ đậm cho option đã chọn */
            color: #007bff; /* Màu chữ cho option đã chọn */
        }
    </style>
</head>

<body>
    <?php include 'header_admin.php'; ?>
    <h1 style="text-align: center;background-color:#fff; padding: 10px;">Thêm Sản Phẩm Mới</h1>
    <div class="admin-container">
        

        <main class="admin-content">
            
            <form action="add_product_process.php" method="POST" enctype="multipart/form-data" class="product-form">
                <label for="images">Hình ảnh:</label>
                <input type="file" id="images" name="images" accept="image/*" required>
                <div class="preview"></div>

                <label for="sanpham_id">ID Sản Phẩm:</label>
                <input type="text" name="sanpham_id" min="0" required>

                <label for="ten_san_pham">Tên Sản Phẩm:</label>
                <input type="text" name="ten_san_pham" required>

                <label for="gia">Giá:</label>
                <input type="number" name="gia" min="1" required>

                <label for="mo_ta">Mô Tả:</label>
                <textarea name="mo_ta" required></textarea>

                <label for="soluong">Số Lượng:</label>
                <input type="number" name="soluong" min="1" required>

                <label for="gioitinh">Giới tính:</label>
                <select id="gioitinh" name="gioitinh">
                    <option value="1" <?php if ($product['gioitinh'] == 1) echo 'selected'; ?>>Nam</option>
                    <option value="0" <?php if ($product['gioitinh'] == 0) echo 'selected'; ?>>Nữ</option>
                    
                </select>
                <!-- Checkbox nhóm -->
                <div class="checkbox-group">
                    <label><input type="checkbox" name="hangmoi" value="1"> Hàng Mới</label>
                    <label><input type="checkbox" name="hangbanchay" value="1"> Hàng Bán Chạy</label>
                    <label><input type="checkbox" name="hanggiamgia" value="1"> Hàng Giảm Giá</label>
                </div>
                <label for="giamgia">Giảm Giá (%):</label>
                <input type="number" name="giamgia" max="100" min="0" value="0" required>
                <!-- Nút Upload -->
                <button type="submit">Upload</button>
            </form>
        </main>
    </div>

    <?php include 'footer.php'; ?>
    
    
</body>

</html>
