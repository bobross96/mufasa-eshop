<?php

    include '../dbconnect.php';
    include 'sessionPolice.php';
   

    if (isset($_POST['changeOrder'])){
        $order_idINT = (int)$_POST['idChanged'];
        $orderStatus = $_POST['changeOrder'];

        $updateOrder = "UPDATE mufasa_orders SET order_status = '$orderStatus' WHERE id = $order_idINT";
        $db -> query($updateOrder);

    }

    $orders_query = "SELECT * FROM mufasa_orders ORDER BY id DESC";
    $orders_result = $db->query($orders_query);




?>

<script>
        document.addEventListener("DOMContentLoaded", function(event) { 
            var scrollpos = sessionStorage.getItem('scrollpos');
            if (scrollpos) window.scrollTo(0, scrollpos);
        });

        window.onbeforeunload = function(e) {
            sessionStorage.setItem('scrollpos', window.scrollY);
        };
</script>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <div class='container'>
    <div>
        <nav>
        <ul><a href="admin-stock.php">Manage Stock</a></ul>
        <ul><a href="admin-orders.php">Manage Orders</a></ul>
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

                <div class="order-container">
                <p>Order ID:<?php echo $orderInfo['id'] ?></p><br>
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
                        <img src='../images/productid<?php echo $value['product_id']; ?>.jpg' alt='cart-image' width='100px' height='100px'>
                        <figcaption><?php echo $row['product_name']; ?>
                        </figcaption>
                        </figure>
                    </td>
                    <td>Price:$ <?php echo $value['current_price']*$value['quantity']; ?> </td>
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
            <form id="submitForm<?php echo $orderInfo['id'];?>" action="<?php echo $_SERVER['SELF']?>" method="POST">
            <label for="changeOrder">Order Status:</label>
            <select name="changeOrder" id="<?php echo $orderInfo['id'];?>" onchange="formChange(this.id)">
            <option value="">---</option>
                <option  value="Created" <?php if ($orderInfo['order_status'] == 'Created') {echo 'selected';} ?>>Created</option>
                <option  value="In Transit" <?php if ($orderInfo['order_status']  == 'In Transit') {echo 'selected';} ?>>In Transit</option>
                <option  value="Delivering" <?php if ($orderInfo['order_status']  == 'Delivering') {echo 'selected';} ?>>Delivering</option>
                <option  value="Delivered" <?php if ($orderInfo['order_status']  == 'Delivered') {echo 'selected';} ?>>Delivered</option>
            </select>
            <input type="hidden" name="idChanged" id="id<?php echo $orderInfo['id']; ?>">
            </form>
                
                
            </div>  
            </div>

            
                <?php



            }


        ?>
          
    </div>
</div>
    <script src="javascript/admin-orders.js"></script>
    
</body>
</html>