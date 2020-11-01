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

        
        
    }


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
    <title>Cart</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="css/order.css">
    <link rel="stylesheet" href="css/cart.css">
   
	<style>
	
	input[type=number]{
	text-align: center;
	} 
	
	/* Chrome, Safari, Edge, Opera */
	input::-webkit-outer-spin-button,
	input::-webkit-inner-spin-button {
	  -webkit-appearance: none;
	  margin: 0;
	}

	/* Firefox */
	input[type=number] {
	  -moz-appearance: textfield;
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
        <h2 style='text-align:center'>No items in cart! Help Mufasa out!</h2>
        
        <?php     
        }
        else {
        ?>

        <table>
        <?php 
        
        $totalPrice = 0;

        foreach ($_SESSION['cart'] as $product_id => $quantity) {
        //query for product info here 
        $productQuery = "SELECT * FROM products WHERE id = $product_id";
        $output = $db -> query($productQuery);
        $productInfo = $output -> fetch_assoc();
        


        ?>    
        <tr>
            <td style="max-width: 50px;">
			<button name='deleteButton' value='<?php echo $product_id ?>' style='border: none; outline: 0; color: dimgray; background-color:white; cursor: pointer; width: 30px; height:30px; font-size: 18px;' type='submit'>X</button>
			</td>
			<td>
            <a href="product.php?id=<?php echo $product_id; ?>">
            <figure>
            <img src='images/productid<?php echo $product_id; ?>.jpg' alt='cart-image' width='120px' height='120px' style="padding-bottom:10px;">
            <figcaption><?php echo $productInfo['product_name']; ?></figcaption></figure></a>
            </td>
            <td>

            <button type="button" class='minusButton' name='minusButton' value='<?php echo $product_id; ?>' id='buttonMinus<?php echo $product_id?>' <?php if ($quantity == 1){ echo "disabled";} ?>>-</button>
            <input type='number' readonly id='<?php echo $product_id; ?>' class='product-qty-input qtyInput'  name='<?php echo $product_id; ?>' value='<?php echo $quantity; ?>' min='1' max="99" onchange="updatePrice(this.id)">
            <button class='plusButton' id='buttonPlus<?php echo $product_id ?>' name='plusButton' value='<?php echo $product_id; ?>'>+</button>

            <input type='hidden' id='input<?php echo $product_id; ?>' value="<?php echo $productInfo['price'] ?>">
            <input type='hidden' id='change<?php echo $product_id; ?>' name='focusInput[]'>
            <input type="hidden" id='stock<?php echo $product_id ?>' value='<?php echo $productInfo['stock']; ?>' >
            </td>

            <div><td class="itemTotalPrice" id='price<?php echo $product_id;?>' >$<?php echo $productInfo['price']*$quantity;?>	

            </td>
        </tr>
			
		
        <?php
        
        
        $totalPrice += $productInfo['price']*$quantity;

        }
        ?>
		</table>
		<br><br><p style="text-align:center; font-size: 20px;">Cart Total:
        <td id='totalPrice'>$<?php echo $totalPrice; ?>
      
        <?php
        }
        ?>

        
        </form><br><br>
		
		
		
		
		<?php 
        if ($cartItemsQty > 0){
            echo "<div style='text-align:center'>";
            echo "<a href='checkout.php'><button class='checkoutbutton'>Check Out</button></a>";
        };

        
        

        ?>
       
        
        
        
        

        </div>
        <?php 

        include 'recommendation.php';
        
        ?>

		
		
			
    </div>
    </div>
    <script src="javascript/cart.js"></script>
</body>
</html>


