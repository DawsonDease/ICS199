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

    // Inserting into product_category
    $checkboxes = $_POST['checked'];
    $curr_user = $_SESSION['email'];
    $query = "SELECT user_id
                FROM user
                WHERE user_email = '$curr_user';";

    $user_array = mysqli_query($dbc, $query);
    $success = true;
    $fails = 0;

    if (!$user_array) {
        $success = false;
        echo "<h3>Failed to obtain user.</h3>";
    }
    
    while ($user = mysqli_fetch_array($user_array)) {
        // Current user's user_id
        $user_id = $user['user_id'];

        // Loop through checked checkboxes
        foreach ($checkboxes as $product_id) {
            $query = "SELECT * FROM user_cart WHERE user_id = $user_id and product_id = $product_id;";
            $result = mysqli_query($dbc, $query);

            //Inform user of failure
            if (!$result) {
                $success = false;
                echo "<h3>Failed to get user's cart.</h3>";
            }
            
            // If product is already in current user's cart
            if (mysqli_num_rows($result) == 1) {
                $query = "SELECT quantity FROM user_cart WHERE user_id = $user_id and product_id = $product_id;";
                $quantity_array = mysqli_query($dbc, $query);

                while ($quantity = mysqli_fetch_array($quantity_array)) {
                    //increment quantity of product in cart
                    $quantity = $quantity['quantity'] + 1;
                    $query = "UPDATE user_cart SET quantity = $quantity WHERE user_id = $user_id and product_id = $product_id;";
                    $result = mysqli_query($dbc, $query);

                    if (!$result) {
                        $success = false;
                        $fails += 1;
                    }
                }
            // Else just add product
            } else {
                $query = "INSERT INTO user_cart(user_id, product_id)
                          VALUES ($user_id, $product_id);";
                $result = mysqli_query($dbc, $query);

                if (!$result) {
                    $success = false;
                    $fails += 1;
                }
            }
        }
    }
    
    //Inform user of success/failure
    $message = "Product(s) successfully added to cart!";

    if (!$success) $message = "$fails product(s) failed to be added to cart.";

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