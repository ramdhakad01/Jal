<?php
include("confige.php");

if (isset($_POST['submit']))
 {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $password = $_POST['password'];// Hash password for security
    
    $sql = "INSERT INTO registration_seller ( `id`,`name`,`email`,`phone`,`address`,`password`)
     VALUES ('NULL','$name','$email','$phone','$address','$password')";
    
    if(mysqli_query($conn,$sql))
    {
         echo "<script>
                    alert('Registration Successful!');
                    window.location.href = 'registration.html'; // Redirect to login page
                  </script>";
        
    }
    else
    {
        echo "erro".mysqli_error($conn);
    }
}

$conn->close();
?>
