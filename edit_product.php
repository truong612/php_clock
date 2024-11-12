<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Sản Phẩm - Admin</title>
    <style type="text/css">
        /* CSS cho trang quản lý sản phẩm */

    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f0f8ff;
        color: #333;
    }

    .admin-container {
        display: flex;
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    .admin-sidebar {
        width: 250px;
        background-color: #007acc;
        color: #fff;
        padding: 20px;
        border-radius: 8px;
    }

    .admin-sidebar h2 {
        font-size: 24px;
        margin-bottom: 20px;
    }

    .admin-sidebar ul {
        list-style: none;
        padding: 0;
    }

    .admin-sidebar ul li {
        margin-bottom: 15px;
    }

    .admin-sidebar ul li a {
        text-decoration: none;
        color: #fff;
        font-weight: bold;
    }

    .admin-sidebar ul li a:hover {
        text-decoration: underline;
    }

    .admin-content {
        flex: 1;
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        margin-left: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .admin-content h1 {
        font-size: 28px;
        color: #007acc;
        margin-bottom: 20px;
    }

    .alert {
        padding: 10px;
        background-color: #4CAF50;
        color: white;
        margin-bottom: 20px;
        border-radius: 5px;
    }

    .product-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .product-table th,
    .product-table td {
        padding: 15px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    .product-table th {
        background-color: #007acc;
        color: white;
        font-weight: bold;
    }

    .product-table tr:hover {
        background-color: #f1f1f1;
    }

    .edit-btn {
        color: #007acc;
        text-decoration: none;
        font-weight: bold;
        padding: 8px 12px;
        border: 1px solid #007acc;
        border-radius: 4px;
    }

    .edit-btn:hover {
        background-color: #007acc;
        color: #fff;
    }

    </style>
</head>

<body>
    <?php include 'header_admin.php'; ?>

    <div class="admin-container">
        
        
        <main class="admin-content">
            

            <?php
            // Hiển thị thông báo nếu có
            if (isset($_GET['success']) && $_GET['success'] == 1) {
                echo "<div class='alert'>Thêm sản phẩm thành công!</div>";
            }

            include 'database.php';

            // Lấy tất cả sản phẩm từ cơ sở dữ liệu
            $sql = "SELECT * FROM sanpham";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<table class='product-table'>";
                echo "<tr>
                            <th>ID</th>
                            <th>Tên Sản Phẩm</th>
                            <th>Giá</th>
                            <th>Số Lượng</th>
                            <th>Hành Động</th>
                          </tr>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row["sanpham_id"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["ten_san_pham"]) . "</td>";
                    echo "<td>" . number_format(htmlspecialchars($row["gia"])) . " VND</td>";
                    echo "<td>" . htmlspecialchars($row["soluong"]) . "</td>";
                    echo "<td><a href='edit_product_form.php?sanpham_id=" . htmlspecialchars($row["sanpham_id"]) . "' class='edit-btn'>Sửa</a></td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<p>Không có sản phẩm nào!</p>";
            }

            // Đóng kết nối
            $conn->close();
            ?>
        </main>
    </div>

    <?php include 'footer.php'; ?>
</body>

</html>