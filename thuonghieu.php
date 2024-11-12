<?php
session_start();
include 'database.php'; // Kết nối đến cơ sở dữ liệu

// Lấy tên thương hiệu từ GET
$hang_san_xuat = isset($_GET['hang_san_xuat']) ? $_GET['hang_san_xuat'] : '';

// Lấy danh sách sản phẩm theo thương hiệu
$stmt = $conn->prepare("SELECT * FROM sanpham WHERE ten_san_pham LIKE ?");
$hang_san_xuat_param = "%" . $hang_san_xuat . "%";
$stmt->bind_param("s", $hang_san_xuat_param);
$stmt->execute();
$result = $stmt->get_result();

// Lấy tất cả các thương hiệu để hiển thị trong form lọc
$brands_result = $conn->query("SELECT DISTINCT ten_san_pham FROM sanpham");
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thương Hiệu</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f9f9f9;
        margin: 0;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background-color: #ffffff;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        padding: 15px;
    }

    th,
    td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
        margin-left: 17px;
    }

    th {
        background-color: #d3e8ff;
        color: #333;
    }

    .filter-form {
        margin-bottom: 20px;
    }

    .filter-form select,
    .filter-form button {
        padding: 10px;
        margin-right: 10px;
    }
    </style>
</head>

<body>
    <?php include 'header.php'; ?>
    <form class="filter-form" action="thuonghieu.php" method="GET">
        <label for="hang_san_xuat">Chọn Thương Hiệu:</label>
        <select name="hang_san_xuat" id="hang_san_xuat">
            <option value="">Tất cả</option>
            <?php while ($row = $brands_result->fetch_assoc()): ?>
            <option value="<?php echo htmlspecialchars($row['ten_san_pham']); ?>"
                <?php if ($hang_san_xuat == $row['ten_san_pham']) echo 'selected'; ?>>
                <?php echo htmlspecialchars($row['ten_san_pham']); ?>
            </option>
            <?php endwhile; ?>
        </select>
        <button type="submit">Lọc</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>Tên Sản Phẩm</th>
                <th>Giá</th>
                <th>Mô Tả</th>
                <th>Hình Ảnh</th>
                <th>Số Lượng</th>
                <th>Thương Hiệu</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['ten_san_pham']); ?></td>
                <td><?php echo number_format($row['gia'], 0, ',', '.'); ?> VND</td>
                <td><?php echo htmlspecialchars($row['mo_ta']); ?></td>
                <td><img src="<?php echo htmlspecialchars($row['images']); ?>"
                        alt="<?php echo htmlspecialchars($row['ten_san_pham']); ?>" style="width: 100px;"></td>
                <td><?php echo htmlspecialchars($row['soluong']); ?></td>
                <td><?php echo htmlspecialchars($row['ten_san_pham']); ?></td>
                <!-- Giả sử tên sản phẩm là thương hiệu -->
            </tr>
            <?php endwhile; ?>
            <?php else: ?>
            <tr>
                <td colspan="6">Không có sản phẩm nào.</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <?php include 'footer.php'; ?>
</body>

</html>