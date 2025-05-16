 <?php
session_start();
include 'confige.php'; // DB connection
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment Status</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(to right, #2c3e50, #4ca1af);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .status-container {
            background-color: rgba(0, 0, 0, 0.7);
            padding: 30px 40px;
            border-radius: 12px;
            text-align: center;
            max-width: 600px;
            width: 90%;
            height: auto;
            box-shadow: 0 0 15px rgba(0,0,0,0.3);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        h2 {
            margin-bottom: 10px;
            font-size: 26px;
        }

        p {
            font-size: 18px;
            margin: 8px 0;
        }

        .success {
            color: #00ff99;
        }

        .error {
            color: #ff5c5c;
        }

        strong {
            color: #ffd700;
        }

        .button-container {
            margin-top: 30px;
        }

        .continue-btn {
            display: inline-block;
            padding: 12px 25px;
            background-color: #00c8ff;
            color: white;
            text-decoration: none;
            font-size: 16px;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }

        .continue-btn:hover {
            background-color: #0099cc;
        }
    </style>
</head>
<body> 

<div class="status-container">
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $txn_id = $_POST['transaction_id'] ?? '';
    $amount = $_POST['amount'] ?? '0.00';
    $product_ids = $_POST['product_ids'] ?? '';
    $username = $_SESSION['email'] ?? 'UnknownUser';

    if (empty($txn_id)) {
        echo "<h2 class='error'>Transaction ID missing.</h2>";
        exit;
    }

    // Insert into transaction table
    $stmt = $conn->prepare("INSERT INTO transaction_data (username, transaction_id, amount, product_ids) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssds", $username, $txn_id, $amount, $product_ids);

    if ($stmt->execute()) {
        echo "<h2 class='success'>Thank you, <strong>$username</strong>! Payment of ₹" . htmlspecialchars($amount) . " has been recorded.</h2>";
        echo "<p>Transaction ID: <strong>" . htmlspecialchars($txn_id) . "</strong></p>";
    } else {
        echo "<h2 class='error'>Error saving transaction. Please try again.</h2>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "<h2 class='error'>Invalid request</h2>";
}
?> 
