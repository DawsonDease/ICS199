<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="Includes/styles.css">
    <title>Vlad's Quality Instruments</title>
  </head>
  
  <?php include("Includes/header.php"); ?>

  <body>
    <div id='content'>
    <?php
    session_start();

    //connect to database
    include("Includes/db_connect.php");

    $checkboxes = $_POST['checked'];
    $success = true;
    
    foreach ($checkboxes as $product_id) {
        //delete from product_category
        $query = "DELETE FROM product_category WHERE product_id = '$product_id';";
        $result = mysqli_query($dbc, $query);

        if (!$result) $success = false;

        //delete from product
        $query = "DELETE FROM product WHERE product_id = '$product_id';";
        $result = mysqli_query($dbc, $query);

        if (!$result) $success = false;
    }

    //inform user of failure/success
    $message = "Product(s) successfully removed!";
    if (!$success) $message = "One or more products failed to be removed.";

    echo "<meta http-equiv='refresh' content='0;URL=view_products.php'/>";
    echo "<script type='text/javascript'>alert('$message');</script>";
    ?>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="Includes/JavaScript/index.js"></script>
  </body>
  
  <?php include("Includes/footer.html"); ?>

</html>