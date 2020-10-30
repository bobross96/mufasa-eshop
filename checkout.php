<?php

    include 'sessionPolice.php';
    include 'dbconnect.php';

    $user_idINT = (int)$_SESSION['user_id'];
  

    // query all the orders from session cart

   

    $totalPrice = 0;
    

    $deliveryQuery = "SELECT * FROM users WHERE id = $user_idINT";
    $deliveryDetails = $db->query($deliveryQuery);
    $row = $deliveryDetails -> fetch_assoc();



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
        <div class="flex-box">
            <div class="details-form">
                <h1>Check Out</h1>            
                <h2>Deliver to:</h2>
                <div class="form-element">
                <label for="address">Address:</label>
                <input type="text" class="form-input" id="address" name="address" value="<?php echo $row['address'] ?>" required onchange=validateAdd(this.value)><br>
                </div>
                <div class="form-element">
                <label for="postalCode">Postal Code:</label>
                <input type="text" class="form-input" id="postalCode" name="postalCode" value="<?php echo $row['postal_code'] ?>" required onchange=validatePostalCode(this.value)><br>
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
                    $totalPrice  = 0;
                    foreach ($_SESSION['cart'] as $product_id => $quantity) { 
                        $productQuery = "SELECT * FROM products WHERE id = $product_id";
                        $output = $db -> query($productQuery);
                        $productInfo = $output -> fetch_assoc();
                        
                        ?>
                        <tr>
                        <td>
                        <figure>
                        <img src='images/productid<?php echo $product_id ?>.jpg' alt='cart-image' width='100px' height='100px'>
                        <figcaption><?php echo $productInfo['product_name'] ?></figcaption>
                        </td>
                        <td><?php echo $quantity ?></td>
                        <td>$<?php echo $productInfo['price']*$quantity ?></td>
                        </tr>
                    <?php
                    
                    $totalPrice += $productInfo['price']*$quantity;

                    }

                    ?>

                    <tr><td colspan='2'>Total Price:</td>
                    <td>$<?php echo $totalPrice ?></td>
                    </tr>
                
                

                </table>
            </div>
        </div>            
        <div style="text-align:center">
        
        <input type="submit" id="confirmPayment" value="Confirm Payment" name="order">
        
        </div>
    </div>
    </form>
    <script src="javascript/checkout.js"></script>
</body>
</html>