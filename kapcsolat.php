<?php

  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "cookquest";

  // create connection
  $conn = mysqli_connect($servername, $username, $password, $dbname);
  $conn->set_charset("utf8");

  // check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  //echo "Connected successfully";

?>