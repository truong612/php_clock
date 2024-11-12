<!DOCTYPE html>
<html lang="vi">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Quản lý cửa hàng đồng hồ</title>
	<style>
		body {
			font-family: Arial, sans-serif;
			background-color: #f4f6f9;
			margin: 0;
			padding: 0;
		}

		.admin-container {
			display: flex;
			width: 100%;
			padding: 20px;
		}

		.sidebar {
			width: 250px;
			padding: 20px;
			background-color: #3594d3;
			color: white;
			border-radius: 8px;
		}

		.sidebar h2 {
			text-align: center;
		}

		.sidebar ul {
			list-style-type: none;
			padding: 0;
		}

		.sidebar ul li {
			margin: 10px 0;
		}

		.sidebar ul li a {
			color: black;
		    text-decoration: none;
		    padding: 8px 15px;
		    border-radius: 5px;
		    transition: background 0.3s ease;
		}

		.sidebar ul li a:hover {
			color: #ffdd57;
		}

		.content {
			flex: 1;
			margin-left: 20px;
		}

		.content h1 {
			font-size: 24px;
			color: black;
			margin-bottom: 20px;
		}

		table {
			width: 100%;
			border-collapse: collapse;
			background-color: #fff;
			box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
		}

		th,
		td {
			padding: 12px;
			text-align: center;
			border-bottom: 1px solid #ddd;
		}

		th {
			background-color: #007bff;
			color: #fff;
		}

		h2,
		a {
			color: black;
		}

		.btn-edit,
		.btn-delete {
			padding: 6px 12px;
			border-radius: 4px;
			text-decoration: none;
			color: #fff;
		}

		.btn-edit {
			background-color: #28a745;
		}

		.btn-edit:hover {
			background-color: #218838;
		}

		.btn-delete {
			background-color: #dc3545;
		}

		.btn-delete:hover {
			background-color: #c82333;
		}
	</style>
</head>

<body>
	<?php include 'header_admin.php'; ?>
	<h2 style="text-align:center;padding-top: 20px;font-size: 30px;">Quản lý cửa hàng</h2>
	<main class="admin-container">
		

		<section class="content">
			<h1>Danh sách sản phẩm</h1>
			<table>
				<thead>
					<tr>
						<th>Hình ảnh</th>
						<th>Tên sản phẩm</th>
						<th>Giá</th>
						<th>Số lượng</th>
						<th>Hành động</th>
					</tr>
				</thead>
				<tbody>
					<?php
					include 'database.php';
					$sql = "SELECT * FROM sanpham";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
						while ($row = $result->fetch_assoc()) {
							echo "<tr>";
							echo "<td><img src='" . $row['images'] . "' width='100' height='100'></td>";
							echo "<td>" . $row['ten_san_pham'] . "</td>";
							echo "<td>" . number_format($row['gia']) . " VND</td>";
							echo "<td>" . $row['soluong'] . "</td>";
							echo "<td>
                                    <a href='edit_product_form.php?sanpham_id=" . $row['sanpham_id'] . "' class='btn-edit'>Sửa</a>
                                    <a href='delete_product_process.php?sanpham_id=" . $row['sanpham_id'] . "' onclick='return confirm(\"Bạn có chắc chắn muốn xóa sản phẩm này?\")' class='btn-delete'>Xóa</a>
                                  </td>";
							echo "</tr>";
						}
					} else {
						echo "<tr><td colspan='5'>Không có sản phẩm nào!</td></tr>";
					}

					$conn->close();
					?>
				</tbody>
			</table>
		</section>
	</main>

	<?php include 'footer.php'; ?>
</body>

</html>