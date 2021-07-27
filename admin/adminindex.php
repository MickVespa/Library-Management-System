<?php
  include "connection.php";
  include "navbar.php";
  //session_start(); Inlcuded in navbar.php
?>

<!DOCTYPE html>
<html>
<head>
  <title>Library Management System</title>
  <link rel="stylesheet" type="text/css" href="styles.css">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

</head>

<body>

  <section>
    <img class="libraryPicture"src="images/library.jpg" alt="library picture">
    <div class="welcomeText">
      <h1 class="title">Library Management System</h1> <br>
      <h3>CSC 445, Team 3</h3>
      <br>
      <?php
        if(isset($_SESSION['login_user'])) {  //only works if someone is logged in
          echo "Welcome ";
          echo $_SESSION['login_user'];
        }

       ?>
    </div>
  </section>

  <footer>
    <p class="copywrite">© 2021 Team 3.</p>
  </footer>

</body>

</html>
