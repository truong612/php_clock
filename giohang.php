<?php
session_start();
include 'database.php';

// Kiểm tra người dùng đã đăng nhập chưa
if (!isset($_SESSION["user_id"])) {
    header("Location: dangnhap.php");
    exit;
}

$user_id = $_SESSION["user_id"];

// Truy vấn để lấy sản phẩm trong giỏ hàng
$stmt = $conn->prepare("SELECT sanpham.ten_san_pham, sanpham.gia,gio_hang.id, gio_hang.so_luong, sanpham.sanpham_id, sanpham.gia * gio_hang.so_luong AS thanh_tien
                        FROM gio_hang
                        JOIN sanpham ON gio_hang.sanpham_id = sanpham.sanpham_id
                        WHERE gio_hang.user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$tong_tien = 0; // Biến để lưu tổng tiền
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <title>Giỏ Hàng</title>
    <style>
        main {
            display: flex;
            justify-content: center;
            padding: 20px;
           
        }

        table {
            width: 90%;
            border-collapse: collapse;
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

       
        th, td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #d3e8ff;
            color: #333;
            font-weight: bold;
        }

        td a{
            text-decoration: none;
        }
        tr:nth-child(even) {
            background-color: #f9fcff;
        }

        /* Nút xóa sản phẩm */
        button[type="submit"] {
            padding: 8px 16px;
            background-color: #ff6b6b;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: background-color 0.2s;
        }

        button[type="submit"]:hover {
            background-color: #ff4c4c;
        }

        /* Modal */
        .modal {
            display: none; /* Ẩn modal mặc định */
            position: fixed; 
            z-index: 1; 
            left: 0;
            top: 0;
            width: 100%; 
            height: 100%; 
            overflow: auto; 
            background-color: rgba(0, 0, 0, 0.6); /* Tăng độ mờ cho nền */
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto; 
            padding: 20px;
            border: 1px solid #888;
            width: 80%; 
            border-radius: 10px; /* Bo góc cho modal */
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3); /* Đổ bóng cho modal */
            animation: slideDown 0.5s ease; /* Thêm hiệu ứng chuyển động */
        }

        @keyframes slideDown {
            from { transform: translateY(-30px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #ff6b6b; /* Màu sắc thay đổi khi hover */
            text-decoration: none;
            cursor: pointer;
        }

        #modalMessage {
            color: #333; /* Màu chữ thông báo */
            font-size: 18px; /* Kích thước chữ */
            text-align: center; /* Căn giữa chữ */
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #d3e8ff; /* Màu nền tiêu đề */
            padding: 10px 15px; /* Padding cho tiêu đề */
            border-radius: 10px 10px 0 0; /* Bo góc trên cho tiêu đề */
        }

        .modal-title {
            font-size: 20px;
            color: #333; /* Màu chữ tiêu đề */
            font-weight: bold; /* Chữ in đậm */
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>

    <main>
        <table>
            <thead>
                <tr>                   
                    <th>Sản Phẩm</th>
                    <th>Giá</th>
                    <th>Số Lượng</th>           
                    <th>Thành Tiền</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result && $result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row["ten_san_pham"]); ?></td>
                            <td><?php echo number_format($row["gia"], 0, ',', '.'); ?> VND</td>
                            <td>
                                <a href="capnhap_soluong.php?sanpham_id=<?php echo $row['sanpham_id']; ?>&action=increase">+</a>
                                <?php echo $row["so_luong"]; ?>
                                <a href="capnhap_soluong.php?sanpham_id=<?php echo $row['sanpham_id']; ?>&action=decrease">-</a>
                            </td>
                            <td><?php echo number_format($row["thanh_tien"], 0, ',', '.'); ?> VND</td>
                            
                            <td>
                                <a href="xoa_san_pham.php?sanpham_id=<?php echo $row['sanpham_id']; ?>" style="background-color: #ff6b6b; color: #fff; border-radius: 5px; padding: 8px 16px;">Xoá</a>
                            </td>
                        </tr>
                        <?php 
                            $tong_tien += $row["thanh_tien"]; 
                            $ten_san_pham_list .= $row["ten_san_pham"] . ", "; 
                        ?>

                    <?php endwhile; ?>
                    <?php $ten_san_pham_list = rtrim($ten_san_pham_list, ', '); ?>
                    <tr>
                        <td colspan="3"><strong>Tổng Tiền</strong></td>
                        <td><?php echo number_format($tong_tien, 0, ',', '.'); ?> VND</td>
                        <td>
                            <a href="thanhtoan.php?tong_tien=<?php echo $tong_tien; ?>&user_id=<?php echo $user_id; ?>&ten_san_pham=<?php echo urlencode($ten_san_pham_list); ?>" 
                               style="background-color: #007bff; color: #fff; padding: 8px 16px;">
                                Đặt hàng
                            </a>
                        </td>
                    </tr>
                <?php else: ?>
                    <tr>
                        <td colspan="6">Giỏ hàng hiện đang trống.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

    </main>
    <a href="lichsumuahang.php?user_id=<?php echo $user_id;?>" style="display: flex;margin: auto;width: 100vh;justify-content: center;align-items: center;">Lịch sử mua hàng</a>

    <?php include 'footer.php'; ?>
</body>
</html>
