<?php 
include 'sessionPolice.php';
include 'dbconnect.php';

    $user_idINT = (int)$_SESSION['user_id'];
    $orders_query = "SELECT * FROM mufasa_orders WHERE user_id = $user_idINT";
    $orders_result = $db->query($orders_query);


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order History</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="css/order.css">
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
    </div>
</body>
</html>