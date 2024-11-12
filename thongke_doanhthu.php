<?php
	include('database.php');

	// Truy vấn số lượng người dùng
	$sql_nguoidung = "SELECT COUNT(DISTINCT user_id) AS so_luong_nguoi_dung FROM users";
	$result_nguoidung = $conn->query($sql_nguoidung);
	$row_nguoidung = $result_nguoidung->fetch_assoc();
	$so_luong_nguoi_dung = $row_nguoidung['so_luong_nguoi_dung'];

	// Truy vấn tổng doanh thu
	$sql_doanhthu = "SELECT SUM(tongtien) AS tong_doanh_thu FROM don_hang";
	$result_doanhthu = $conn->query($sql_doanhthu);
	$row_doanhthu = $result_doanhthu->fetch_assoc();
	$tong_doanh_thu = $row_doanhthu['tong_doanh_thu'];

	// Truy vấn các sản phẩm đã bán và số lượng
	$sql = "SELECT 
            s.ten_san_pham,  
            SUM(g.so_luong) AS so_luong_ban  
        FROM 
            gio_hang g
        JOIN 
            sanpham s ON g.sanpham_id = s.sanpham_id  
        GROUP BY 
            s.ten_san_pham";

	// Thực thi câu truy vấn và lấy kết quả
	$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thống kê cửa hàng</title>
    <style type="text/css">
    	/* Đặt font chữ và khoảng cách cho toàn bộ trang */
		/* Cấu trúc toàn trang */
body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f7fc;
    margin: 0;
    padding: 0;
    color: #333;
}

/* Tiêu đề chính */


/* Style cho các phần thống kê */
.soluongnguidung, .tongdoanhthu {
    background: linear-gradient(145deg, #ffffff, #f1f3f8);
    border-radius: 12px;
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
    margin: 20px auto;
    padding: 30px;
    width: 80%;
    text-align: center;
    font-size: 20px;
}

.soluongnguidung h2, .tongdoanhthu h2 {
    color: #2a9d8f;
    font-weight: 600;
    font-size: 24px;
}

/* Style cho bảng */
table.tab {
    width: 80%;
    margin: 30px auto;
    border-collapse: collapse;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
}

table.tab th, table.tab td {
    padding: 15px;
    text-align: center;
    border: 1px solid #ddd;
}

table.tab th {
    background-color: #2a9d8f;
    color: white;
    font-size: 18px;
    text-transform: uppercase;
    font-weight: 500;
}

table.tab td {
    background-color: #f9f9f9;
    font-size: 16px;
    color: #555;
}

table.tab tr:nth-child(even) td {
    background-color: #f1f1f1;
}

table.tab tr:hover {
    background-color: #e0f7f3;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

/* Cải thiện hiệu ứng cho tiêu đề trong bảng */
table.tab th:hover {
    background-color: #26a69a;
}

/* Style cho các button */
button {
    background-color: #2a9d8f;
    color: white;
    border: none;
    padding: 12px 24px;
    font-size: 16px;
    border-radius: 30px;
    cursor: pointer;
    transition: background-color 0.3s;
    margin-top: 20px;
}

button:hover {
    background-color: #219a84;
}

button:focus {
    outline: none;
}

/* Thêm style cho liên kết */
a {
    color: #2a9d8f;
    text-decoration: none;
    font-weight: 500;
}

a:hover {
    text-decoration: underline;
}


    </style>
</head>
<body>
	<?php include('header_admin.php') ?>
    <h1 style="text-align: center;
    color: #333;
    font-size: 32px;
    font-weight: bold;
    margin-top: 30px;">Thống kê cửa hàng</h1>
    
    <div class="soluongnguidung">
        <h2>Số lượng người dùng: <?php echo $so_luong_nguoi_dung; ?></h2>
    </div>
    
    <div class="tongdoanhthu">
        <h2>Tổng doanh thu: <?php echo number_format($tong_doanh_thu, 0, ',', '.'); ?> VND</h2>
    </div>

    <?php 
    if ($result->num_rows > 0) {
        // Bắt đầu bảng HTML
        echo "<table class='tab'>
                <tr>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng bán</th>
                </tr>";

        // Lặp qua từng dòng kết quả và hiển thị
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["ten_san_pham"] . "</td>
                    <td>" . $row["so_luong_ban"] . "</td>
                  </tr>";
        }

        // Kết thúc bảng HTML
        echo "</table>";
    } else {
        echo "Không có dữ liệu";
    }
    ?>

    <?php
    // Đóng kết nối
    $conn->close();
    ?>
</body>
</html>
