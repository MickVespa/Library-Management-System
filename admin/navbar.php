<?php
  include "connection.php";
  session_set_cookie_params(0); //suppose to keep computer from remebering login $session if browser is exited
  session_start();
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <body>
    <body>
      <header>
        <div class="navigationBar">
          <ul>
            <li><a href="adminindex.php">Home</a></li>
            <li><a href=inventory.php>Media Inventory</a></li>
            <!--<li><a href="adminLogin.php">admin-Login</a></li>-->
            <li>
              <?php
                  if(isset($_SESSION['login_user'])) {  //only shows if someone is logged in
                    echo "<a href='profile.php'>Profile</a>";
                  }
                  else {
                    echo "<a href='adminLogin.php'>Admin-Login</a>";
                  }
                ?>
            </li>
            <li>
              <?php
                if(isset($_SESSION['login_user'])) {  //only shows if someone is logged in
                  echo "<a href='studentInformation.php'>Student Information</a>";
                }
              ?>
            </li>
            <li>
              <?php
                  if(isset($_SESSION['login_user'])) {  //only shows if someone is logged in
                    echo "<p style='color:blue;'>"
                    .'Welcome ';
                    echo $_SESSION['login_user'];
                  }
                ?>
            </li>
            <li style="float: right;"><a href="mailto:online.library@gmail.com">Contact Us</a></li>
            <li style="float: right;">
              <?php
                if(!isset($_SESSION['login_user'])) { //only shows if no one is logged in
                  echo "<a href='Registration.php'>Sign Up</a>";
                }
              ?>
          </li>
            <li style="float: right;">
              <?php
                  if(isset($_SESSION['login_user'])) {  //only shows if someone is logged in
                    echo "<a href='logout.php'>Log-Out</a>";
                  }
                ?>
            </li>
          </ul>
        </div>
      </header>
  </body>
</html>
