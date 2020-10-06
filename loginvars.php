<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="Includes/styles.css">
    <title>Add Product</title>
  </head>

    <body>
    <?php
    //connect to database
    include("Includes/db_connect.php");

    // Inserting into product table
    $email = strip_tags($_POST['email']);
    $passwd = strip_tags($_POST['passwd']);
    
    //create query
    $query = "SELECT * FROM user WHERE user_email='$email' and user_password='$passwd';";

    //run query
    $result = mysqli_query($dbc, $query);

    // Display sql db error
    if (!$result) echo "Failed to obtain user credentials.";


    if (mysqli_num_rows($result) == 1) {
        while ($row = mysqli_fetch_array($result)) {
            if ($row['privacy_policy'] == 'false' && $row['user_type'] == 'standard') {
                session_start();

                $_SESSION["email"] = $row['user_email'];
                $_SESSION["fname"] = $row['fname'];

                echo "<meta http-equiv='refresh' content='0;URL=privacy_policy.php'/>";

            } else {
                $currDate = date("Y-m-d");
                $email = $row['user_email'];
                $query = "UPDATE user SET login_date = '$currDate' WHERE user_email = '$email';";
                $result = mysqli_query($dbc, $query);

                if (!$result) echo "Failed to update login_date.";
                session_start();

                $_SESSION["email"] = $email;
                $_SESSION["fname"] = $row['fname'];
                $_SESSION["type"] = $row['user_type'];

                echo "<meta http-equiv='refresh' content='0;URL=view_products.php'/>";
            }
        }
        
    } else {
        echo "<meta http-equiv='refresh' content='0;URL=login.php'/>";
        echo "<script type='text/javascript'>alert('User credentials invalid.');</script>";
    }
    

    ?>
    </body>

</html>