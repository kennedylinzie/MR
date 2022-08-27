<?php
   //error_reporting(0);
  $server   = "localhost";
  $username = "root";
  $password = "";
  $database = "medication_reminder";
  $conn     = new mysqli($server,$username,$password,$database);

  if($conn->connect_error)
  {
    die("Connection: ".$conn->connect_error);
  }

  ?>
