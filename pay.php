<?php
session_start();
include 'confige.php';

// Total amount from URL
$amount = isset($_GET['total']) ? floatval($_GET['total']) : 0.00;

// UPI Payment Details
$upi_id = "6263949084@ybl"; 
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
            overflow-y: auto;
            max-height: 90vh;
            scrollbar-width: none;
            -ms-overflow-style: none;
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

        @media (max-width: 600px) {
            .container {
                max-height: 80vh;
                overflow-y: auto;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Pay via UPI</h2>
        <p class="info"><strong>Total Amount:</strong> ₹<?= number_format($amount, 2) ?></p>
        <p>Scan the QR code below using any UPI app (Google Pay, PhonePe, Paytm, etc.)</p>
        
        <img src="<?= $qr_code ?>" alt="UPI Payment QR Code">
        <p>Generated QR URL: <a href="<?= $qr_code ?>" target="_blank">Click here if QR is not visible</a></p>

        <form action="verify_payment.php" method="POST" id="paymentForm">
            <label>Enter Transaction ID:</label><br>
            <input type="hidden" name="amount" value="<?= $amount ?>">
            <input type="text" name="transaction_id" id="transaction_id" required placeholder="Enter UPI Transaction ID">
            <button type="submit">Confirm Payment</button>
        </form>
    </div>
    
</body>
</html>
