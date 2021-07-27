<?php
  include "navbar.php";
  include "connection.php";
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>Media Inventory</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
  </head>
  <body>
    <section>
      <br><br>
    <h1 class="mediaHeader">Media Inventory</h1>
    <br><br>
    <!--______________________________Search Bar_____________________________-->
    <div class="srch">
      <form class="searchBar" name="form1" method="post">
          <input class="form-control" type="text" name="search" placeholder="Search Media">
          <input class="button" type="submit" name="Search" value="search">
          <br><br>
      <?php
        if(isset($_SESSION['login_user'])) { //keeps hidden unless logged in
          echo"<a href='requests.php'>View Media Checked-out / Requests</a>";
        }
      ?>
          <img style="float:left; margin-left: 10%; "src="images/books.png" alt="book picture">
          <img style="float:right; margin-right: 10%; "src="images/books.png" alt="book picture">
      </form>
      <br><br>
    </div>
    <?php
      if(isset($_SESSION['login_user'])) { //keeps hidden unless logged in
        echo "<div class='mediaManage'>";
          echo "<form class='addMedia' action='addMedia.php' method='post'>";
            echo "<input class='button' type='submit' name='Add' value='Add Media'>";
          echo "</form>";
          echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
          echo"<form class='deleteMedia' action='deleteMedia.php' method='post'>";
            echo"<input class='button' type='submit' name='Delete' value='Delete Media'>";
          echo "</form>";
        echo"</div>";
      }
    ?>
    <br><br>
    <?php
      if (isset($_POST['Search'])) {          //if button has been pressed
        $q=mysqli_query($db,"SELECT * FROM `media` WHERE
          (CONVERT(`m_id` USING utf8) LIKE '%$_POST[search]%' OR CONVERT(`title` USING utf8) LIKE
          '%$_POST[search]%' OR CONVERT(`authors` USING utf8) LIKE '%$_POST[search]%' OR CONVERT(`isbn` USING utf8)
          LIKE '%$_POST[search]%' OR CONVERT(`quantity` USING utf8) LIKE '%$_POST[search]%' OR CONVERT(`subject` USING utf8)
          LIKE '%$_POST[search]%' OR CONVERT(`type` USING utf8) LIKE '%$_POST[search]%' OR CONVERT(`status` USING utf8) LIKE '%$_POST[search]%')
          ORDER BY `title` ASC");
          //search database for like terms in the serach bar

          if (mysqli_num_rows($q)==0) {
            echo "<h2 style='text-align:center'>The Media You're Searching for Doesn't Exist</h2>";
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
                  echo "<th>";  echo "Title"; echo "</th>";
                  echo "<th>";  echo "Authors"; echo "</th>";
                  echo "<th>";  echo "ISBN"; echo "</th>";
                  echo "<th>";  echo "Subject"; echo "</th>";
                  echo "<th>";  echo "Type"; echo "</th>";
                  echo "<th>";  echo "Quantity Available"; echo "</th>";
                  echo "<th>";  echo "Status"; echo "</th>";
                echo "</tr>";
              echo "</thead>";

              echo "<tbody>";

                while ($row=mysqli_fetch_assoc($q)) {
                  echo "<tr class='active-row'>";
                    echo "<td>"; echo $row['m_id']; echo "</td>";
                    echo "<td>"; echo $row['title']; echo "</td>";
                    echo "<td>"; echo $row['authors']; echo "</td>";
                    echo "<td>"; echo $row['isbn']; echo "</td>";
                    echo "<td>"; echo $row['subject']; echo "</td>";
                    echo "<td>"; echo $row['type']; echo "</td>";
                    echo "<td>"; echo $row['quantity']; echo "</td>";
                    echo "<td>"; echo $row['status']; echo "</td>";
                  echo "</tr>";
                }
                echo "</tbody>";
              echo "</table>";
          }
        }
      else { /*if button is not pressed.*/

        $res=mysqli_query($db, "SELECT * FROM `media` ORDER BY `media`.`title` ASC
    ;");    //Order by title in decending

        echo "<table class='styled-table'>";
          echo "<thead>";
            echo "<tr>";
          //table header
              echo "<th>";  echo "ID"; echo "</th>";
              echo "<th>";  echo "Title"; echo "</th>";
              echo "<th>";  echo "Authors"; echo "</th>";
              echo "<th>";  echo "ISBN"; echo "</th>";
              echo "<th>";  echo "Subject"; echo "</th>";
              echo "<th>";  echo "Type"; echo "</th>";
              echo "<th>";  echo "Quantity Available"; echo "</th>";
              echo "<th>";  echo "Status"; echo "</th>";
            echo "</tr>";
          echo "</thead>";

          echo "<tbody>";

            while ($row=mysqli_fetch_assoc($res)) {
              echo "<tr class='active-row'>";
                echo "<td>"; echo $row['m_id']; echo "</td>";
                echo "<td>"; echo $row['title']; echo "</td>";
                echo "<td>"; echo $row['authors']; echo "</td>";
                echo "<td>"; echo $row['isbn']; echo "</td>";
                echo "<td>"; echo $row['subject']; echo "</td>";
                echo "<td>"; echo $row['type']; echo "</td>";
                echo "<td>"; echo $row['quantity']; echo "</td>";
                echo "<td>"; echo $row['status']; echo "</td>";
              echo "</tr>";
            }
            echo "</tbody>";
          echo "</table>";
      }
  ?>
  </section>
  </body>
</html>
