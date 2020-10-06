<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="Includes/styles.css">
    <title>Sign Out</title>
  </head>
  <?php include("Includes/header.php"); ?>
    <body>
        <?php
            // remove all session variables
            session_unset();

            // destroy the session 
            session_destroy();

            //include "view_products.php";
            echo "<meta http-equiv='refresh' content='0;URL=view_products.php'/>";
        ?>
    </body>
    <?php include("Includes/footer.html"); ?>
</html>