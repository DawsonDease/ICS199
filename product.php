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
        <div id="content">
        <?php
            error_reporting(E_ALL); ini_set('display_errors', 1);
            session_start();

            //connect to database
            include("Includes/db_connect.php");
            
            //determine if user is logged in
            $logged_in = false;
            if(isset($_SESSION['type'])) $logged_in = true;

            if (isset($_GET['product'])) {
                $product = $_GET['product'];
                $query = "SELECT * FROM product WHERE product_name = '$product';";

                //run query
                $products = mysqli_query($dbc, $query);

                while ($product = mysqli_fetch_array($products)) {
                    echo "<img class='pic' src='" . $product['image'] . "'>";
                    echo "<div id='info'>
                            <h2>" . $product['product_name'] . "</h2>
                            <p>" . $product['description'] . "</p>
                            <h4 id='right-justified'><b>Price: </b><span id='price'>$" . $product['price'] . "</span></h4>";
                    if ($logged_in) {
                        echo "<form method='POST' action=''>
                                <span id='checkbox'>Quantity </span>
                                <input type='number' name='quantity' value='1'>
                                <button type='submit' name='add' value='" . $product['product_id'] . "'>Add to Cart</button>
                            </form>";
                    }
                    echo "</div>";
                }
            

                //Insert product into cart if add cart button is pressed
                if (isset($_POST['add'])) {
                    $product_id = $_POST['add'];
                    $email = $_SESSION['email'];
                    $query = "SELECT user_id FROM user WHERE user_email = '$email';";
                
                    //run query
                    $user_array = mysqli_query($dbc, $query);

                    while ($user = mysqli_fetch_array($user_array)) {
                        $user_id = $user['user_id'];
                        $query = "INSERT INTO user_cart(user_id, product_id)
                                VALUES ($user_id, $product_id);";

                        //run query
                        $result = mysqli_query($dbc, $query);
                    }
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
    </body>
  
    <?php include("Includes/footer.html"); ?>
  
</html>