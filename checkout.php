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
    <link rel="stylesheet" href="css/checkout.css">
</head>
<body>
<form action="mail.php" method="POST">
    <?php 

    include 'header.php';
    
    ?>
<div class="container">    

        <div class="details-form">
        <h1>Check Out</h1>            
            <h2>Deliver to:</h2>
            <div class="form-element">
            <label for="address">Address:</label>
            <input type="text" class="form-input" name="address" required><br>
            </div>
            <div class="form-element">
            <label for="unitNumber">Unit no:</label>
            <input type="text" class="form-input" name="unitNumber" required><br>
            </div>
            <div class="form-element">
            <label for="postalCode">Postal Code:</label>
            <input type="text" class="form-input" name="postalCode" required><br>
            </div>
        </div>
        <div class="items-cart">
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
        </div>
        <div style="text-align:center">
        


        
        </div>
        <div style="text-align:center">
        
        <input type="submit" value="Confirm Payment" name="order">
        
        </div>
    </div>
    </form>
    <script src="checkout.js"></script>
</body>
</html>