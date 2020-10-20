<?php

    include 'sessionPolice.php';
    include 'dbconnect.php';

    $user_idINT = (int)$_SESSION['user_id'];

   



    $query = "SELECT c.id,c.product_id,c.quantity,p.product_name,p.price FROM cart_product c,products p WHERE c.user_id = $user_idINT AND c.product_id = p.id"; 
    
    $result = $db->query($query);
    $totalPrice = 0;
    foreach ($result as $value) {
        $totalPrice += $value['quantity']*$value['price'];
    }

    #var_dump($result);

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if ($_POST['deleteButton'] != 0){
            $idINT = (int)$_POST['deleteButton'];
            $delete = "DELETE FROM cart_product WHERE id=$idINT";
            $db->query($delete);
        }
        foreach ($_POST as $key => $value) {

            //update the key from inside the cart table!
            // key is producid , value is quantity, userid int ?
            $idINT = (int)$key;
            $qty_INT = (int)$value;

            $update = "UPDATE cart_product SET quantity = $qty_INT WHERE id = $idINT ";
            $db->query($update);
            
            //query again to update according to the updates lmao..
            $query = "SELECT c.id,c.product_id,c.quantity,p.product_name,p.price FROM cart_product c,products p WHERE c.user_id = $user_idINT AND c.product_id = p.id"; 
            $result = $db->query($query);
            $totalPrice = 0;
            foreach ($result as $value) {
                $totalPrice += $value['quantity']*$value['price'];
            }

           
        }
    }


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="css/order.css">
    <script type="module" src="javascript/cart.js"></script>
</head>
<body>
    <div class="container">
    <?php 

    include 'header.php';
    include 'categoryBar.php';
    
    ?>
    <div class="rightColumn">
        <h1>Cart</h1>
        <form action="<?php echo $_SERVER['PHP_SELF']?>" method='POST'>
        <input type="submit" value="Update Cart" id="updateCart" name="updateCart">
        <br>
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
            echo "<td>";
            echo "<button style='vertical-align:top' type='button' class='minusButton' id='buttonMinus".$value['id']."'>-</button>&nbsp;";
            echo "<input type='number' id=".$value['id']." class='product-qty-input qtyInput'  name='".$value['id']."' value='".$value['quantity']."' min='0' >";
            echo "&nbsp;<button style='vertical-align:top' type='button' class='plusButton' id='buttonPlus".$value['id']."'>+</button>&nbsp;";
            echo "&nbsp;<button name='deleteButton' value='".$value['id']."' style='vertical-align:top ; color:red' type='submit'>X</button>";
            echo "<input type='hidden' id='input".$value['id']."' value=".$value['price']." >";
            echo "</td>";
            echo "<td id='price".$value['id']."' >$".$value['price']*$value['quantity'];        
            echo "</td>";
            echo "</tr>";
        }

        echo "<tr><td colspan='2'>Total Price:</td>";
        echo "<td id='totalPrice'>$".$totalPrice."</td>";
        echo "</tr>";
        
        ?>

        </table>
        </form>

        
        <div style="float:right">
        
        <a href="checkout.php"><button>Check Out</button></a>

        </div>
    </div>
    </div>
</body>
</html>


