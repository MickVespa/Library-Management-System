<?php
  include "navbar.php";
  include "connection.php";
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Password Reset</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <body>
    <div class="passwordReset">
      <h1 class="title">Password Reset</h1> <br>
      <form class="sLogin" action="" method="post">
        <input type="text" name="Username" placeholder="Username" required=""> <br><br>
        <input type="text" name="Email" placeholder="Email" required=""> <br><br>
        <input type="password" name="Password" placeholder="New Password" required=""> <br><br>
        <input type="password" name="ConfPassword" placeholder="Confirm Password" required=""> <br><br>
        <input class="button" type="submit" name="reset" value="Reset">
      </form>
    </div>
    <?php
      //sets password in admin database to new password entered in form
      // matching username and email to admin database for specific password update
      if(isset($_POST['reset'])) {
        if($_POST['Password'] !== $_POST['ConfPassword']) {
          echo "<script>alert('Passwords are not equal')</script>";
          echo "<script>window.location='passwordReset.php'</script>";
        }

        $sql1 = "SELECT username FROM `admin`"; //returns usernames already signed up
        $sql2 = "SELECT email FROM `admin`"; //returns emails already signed up
        $result1 = mysqli_query($db,$sql1);
        $result2 = mysqli_query($db,$sql2);
        $reset1 = false;
        $reset2 = false;
        while($row = mysqli_fetch_assoc($result1)) { //cycles through usernames already in database
          if($row['username'] == $_POST['Username']){
            $reset1 = true;
          }
        }

        while($row = mysqli_fetch_assoc($result2)) { //cycles through emails already in database
          if($row['email'] == $_POST['Email']){
            $reset2 = true;
          }
        }

        if($reset1 === true && $reset2 === true) { //if username and email match in the system
            mysqli_query($db, "UPDATE admin SET password='$_POST[Password]'
            WHERE username = '$_POST[Username]' AND email = '$_POST[Email]';");

            echo "<script>alert('Password Reset Successful!')</script>";
        }
        else {
          echo "<script>alert('Password Reset Failed, Username or Password Combonation Inccorect')</script>";

        }
      }
      ?>
  </body>
</html>
