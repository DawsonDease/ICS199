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
  
  <?php include("Includes/header.php"); 
  if ($_SESSION["type"] == 'admin' || $_SESSION["type"] == 'standard') {
    echo "<script type='text/javascript'>alert('You are logged in! Please log out to register a new account');</script>";
    echo "<meta http-equiv='refresh' content='0;URL=view_products.php'/>";
  }
  ?>

  <body>
    <div id="content">
        <p class="policy"><b>Privacy Policy</b><br><br>As of April 1st 2019 the government of Canada has passed the General Data Protection Regulation bill. The bill now requires full transparency of how data is collected
        and used on our website. Vlad's Quality Instruments will collect data such as Date of last login, Email, Full Name and address. This data will be stored in our datbase and used
        to identify the user. By accepting this message I hearby fully understand what data is being collected/used on Vlad's Quality Instruments.</p>

          <h2><b>Register Account</b></h2>
          <form method="post" action="add_account.php" onsubmit="return validateForm()">
		        <h3>First Name: </h3>
              <input type="text" name="fname" id="fname" required/></br>

              <h3>Last Name: </h3>
              <input type="text" name="lname" id="lname" required/></br>

              <h3>Email: </h3>
              <input type="email" name="email" id="email" required/></br>

              <h3>Address: </h3>
              <input type="text" name="address" id="address" required/></br>
          
		        <h3>Password: </h3>
              <input type="password" name="password" id="password" required></br>

              <h3>Confirm Password: </h3>
              <input type="password" name="cPass" id="cPass" required/></br></br>

              <input type="checkbox" name="acceptPolicy" required> I have read and accept the Privacy Policy 
                </br>
		          </br>
		          <input type="submit" value="Create"/>
                  </br>
            </form>
        </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="Includes/JavaScript/register.js"></script>
  </body>

  <?php include("Includes/footer.html"); ?>

</html>