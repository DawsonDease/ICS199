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
    
    <div class="categories" >
        <h3><b><u>Select Category</u></b></h3>
    <?php
    session_start();

    //connect to database
    include("Includes/db_connect.php");

    //determine if user is logged in
    $logged_in = false;
    if ($_SESSION["type"] == 'admin' || $_SESSION["type"] == 'standard') $logged_in = true;

    //create filter buttons
    $query = "SELECT category_name from category;";
    $rows = mysqli_query($dbc, $query);
    $i = 1;

    echo "<form id='filters' action='' method='GET'>";
    while ($row = mysqli_fetch_array ($rows, MYSQLI_BOTH)) {

        echo "<input type='submit' value='{$row[0]}' id='category_btn' name='selectedcategory'>";
        echo "<br>";
        $i += 1;
    }
    echo "<input type='submit' value='View All' id='category_btn' name='selectedcategory'>";
    echo '</form></div>';
    echo "<div class='products'>"; 

    if (isset($_GET['selectedcategory'])) {
        $selectedcategory = $_GET['selectedcategory'];
      
        if ($selectedcategory == 'View All') {
            $query = "SELECT * FROM product ORDER BY product_name;";
        } else {
            $query = "SELECT * FROM product p inner join product_category pc on 
                      (p.product_id = pc.product_id) inner join category c on (pc.category_id = c.category_id)
                      WHERE category_name = '$selectedcategory' ORDER BY product_name;";
        }

        //run query
        $rows = mysqli_query($dbc, $query);
      
        echo "<table class='table table-bordered'>
              <thead class='thead-light'>
              <tr>";
        if ($logged_in) echo "<th scope='col'></th>";

        echo "<h2><i>$selectedcategory</i></h2>";

        echo "<th scope='col'>Product</th><th scope='col'>Description</th><th scope='col'>Image</th><th scope='col'>Price</th></tr></thead>
              <tbody>";
        if ($logged_in) {
            if ($_SESSION["type"] == 'admin') {
                echo "<form method='post' onsubmit='return confirmation()' action='admin_remove.php'>
                      <input type='submit' id='submit' value='Remove Product' disabled/>";
            } else {
                echo "<form method='post' onsubmit='return checkCheckboxes()' action='add_cart.php'>
                      <input type='submit' id='submit' value='Add to cart' disabled/>";
            }

            echo "<input type='reset' id='reset' onclick='disable()' value='Clear Selection' disabled/>";
        }
        while($row = mysqli_fetch_array($rows, MYSQLI_ASSOC)) {
            //echo "<tbody>";
            echo "<tr>";
		        if ($logged_in) echo "<td> <input type='checkbox' onchange='return checkCheckboxes()' name='checked[]' value='" . $row['product_id'] . "'></td>";
            echo "<th scope='col'>".$row['product_name']."</th>";
            echo "<td>".$row['description']."</td>";
            echo "<td><img class='thumbnail' src='".$row['image']."'></td>";
            echo "<td>$".$row['price']."</td>";
            echo "</tr>";
            //echo "</tbody>";
        }
        echo "</form></tbody></table>";
        mysqli_close($dbc);
    }else {

    $featured = "SELECT DISTINCT product_id,product_name, description, image, price FROM product
                inner join product_category 
                using(product_id)
                inner join category 
                using(category_id)
                WHERE product_name = 'Acoustic guitar' 
                or product_name = 'Saxophone' 
                or product_name = 'Acoustic drumset' 
                or product_name = 'Cello'
                ORDER BY product_name;";
    
    echo "<h2><i>Featured Products</i></h2>";

    $rows = mysqli_query($dbc, $featured);
    echo "<table class='table table-bordered'>
    <thead class='thead-light'>
    <tr>";
    if ($logged_in) echo "<th scope='col'></th>";

        echo "<th scope='col'>Product</th><th scope='col'>Description</th><th scope='col'>Image</th><th scope='col'>Price</th></tr></thead>
        <tbody>";
        if ($logged_in) {
            if ($_SESSION["type"] == 'admin') {
                echo "<form method='post' onsubmit='return confirmation()' action='admin_remove.php'>
                <input type='submit' id='submit' value='Remove Product' disabled/>";
            } else {
                echo "<form method='post' onsubmit='return checkCheckboxes()' action='add_cart.php'>
                <input type='submit' id='submit' value='Add to cart' disabled/>";
            }

        echo "<input type='reset' id='reset' onclick='disable()' value='Clear Selection' disabled/>";
        }
        while($row = mysqli_fetch_array($rows, MYSQLI_ASSOC)) {
        
            echo "<tr>";
            if ($logged_in) echo "<td> <input type='checkbox' onchange='checkCheckboxes()' name='checked[]' value='" . $row['product_id'] . "'></td>";
                echo "<th scope='col'>".$row['product_name']."</th>";
                echo "<td>".$row['description']."</td>";
                echo "<td><img class='thumbnail' src='".$row['image']."'></td>";
                echo "<td>$".$row['price']."</td>";
                echo "</tr>";

                
        }
        echo "</form></tbody></table>";
    }
    echo '</div>';
    ?>
   
    
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
