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
 
  $first_name = strip_tags($_POST['fname']);
  $last_name = strip_tags($_POST['lname']);
  $address= strip_tags($_POST['address']);
  $email= strip_tags($_POST['email']);
  $password = strip_tags($_POST['password']);
  
  //connect to database
  include("Includes/db_connect.php");
  
  $query = "SELECT user_email from user where user_email ='$email';";
  $resultemail_array = mysqli_query($dbc, $query);

  while ($resultemail = mysqli_fetch_array($resultemail_array)) {
    $resultemail = $resultemail['user_email'];
  }
    if (mysqli_fetch_row($resultemail) == 1) {
        echo "<script type='text/javascript'>alert('This email is already registered! Please enter a different email');</script>";
        echo "<meta http-equiv='refresh' content='0;URL=register.php'/>";
    } else {
        $currDate = date("Y-m-d");
        $query = "INSERT INTO user(user_email, user_password, address, fname, lname, user_type, privacy_policy, login_date, date_accepted)
                values('$email','$password','$address','$first_name','$last_name','standard','true','$currDate','$currDate');";
    
        $result = mysqli_query($dbc, $query);
        if (!$result) {
          echo "<script type='text/javascript'>alert('This email is already registered! Please enter a different email');</script>";
          echo "<meta http-equiv='refresh' content='0;URL=register.php'/>";
        }
        else {
            session_start();

            //Set Session variables
            $_SESSION['type'] = "standard";
            $_SESSION['fname'] = $first_name;
            $_SESSION['email'] = $email;
          
        

            //redirect to main page
            echo "<meta http-equiv='refresh' content='0;URL=view_products.php'/>";
        }
    }
  
  
  

?>
</body>
<?php include("Includes/footer.html"); ?>
</html> 