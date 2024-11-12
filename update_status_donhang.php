<?php
include 'database.php';

if (isset($_POST['user_id']) && isset($_POST['status'])) {
    echo $user_id = $_POST['user_id'];
    echo $status = $_POST['status'];

    $sql = "UPDATE don_hang SET status = ? WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $status, $user_id);

    if ($stmt->execute()) {
        header("Location: donhang.php"); // Redirect to the page with the list after updating
    } else {
        echo "Error updating status.";
    }

    $stmt->close();
}
$conn->close();
?>