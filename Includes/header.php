<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
        crossorigin="anonymous">
    <link rel="stylesheet" href="Includes/styles.css">
    <title>Add Product</title>
</head>
<header>
    <nav class="navbar navbar-light bg-light">
        <div id="title">
            <a class="navbar-brand" href="view_products.php">
                <img src="http://euromaidanpress.com/wp-content/uploads/2014/07/meet-the-pr-firm-that-helped-vladimir-putin-troll-the-entire-country.jpg" width="40" height="40" class="d-inline-block align-top" alt="">
                Vlad's Quality Instruments
            </a>
        </div>
        <div id="slogan">The home of all your Instrument needs!</div>
        <div id="navigation">

        <?php
        session_start();
            if ($_SESSION["type"] == 'admin' || $_SESSION["type"] == 'standard') {
                
                
                echo "<h3 id='greeting'>Welcome, " . $_SESSION['fname'] . "</h3>";
        
                if ($_SESSION['type']== "admin") {
                    echo "<button id='addproduct' onclick= window.location.href='admin_add_form.php'>Add Product</button>";
                    echo "<button id='signout' onclick= location.href='logout.php'>Log Out</button>";
                } else if ($_SESSION['type']=="standard") {
                    echo "<button id='cart' onclick= location.href='view_cart.php'>My Cart</button>";
                    echo "<div class='dropdown'>";
                    echo "<button class='dropbtn'>Account</button>";
                    echo "<div class='dropdown-content'>";
                    echo "<a href='order_history.php'>Order History</a>";
                    echo "<a href='privacy_policy.php'>Privacy Policy</a>";
                    echo "</div>";
                    echo "</div>";
                    echo "<button id='signout' onclick= location.href='logout.php'>Log Out</button>";
                }
            } else {
                echo "<button id='login' onclick= location.href='login.php'>Login</button>";
                echo "<button id='register' onclick=location.href='register.php'>Register</button>";

            }
        ?>

        </div>
    </nav>
</header>

