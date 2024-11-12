<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Quen mat khau</title>
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
		session_start();
		include('database.php'); // Kết nối cơ sở dữ liệu

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		    $username = $_POST['ten_dang_nhap'];
		    $password = $_POST['mat_khau'];
		    $confirm_password = $_POST['confirm_mat_khau'];

		    // Kiểm tra mật khẩu và xác nhận mật khẩu
		    if ($password != $confirm_password) {
		        echo "<script>alert('Mật khẩu không khớp!');</script>";
		    } else {
		        // Kiểm tra xem tên đăng nhập có tồn tại không
		        $sql = "SELECT * FROM users WHERE ten_dang_nhap = ?";
		        $stmt = $conn->prepare($sql);
		        $stmt->bind_param("s", $username);
		        $stmt->execute();
		        $result = $stmt->get_result();

		        if ($result->num_rows > 0) {
		            
		           

		            $update_sql = "UPDATE users SET mat_khau = ? WHERE ten_dang_nhap = ?";
		            $update_stmt = $conn->prepare($update_sql);
		            $update_stmt->bind_param("ss", $password, $username);

		            if ($update_stmt->execute()) {
		                echo "<script>alert('Mật khẩu đã được thay đổi thành công!');</script>";
		            } else {
		                echo "<script>alert('Đã có lỗi xảy ra, vui lòng thử lại sau!');</script>";
		            }
		        } else {
		            echo "<script>alert('Tên đăng nhập không tồn tại!');</script>";
		        }
		    }
		}
	?>
	<div class="login-form">
	    <h2>Đổi mật khẩu</h2>
	    <form action="quen_matkhau.php" method="POST">
		      <label for="ten_dang_nhap">Tên Đăng Nhập<span style="color: red;">*</span></label>
		      <input type="text" id="ten_dang_nhap" name="ten_dang_nhap" required value="<?php echo isset($username) ? $username : ''; ?>" placeholder="Vui lòng nhập tên đăng nhập !" required>

		      <label for="mat_khau">Mật Khẩu mới<span style="color: red;">*</span></label>
		      <input type="password" id="mat_khau" name="mat_khau" value="<?php echo isset($password) ? $password : ''; ?>" required placeholder="Vui lòng nhập mật khẩu mới !" required>

		      <label for="confirm_mat_khau">Nhập lại Mật Khẩu<span style="color: red;">*</span></label>
		      <input type="password" id="confirm_mat_khau" name="confirm_mat_khau" value="<?php echo isset($confirm_password) ? $confirm_password : ''; ?>" required placeholder="Vui lòng nhập mật khẩu mới!" required>

		      <div style="margin: 15px 0;">
		        Bạn không có tài khoản? <a href="dang_ky.php">Đăng ký ngay</a>|<a href="index.php">Về trang chủ</a>|<a href="quen_matkhau.php">Quên mật khẩu</a>
		      </div>

		      <button type="submit">Đổi mật khẩu</button>
	    </form>
  	</div>
</body>
</html>