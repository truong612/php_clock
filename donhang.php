<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quản lí người dùng</title>
    <style type="text/css">
       * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    background-color: #f4f7fb;
    color: #333;
}

.content {
    max-width: 1200px;
    margin: 40px auto;
    padding: 30px;
    background-color: #ffffff;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    border-radius: 12px;
}

h1 {
    text-align: center;
    color: #007bff;
    font-size: 2.2em;
    margin-bottom: 20px;
    font-weight: 700;
    letter-spacing: 1px;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

th, td {
    padding: 15px;
    border: 1px solid #e0e0e0;
    text-align: center;
    font-size: 1em;
}

th {
    background-color: #007bff;
    color: #ffffff;
    font-weight: 600;
    text-transform: uppercase;
}

td {
    color: #555;
}

tr:nth-child(even) {
    background-color: #f9f9f9;
}

tr:hover {
    background-color: #f1f7ff;
    transition: background-color 0.3s;
}

.btn-edit, .btn-delete {
    display: inline-block;
    padding: 8px 16px;
    color: #ffffff;
    text-decoration: none;
    border-radius: 20px;
    font-size: 0.9em;
    margin-right: 5px;
    transition: background-color 0.3s ease, transform 0.2s;
    font-weight: bold;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.btn-edit {
    background-color: #28a745;
}

.btn-delete {
    background-color: #dc3545;
}

.btn-edit:hover {
    background-color: #218838;
    transform: translateY(-2px);
}

.btn-delete:hover {
    background-color: #c82333;
    transform: translateY(-2px);
}

.status form {
    display: inline-block;
    margin: 0;
}

.status select {
    padding: 6px 10px;
    font-size: 0.9em;
    width: 120px;
    border-radius: 5px;
    border: 1px solid #ddd;
    background-color: #f0f5ff;
    cursor: pointer;
    transition: background-color 0.3s ease, box-shadow 0.2s;
}

.status select:focus {
    outline: none;
    border-color: #007bff;
    background-color: #eef7ff;
    box-shadow: 0 0 8px rgba(0, 123, 255, 0.5);
}

/* Responsive design for mobile devices */
@media (max-width: 768px) {
    .content {
        padding: 20px;
        margin: 20px;
    }

    th, td {
        padding: 12px;
        font-size: 0.9em;
    }

    h1 {
        font-size: 1.8em;
    }

    .btn-edit, .btn-delete {
        padding: 6px 10px;
        font-size: 0.8em;
    }
}

    </style>
</head>
<body>
    <?php include 'header_admin.php'; ?>
    <section class="content">
        <h1 style="color: black;">Danh sách đơn hàng</h1>
        <table>
            <thead>
                <tr>
                    <th>Tên</th>
                    <th>SĐT</th>
                    <th>Địa chỉ</th>
                    <th>Tổng tiền</th>
                    <th>Tên sản phẩm</th>
                    <th>Trạng thái</th>
                    <th>Chức năng</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    include 'database.php';
                    $sql = "SELECT * FROM don_hang";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['ten'] . "</td>";
                            echo "<td>" . $row['sdt'] . "</td>";
                            echo "<td>" . $row['diachi'] . "</td>";
                            echo "<td>" . number_format($row['tongtien']) . " VND" . "</td>";
                            echo "<td>" . $row['tensanpham'] . "</td>";
                            $status = $row['status'];
                            echo "<td>
                                    <form action='update_status_donhang.php' method='POST' class='status' onChange='this.submit()'>
                                        <select name='status'>
                                            <option value='0' " . ($status == 0 ? 'selected' : '') . ">Chưa giao hàng</option>
                                            <option value='1' " . ($status == 1 ? 'selected' : '') . ">Đã giao</option>
                                        </select>
                                        <input type='hidden' name='user_id' value='" . $row['user_id'] . "' />
                                    </form>
                                  </td>";
                            echo "<td>
                                    <a href='edit_donhang.php?order_id=" . $row['order_id'] . "&ten=" . $row['ten'] . "' class='btn-edit'>Sửa</a>
                                    <a href='delete_donhang.php?order_id=" . $row['order_id'] . "' onclick='return confirm(\"Bạn có chắc chắn muốn xóa đơn hàng này không?\")' class='btn-delete'>Xóa</a>
                                  </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>Không có đơn hàng nào!</td></tr>";
                    }
                    $conn->close();
                ?>
            </tbody>
        </table>
    </section>
</body>
</html>
