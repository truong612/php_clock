<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký Tài Khoản</title>
    <style type="text/css">
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f4f4f4;
        }

        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
            color: #333;
        }

        h1 {
            font-size: 24px;
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .form-group {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .form-group label {
            font-weight: bold;
            color: #333;
            display: block;
            margin-bottom: 5px;
        }

        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group input[type="password"],
        .form-group input[type="file"],
        .form-group input[type="tel"]
         {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
            font-size: 14px;
            color: #333;
        }

        .form-group input[type="file"] {
            padding: 8px;
            background-color: #f9f9f9;
        }

        .two-column {
            flex: 1 1 45%;
        }

        .file-upload {
            flex: 1 1 100%;
        }

        .login-link {
            text-align: center;
            margin: 10px 0;
            font-size: 14px;
            color: #777;
        }

        .login-link a {
            color: #6c63ff;
            text-decoration: none;
            font-weight: bold;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        .submit-btn {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            color: #fff;
            background-color: #6c63ff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .submit-btn:hover {
            background-color: #5842d2;
        }

        /* Responsive adjustments */
        @media (max-width: 500px) {
            .form-group {
                flex-direction: column;
            }
            .two-column {
                flex: 1 1 100%;
            }
        }

        /* Notification styles */
        .notification-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .notification-box {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 300px;
            text-align: center;
            animation: fade-in 0.3s ease;
        }

        @keyframes fade-in {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .notification-error {
            color: #d9534f;
            font-weight: bold;
        }

        .notification-success {
            color: #5cb85c;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Tạo Tài Khoản</h1>
    <form action="dangky.php" method="POST" >
        <div class="form-group">
            <div class="two-column">
                <label for="ten_tai_khoan">Tên *</label>
                <input type="text" id="ten_tai_khoan" name="ten_tai_khoan" placeholder="Nhập vào tên của bạn" required>
            </div>
            <div class="two-column">
                <label for="mat_khau">Mật khẩu *</label>
                <input type="password" id="mat_khau" name="mat_khau" placeholder="Nhập mật khẩu của bạn" required>
            </div>
        </div>
        <div class="form-group">
            <div class="two-column">
                <label for="ten_dang_nhap">Tên Đăng Nhập *</label>
                <input type="text" id="ten_dang_nhap" name="ten_dang_nhap" placeholder="Nhập vào tên đăng nhập của bạn" required>
            </div>
            <div class="two-column">
                <label for="nhap_lai_mat_khau">Xác nhận mật khẩu *</label>
                <input type="password" id="nhap_lai_mat_khau" name="nhap_lai_mat_khau" placeholder="Xác nhận mật khẩu" required>
            </div>
        </div>
        <div class="form-group file-upload">
            <div class="two-column">
                <label for="sdt">SĐT *</label>
                <input type="tel" id="sdt" name="sdt" placeholder="Nhập số điện thoại của bạn" pattern="[0-9]{10}">
            </div>
            <div class="two-column">
                <label for="email">Email *</label>
                <input type="email" id="email" placeholder="Nhập vào email của bạn" name="email">
            </div>
        </div>
        <div class="form-group">
            <div class="two-column">
                <label for="dia_chi">Địa chỉ *</label>
                <input type="text" id="dia_chi" name="dia_chi" placeholder="Nhập vào địa chỉ của bạn" required>
            </div>
        </div>
        <div class="login-link">
            Bạn đã có tài khoản? <a href="dangnhap.php">Đăng Nhập Ngay</a>|<a href="index.php">Về trang chủ </a>
        </div>
        <button type="submit" class="submit-btn">Đăng ký ngay </button>
    </form>
</div> 

<?php
    // Kết nối cơ sở dữ liệu
    include 'database.php';

    $error = "";
    $success = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $ten_tai_khoan = $_POST["ten_tai_khoan"];
        $ten_dang_nhap = $_POST["ten_dang_nhap"];
        $email = $_POST["email"];
        $sdt = $_POST["sdt"];
        $dia_chi = $_POST["dia_chi"];
        $mat_khau = $_POST["mat_khau"];
        $nhap_lai_mat_khau = $_POST["nhap_lai_mat_khau"];

        if (empty($ten_tai_khoan) || empty($ten_dang_nhap) || empty($email) || empty($mat_khau) || empty($nhap_lai_mat_khau)) {
            $error = "Vui lòng điền đầy đủ các thông tin bắt buộc.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "Email không hợp lệ.";
        } elseif ($mat_khau !== $nhap_lai_mat_khau) {
            $error = "Mật khẩu nhập lại không khớp.";
        } else {
            $stmt = $conn->prepare("INSERT INTO users (ten_tai_khoan, ten_dang_nhap, email, sdt, dia_chi, mat_khau) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssss", $ten_tai_khoan, $ten_dang_nhap, $email, $sdt, $dia_chi, $mat_khau);

            if ($stmt->execute()) {
                $success = "Đăng ký thành công!";
            } else {
                $error = "Tên đăng nhập hoặc email đã tồn tại.";
            }

            $stmt->close();
        }
    }

    $conn->close();
?>

<?php if ($error || $success): ?>
    <div class="notification-overlay">
        <div class="notification-box">
            <?php if ($error): ?>
                <p class="notification-error"><?php echo $error; ?></p>
            <?php else: ?>
                <p class="notification-success"><?php echo $success; ?></p>
                <script>
                    setTimeout(function() {
                        window.location.href = "index.php";
                    }, 2000); // Chuyển trang sau 2 giây
                </script>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>

</body>
</html>
