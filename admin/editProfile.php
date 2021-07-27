<?php
  include "connection.php";
  include "navbar.php";
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>Admin Registration</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <title>Edit Profile</title>
  </head>
  <body>


  <div class="profileInfo">
    <div class="currentInfo">
      <?php

        $q=mysqli_query($db,"SELECT * FROM admin where username=
          '$_SESSION[login_user]' ;");
      ?>
      <h1 style="margin-top: 5%; ">My Profile (Edit)</h1>
      <?php
        $row=mysqli_fetch_assoc($q);
        ?>
      <br><br><br>
          <?php
          echo "<table class='styled-table' style='float: left'>";
            echo "<thead>";
              echo "<tr style ='text-align: center;'>";
          //table header
              echo "<th colspan='2'>";  echo "Information"; echo "</th>";
            echo "</tr>";
          echo "</thead>";

          echo "<tbody>";
            echo "<tr>";
              echo "<td>";
                echo "<b> First Name: </b>";
              echo "</td>";
              echo "<td>";
                echo $row['firstName'];
              echo "</td>";

            echo "</tr>";
            echo "<tr>";
              echo "<td>";
                echo "<b> Last Name: </b>";
              echo "</td>";
              echo "<td>";
                echo $row['lastName'];
              echo "</td>";
          echo "</tr>";
          echo "<tr>";
            echo "<td>";
              echo "<b> Admin ID: </b>";
            echo "</td>";
            echo "<td>";
              echo $row['a_id'];
            echo "</td>";
          echo "</tr>";
          echo "<tr>";
            echo "<td>";
              echo "<b> Username: </b>";
            echo "</td>";
            echo "<td>";
              echo $row['username'];
            echo "</td>";
          echo "</tr>";
          echo "<tr>";
            echo "<td>";
              echo "<b> Password: </b>";
            echo "</td>";
              echo "<td>";
                echo $row['password'];
              echo "</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td>";
              echo "<b> Phone Number: </b>";
            echo "</td>";
            echo "<td>";
              echo $row['phone'];
            echo "</td>";
          echo "</tr>";
          echo "<tr>";
          echo "<td>";
            echo "<b> Email: </b>";
          echo "</td>";
          echo "<td>";
            echo $row['email'];
          echo "</td>";
          echo "</tr>";
           ?>
      </div>

  <div class ="editButton" style="float: right; margin-top: 5%">
    <form class="editProfile" method="post">
      <input type="text" name="firstname2" placeholder="First Name" required=""> <br><br>
      <input type="text" name="lastname2" placeholder="Last Name" required=""> <br><br>
      <input type="text" name="aID2" placeholder="Admin ID" required=""> <br><br>
      <input type="text" name="username2" placeholder="Username" required=""> <br><br>
      <input type="text" name="password2" placeholder="Password" required=""> <br><br>
      <input type="text" name="phone2" placeholder="Phone Number" required=""> <br><br>
      <input type="text" name="email2" placeholder="Email Address" required=""> <br><br>
      <input class="button" type="submit" name="edit1" value="Submit Changes">
    </form>
  </div>
</div>
  <?php
    if(isset($_POST['edit1'])) { //checks to see if button is pressed
      $taken = false;
      $sql2 = "SELECT username FROM `admin`"; //returns usernames already signed up
      $result = mysqli_query($db,$sql2);

      while($row = mysqli_fetch_assoc($result)) { //cycles through usernames already in database
        if($row['username'] == $_POST['username2'] && $_POST['username2']!=$_SESSION['login_user']){
          $taken = true; //when duplicate username is found not including current username (edits for other values)
        } //
      }
      //generated code from phpmyadmin
      if(!$taken){
        mysqli_query($db,"UPDATE `admin` SET `a_id` = '$_POST[aID2]',`firstName` = '$_POST[firstname2]',
          `lastName` = '$_POST[lastname2]',`username` = '$_POST[username2]',`password` = '$_POST[password2]',
          `phone` = '$_POST[phone2]',`email` = '$_POST[email2]'
          WHERE `username` ='$_SESSION[login_user]';");

  ?>
  <script type="text/javascript">
    alert("Edit Successful, Please log back in to view changes");
    window.location="logout.php"
  </script>
  <?php
  }
  else {
  ?>
    <script type="text/javascript">
      alert("username already exists, please pick a different username");
      window.location="editProfile.php"
    </script>
  <?php
  }
  }
  ?>

</body>
</html>
