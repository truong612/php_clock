<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Lịch sử mua hàng</title>
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
	<?php include('header.php'); ?>
	<section class="content">
			<h1 style="text-align=center;color: black;">Lịch sử mua </h1>
			<table>
				<thead>
					<tr>
						<th>Tên </th>
						<th>SĐT</th>
						<th>Địa chỉ</th>
						<th>Tổng tiền</th>
						<th>Tên sản phẩm</th>
						
					</tr>
				</thead>
				<tbody>
					<?php
						$user_id = $_GET['user_id'];
						include 'database.php';
						$sql = "SELECT * FROM don_hang WHERE user_id = $user_id ";
						$result = $conn->query($sql);

						if ($result->num_rows > 0) {
							while ($row = $result->fetch_assoc()) {
								echo "<tr>";
								echo "<td>" . $row['ten'] . "</td>";
								echo "<td>" . $row['sdt'] . "</td>";
								echo "<td>" . $row['diachi'] . "</td>";
								echo "<td>" . number_format($row['tongtien']) . " VND". "</td>";
								echo "<td>" . $row['tensanpham'] . "</td>";
								
								
								echo "</tr>";
							}
						} else {
							echo "<tr><td colspan='5'>Không có đơn hàng nào !</td></tr>";
						}

						$conn->close();
					?>
				</tbody>
			</table>
		</section>
</body>
</html>