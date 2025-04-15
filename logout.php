<?php
session_start();
session_destroy();
// header("Location: index.php");
echo "<script>
                alert('Thankyou for visiting ');
                window.location.href = 'index.php'; // Redirect to homepage
              </script>";
exit();
?>