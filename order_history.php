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
        
        <h2>Orders</h2>
        
        <?php 

            foreach ($orders_result as $orderInfo) {
                $orderID = $orderInfo['id']; 
                $getProducts = "SELECT * FROM product_orders WHERE order_id = $orderID ";
                $productResult = $db->query($getProducts) ;
                ?>

                <div style="border : 1px black solid; padding : 20px; margin-bottom:20px">
                <p>Order ID:<?php echo $orderInfo['id'] ?></p>
                <div style="display:inline-block; vertical-align:top">
                <table>
                <tr>
                <th>Product Name</th>
                <th>Product Details</th>
                </tr>
                    <?php 
                foreach ($productResult as $value) {
                    $productID = $value['product_id'];
                    $getProductInfo = "SELECT * FROM products WHERE id = $productID ";
                    $productInfo = $db->query($getProductInfo);
                    $row = $productInfo -> fetch_assoc();
                    ?>
                    
                   <tr>
                    <td rowspan="2">
                        <figure>
                        <img src='images/productid<?php echo $value['product_id']; ?>.jpg' alt='cart-image' width='100px' height='100px'>
                        <figcaption><?php echo $row['product_name']; ?>
                        </figcaption>
                        </figure>
                    </td>
                    <td>Price:$ <?php echo $row['price']*$value['quantity']; ?> </td>
                    </tr>
                    <tr>
                    <td>Quantity:<?php echo $value['quantity']; ?></td>
                    </tr>

                <?php
                }

                ?>
                <tr>
                    <td>Total Price:</td>
                    <td>$ <?php echo $orderInfo['total_amount']; ?></td>
                </tr>
            </table>
            </div>
            <div style="display:inline-block ; vertical-align:top; padding-left : 20px" >
                Order Status: <?php echo $orderInfo['order_status']; ?>
            </div>  
            </div>

            
                <?php



            }


        ?>
        



        
        


    </div>
    
</body>
</html>