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
        <h3><b>Your cart</b></h3>
    <?php
    //error_reporting(E_ALL); ini_set('display_errors', 1);
    session_start();

    //connect to database
    include("Includes/db_connect.php");

    // query the database for current cart products
    echo "<div id='getcart'>";
    $username = $_SESSION['email'];
    $query = "SELECT *
              FROM product p INNER JOIN user_cart uc
              ON (p.product_id = uc.product_id)
              INNER JOIN user u
              ON (uc.user_id = u.user_id)
              WHERE user_email = '$username';";
    
    $products = mysqli_query($dbc, $query);

    // display empty message if database query doesn't return a row.
    if (mysqli_num_rows($products) == 0) echo "<h3>Your cart is empty.</h3>";

    // show the results as a table on screen otherwise
    else {
        echo "<div id='content'>
                <table class='table table-bordered'>
                <thead class='thead-light'>
                  <tr>
                    <th scope='col'>Product</th>
                    <th scope='col'>Description</th>
                    <th scope='col'>Image</th>
                    <th scope='col'>Price</th>
                    <th scope='col'>Quantity</th>
                    <th scope='col'></th>
                  </tr>
                </thead>
                <tbody>
                  <form method='post' onsubmit='return validateForm()' action='update_cart.php'>";
      $totalPrice = 0;
      while ($product = mysqli_fetch_array($products, MYSQLI_ASSOC)) {
          echo "<tr>
                  <th scope='col'>" . $product['product_name'] . "</th>
                  <td>" . $product['description'] . "</td>
                  <td><img class='thumbnail' src='" . $product['image'] . "'></td>
                  <td>$" . $product['price'] . "</td>
                  <td>
                    <div class='inline'>";

          //If quantity is 1, disable decrement button
          if ($product['quantity'] == 1) {
              echo "<button type='submit' id='decrement' name='decrement' value='" . $product['product_id']. "' disabled>-</button>";

          } else {
              echo "<button type='submit' id='decrement' name='decrement' value='" . $product['product_id']. "'>-</button>";
          }

          echo "<span id='quantity'>" . $product['quantity'] . "</span>
                <button type='submit' id='increment' name='increment' value='" . $product['product_id']. "'>+</button>
                </div>
              </td>";
          
          //Remove button
          echo "<td>
                  <button type='submit' name='checked[]' value='" . $product['product_id']. "'>Remove</button>
                </td>";
          echo "</tr>";
      
          //calculate total price
          $totalPrice += ($product['price'] * $product['quantity']);

      }
      echo "<td><h4 id='total'>Total:</h4></td><td></td><td></td><td><h4 id='total'>$$totalPrice</h4></td><td></td><td></td>";
      echo "</form></tbody></table>";
      

      //Stripe stuff
      require_once('./config.php');
      echo "<form action='charge.php' method='POST'>
              <script src='https://checkout.stripe.com/checkout.js' class='stripe-button'
                data-key=pk_test_IB0iwD3zotJwTmM3Eu1XOHTQ00uXrAXzzj
                data-description='Payment Information'
                data-amount='" . $totalPrice * 100 . "'
                data-locale='auto'></script>
            </form>";
      echo "</div>";
    }
    ?>
      </div>
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