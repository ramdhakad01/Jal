
<?php
session_start(); // Start the session
include("confige.php");

if(isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($conn, $_POST['email']);
    $pwd = mysqli_real_escape_string($conn, $_POST['password']);

    // Query to check if the user exists
    $query = "SELECT * FROM registration_user WHERE email='$username' AND password='$pwd'";
    $data = mysqli_query($conn, $query);
    $total = mysqli_num_rows($data);

    if($total == 1) {
        $_SESSION['email'] = $username; // Set session
        echo "<script>
                alert('Login Successfully!');
                window.location.href = 'index.php'; // Redirect to homepage
              </script>";
    } else {
        echo "<script>
                alert('Invalid Username or Password!');
                window.location.href = 'sing.html'; // Redirect to login page
              </script>";
    }
}

// Check if session exists
if (!isset($_SESSION['email'])) {
    header("Location: sing.html");
    exit();
}
?>

