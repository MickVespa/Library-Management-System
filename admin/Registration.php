<?php
  include "navbar.php";
  include "connection.php";
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <script type="text/javascript">
      var password = "newadmin";
      var x = prompt("Enter registration password");
      if (x.toLowerCase() != password) {
       alert("Incorrect Password");
       window.location = "adminindex.php";
     }else{
       alert("Welcome new Admin!")
    }
    </script>
    <title>Admin Registration</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
  </head>
  <body>
    <section>
    <div class="Registration">
      <h1 class="title">Library Management System</h1> <br>
      <h2>Admin Registration Form</h2>
      <form class="registration" action="" method="post"> <!-- method post will put data inputed into datbase-->
        <input type="text" name="a_id" placeholder="Admin ID" required=""> <br><br>
        <input type="text" name="firstName" placeholder="First Name" required=""> <br><br>
        <input type="text" name="lastName" placeholder="Last Name" required=""> <br><br>
        <input type="text" name="username" placeholder="Username" required=""> <br><br>
        <input type="password" name="password" placeholder="Password" required=""> <br><br>
        <input type="text" name="phone" placeholder="Phone Number" required=""> <br><br>
        <input type="text" name="email" placeholder="Email Address" required=""> <br><br>
        <input class="button" type="submit" name="register" value="Register">
      </form>
    </div>
    </section>
      <?php
        if(isset($_POST['register'])) { //checks to see if button is pressed
          $taken = false;
          $sql2 = "SELECT username FROM `admin`"; //returns usernames already signed up
          $result = mysqli_query($db,$sql2);

          while($row = mysqli_fetch_assoc($result)) { //cycles through usernames already in database
            if($row['username'] == $_POST['username']){
              $taken = true; //when duplicate username is found
            } //
          }
          //generated code from phpmyadmin
          if(!$taken){
            mysqli_query($db,"INSERT INTO `admin` VALUES('$_POST[a_id]', '$_POST[firstName]',
            '$_POST[lastName]', '$_POST[username]', '$_POST[password]', '$_POST[phone]',
            '$_POST[email]');");

      ?>
      <script type="text/javascript">
        alert("Registration Successful");
      </script>
      <?php
      }
      else {
      ?>
        <script type="text/javascript">
          alert("username already exists");
        </script>
      <?php
      }
    }
    ?>

  </body>
  </html>
