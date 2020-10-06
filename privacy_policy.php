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

    <body>
        <div id="content">
            <h3>Privacy Policy</h3>
            <p>As of April 1st 2019 the government of Canada has passed the General Data Protection Regulation bill. The bill now requires full transparentcy of how data is collected
            and used on our website. Vlad's Quality Instruments will collect data such as Date of last login, Email, Full Name and address. This data will be stored in our datbase and used
            to identify the user. By accepting this message I hearby fully understand what data is being collected/used on Vlad's Quality Instruments.   </p>
            <?php
                session_start();
            
                //connect to database
                include("Includes/db_connect.php");
                
                echo "<form method='POST' action=''>
                        <input type='submit' name='answer' value='Decline'/>
                        <input type='submit' name='answer' value='Accept'/>
                      </form>";
                
                if (isset($_POST['answer'])) {
                    session_start();
                    $answer = $_POST['answer'];
                    
                    if ($answer == 'Accept') {
                        $currDate = date("Y-m-d");
                        $email = $_SESSION['email'];

                        $query = "UPDATE user SET privacy_policy = 'true' WHERE user_email = '$email';";
                    
                        //run query
                        $result = mysqli_query($dbc, $query);

                        $query = "UPDATE user SET date_accepted = \"$currDate\" WHERE user_email = '$email';";
                    
                        //run query
                        $result = mysqli_query($dbc, $query);
                        if (!$result) echo mysqli_error($dbc);

                        $_SESSION["type"] = "standard";

                    } else {
                        if (isset($_SESSION['type'])) {
                            $email = $_SESSION['email'];

                            //User has not accepted privacy policy
                            $query = "UPDATE user SET privacy_policy = 'false' WHERE user_email = '$email';";
                            $result = mysqli_query($dbc, $query);

                            if (!$result) echo mysqli_error($dbc);

                            //Can't track login date
                            $query = "UPDATE user SET login_date = NULL WHERE user_email = '$email';";
                            $result = mysqli_query($dbc, $query);

                            if (!$result) echo mysqli_error($dbc);

                            //Can't track date accepted
                            $query = "UPDATE user SET date_accepted = NULL WHERE user_email = '$email';";
                            $result = mysqli_query($dbc, $query);

                            if (!$result) echo mysqli_error($dbc);

                        }
                        // remove all session variables
                        session_unset();

                        // destroy the session 
                        session_destroy();

                        echo "<script type='text/javascript'>alert('Without accepting the privacy policy, you will not be able to log in to your account. You will be prompted to accept the privacy policy everytime you log in until you accept it.');</script>";
                    }

                    echo "<meta http-equiv='refresh' content='0;URL=view_products.php'/>";
                }
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