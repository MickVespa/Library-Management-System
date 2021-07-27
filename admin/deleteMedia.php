<?php
  include "navbar.php";
  include "connection.php";
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>Add Media</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
  </head>
  <body>
    <section>
    <div class="Registration">
      <h1 class="title">Delete Media</h1> <br>
      <h2>Enter the Media ID you want to remove.</h2>
      <form class="addMedia" action="" method="post"> <!-- method post will put data inputed into datbase-->
        <input type="text" name="media_id" placeholder="Media ID" required=""> <br><br>
        <input class="button" type="submit" name="delete" value="Delete">
      </form>
    </div>
    <?php
    if (isset($_POST['delete'])) {          //if button has been pressed
      $q=mysqli_query($db,"SELECT * FROM `media` WHERE
        (CONVERT(`m_id` USING utf8) LIKE '$_POST[media_id]')
        ORDER BY `title` ASC");

        if (mysqli_num_rows($q)==0) {
          echo "<script language='javascript' type='text/javascript'>";
            echo "alert('Incorrect Media ID');";
          echo "</script>";
        }
        else {
          mysqli_query($db,"DELETE FROM `media` WHERE `m_id` = '$_POST[media_id]'");
          echo "<script language='javascript' type='text/javascript'>";
            echo "alert('Media Deleted Successfuly');";
            echo "window.location='inventory.php'";
          echo "</script>";
      }
    }

    ?>
