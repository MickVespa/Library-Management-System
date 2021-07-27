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
      <h1 class="title">Library Management System</h1> <br>
      <h2>Add Media</h2>
      <img style="float:left;" src="images/books.png" alt="book picture">
      <img style="float:right;" src="images/books.png" alt="book picture">
      <form class="addMedia" action="" method="post"> <!-- method post will put data inputed into datbase-->
        <input type="text" name="m_id" placeholder="Media ID" required=""> <br><br>
        <input type="text" name="title" placeholder="Title" required=""> <br><br>
        <input type="text" name="authors" placeholder="Authors" required=""> <br><br>
        <input type="text" name="isbn" placeholder="ISBN" required=""> <br><br>
        <input type="text" name="quantity" placeholder="Quantity" required=""> <br><br>
        <input type="text" name="subject" placeholder="Subject" required=""> <br><br>
        <input type="text" name="type" placeholder="Type" required=""> <br><br>
        <input type="text" name="status" placeholder="Status" required=""> <br><br>
        <input class="button" type="submit" name="add" value="Add">
      </form>
    </div>
    </section>
      <?php
        if(isset($_POST['add'])) { //checks to see if button is pressed
          $taken = false;
          $sql = "SELECT m_id FROM `media`"; //returns book IDs already signed up
          $result = mysqli_query($db,$sql);

        while($row = mysqli_fetch_assoc($result)) { //cycles through book IDs already in database
          if($row['m_id'] == $_POST['m_id']){
            $taken = true; //when duplicate book ID is found
          }
        }
        //generated code from phpmyadmin
        if(!$taken){
            mysqli_query($db,"INSERT INTO `media` VALUES('$_POST[m_id]', '$_POST[title]',
            '$_POST[authors]', '$_POST[isbn]', '$_POST[quantity]', '$_POST[subject]',
            '$_POST[type]', '$_POST[status]');");

      ?>
      <script type="text/javascript">
        alert("Media Added Successfully");
      </script>
    <?php
      }
      else {
      ?>
        <script type="text/javascript">
          alert("Book ID already exists");
        </script>
      <?php
      }
    }
      ?>
    </body>
  </html>
