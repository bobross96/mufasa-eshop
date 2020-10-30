<?php

    include 'sessionPolice.php';
    include 'dbconnect.php';
    
    //var_dump($_SESSION['cart']);
    $user_idINT = (int)$_SESSION['user_id'];
    /* $query = "SELECT c.id,c.product_id,c.quantity,p.product_name,p.price FROM cart_product c,products p WHERE c.user_id = $user_idINT AND c.product_id = p.id"; 
    
    $result = $db->query($query);
    $totalPrice = 0;
    foreach ($result as $value) {
        $totalPrice += $value['quantity']*$value['price'];
    } */
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if ($_POST['deleteButton'] != 0){
            $deleteidINT = (int)$_POST['deleteButton'];
            unset($_SESSION['cart'][$deleteidINT]);
            
        }
         
        //this is to focus on the element that changed
        if (isset($_POST['focusInput'])){
            foreach ($_POST['focusInput'] as $value) {
                if ($value != 0){
                    $currentidINT = $value;
                break;
                }
            }
            
        }

       
        foreach ($_POST as $key => $value) {
                if (array_key_exists($key,$_SESSION['cart'])){
                    $_SESSION['cart'][$key] = (int)$value;
                    
                }
                
                
            }

        

        if (isset($currentidINT)){  
            echo "<script>location.href='#".$currentidINT."'";
            echo "</script>";
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
   
	<style>
	
	input[type=number]{
	text-align: center;
	} 
	
	input[type=number]::-webkit-inner-spin-button, 
	input[type=number]::-webkit-outer-spin-button 
	{  
	opacity: 0;
	}
	</style>
</head>
<body>
  
    <?php 

    include 'header.php';
   
    ?>
    <div class="rightColumn" style='min-width:85%;'>
        <h1 style="text-align:center">Cart</h1>
        <form action="<?php echo $_SERVER['PHP_SELF']?>" method='POST'>
        <input type="submit" style="display:none" value="Update Cart" id="updateCart" name="updateCart">
        <br>
        <?php
        
        if ($cartItemsQty == 0){

        ?>
        <h2 style='text-align:center'>No items in cart! Help Mufasa out</h2>
        
        <?php     
        }
        else {
        ?>

        <table><tr>
        <th>Product</th><th>Quantity</th><th>Price</th>
        </tr>
        <?php 
        
        foreach ($_SESSION['cart'] as $product_id => $quantity) {
        //query for product info here 
        $productQuery = "SELECT * FROM products WHERE id = $product_id";
        $output = $db -> query($productQuery);
        $productInfo = $output -> fetch_assoc();
        

        ?>    
        <tr>
            <td>
            <figure>
            <img src='images/productid<?php echo $product_id; ?>.jpg' alt='cart-image' width='100px' height='100px'>
            <figcaption><?php echo $productInfo['product_name']; ?></figcaption></figure>
            </td>
            <td>
            <button style='vertical-align:top' type="button" class='minusButton' name='minusButton' value='<?php echo $product_id; ?>' id='buttonMinus<?php echo $product_id?>' <?php if ($value['quantity'] == '1'){ echo "disabled";} ?>>-</button>&nbsp;
            <input type='number' id='<?php echo $product_id; ?>' class='product-qty-input qtyInput'  name='<?php echo $product_id; ?>' value='<?php echo $quantity; ?>' min='1' onchange="updatePrice(this.id)">
            &nbsp;<button style='vertical-align:top' class='plusButton' id='buttonPlus<?php echo $product_id ?>' name='plusButton' value='<?php echo $product_id; ?>'>+</button>&nbsp;
            &nbsp;<button name='deleteButton' value='<?php echo $product_id ?>' style='vertical-align:top ; color:red' type='submit'>X</button>
            <input type='hidden' id='input<?php echo $product_id; ?>' value="<?php echo $productInfo['price'] ?>">
            <input type='hidden' id='change<?php echo $product_id; ?>' name='focusInput[]'>
            <input type="hidden" id='stock<?php echo $product_id ?>' value='<?php echo $productInfo['stock']; ?>' >
            </td>
            <td id='price<?php echo $product_id;?>' >$<?php echo $productInfo['price']*$quantity;?>        
            </td>
            </tr>
        <?php
        }

        echo "<tr><td colspan='2'>Total Price:</td>";
        echo "<td id='totalPrice'>$".$totalPrice."</td>";
        echo "</tr>";
        }
        ?>

        </table>
        </form><br><br>

        <?php 
        if ($cartItemsQty > 0){
            echo "<div style='text-align:center'>";
            echo "<a href='checkout.php'><button>Check Out</button></a>";
        };

        
        

        ?>
       
        
        
        
        

        </div>
		
		
			
    </div>
    </div>
    <script src="javascript/cart.js"></script>
</body>
</html>


