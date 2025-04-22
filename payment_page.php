<?php
$upi_id = "6263949084@axl"; // अपना UPI ID डालें
$name = "Amit Kumar";
$amount = 500;
?>

<!DOCTYPE html>
<html>
<head>
  <title>Scan & Pay</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
      text-align: center;
      padding: 40px;
    }

    .container {
      background-color: white;
      max-width: 400px;
      margin: auto;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    img {
      width: 250px;
      height: 300px;
      margin-bottom: 20px;
    }

    h2 {
      color: #333;
    }

    p {
      font-size: 16px;
      color: #555;
    }

    button {
      background-color: #28a745;
      color: white;
      padding: 12px 20px;
      font-size: 16px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
    }

    button:hover {
      background-color: #218838;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Step 1: QR को स्कैन करें</h2>
    
    <!-- QR Code Image -->
    <img src="img/Qrcode.jpg" alt="UPI QR Code"><br>

    <p>Pay ₹<?php echo $amount; ?> to UPI ID: <b><?php echo $upi_id; ?></b></p>

    <h2>Step 2: पेमेंट करने के बाद यह बटन दबाएँ</h2>
    <form action="payment_success.php" method="POST">
      <input type="hidden" name="name" value="<?php echo $name; ?>">
      <button type="submit">मैंने पेमेंट कर दिया</button>
    </form>
  </div>
</body>
</html>
