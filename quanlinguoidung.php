<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Quản lí người dùng</title>
	<style type="text/css">
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f9;
        margin: 0;
        padding: 0;
        color: #333;
    }

    .content {
        max-width: 100%;
        margin: 20px auto;
        padding: 20px;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
    }

    h1 {
        text-align: center;
        
        
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th, td {
    	max-width: 200px;

        padding: 15px;
        border: 1px solid #ddd;
        text-align: left;
        vertical-align: middle;
        text-align: center;
    }

    th {
        background-color: #f8f8f8;
        font-weight: bold;
    }

    tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .btn-edit,
    .btn-delete {
        display: inline-block;
        padding: 6px 10px;
        color: #fff;
        text-decoration: none;
        border-radius: 4px;
        font-size: 14px;
        margin-right: 5px;
    }

    .btn-edit {
        background-color: #4CAF50;
    }

    .btn-delete {
        background-color: #e74c3c;
    }

    .btn-edit:hover {
        background-color: #45a049;
    }

    .btn-delete:hover {
        background-color: #c0392b;
    }

    /* Điều chỉnh khoảng cách các phần tử */
    .header, .content, .footer {
        margin-bottom: 30px;
    }

    /* Tăng khoảng cách giữa các cột */
    table td, table th {
        padding: 12px 18px;
    }
    .chucnang{
    	display: flex;
    	justify-content: center;
    	align-items: center;

    }

    .chucnang a{
    	width:250px;
    }
</style>


</head>
<body>
	<?php include 'header_admin.php'; ?>
	<section class="content">
			<h1 style="text-align=center;">Danh sách người dùng</h1>
			<table>
				<thead>
					<tr>
						<th>Tên tài khoản</th>
						<th>Tên đăng nhập</th>
						<th>Mật khẩu</th>
						<th>Email</th>
						<th>Số điện thoại</th>
						<th>Địa chỉ</th>
						<th>Chức năng</th>
					</tr>
				</thead>
				<tbody>
					<?php
						include 'database.php';
						$sql = "SELECT * FROM users";
						$result = $conn->query($sql);

						if ($result->num_rows > 0) {
							while ($row = $result->fetch_assoc()) {
								echo "<tr>";
								echo "<td>" . $row['ten_tai_khoan'] . "</td>";
								echo "<td>" . $row['ten_dang_nhap'] . "</td>";
								echo "<td>" . $row['mat_khau'] . "</td>";
								echo "<td>" . $row['email'] . "</td>";
								echo "<td>" . $row['sdt'] . "</td>";
								echo "<td>" . $row['dia_chi'] . "</td>";
								echo "<td class ='chucnang'>
	                                    <a href='edit_user.php?user_id=" . $row['user_id'] . "' class='btn-edit'>Sửa</a>
	                                    <a href='delete_user.php?user_id=" . $row['user_id'] . "' onclick='return confirm(\"Bạn có chắc chắn muốn xóa người dùng này không này?\")' class='btn-delete'>Xóa</a>
	                                    
	                                  </td>";
								echo "</tr>";
                                // <a href='donhang.php?user_id=" . $row['user_id'] . "' class='btn-edit'>Giỏ hàng</a>
							}
						} else {
							echo "<tr><td colspan='5'>Không có người dùng nào !</td></tr>";
						}

						$conn->close();
					?>
				</tbody>
			</table>
		</section>
</body>
</html>