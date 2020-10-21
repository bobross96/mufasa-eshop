<?php

    include 'sessionPolice.php';
    include 'dbconnect.php';

    $user_idINT = (int)$_SESSION['user_id'];

    // query all the orders depending on user id 
    $query = "SELECT * FROM cart_product c,products p WHERE c.user_id = $user_idINT AND c.product_id = p.id"; 
    
    $result = $db->query($query);

    $totalPrice = 0;
    foreach ($result as $value) {
        $totalPrice += $value['quantity']*$value['price'];
    }

    


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Out</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="css/order.css">
</head>
<body>
    <div class="container">
    <?php 

    include 'header.php';
    include 'categoryBar.php';
    
    ?>
    <div class="rightColumn">
        <h1>Check Out</h1>
        <table>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>
        <?php
        
        foreach ($result as $value) {
            echo "<tr>";
            echo "<td>";
            echo "<figure>";
            echo "<img src='images/productid".$value['product_id'].".jpg' alt='cart-image' width='100px' height='100px'>";
            echo "<figcaption>".$value['product_name']."</figcaption>";
            echo "</td>";
            echo "<td>".$value['quantity']."</td>";
            echo "<td>$".$value['price']*$value['quantity']."</td>";
            echo "</tr>";
        }

        echo "<tr><td colspan='2'>Total Price:</td>";
        echo "<td>$".$totalPrice."</td>";
        echo "</tr>";
        
        ?>

        </table>
        <div style="text-align:center">
        <form action="order_history.php" method="POST">
        <input type="submit" value="Submit" name="order">
        </form>
        </div>
    </div>
    </div>
</body>
</html>