<?php
  include "navbar.php";
  include "connection.php";
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>Media Checkout List / Requests</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
  </head>
  <body>
    <div class="request">
      <br><br>
    <h1 class="mediaHeader">Library Management System</h1>
    <br><br>
  <h2>Media Checkout Requests</h2>
  <form class="approve" action="" method="post">
    <input type='text' name='username1' placeholder='Username' required=''>
     &nbsp
    <input type='text' name='m_id1' placeholder='Media ID' required=''>
    &nbsp
    <input class='button' type='submit' name='approve5' value='Approve/Deny'>
  </form>

    <?php
    /* PENDING ISSUE QUERY WITH TABLE*/
    $sql= "SELECT student.username,media.m_id,title,authors,isbn,subject,type,status FROM
    student INNER JOIN issuemedia ON student.username = issuemedia.username INNER JOIN
    media ON issuemedia.mID = media.m_id WHERE issuemedia.issueStatus = 'Awaiting Approval'";

    $res = mysqli_query($db,$sql);

    if(mysqli_num_rows($res) == 0)
    {
        echo "<h3><em>No Pending Requests</em></h3>";
  }
  else {

    echo "<table class='styled-table'table style = 'margin-top: 1%';>";
      echo "<thead>";
        echo "<tr>";
      //table header
          echo "<th style='background-color:#6495ED'>";  echo "Username"; echo "</th>";
            echo "<th>";  echo "Media ID"; echo "</th>";
          echo "<th>";  echo "Title"; echo "</th>";
          echo "<th>";  echo "Authors"; echo "</th>";
          echo "<th>";  echo "ISBN"; echo "</th>";
          echo "<th>";  echo "Subject"; echo "</th>";
          echo "<th>";  echo "Type"; echo "</th>";
          echo "<th style='background-color:#a0522d'>";  echo "Status"; echo "</th>";
        echo "</tr>";
      echo "</thead>";

      echo "<tbody>";

        while ($row=mysqli_fetch_assoc($res)) {
          echo "<tr class='active-row'>";
            echo "<td>"; echo $row['username']; echo "</td>";
            echo "<td>"; echo $row['m_id']; echo "</td>";
            echo "<td>"; echo $row['title']; echo "</td>";
            echo "<td>"; echo $row['authors']; echo "</td>";
            echo "<td>"; echo $row['isbn']; echo "</td>";
            echo "<td>"; echo $row['subject']; echo "</td>";
            echo "<td>"; echo $row['type']; echo "</td>";
            echo "<td>"; echo $row['status']; echo "</td>";

          echo "</tr>";
        }
        echo "</tbody>";
      echo "</table>";
    }
    echo "<br>";echo "<br>";echo "<br>";
    //GO TO APPROVE BOOK REQUESTS PAGE
    ?>
    <?php
    if (isset($_POST['approve5']))
    {
      $res=mysqli_query($db,"SELECT * FROM `issuemedia` WHERE username='$_POST[username1]' && mID='$_POST[m_id1]';");
      $count=mysqli_num_rows($res);

      if($count==false) {

        ?>
              <script type="text/javascript">
                alert("No Username with that Media ID currently requested.");
                window.location="requests.php"
              </script>


        <?php
      }
      else {
        $_SESSION['studentUsername'] = $_POST['username1'];
        $_SESSION['mediaID'] = $_POST['m_id1'];
        ?>
        <script type = "text/javascript">
          window.location="approve.php"
       </script>
    <?php
      }
    }
    ?>
    <?php
    /* CURRENT MEDIA CHECKED OUT QUERY*/
    $sql2= "SELECT student.username,phone,email,media.m_id,title,authors,isbn,subject,type,
    issuemedia.issueDate,returnDate,issueStatus FROM student INNER JOIN issuemedia ON
    student.username = issuemedia.username INNER JOIN media ON issuemedia.mID =
    media.m_id WHERE issuemedia.issueStatus !='Awaiting Approval' ORDER BY issuemedia.returnDate ASC";

    $res2 = mysqli_query($db,$sql2);

    if(mysqli_num_rows($res2) == 0)
    {
        echo "<h3><em>No Media Check Out History</em></h3>";
  }
  else {

    echo "<table class='styled-table'>";
      echo "<thead>";
        echo "<tr>";
      //table header
          echo "<th style='background-color:#6495ED'>";  echo "Username"; echo "</th>";
          echo "<th style='background-color:#6495ED'>";  echo "Phone Number"; echo "</th>";
          echo "<th style='background-color:#6495ED'>";  echo "Email"; echo "</th>";
          echo "<th>";  echo "Media ID"; echo "</th>";
          echo "<th>";  echo "Title"; echo "</th>";
          echo "<th>";  echo "Authors"; echo "</th>";
          echo "<th>";  echo "ISBN"; echo "</th>";
          echo "<th>";  echo "Subject"; echo "</th>";
          echo "<th>";  echo "Type"; echo "</th>";
          echo "<th style='background-color:#a0522d'>";  echo "Issue Date"; echo "</th>";
          echo "<th style='background-color:#a0522d'>";  echo "Return by Date"; echo "</th>";
          echo "<th style='background-color:#a0522d'>";  echo "Issue Status"; echo "</th>";
        echo "</tr>";
      echo "</thead>";

      echo "<tbody>";
        echo "<h2>Media Checked Out History</h2>";

        ?>
        <form class="returnMedia" action="" method="post">
          <input type='text' name='username2' placeholder='Username' required=''>
           &nbsp
          <input type='text' name='m_id2' placeholder='Media ID' required=''>
          &nbsp
          <input class='button' type='submit' name='approve3' value='Return'>
        </form>
        <br><br>
        <?php
        if (isset($_POST['approve3']))
        {
          $res2=mysqli_query($db,"SELECT * FROM `issuemedia` WHERE username='$_POST[username2]' && mID='$_POST[m_id2]';");
          $count2=mysqli_num_rows($res2);

          if($count2==false) {
            ?>
                  <script type="text/javascript">
                    alert("No Username with that Media ID currently Checked Out.");
                    window.location="requests.php"
                  </script>
            <?php
          }
          else {
            mysqli_query($db,"UPDATE issuemedia SET issueStatus = 'Returned' where username = '$_POST[username2]'
            && mID='$_POST[m_id2]';");

            mysqli_query($db, "UPDATE media SET quantity = quantity+1 WHERE m_id = '$_POST[m_id2]';");

            mysqli_query($db, "UPDATE media SET status = 'Available' WHERE m_id = '$_POST[m_id2]';");
            ?>
                  <script type="text/javascript">
                    alert("Media Successfully Returned.");
                    window.location="requests.php"
                  </script>
            <?php
          }
        }
        ?>
        <?php


        while ($row2=mysqli_fetch_assoc($res2)) {
          //Query to check and update tabel with Overdue notices
          $todayDate = date("Y-m-d");
          $overdue='<p style="color:red;">Overdue!</p>';
          if ($todayDate > $row2['returnDate'] AND $row2['returnDate'] != "0000-00-00")
          {
            mysqli_query($db, "UPDATE issuemedia SET issueStatus = '$overdue' where returnDate = '$row2[returnDate]'
            AND issueStatus!='Returned';");
          }

          echo "<tr class='active-row'>";
            echo "<td>"; echo $row2['username']; echo "</td>";
            echo "<td>"; echo $row2['phone']; echo "</td>";
            echo "<td>"; echo $row2['email']; echo "</td>";
            echo "<td>"; echo $row2['m_id']; echo "</td>";
            echo "<td>"; echo $row2['title']; echo "</td>";
            echo "<td>"; echo $row2['authors']; echo "</td>";
            echo "<td>"; echo $row2['isbn']; echo "</td>";
            echo "<td>"; echo $row2['subject']; echo "</td>";
            echo "<td>"; echo $row2['type']; echo "</td>";
            echo "<td>"; echo $row2['issueDate']; echo "</td>";
            echo "<td>"; echo $row2['returnDate']; echo "</td>";
            echo "<td>"; echo $row2['issueStatus']; echo "</td>";
          echo "</tr>";
        }
        echo "</tbody>";
      echo "</table>";
    }
     ?>
     </div>
  </body>
</html>
