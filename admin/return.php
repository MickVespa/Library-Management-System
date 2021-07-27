<?php
  include "navbar.php";
  include "connection.php";
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>Return Media</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
  </head>
  <body>
    <br>
    <div class="returnMedia">
      <h1>Return Media</h1>
      <br><br>
      <form class="returnIssue" method="post">
        <input type="text" name="approve" placeholder="Approve or Deny">
        <br><br> issue date
        <input type="date" name="issue">
        <br><br> return date
        <input type="date" name="return">
        <br><br>
        <!--
        Input type=button did not feel like working, so I switched to type
        'submit' 
      -->
        <input type="submit" type="submit" name="return2" value="Return">
      </form>

    </div>
    <?php
    //again another work around, because type=button didnt feel like working on this file
       if($_POST['submit']=="Return")
      {

        //UPDATE QUERY FOR ISSUE AND RETURN DATE, SESSION VARS FROM REQUESTS.PHP
        mysqli_query($db,"UPDATE issuemedia SET approve = '$_POST[approve]',
          issueDate = '$_POST[issue]', returnDate = '$_POST[return]' WHERE
          username = '$_SESSION[studentUsername2]' AND mID = '$_SESSION[mediaID2]';");

        //INCREASES QUANTITY AVAILABLE BY 1, FROM MEDIA TABLE
        mysqli_query($db, "UPDATE media SET quantity = quantity+1 WHERE m_id = '$_SESSION[mediaID]';");

        //RETURNS QUANTITY ON HAND FOR SELECTED MEDIA ID
        $res5=mysqli_query($db,"SELECT quantity from media where m_id = '$_SESSION[mediaID]';");

        while($row=mysqli_fetch_assoc($res5))
        {
          if($row['quantity'] > 0)
          {
            //changes status column in media table to reflect Available once copy is returned
            mysqli_query($db,"UPDATE media SET status ='Available' WHERE
              m_id ='$_SESSION[mediaID]';");
          }
        }
      ?>
        <script type="text/javascript">
          alert("Request Updated Successfully.");
          window.location = "requests.php"
        </script>
<?php
}
?>
  </body>
</html>
