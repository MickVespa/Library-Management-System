<?php
  //establishes connection with database

  $db = mysqli_connect("localhost","root","","librarymanagementsystem"); /* server name,
  username, password, database name */
  if(!$db) {
    die("Connection failed: " . mysqli_connect_error());
  }
  //echo "Connection successful";
 ?>
