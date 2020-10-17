<?php

    include 'sessionPolice.php';
    include 'dbconnect.php';

    $user_idINT = (int)$_SESSION['user_id'];

    $query = "SELECT * FROM cart c,products p WHERE c.user_id = $user_idINT AND c.product_id = p.id"; 
    
    $result = $db->query($query);
    #var_dump($result);


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <div class="container">
    <?php 

    include 'header.php';
    include 'categoryBar.php';
    
    ?>
    <div class="rightColumn">
        <h1>Cart</h1>
        <?php
        
        foreach ($result as $value) {
            echo "<div class='product'>";
            echo "<a href='product.php?id=".$value['id']."'>";
            echo "<img class='product-image' src='images/productid".$value['id'].".jpg' alt=''>";
            echo "<span class='product-desc'>".$value['product_name']."</span><br>";
            echo "</a>";
            echo "<span class='product-price'>$".$value['price']*$value['quantity']."</span><br>";
            echo "<span class='product-price'>".$value['quantity']." sets</span>";
            echo "</div>";

        }

        ?>

    </div>
    </div>
</body>
</html>