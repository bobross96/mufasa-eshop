<?php

    include 'sessionPolice.php';
    include 'dbconnect.php';

    $user_idINT = (int)$_SESSION['user_id'];

   


    $query = "SELECT * FROM cart_product c,products p WHERE c.user_id = $user_idINT AND c.product_id = p.id"; 
    
    $result = $db->query($query);
    $totalPrice = 0;
    foreach ($result as $value) {
        $totalPrice += $value['quantity']*$value['price'];
    }
    #var_dump($result);

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        foreach ($_POST as $key => $value) {

            //update the key from inside the cart table!
            // key is producid , value is quantity, userid int ?
            $product_idINT = (int)$key;
            $qty_INT = (int)$value;

            $update = "UPDATE cart_product SET quantity = $qty_INT WHERE product_id = $product_idINT AND user_id = $user_idINT ";
            $db->query($update);
            
            //query again to update according to the updates lmao..
            $query = "SELECT * FROM cart_product c,products p WHERE c.user_id = $user_idINT AND c.product_id = p.id"; 
            $result = $db->query($query);
            $totalPrice = 0;
            foreach ($result as $value) {
                $totalPrice += $value['quantity']*$value['price'];
            }
           
        }
    }


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="index.css">
    <script type="module" src="javascript/cart.js"></script>
</head>
<body>
    <div class="container">
    <?php 

    include 'header.php';
    include 'categoryBar.php';
    
    ?>
    <div class="rightColumn">
        <h1>Cart</h1>
        <form action="" method='POST'>
        <input type="submit" value="Update Cart" id="updateCart">
        <br>
        <?php
        
        foreach ($result as $value) {
            echo "<div class='product'>";
            echo "<a href='product.php?id=".$value['id']."'>";
            echo "<img class='product-image' src='images/productid".$value['id'].".jpg' alt=''>";
            echo "<span class='product-desc'>".$value['product_name']."</span><br>";
            echo "</a>";
            echo "<span class='product-price'>$".$value['price']*$value['quantity']."</span><br>";
            echo "<button style='vertical-align:top' type='button' class='minusButton' id='buttonMinus".$value['id']."'>-</button>&nbsp;";
            echo "<input type='number' id='".$value['id']."' class='product-qty-input'  name='".$value['id']."' value='".$value['quantity']."' min='0' >";
            echo "&nbsp;<button style='vertical-align:top' type='button' class='plusButton' id='buttonPlus".$value['id']."'>+</button>&nbsp;sets";
            echo "</div>";

        }

        ?>
        <br><br><br>
        </form>
        
        <div style="float:right">
        <span>Total Price: $<?php echo $totalPrice; ?></span>
        <a href="checkout.php"><button>Check Out</button></a>
        </div>
    </div>
    </div>
</body>
</html>


