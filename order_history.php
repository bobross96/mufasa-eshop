<?php 
include 'sessionPolice.php';
include 'dbconnect.php';

    $user_idINT = (int)$_SESSION['user_id'];
    $orders_query = "SELECT * FROM mufasa_orders WHERE user_id = $user_idINT ORDER BY id DESC";
    $orders_result = $db->query($orders_query);


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order History</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="css/order-history.css"> 
</head>
<body>
    
    <?php include 'header.php'?>
    <div class="container">
    <div id="left-column">
        <nav>
        <ul><a href="profile.php">Profile</a></ul>
        <ul><a href="order_history.php">Order history</a></ul>
        </nav>
    </div>
    <div class="listrightColumn">
        
        <h2 style="max-width:80%; text-align:center;">Order History</h2>
        
        <?php 

            foreach ($orders_result as $orderInfo) {
                $orderID = $orderInfo['id']; 
                $getProducts = "SELECT * FROM product_orders WHERE order_id = $orderID ";
                $productResult = $db->query($getProducts) ;
                ?>

                <div style="border-top: 2px dimgray solid; padding : 20px; margin-bottom:20px; margin-right:20%; text-align:center;">
                <p>Order ID:<?php echo $orderInfo['id'] ?></p>
				<div style="display:inline-block ; vertical-align:top;">
                Order Status: <?php echo $orderInfo['order_status']; ?>
				</div><br><br>
                <div style="display:inline-block; vertical-align:top">
                <table>
                <tr>
                    <th><br>Product<br><br></th>
                    <th>Quantity</th>
                    <th>Item Subtotal</th>
                    </tr>
                    <?php 
                foreach ($productResult as $value) {
                    $productID = $value['product_id'];
                    $getProductInfo = "SELECT * FROM products WHERE id = $productID ";
                    $productInfo = $db->query($getProductInfo);
                    $row = $productInfo -> fetch_assoc();
                    ?>
                    
                   <tr>
                    <td>
                        <figure>
                        <img src='images/productid<?php echo $value['product_id']; ?>.jpg' alt='cart-image' width='70px' height='70px'>
                        <figcaption><?php echo $row['product_name']; ?>
                        </figcaption>
                        </figure>
                    </td>
                    <td><?php echo $value['quantity']; ?></td>
					<td>$<?php echo $row['price']*$value['quantity']; ?> </td>
                    </tr>

                <?php
                }

                ?>
                <tr>
                    <td><br><b>Total Payment</b><br><br></td>
					<td></td>
                    <td><b>$<?php echo $orderInfo['total_amount']; ?></b></td>
                </tr>
				</table><br>
				</div>
             
            </div>

            
                <?php



            }


        ?>
		
		

    </div>
    
</body>
</html>