<!-- <?php
include("confige.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM transaction_data WHERE transaction_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $id);
    if ($stmt->execute()) {
        echo "<script>alert('Order deleted successfully!'); window.location.href='index.php?page=orders';</script>";
    } else {
        echo "<script>alert('Failed to delete order.'); window.location.href='dashboard.php?page=orders';</script>";
    }
    $stmt->close();
}
?> -->
