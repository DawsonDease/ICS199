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
      <?php
          session_start();

          //connect to database
          include("Includes/db_connect.php");

          $increment = $_POST['increment'];
          $decrement = $_POST['decrement'];
          $checkboxes = $_POST['checked'];
          $curr_user = $_SESSION['email'];
          $query = "SELECT user_id
                    FROM user
                    WHERE user_email = '$curr_user';";

          $user_array = mysqli_query($dbc, $query);

          $success = true;

          if (!$user_array) {
              $success = false;
          }
    
          while ($user = mysqli_fetch_array($user_array)) {
              // Current user's user_id
              $user_id = $user['user_id'];

              // check if this page was called with the increment(+) button
              // $increment has the product_id value;
              if ($increment != null) {
                $queryadd = "UPDATE user_cart SET quantity = quantity+1 WHERE user_id = $user_id and product_id = $increment;";
                $resultadd = mysqli_query($dbc, $queryadd);
                echo "<meta http-equiv='refresh' content='0;URL=view_cart.php'/>";
              }
              // check if this page was called with the decrement(-) button
              // $decrement has the product_id value;
              if ($decrement != null) {
                $queryadd = "UPDATE user_cart SET quantity = quantity-1 WHERE user_id = $user_id and product_id = $decrement;";
                $resultadd = mysqli_query($dbc, $queryadd);
                echo "<meta http-equiv='refresh' content='0;URL=view_cart.php'/>";
              }

              // Loop through checked checkboxes
              foreach ($checkboxes as $product_id) {
                  $query = "DELETE FROM user_cart WHERE user_id = $user_id and product_id = $product_id;";
                  $result = mysqli_query($dbc, $query);

                  //Inform user of failure
                  if (!$result) {
                      $success = false;
                  }
              }
          }
    
          //Inform user of success/failure if remove button called page
          if ($increment == null && $decrement == null) {
            if (!$success) echo "<script type='text/javascript'>alert('Product failed to be removed from cart.');</script>";
            
            //refresh to the view_cart page
            echo "<meta http-equiv='refresh' content='0;URL=view_cart.php'/>";
          }
        ?>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="Includes/JavaScript/index.js"></script>
    <script src="Includes/JavaScript/add_cart.js"></script>
  </body>
  
  <?php include("Includes/footer.html"); ?>

</html>