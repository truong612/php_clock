<?php
include 'database.php';

if (isset($_POST['id']) && isset($_POST['status'])) {
    echo $id = $_POST['id'];
    echo $status = $_POST['status'];

    $sql = "UPDATE lienhe SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $status, $id);

    if ($stmt->execute()) {
        header("Location: tin_nhan.php"); // Redirect to the page with the list after updating
    } else {
        echo "Error updating status.";
    }

    $stmt->close();
}
$conn->close();
?>
