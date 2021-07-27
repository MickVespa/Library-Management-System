<?php
  session_start();
  if(isset($_SESSION['login_user'])) {  //only works if someone is logged in
    unset($_SESSION['login_user']);
  }
  header("location:adminindex.php");
 ?>
