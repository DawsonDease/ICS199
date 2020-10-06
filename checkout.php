<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="Includes/styles.css">
        <title>Log In</title>
    </head>

    <?php include("Includes/header.php"); ?>

    <body>
        <div id="content">
            <?php
                //error_reporting(E_ALL); ini_set('display_errors', 1);

                session_start();
            
                //connect to database
                include("Includes/db_connect.php");
            
                //determine if user is logged in
                $logged_in = false;
                if (isset($_SESSION['type'])) $logged_in = true;

                $email = $_SESSION['email'];

                $query = "SELECT p.product_id, u.user_id, quantity, price
                        FROM product p INNER JOIN user_cart uc
                        ON (p.product_id = uc.product_id)
                        INNER JOIN user u
                        ON (uc.user_id = u.user_id)
                        WHERE user_email = '$email';";

                $cart_array = mysqli_query($dbc, $query);

                if (!$cart_array) "Failed to obtain user cart. " . mysqli_error($dbc);

                $created = false;
                $order_id = -1; //Will be set later on
                $user_id = -1; //Will be set later on

                //Loop through products in the user's cart
                while ($product = mysqli_fetch_array($cart_array)) {
                    //Create order
                    if (!$created) { //if statement ensures only one order was created
                        $currDate = date("Y-m-d");
                        $user_id = $product['user_id'];

                        $query = "INSERT INTO order_history(order_date, user_id)
                                    VALUES (\"$currDate\", $user_id);";

                        $result = mysqli_query($dbc, $query);

                        if (!$result) "Failed to create order. " . mysqli_error($dbc);
                        else $created = true;

                        //Obtain created order's ID
                        $query = "SELECT order_id FROM order_history
                                    WHERE user_id = $user_id;";

                        $order_array = mysqli_query($dbc, $query);

                        if (!$order_array) "Failed to obtain order ID. " . mysqli_error($dbc);

                        while ($order = mysqli_fetch_array($order_array)) {
                            $order_id = $order['order_id'];
                        }
                    } //end of create order
                    
                    // Add purchased products to order history
                    $product_id = $product['product_id'];
                    $price = $product['price'];
                    $quantity = $product['quantity'];

                    $query = "INSERT INTO order_content(order_id, product_id, unit_price, quantity)
                                VALUES ($order_id, $product_id, $price, $quantity);";

                    $result = mysqli_query($dbc, $query);

                    if (!$result) "Failed to add product to order. " . mysqli_error($dbc);

                }

                // Delete customer's cart
                $query = "DELETE FROM user_cart WHERE user_id = $user_id;";
                
                $result = mysqli_query($dbc, $query);

                if (!$result) "Failed to delete cart. " . mysqli_error($dbc);

                $numItems = mysqli_num_rows($cart_array);

                echo "<h4>Checkout Successful!</h4>";
                echo "<p>The purchase of your $numItems product(s) was successful! Click <a href='view_products.php'>here</a> to continue shopping, or click <a href='order_history.php'>here</a> to view your order history.";

            ?>
      
        </div>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script src="Includes/JavaScript/xxxxxxxx.js"></script>
    </body>
  
    <?php include("Includes/footer.html"); ?>
  
</html>