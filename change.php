<?php
session_start();
include 'confige.php';

if (!isset($_SESSION['email'])) {
    echo "<script>alert('Unauthorized access. Please login.'); window.location.href='../login.php';</script>";
    exit;
}

$email = $_SESSION['email'];
$message = "";
$popupType = ""; // success or error

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $current = trim($_POST['current_password']);
    $new = trim($_POST['new_password']);
    $confirm = trim($_POST['confirm_password']);

    $stmt = $conn->prepare("SELECT password FROM registration_user WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if (!$user) {
        $message = "User not found.";
        $popupType = "error";
    } elseif (trim($user['password']) !== $current) {
        $message = "Current password is incorrect.";
        $popupType = "error";
    } elseif ($new !== $confirm) {
        $message = "New password and confirm password do not match.";
        $popupType = "error";
    } else {
        $stmt = $conn->prepare("UPDATE registration_user SET password = ? WHERE email = ?");
        $stmt->bind_param("ss", $new, $email);
        if ($stmt->execute()) {
            $message = "Password changed successfully.";
            $popupType = "success";
        } else {
            $message = "Error updating password.";
            $popupType = "error";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Settings</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 40px;
            background: #f0f2f5;
        }
        .container {
            max-width: 400px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        input[type="password"], input[type="submit"] {
            width: 100%;
            padding: 12px;
            margin: 8px 0 16px 0;
            border-radius: 6px;
            border: 1px solid #ccc;
        }
        input[type="submit"] {
            background: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        h2 {
            text-align: center;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Change Password</h2>
    <form method="post" action="">
        <label>Current Password:</label>
        <input type="password" name="current_password" required>

        <label>New Password:</label>
        <input type="password" name="new_password" required>

        <label>Confirm Password:</label>
        <input type="password" name="confirm_password" required>

        <input type="submit" value="Change Password">
        <!-- New buttons -->
    <div style="text-align: center; margin-top: 20px;">
        <a href="../forgot-password.php" style="margin-right: 15px; color: #007BFF; text-decoration: none;">Forgot Password?</a>
        <a href="sing.html" style="color: #007BFF; text-decoration: none;">Login</a>
    </div>
    </form>
</div>

<?php if (!empty($message)): ?>
    <script>
        const type = "<?= $popupType ?>";
        const msg = "<?= $message ?>";
        alert((type === "success" ? "✅ " : "❌ ") + msg);
    </script>
<?php endif; ?>


</body>

</html>
