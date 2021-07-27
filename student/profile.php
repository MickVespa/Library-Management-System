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
        //queries data from student table based on logged in user
        $q=mysqli_query($db,"SELECT * FROM student where username=
          '$_SESSION[login_user]' ;");
          //queries data from mediaIssue table AND media table based on logged in user
          $q2=mysqli_query($db,"SELECT m_id, title, authors, isbn, subject, type,
            issueStatus, issueDate, returnDate FROM media, issuemedia WHERE
            issuemedia.username = '$_SESSION[login_user]' AND
            issuemedia.mID = media.m_id ORDER BY issuemedia.returnDate ASC;");

      ?>
      <h1 style="margin-top: 5%; ">My Profile</h1>
      <br>
      <h2>My Information</h2>

      <?php
        $row=mysqli_fetch_assoc($q);

          //About Table
          echo "<table class='styled-table' style='margin-bottom: 5%'>";
            echo "<thead>";
              echo "<tr style ='text-align: center;'>";
          //table header
              echo "<th colspan='2'>";  echo "<form class='' action='editProfile.php' method='post'>
                <input class='button' type='submit' name='submit1' value='Edit'>
                </form>"; echo "</th>";
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
              echo "<b> Student ID: </b>";
            echo "</td>";
            echo "<td>";
              echo $row['s_id'];
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


          //Issued Table
          echo "<table class='styled-table'>";
            echo "<thead>";
              echo "<tr>";
            //table header
                echo "<th>";  echo "Media ID"; echo "</th>";
                echo "<th>";  echo "Title"; echo "</th>";
                echo "<th>";  echo "Authors"; echo "</th>";
                echo "<th>";  echo "ISBN"; echo "</th>";
                echo "<th>";  echo "Subject"; echo "</th>";
                echo "<th>";  echo "Type"; echo "</th>";
                echo "<th style='background-color:#a0522d'>";  echo "Issue Status"; echo "</th>";
                echo "<th style='background-color:#a0522d'>";  echo "Issued Date"; echo "</th>";
                echo "<th style='background-color:#a0522d'>";  echo "Return by Date"; echo "</th>";
              echo "</tr>";
            echo "</thead>";

            echo "<tbody>";
              echo "<h2>My Checkout List</h2>";


              while ($row2=mysqli_fetch_assoc($q2)) {

                //Query to check and update tabel with Overdue notices
                $todayDate = date("Y-m-d");
                $overdue='<p style="color:red;">Overdue!</p>';
                if ($todayDate > $row2['returnDate'] AND $row2['returnDate'] != "0000-00-00" )
                {
                  mysqli_query($db, "UPDATE issuemedia SET issueStatus = '$overdue'
                  WHERE returnDate = '$row2[returnDate]' AND issueStatus!='Returned' OR issueStatus!='';");
                }

                echo "<tr class='active-row'>";
                  echo "<td>"; echo $row2['m_id']; echo "</td>";
                  echo "<td>"; echo $row2['title']; echo "</td>";
                  echo "<td>"; echo $row2['authors']; echo "</td>";
                  echo "<td>"; echo $row2['isbn']; echo "</td>";
                  echo "<td>"; echo $row2['subject']; echo "</td>";
                  echo "<td>"; echo $row2['type']; echo "</td>";
                  echo "<td>"; echo $row2['issueStatus']; echo "</td>";
                  echo "<td>"; echo $row2['issueDate']; echo "</td>";
                  echo "<td>"; echo $row2['returnDate']; echo "</td>";
                echo "</tr>";
              }
              echo "</tbody>";
            echo "</table>";
           ?>

    </div>
  </body>
</html>
