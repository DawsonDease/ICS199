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
        <h3><b>Your orders</b></h3>
    <?php
    //error_reporting(E_ALL); ini_set('display_errors', 1);

    session_start();

    //connect to database
    include("Includes/db_connect.php");

    $email = $_SESSION['email'];

    //Obtain every order placed by the current user
    $query = "SELECT distinct oh.order_id, order_date, sum(unit_price * quantity) as total_price
            FROM order_content oc inner join order_history oh
                on (oc.order_id = oh.order_id)
                inner join user u
                on (oh.user_id = u.user_id)
            WHERE user_email='$email'
            GROUP BY order_id, order_date
            ORDER BY order_date desc;";

    $orders = mysqli_query($dbc, $query);

    if (!$orders) echo "Failed to obtain orders. " . mysqli_error($dbc);

    // display empty message if database query doesn't return a row.
    if (mysqli_num_rows($orders) == 0) echo "<h3>You have no previous orders.</h3>";
    else {
        while ($order = mysqli_fetch_array($orders)) {
            $currOrder = $order['order_id'];
            $orderDate = $order['order_date'];
            $totalPrice = $order['total_price'];

            // query the database for contents of current order
            echo "<div id='getcart'>";
            $query = "SELECT oc.order_id, p.product_id, product_name, description, image, unit_price, quantity
                    FROM product p inner join order_content oc
                    on (p.product_id = oc.product_id)
                    inner join order_history oh
                    on (oc.order_id = oh.order_id)
                    inner join user u
                    on (oh.user_id = u.user_id)
                    WHERE oc.order_id = '$currOrder';";
    
            $order_content = mysqli_query($dbc, $query);

            if (!$order_content) echo "Failed to obtain order content. " . mysqli_error($dbc);

            // show the results as a table
            else {
                echo "<div id='content'>
                        <h4><b>Date Ordered: </b><i>$orderDate</i></h4>
                        <table class='table table-bordered'>
                            <thead class='thead-light'>
                                <tr>
                                    <th scope='col'>Product</th>
                                    <th scope='col'>Description</th>
                                    <th scope='col'>Image</th>
                                    <th scope='col'>Price</th>
                                    <th scope='col'>Quantity</th>
                                </tr>
                            </thead>
                            <tbody>";
                //loop through all product in current order
                while ($product = mysqli_fetch_array($order_content)) {
                    echo "<tr>
                            <th scope='col'>" . $product['product_name'] . "</th>
                            <td>" . $product['description'] . "</td>
                            <td><img class='thumbnail' src='" . $product['image'] . "'></td>
                            <td>$" . $product['unit_price'] . "</td>
                            <td>" . $product['quantity'] . "</td>
                        </tr>";
                }

                echo "<td><h4 id='total'><b>Total:</b></h4></td><td></td><td></td><td><h4 id='total'><b>$$totalPrice</b></h4></td><td></td>";
                echo "</tbody></table></div>";
            }

            echo "</div>";
        }
    }
    ?>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="Includes/JavaScript/add_cart.js"></script>
  </body>
  
  <?php include("Includes/footer.html"); ?>

</html>