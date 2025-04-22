<?php
session_start();
include 'confige.php';

// Check if booking details exist
if (empty($_SESSION['movie']) || empty($_SESSION['date']) || empty($_SESSION['time']) || empty($_SESSION['seats'])) {
    die("No booking details found! Please book your seats first.");
}

// Retrieve session data
$movie = $_SESSION['movie'];
$date = $_SESSION['date'];
$time = $_SESSION['time'];
$seats = $_SESSION['seats'];

// Calculate seat count and total amount
$seat_count = is_array($seats) ? count($seats) : count(explode(',', $seats));
$original_amount = 100 * $seat_count; // ₹100 per seat
$amount = $original_amount;

// Handle discount coupon
$discount = 0;
$valid_coupons = [
    "SAVE50"  => 50,  // ₹50 discount
    "MOVIE20" => 20,  // ₹20 discount
];

if (!empty($_POST['coupon_code'])) {
    $coupon_code = strtoupper(trim($_POST['coupon_code']));
    
    if ($coupon_code === "MOM50") {
        $discount = $original_amount * 0.50;
    } elseif (array_key_exists($coupon_code, $valid_coupons)) {
        $discount = $valid_coupons[$coupon_code];
    } else {
        $error_message = "❌ Invalid Coupon Code!";
    }

    $amount = max($original_amount - $discount, 0);

    $_SESSION['discount'] = $discount;
    $_SESSION['coupon_applied'] = $coupon_code;
}

$_SESSION['amount'] = $amount;
session_write_close();

// UPI Payment Details
$upi_id = "9669855737@ybl"; 
$payment_url = "upi://pay?pa=$upi_id&pn=MovieBooking&mc=0000&tid=" . uniqid() . "&tr=TXN" . time() . "&tn=Movie%20Ticket&am=$amount&cu=INR";

// Use QuickChart.io instead of Google API
$qr_code = "https://quickchart.io/qr?text=" . urlencode($payment_url) . "&size=300";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UPI Payment</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            text-align: center; 
            color: white; 
            margin: 0; 
            padding: 0; 
            overflow: hidden;
        }

        .video-bg { 
            position: fixed; 
            top: 0; 
            left: 0; 
            width: 100%; 
            height: 100%; 
            object-fit: cover; 
            z-index: -1; 
        }
        .container {
            padding: 20px;
            max-width: 500px;
            margin: auto;
            background: rgba(0, 0, 0, 0.7);
            border-radius: 10px;
            margin-top: 50px;
            padding: 30px;
            overflow-y: auto; /* Enables scrolling inside the content */
            max-height: 90vh; /* Ensures it doesn't exceed viewport */
            scrollbar-width: none; /* Hides scrollbar in Firefox */
            -ms-overflow-style: none; /* Hides scrollbar in IE/Edge */
        }

        img { 
            width: 300px; 
            height: 300px; 
            margin: 20px 0; 
        }

        input, button { 
            padding: 10px; 
            margin: 10px; 
            width: 80%; 
        }

        .info { 
            font-size: 18px; 
            margin: 10px 0; 
        }

        strong { 
            color: #fff; 
        }

        .error { 
            color: red; 
        }

        .success { 
            color: green; 
        }

        /* Ensure scrolling on mobile screens */
        @media (max-width: 600px) {
            .container {
                max-height: 80vh;
                overflow-y: auto;
            }
        }
    </style>
</head>
<body>

    <video autoplay loop muted class="video-bg">
        <source src="pay.mp4" type="video/mp4">
    </video>

    <div class="container">
        <h2>Pay via UPI</h2>
        <p>Scan the QR code below using any UPI app (Google Pay, PhonePe, Paytm, etc.)</p>
        
        <img src="<?= $qr_code ?>" alt="UPI Payment QR Code">
        <p>Generated QR URL: <a href="<?= $qr_code ?>" target="_blank">Click here if QR is not visible</a></p>

        <p class="info"><strong>Original Price: ₹<?= $original_amount ?></strong></p>
        <?php if (!empty($discount)): ?>
            <p class="success">🎉 Discount Applied: ₹<?= $discount ?> (Code: <?= $_SESSION['coupon_applied'] ?>)</p>
        <?php endif; ?>
        <p class="info"><strong>Final Amount: ₹<?= htmlspecialchars($amount) ?></strong></p>
        <p class="info">UPI ID: <strong><?= htmlspecialchars($upi_id) ?></strong></p>

        <form method="POST">
            <label>Have a Coupon?</label><br>
            <input type="text" name="coupon_code" placeholder="Enter Coupon Code">
            <button type="submit">Apply Coupon</button>
        </form>
        <?php if (!empty($error_message)): ?>
            <p class="error"><?= $error_message ?></p>
        <?php endif; ?>

        <form action="verify_payment.php" method="POST" id="paymentForm">
            <label>Enter Transaction ID:</label><br>
            <input type="text" name="transaction_id" id="transaction_id" required placeholder="Enter UPI Transaction ID">
            <button type="submit">Confirm Payment</button>
        </form>

        <script>
            document.getElementById("paymentForm").addEventListener("submit", function() {
                setTimeout(function() {
                    window.location.href = "verify_payment.php";
                }, 2000); // Redirect to verify_payment.php after 2 seconds
            });
        </script>
    </div>
    
</body>
</html>