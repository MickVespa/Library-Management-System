<?php
  include "navbar.php";
  include "connection.php";
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>Student Information</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
  </head>
  <body>
    <section>
      <br><br>
    <h1 class="mediaHeader">Student Information</h1>
    <br><br>
    <!--______________________________Search Bar_____________________________-->
    <div class="srch">
      <form class="searchBar" name="form1" method="post">
          <input class="form-control" type="text" name="search" placeholder="Search Student">
          <input class="button" type="submit" name="Search" value="search">
          &nbsp&nbsp<a href="advanceSearchMedia.php">Advance Search</a>
          <br><br>
          <?php
            if(isset($_SESSION['login_user'])) { //keeps hidden unless logged in
              echo"<a href='requests.php'>View Media Checked-out / Requests</a>";
            }
          ?>

    </div>
    <br><br>
    <?php
      if (isset($_POST['Search'])) {          //if button has been pressed`
        $q=mysqli_query($db,"SELECT * FROM `student` WHERE
          (CONVERT(`s_id` USING utf8) LIKE '%$_POST[search]%' OR CONVERT(`firstName` USING utf8) LIKE
          '%$_POST[search]%' OR CONVERT(`lastName` USING utf8) LIKE '%$_POST[search]%' OR CONVERT(`username` USING utf8)
          LIKE '%$_POST[search]%' OR CONVERT(`password` USING utf8) LIKE '%$_POST[search]%' OR CONVERT(`phone` USING utf8)
          LIKE '%$_POST[search]%' OR CONVERT(`email` USING utf8) LIKE '%$_POST[search]%')
          ORDER BY `lastName` ASC");
          //search database for like terms in the serach bar

          if (mysqli_num_rows($q)==0) {
            echo "<h2 style='text-align:center'>The Student You're Searching for Doesn't Exist</h2>";
            echo "<h2 style='text-align:center'>...</h2>";
            echo "<br>";"<br>";"<br>";"<br>";"<br>";"<br>";
            echo  "<div class = obiwan>";
              echo '<img src="images/incompleteArchives.jpg" alt="Obiwan" />';
            echo "</div>";
          }
          else {
            echo "<table class='styled-table'>";
              echo "<thead>";
                echo "<tr>";
              //table header
                  echo "<th>";  echo "ID"; echo "</th>";
                  echo "<th>";  echo "First Name"; echo "</th>";
                  echo "<th>";  echo "Last Name"; echo "</th>";
                  echo "<th>";  echo "Username"; echo "</th>";
                  echo "<th>";  echo "Password"; echo "</th>";
                  echo "<th>";  echo "phone"; echo "</th>";
                  echo "<th>";  echo "Email"; echo "</th>";
                echo "</tr>";
              echo "</thead>";

              echo "<tbody>";

                while ($row=mysqli_fetch_assoc($q)) {
                  echo "<tr class='active-row'>";
                    echo "<td>"; echo $row['s_id']; echo "</td>";
                    echo "<td>"; echo $row['firstName']; echo "</td>";
                    echo "<td>"; echo $row['lastName']; echo "</td>";
                    echo "<td>"; echo $row['username']; echo "</td>";
                    echo "<td>"; echo $row['password']; echo "</td>";
                    echo "<td>"; echo $row['phone']; echo "</td>";
                    echo "<td>"; echo $row['email']; echo "</td>";
                  echo "</tr>";
                }
                echo "</tbody>";
              echo "</table>";
          }
        }
      else { /*if button is not pressed.*/

        $res=mysqli_query($db, "SELECT * FROM `student`;");

        echo "<table class='styled-table'>";
          echo "<thead>";
            echo "<tr>";
          //table header
              echo "<th>";  echo "ID"; echo "</th>";
              echo "<th>";  echo "First Name"; echo "</th>";
              echo "<th>";  echo "Last Name"; echo "</th>";
              echo "<th>";  echo "Username"; echo "</th>";
              echo "<th>";  echo "Password"; echo "</th>";
              echo "<th>";  echo "Phone"; echo "</th>";
              echo "<th>";  echo "Email"; echo "</th>";
            echo "</tr>";
          echo "</thead>";

          echo "<tbody>";

            while ($row=mysqli_fetch_assoc($res)) {
              echo "<tr class='active-row'>";
                echo "<td>"; echo $row['s_id']; echo "</td>";
                echo "<td>"; echo $row['firstName']; echo "</td>";
                echo "<td>"; echo $row['lastName']; echo "</td>";
                echo "<td>"; echo $row['username']; echo "</td>";
                echo "<td>"; echo $row['password']; echo "</td>";
                echo "<td>"; echo $row['phone']; echo "</td>";
                echo "<td>"; echo $row['email']; echo "</td>";
              echo "</tr>";
            }
            echo "</tbody>";
          echo "</table>";
      }

  ?>
  </section>
  </body>
</html>
