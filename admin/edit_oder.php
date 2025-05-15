<?php
include 'confige.php';

if (!isset($_GET['id'])) {
    echo "Invalid Request!";
    exit;
}

$transaction_id = $_GET['id'];

// Fetch existing order details
$sql = "SELECT * FROM transaction_data WHERE transaction_id = '$transaction_id'";
$result = mysqli_query($conn, $sql);

if (!$result || mysqli_num_rows($result) == 0) {
    echo "Order not found!";
    exit;
}

$order = mysqli_fetch_assoc($result);

// If form submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $amount = $_POST['amount'];
    $product_ids = $_POST['product_ids'];

    $updateSql = "UPDATE transaction_data SET 
                    username = '$username',
                    amount = '$amount',
                    product_ids = '$product_ids'
                  WHERE transaction_id = '$transaction_id'";

    if (mysqli_query($conn, $updateSql)) {
        echo "<script>alert('Order updated successfully!'); window.location.href='dashboard.php';</script>";
    } else {
        echo "Error updating order: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Order</title>
    <style>
        form {
            max-width: 400px;
            margin: auto;
            padding: 20px;
            background: #f1f1f1;
            border-radius: 10px;
        }
        input, label {
            width: 100%;
            margin-bottom: 10px;
            padding: 8px;
        }
        button {
            padding: 10px;
            background-color: dodgerblue;
            color: white;
            border: none;
            cursor: pointer;
            width: 100%;
        }
    </style>
</head>
<body>

<h2 style="text-align: center;">Edit Order</h2>

<form method="POST">
    <label>Username</label>
    <input type="text" name="username" value="<?php echo htmlspecialchars($order['username']); ?>" required>

    <label>Amount</label>
    <input type="number" name="amount" value="<?php echo htmlspecialchars($order['amount']); ?>" required>

    <label>Product IDs (comma separated)</label>
    <input type="text" name="product_ids" value="<?php echo htmlspecialchars($order['product_ids']); ?>" required>

    <button type="submit">Update Order</button>
</form>

</body>
</html>
