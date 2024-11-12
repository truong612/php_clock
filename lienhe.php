<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liên hệ</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

	<?php include 'header.php'; ?>
	
	<?php
	include 'database.php';
	if (!isset($_SESSION["user_id"])) {
	    header("Location: dangnhap.php");
	    exit;
	}
	$error = "";
	$success = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	    $user_id = $_SESSION["user_id"];
	    $ten = $_POST["ten"];
	    $email = $_POST["email"];
	    $sdt = $_POST["sdt"];
	    $tin_nhan = $_POST["tin_nhan"];

	    if (empty($ten) || empty($email) || empty($tin_nhan)) {
	        $error = "Vui lòng điền đầy đủ các thông tin bắt buộc.";
	    } else {
	    	$status = 0;
	        $stmt = $conn->prepare("INSERT INTO lienhe (ten, email, sdt, tin_nhan, status) VALUES (?, ?, ?, ?, ?)");
	        $stmt->bind_param("ssssi", $ten, $email, $sdt, $tin_nhan, $status);

	        if ($stmt->execute()) {
	            $success = "Cảm ơn bạn đã liên hệ! Chúng tôi sẽ phản hồi sớm nhất.";
	        } else {
	            $error = "Đã có lỗi xảy ra, vui lòng thử lại.";
	        }

	        $stmt->close();
	    }
	}
	?>

	<?php if ($error || $success): ?>
	    <div class="notification-overlay">
	        <div class="notification-box">
	            <?php if ($error): ?>
	                <p class="notification-error"><?php echo $error; ?></p>
	            <?php endif; ?>
	            <?php if ($success): ?>
	                <p class="notification-success"><?php echo $success; ?></p>
	            <?php endif; ?>
	        </div>
	    </div>
	<?php endif; ?>

	<h1 style="text-align: center;">Liên Hệ</h1>

	<form action="lienhe.php" method="POST">
	    <label for="ten">Tên của bạn:</label>
	    <input type="text" id="ten" name="ten" required><br><br>

	    <label for="email">Email:</label>
	    <input type="email" id="email" name="email" required><br><br>

	    <label for="sdt">Số điện thoại:</label>
	    <input type="tel" id="sdt" name="sdt" pattern="[0-9]{10}"><br><br>

	    <label for="tin_nhan">Tin nhắn:</label><br>
	    <textarea id="tin_nhan" name="tin_nhan" rows="4" cols="50" required></textarea><br><br>

	    <div class="button-container">
	        <input type="submit" value="Gửi">
	    </div>
	</form>

	<script>
	    document.addEventListener('click', function(event) {
	        const overlay = document.querySelector('.notification-overlay');
	        if (overlay && event.target === overlay) {
	            overlay.style.display = 'none';
	        }
	    });

	    setTimeout(function() {
	        const overlay = document.querySelector('.notification-overlay');
	        if (overlay) {
	            overlay.style.display = 'none';
	        }
	    }, 1500); 
	</script>

	<?php include 'footer.php'; ?>

</body>
</html>
