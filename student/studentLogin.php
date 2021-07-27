<?php
  include "navbar.php";
  include "connection.php";
  //session_start(); included in navbar
  if(isset($_SESSION['login_user'])) {
    echo "Please logout before logging into a different account";
  }

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>Student Login</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
  </head>
  <body>
    <section>
      <div class="studentlogIn">
        <h1 class="title">Library Management System</h1> <br>
        <h2>Student Login</h2>
        <form class="sLogin" action="" method="post">
          <input type="text" name="Username" placeholder="Username" required=""> <br><br>
          <input type="password" name="Password" placeholder="Password" required=""> <br><br>
          <input class="button" type="submit" name="Search" value="Login">
        </form>
        <p>
          <a href="passwordReset.php">Forgot Password?</a> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
          <a href="Registration.php">Register</a>
        </p>
      </div>
    </section>
    <?php

    if(isset($_POST['Search'])) {

      $login=false;
      $res=mysqli_query($db,"SELECT * FROM `student` WHERE username='$_POST[Username]' && password='$_POST[Password]';");
      $count=mysqli_num_rows($res);

      if($count==false) {

        ?>
              <script type="text/javascript">
                alert("The username and password doesn't match.");
              </script>


        <?php
      }
      else {
        $_SESSION['login_user'] = $_POST['Username'];
        ?>
        <script type="text/javascript">
            window.location="studentindex.php"
          </script>
        <?php
      }
    }
  ?>
  </body>
</html>
