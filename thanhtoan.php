<?php
session_start();
// Kiểm tra nếu user đã đăng nhập
if (!isset($_SESSION["user_id"])) {
    header("Location: dangnhap.php");
    exit;
}

$user_id = $_SESSION["user_id"]; 
?>


<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <title>Thanh Toán</title>
    <style type="text/css">
        body, html {
            height: 100%;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f7f7f7; /* Màu nền nhạt */
        }

        main {
            width: 100%; /* Không cần chỉnh thêm */
        }

        form {
            width: 100vh;

            max-width: 600px;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        label {
            font-weight: bold;
            margin-top: 15px;
            display: block;
            color: #333;
        }

        input[type="text"], input[type="number"] {
            width: 90%;
            padding: 12px;
            margin: 6px 0 20px 0;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
        }

        .button-container {
            display: flex;
            justify-content: space-between;
            gap: 10px;
        }

        button[type="submit"], .back-button {
            background-color: #28a745;
            color: white;
            padding: 12px;
            width: 40%;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 15px;
            text-align: center;
            text-decoration: none;
        }

        button[type="submit"]:hover, .back-button:hover {
            background-color: #218838;
        }

        .back-button {
            background-color: #28a745;
        }

        .back-button:hover {
            background-color: #218838;
        }

        @media (max-width: 768px) {
            form {
                padding: 20px;
            }

            input[type="text"], input[type="number"] {
                font-size: 13px;
            }

            button[type="submit"], .back-button {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <?php
        
        $tong_tien = isset($_GET['tong_tien']) ? $_GET['tong_tien'] : 0;
        $ten_san_pham = isset($_GET['ten_san_pham']) ? $_GET['ten_san_pham'] : '';
        
    ?>
    <form action ="xuly_thanhtoan.php" method="POST">
        <input type="hidden" id="user_id" name="user_id" value="<?php echo htmlspecialchars($user_id); ?>" readonly>
        <label for="ten_khach_hang">Tên khách hàng:</label>
        <input type="text" id="ten_khach_hang" name="ten_khach_hang" required>

        <label for="so_dien_thoai">Số điện thoại:</label>
        <input type="text" id="so_dien_thoai" name="so_dien_thoai" required>

        <label for="dia_chi">Địa chỉ:</label>
        <input type="text" id="dia_chi" name="dia_chi" required>

        <label for="tongtien">Tổng tiền:</label>
        <input type="number" id="tongtien" name="tongtien" readonly value="<?php echo $tong_tien; ?>">

        <label for="tensanpham">Tên sản phẩm:</label>
        <input type="text" id="tensanpham" name="tensanpham" readonly value="<?php echo $ten_san_pham; ?>">

        <div class="button-container">
            <button type="submit">Xác nhận thanh toán</button>
            <a href="giohang.php" class="back-button">Quay về</a>
        </div>
    </form>
</body>
</html>
