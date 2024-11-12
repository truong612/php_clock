<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>
    <style type="text/css">
    	body {
	      display: flex;
	      justify-content: center;
	      align-items: center;
	      height: 100vh;
	      margin: 0;
	      font-family: Arial, sans-serif;
	      background-color: #f2f2f2;
	    }

	    .login-form {
	      width: 450px;
	      padding: 20px;
	      background-color: white;
	      border-radius: 8px;
	      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
	      text-align: center;
	    }

	    .login-form h2 {
	      font-size: 24px;
	      color: #333;
	    }

	    .login-form label {
	      display: block;
	      font-size: 14px;
	      text-align: left;
	      margin: 10px 0 5px;
	      color: #333;
	    }

	    .login-form input[type="text"],
	    .login-form input[type="password"] {
	      width: 90%;
	      padding: 10px;
	      margin-bottom: 10px;
	      border: 1px solid #ccc;
	      border-radius: 4px;
	      background-color: #f5f5f5;
	      font-size: 14px;
	      color: #333;
	    }

	    .login-form a {
	      color: #6a1b9a;
	      text-decoration: none;
	      font-size: 14px;
	    }

	    .login-form a:hover {
	      text-decoration: underline;
	    }

	    .login-form button {
	      width: 100%;
	      padding: 10px;
	      background-color: #6a1b9a;
	      color: white;
	      border: none;
	      border-radius: 4px;
	      font-size: 16px;
	      cursor: pointer;
	    }

	    .login-form button:hover {
	      background-color: #5a157d;
	    }
    </style>

    
</head>
<body>

	<?php
	// Kết nối cơ sở dữ liệu
	include 'database.php';

	$error = "";
	$success = "";
	// Xử lý khi người dùng nhấn nút "Đăng nhập"
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	    $ten_dang_nhap = $_POST["ten_dang_nhap"];
	    $mat_khau = $_POST["mat_khau"];

	    // Kiểm tra tên đăng nhập và mật khẩu không để trống
	    if (empty($ten_dang_nhap) || empty($mat_khau)) {
	        $error = "Vui lòng điền tên đăng nhập và mật khẩu.";
	    } else {
	        // Tìm người dùng trong cơ sở dữ liệu
	        $stmt = $conn->prepare("SELECT * FROM users WHERE ten_dang_nhap = ?");
	        $stmt->bind_param("s", $ten_dang_nhap);
	        $stmt->execute();
	        $result = $stmt->get_result();

	        // Kiểm tra nếu tìm thấy người dùng
	        if ($result->num_rows > 0) {
	            $user = $result->fetch_assoc();

	            // Kiểm tra mật khẩu
	            if ($user["mat_khau"] == $mat_khau) {
	                // Đăng nhập thành công
	                session_start();
	                $_SESSION["user_id"] = $user["user_id"];
	                $_SESSION["ten_dang_nhap"] = $user["ten_dang_nhap"];
	                echo "<p style='color: green;'>Đăng nhập thành công! Chào mừng, " . htmlspecialchars($user["ten_dang_nhap"]) . ".</p>";
	                // Chuyển hướng đến trang chính (ví dụ: index.php)
	                header("Location: index.php");
	                exit;
	            } else {
	                $error = "Mật khẩu không chính xác.";
	            }
	        } else {
	           	$stmt_admin = $conn->prepare("SELECT * FROM admin WHERE ten_admin = ? AND mat_khau_admin = ?");
	            $stmt_admin->bind_param("ss", $ten_dang_nhap, $mat_khau);
	            $stmt_admin->execute();
	            $result_admin = $stmt_admin->get_result();

	            if ($result_admin->num_rows > 0) {
	                header("Location: dashboard.php");
	                exit;
	            } else {
	                $error = "Tài khoản hoặc mật khẩu không đúng!";
	            }
	            $stmt_admin->close();
		        }

	        // Đóng statement
	        $stmt->close();
	    }
	}

	

	// Đóng kết nối
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

	<!-- <script>
	    // Đóng thông báo khi người dùng nhấn vào vùng overlay
	    document.addEventListener('click', function(event) {
	        const overlay = document.querySelector('.notification-overlay');
	        if (overlay && event.target === overlay) {
	            overlay.style.display = 'none';
	        }
	    });

	    // Tự động đóng thông báo sau 3 giây
	    setTimeout(function() {
	        const overlay = document.querySelector('.notification-overlay');
	        if (overlay) {
	            overlay.style.display = 'none';
	        }
	    }, 1500); 
	</script> -->

	

	<div class="login-form">
	    <h2>Welcome Back!</h2>
	    <form action="dangnhap.php" method="POST">
		      <label for="ten_dang_nhap">Tên Đăng Nhập<span style="color: red;">*</span></label>
		      <input type="text" id="ten_dang_nhap" name="ten_dang_nhap" required placeholder="Vui lòng nhập tên đăng nhập !" required>

		      <label for="mat_khau">Mật Khẩu<span style="color: red;">*</span></label>
		      <input type="password" id="mat_khau" name="mat_khau" required placeholder="Vui lòng nhập mật khẩu !" required>

		      <div style="margin: 15px 0;">
		        Bạn không có tài khoản? <a href="dangky.php">Đăng ký ngay</a>|<a href="index.php">Về trang chủ</a>|<a href="quen_matkhau.php">Quên mật khẩu</a>
		      </div>

		      <button type="submit">Đăng nhập ngay</button>
	    </form>
  	</div>

</body>
</html>
