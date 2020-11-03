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
    <?php 

    include 'header.php';
    
    ?>
<form action="mail.php" method="POST">
<div class="container">    
            <div class="details-form" style="max-width:80%; text-align:center;">
                <h1>Check Out</h1>            
                <div class="form-element">
                    <div>
                        <span>Address:</span>
                        <span><input type="text"  id="address" name="address" value="<?php echo $row['address'] ?>" required onchange=validateAdd(this.value)>
                        </span>
                    </div><br>
                    <div>
                        <span>Postal Code:</span>
                        <span><input type="text"  id="postalCode" name="postalCode" value="<?php echo $row['postal_code'] ?>" required onchange=validatePostalCode(this.value)>
                        </span>
                    </div>
                </div><br>
            <div class="items-cart">
                <table>
                    <tr>
                        <th><br>Product<br><br></th>
                        <th>Quantity</th>
                        <th>Item Subtotal</th>
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

                    <tr><td style="font-size:18px;"><br><b>Total Payment</b><br><br></td>
					<td></td>
                    <td><b>$</b><?php echo "<b>{$totalPrice}</b>"; ?></td>
                    </tr>
                
                

                </table>
            </div>
                   
        <div style="text-align:center">
        
        <input type="submit" style="border: none; outline: 0; padding: 12px; color: white; background-color: #f57224; text-align: center; cursor: pointer; width: 180px; font-size: 18px;" id="confirmPayment" value="Confirm Payment" name="order"><br><br>
        
        </div>
    </div>
    </form>
    <script src="javascript/checkout.js"></script>
</body>
</html>