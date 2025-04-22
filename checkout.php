<?php
// ----- PHP LOGIC -----
$upi_id = "6263949084@axl";   // UPI ID
$name = "Jalwala";            // UPI पे दिखने वाला नाम
$totalAmount = isset($_GET['total']) ? floatval($_GET['total']) : 0;  // Total from URL
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pay Now - Jalwala</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            padding: 40px;
            text-align: center;
        }
        .pay-box {
            background-color: #fff;
            max-width: 400px;
            margin: auto;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        h2 {
            margin-bottom: 5px;
        }
        .upi-id {
            font-size: 14px;
            color: #666;
            margin-bottom: 20px;
        }
        .amount {
            font-size: 24px;
            color: #333;
            margin: 20px 0;
        }
        .qr img {
            width: 250px;
            height: 250px;
            border: 1px solid #ddd;
            border-radius: 6px;
        }
        .note {
            margin-top: 20px;
            font-size: 14px;
            color: #777;
        }
        .btn {
            display: inline-block;
            margin-top: 25px;
            padding: 12px 20px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            text-decoration: none;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

<div class="pay-box">
    <h2><?php echo $name; ?> को पे करें</h2>
    <p class="upi-id">UPI ID: <strong><?php echo $upi_id; ?></strong></p>

    <div class="amount">₹<?php echo number_format($totalAmount, 2); ?></div>

    <div class="qr">
        <img src="img/Qrcode.jpg" alt="UPI QR Code"><br>
    </div>

    <p class="note">UPI एप्प से QR स्कैन करके पेमेंट करें</p>

    <form action="verify_payment.php" method="POST">
        <input type="hidden" name="amount" value="<?php echo $totalAmount; ?>">
        <input type="hidden" name="name" value="<?php echo $name; ?>">
        <button type="submit" class="btn">मैंने पेमेंट कर दिया</button>
    </form>
</div>

<script>
    // Optional: Auto-clear cart from localStorage
    localStorage.removeItem('jalWalaCart');
</script>

</body>
</html>
