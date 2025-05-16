<?php
include('confige.php');
// Check if form submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize inputs
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Insert query
    $sql = "INSERT INTO contact_messages (name, email, phone, subject, message) 
            VALUES ('$name', '$email', '$phone', '$subject', '$message')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Message sent successfully!');window.location.href='thankyou.html';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
