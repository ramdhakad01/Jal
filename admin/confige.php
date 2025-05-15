<?php
 $servername="localhost";
 $username="root";
 $password="";
 $dbname="jalwala_db";
  $conn=mysqli_connect($servername,$username,$password,$dbname);
  if(!$conn)
  {
    echo"connection failed";
  }
  else
  {
   // echo " connection is successfully";
  }
  ?>