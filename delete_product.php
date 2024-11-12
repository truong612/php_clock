<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xóa Sản Phẩm - Admin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f7fc;
        }

        .admin-container {
            display: flex;
        }

        .admin-sidebar {
            width: 250px;
            background-color: #003366;
            color: white;
            padding: 20px;
            min-height: 100vh;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }

        .admin-sidebar h2 {
            font-size: 22px;
            margin-bottom: 20px;
            color: #fff;
            text-align: center;
        }

        .admin-sidebar ul {
            list-style: none;
            padding: 0;
        }

        .admin-sidebar ul li {
            margin-bottom: 15px;
        }

        .admin-sidebar ul li a {
            color: #f9f9f9;
            font-size: 18px;
            text-decoration: none;
            padding: 10px 15px;
            display: block;
            border-radius: 5px;
            transition: 0.3s;
            font-weight: bold;
        }

        .admin-sidebar ul li a:hover {
            background-color: #006699;
            color: #ffffff;
        }

        .admin-content {
            flex: 1;
            padding: 40px;
        }

        .admin-content h1 {
            color: #003366;
            font-size: 28px;
            margin-bottom: 20px;
        }

        .product-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .product-table th,
        .product-table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;

        }

        .product-table th {
            background-color: #f2f2f2;
        }

        .btn-delete {
            padding: 5px 10px;
            background-color: #d9534f;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s;
            margin: auto;
        }

        .btn-delete:hover {
            background-color: #c9302c;
        }

        .alert {
            padding: 10px;
            margin: 20px 0;
            border: 1px solid green;
            background-color: #dff0d8;
            color: green;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <?php include 'header_admin.php'; ?>
    <h1 style="text-align:center;padding: 25px;">Xóa Sản Phẩm</h1>
    <div class="admin-container">
        

        <main class="admin-content">
            

            <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
                <div class='alert'>Xóa sản phẩm thành công!</div>
            <?php endif; ?>

            <table class="product-table">
                <thead>
                    <tr>
                        <th>Mã Sản Phẩm</th>
                        <th>Tên Sản Phẩm</th>
                        <th>Giá</th>
                        <th>Thao Tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include 'database.php'; // Kết nối tới cơ sở dữ liệu
                    
                    // Truy vấn sản phẩm
                    $sql = "SELECT sanpham_id, ten_san_pham, gia FROM sanpham";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>" . $row['sanpham_id'] . "</td>
                                    <td>" . $row['ten_san_pham'] . "</td>
                                    <td>" . number_format(htmlspecialchars($row["gia"])) . " VND </td>
                                    <td>
                                        <a href='delete_product_process.php?sanpham_id=" . $row['sanpham_id'] . "' onclick='return confirm(\"Bạn có chắc chắn muốn xóa sản phẩm này?\")' class='btn-delete'>Xóa</a>
                                    </td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>Không có sản phẩm nào.</td></tr>";
                    }
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </main>
    </div>

    <?php include 'footer.php'; ?>
</body>

</html>