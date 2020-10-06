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

  <?php include("Includes/header.php");
  if ($_SESSION["type"] == 'admin' || $_SESSION["type"] == 'standard') {
    echo "<script type='text/javascript'>alert('You are already logged in!');</script>";
    echo "<meta http-equiv='refresh' content='0;URL=view_products.php'/>";
  }
  ?>

  <body>
      <div id="content">
          <h2><b>Login</b></h2>
          <form action="loginvars.php" onsubmit="return validateForm()" method="post">
		      <h3>Email:</h3>
              <input type="text" name="email" id="email" placeholder="Someone@mail.com" required/></br>

		      <h3>Password:</h3>
              <input type="password" name="passwd" id="passwd" required/></br>
                <br>
              <input type="submit" id="submit" value='Login'/>

              <p>Don't have an account? <a href='register.php'>Create account</a></p>
            </form>
        </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="Includes/JavaScript/login.js"></script>
  </body>
  
    <?php include("Includes/footer.html"); ?>
  
</html>