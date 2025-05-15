 <?php
session_start();
include 'confige.php'; // DB connection
?>
<!-- <!DOCTYPE html>
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
<body> -->

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
        echo "<p>Product IDs: <strong>" . htmlspecialchars($product_ids) . "</strong></p>";
    } else {
        echo "<h2 class='error'>Error saving transaction. Please try again.</h2>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "<h2 class='error'>Invalid request</h2>";
}
?> 

<!-- 
    <div class="button-container">
        <a href="index.php" class="continue-btn">Continue Shopping</a>
    </div>
</div>

</body>
</html>   -->
<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Successful</title>
    <link rel="stylesheet" href="order-styles.css">
</head>
<body>
    <div class="order-success">
        <div class="success-icon">✓</div>
        <h1>Your Order is Confirmed!</h1>
        <p>Thank you for your purchase. We've received your order and will begin processing it right away.</p>
        
        <div class="order-id">
            Order ID: <span id="order-id-display"></span>
        </div>
        
        <div class="action-buttons">
            <button class="view-order-btn" onclick="viewOrderDetails()">View Order</button>
            <button class="continue-shopping-btn" onclick="continueShopping()">Continue Shopping</button>
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get order data from localStorage
            const orderData = JSON.parse(localStorage.getItem('orderData'));
            
            // Display order ID
            document.getElementById('order-id-display').textContent = orderData.orderId;
        });
        
        function viewOrderDetails() {
            window.location.href = 'order-details.html';
        }
        
        function continueShopping() {
            // Redirect to home page or shop page
            window.location.href = 'index.php';
        }
    </script>
</body>
</html>

 -->
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="order-styles.css">
</head>
<body>
    <div class="container">
        <div class="checkout-container">
            <div class="progress-bar">
                <div class="step active" data-step="1">
                    <div class="step-number">1</div>
                    <div class="step-name">Basic Details</div>
                </div>
                <div class="step-connector"></div>
                <div class="step" data-step="2">
                    <div class="step-number">2</div>
                    <div class="step-name">Shipping</div>
                </div>
                <div class="step-connector"></div>
                <div class="step" data-step="3">
                    <div class="step-number">3</div>
                    <div class="step-name">Method</div>
                </div>
                <div class="step-connector"></div>
                <div class="step" data-step="4">
                    <div class="step-number">4</div>
                    <div class="step-name">Payment</div>
                </div>
            </div>

            <div class="checkout-form">
                <!-- Basic Details Section -->
                <div class="section" id="basic-details-section">
                    <div class="section-header" onclick="toggleSection('basic-details-content')">
                        <h2>BASIC DETAILS</h2>
                        <span class="toggle-icon">▼</span>
                    </div>
                    <div class="section-content" id="basic-details-content">
                        <div class="form-row">
                            <input type="text" placeholder="First name" id="first-name">
                            <input type="text" placeholder="Last name" id="last-name">
                        </div>
                        <div class="form-row">
                            <input type="email" placeholder="Enter your mail id" id="email">
                        </div>
                        <div class="form-row">
                            <div class="phone-input">
                                <select id="country-code">
                                    <option value="+91">+91</option>
                                    <option value="+1">+1</option>
                                    <option value="+44">+44</option>
                                </select>
                                <input type="tel" placeholder="Phone number" id="phone">
                            </div>
                        </div>
                        <div class="form-row login-row">
                            <span>Already registered with us? <a href="#" class="login-link">LOGIN IN</a></span>
                        </div>
                        <div class="form-row">
                            <button class="continue-btn" onclick="goToStep(2)">Continue</button>
                        </div>
                    </div>
                </div>

                <!-- Shipping Section -->
                <div class="section" id="shipping-section">
                    <div class="section-header" onclick="toggleSection('shipping-content')">
                        <h2>SHIPPING</h2>
                        <span class="toggle-icon">▼</span>
                    </div>
                    <div class="section-content" id="shipping-content" style="display: none;">
                        <div class="form-row">
                            <input type="text" placeholder="Street address" id="street">
                        </div>
                        <div class="form-row">
                            <input type="text" placeholder="City/Town" id="city">
                        </div>
                        <div class="form-row">
                            <input type="text" placeholder="PIN code" id="pin">
                            <div class="select-wrapper">
                                <select id="state">
                                    <option value="" disabled selected>State</option>
                                    <option value="Delhi">Indore</option>
                                    <option value="Delhi">Delhi</option>
                                    <option value="Maharashtra">Maharashtra</option>
                                    <option value="Karnataka">Dewas</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="select-wrapper full-width">
                                <select id="country">
                                    <option value="" disabled selected>Country</option>
                                    <option value="India">India</option>
                                    <option value="USA">USA</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <label class="checkbox-container">
                                <input type="checkbox" id="different-billing">
                                <span class="checkmark"></span>
                                Use a different billing address
                            </label>
                        </div>
                        <div class="form-row">
                            <button class="continue-btn" onclick="goToStep(3)">Continue</button>
                        </div>
                    </div>
                </div>

                <!-- Method Section
                <div class="section" id="method-section">
                    <div class="section-header" onclick="toggleSection('method-content')">
                        <h2>METHOD</h2>
                        <span class="toggle-icon">▼</span>
                    </div>
                    <div class="section-content" id="method-content" style="display: none;">
                        <div class="form-row">
                            <div class="delivery-options">
                                <label class="radio-container">
                                    <input type="radio" name="delivery-method" value="standard" checked>
                                    <span class="radio-checkmark"></span>
                                    <div class="delivery-option-details">
                                        <span class="delivery-option-name">Standard Delivery</span>
                                        <span class="delivery-option-price">Free</span>
                                    </div>
                                </label>
                                <label class="radio-container">
                                    <input type="radio" name="delivery-method" value="express">
                                    <span class="radio-checkmark"></span>
                                    <div class="delivery-option-details">
                                        <span class="delivery-option-name">Express Delivery</span>
                                        <span class="delivery-option-price">₹50</span>
                                    </div>
                                </label>
                            </div>
                        </div>
                        <div class="form-row">
                            <button class="continue-btn" onclick="goToStep(4)">Continue</button>
                        </div>
                    </div>
                </div> -->

                <!-- Payment Section -->
                <!-- <div class="section" id="payment-section">
                    <div class="section-header" onclick="toggleSection('payment-content')">
                        <h2>PAYMENT</h2>
                        <span class="toggle-icon">▼</span>
                    </div>
                    <div class="section-content" id="payment-content" style="display: none;">
                        <div class="form-row">
                            <div class="payment-options">
                                <label class="radio-container">
                                    <input type="radio" name="payment-method" value="cod" checked>
                                    <span class="radio-checkmark"></span>
                                    Cash on delivery
                                </label>
                                <label class="radio-container">
                                    <input type="radio" name="payment-method" value="cup">
                                    <span class="radio-checkmark"></span>
                                    UPI 
                                </label>
                            </div>
                        </div> -->
                        <div class="form-row">
                            <button class="order-now-btn" onclick="placeOrder()">Order Now</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="order-summary">
            <div id="app"></div>
    </div>

    <script src="js/cart.js"></script>
    <script src="order-script.js"></script>
</body>
</html>
