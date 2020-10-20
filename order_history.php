<?php 
include 'sessionPolice.php';
include 'dbconnect.php';

$user_idINT = (int)$_SESSION['user_id'];

// query all the orders depending on user id 
$query = "SELECT * FROM cart_product c,products p WHERE c.user_id = $user_idINT AND c.product_id = p.id"; 

$result = $db->query($query);

$totalPrice = 0;
foreach ($result as $value) {
    $cart_id = $value['id'];
    $totalPrice += $value['quantity']*$value['price'];
}

$orders_query = "SELECT * FROM mufasa_orders";
$orders_result = $db->query($orders_query);

if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['order'] == 'Submit'){
    //add cart items to order
    //update first? if not create
    $insert_order = "INSERT INTO mufasa_orders VALUES (NULL,$user_idINT,CURRENT_TIMESTAMP,$totalPrice) ";
    
    $db->query($insert_order);
    // add invididual products into the product_orders table
    $order_id = $db->insert_id;
    foreach ($result as $value) {
        $product_idINT = (int)$value['product_id'];
        $quantityINT =(int)$value['quantity'];
        $insert_product_order = "INSERT INTO product_orders VALUES (NULL,$order_id,$product_idINT,$quantityINT)";
        $db->query($insert_product_order);
    }

    $cart_idINT = (int)$cart_id;
    //delete items from cart
    $delete = "DELETE FROM cart_product WHERE user_id=$user_idINT";
    $db->query($delete);

    echo "<script>alert('successfully ordered')</script>";

    $orders_query = "SELECT * FROM mufasa_orders";
    $orders_result = $db->query($orders_query);



}



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="css/order.css">
</head>
<body>
    <?php include 'header.php'?>
    <?php include 'categoryBar.php'?>
    <div class="rightColumn">
        <table>
        <tr>
            <td>ID</td>
            <td>Order Date</td>
            <td>Total Amount</td>
        </tr>
        <?php 

            foreach ($orders_result as $value) {
                echo "<tr>";
                echo "<td>".$value['id']."</td>";
                echo "<td>".$value['order_date']."</td>";
                echo "<td>".$value['total_amount']."</td>";
                echo "</tr>";



            }


        ?>



        </table>


    </div>
</body>
</html>