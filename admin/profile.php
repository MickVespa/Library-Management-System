<?php
  include "connection.php";
  include "navbar.php";

 ?>
 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <title>Profile</title>
     <link rel="stylesheet" type="text/css" href="styles.css">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <meta charset="utf-8">
   </head>
  <body>
    <div class="profileInfo">
      <?php

        $q=mysqli_query($db,"SELECT * FROM admin where username=
          '$_SESSION[login_user]' ;");
      ?>
      <h1 style="margin-top: 5%; ">My Profile</h1>
      <?php
        $row=mysqli_fetch_assoc($q);
        ?>
      <br><br><br>
          <?php
          echo "<table class='styled-table'>";
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
    <div class ="profileButton">
      <form class="" action="editProfile.php" method="post">
        <input class="button" type="submit" name="submit1" value="Edit">
      </form>
    </div>
  </body>
</html>
