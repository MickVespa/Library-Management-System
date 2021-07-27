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
          <input class="form-control" type="text" name="search" placeholder="Search Media...">
          <input class="button" style="margin-left:1% "type="submit" name="Search" value="search">
          <?php
            if(isset($_SESSION['login_user'])) { //keeps hidden unless logged in
              echo"<br>"; echo"<br>"; echo"<br>";
              echo"<input class='form-control' type='text' name='search2' placeholder='Enter Media ID to Request'>";
              echo"<input class='button'style='margin-left:1%' type='submit' name='request' value='Request'>";
            }
          ?>
          <img style="float:left; margin-left: 20%; "src="images/books.png" alt="book picture">
          <img style="float:right; margin-right: 20%; "src="images/books.png" alt="book picture">
      </form>

    </div>
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
      if(isset($_POST['request']))
     {
        //looks to see where the entered Media ID is = to m_id in the inventory
        $q=mysqli_query($db,"SELECT * FROM `media` WHERE
        (CONVERT(`m_id` USING utf8) LIKE '$_POST[search2]')
        ORDER BY `title` ASC");

        //QUERY THAT RETURNS ALL INSTANCES WHERE THE LOGGED IN USER HAS REQUESTED THE MEDIA ID ALREADY
        $q2=mysqli_query($db,"SELECT * FROM issuemedia WHERE username = '$_SESSION[login_user]' AND
        mID = '$_POST[search2]' AND issueStatus='';");

        if (mysqli_num_rows($q)==0)
        {
        //if media ID entered doesnt match within media database m_id
          echo "<script language='javascript' type='text/javascript'>";
            echo "alert('Incorrect Media ID');";
            echo "window.location='inventory.php'";
          echo "</script>";
        }
        //if there is already a request for the media ID under the logged in user/student
        if (mysqli_num_rows($q2)!=0)
        {
          echo "<script language='javascript' type='text/javascript'>";
            echo "alert('Media ID already requested or Signed out to the user.');";
            echo "window.location='inventory.php'";
          echo "</script>";
        }
        else {
          //This query adds to the issueMedia table, where a student can request a form of media based on its book.
          //This information will be saved into issueMedia table, the Admin will need to approve on their end
          mysqli_query($db, "INSERT INTO `issueMedia` VALUES('$_SESSION[login_user]','$_POST[search2]','Awaiting Approval','','');");
          echo "<script language='javascript' type='text/javascript'>";
            echo "alert('Media Requested Successfuly');";
            echo "window.location='inventory.php'";
          echo "</script>";
      }
    }

  ?>
  </section>
  </body>
</html>
