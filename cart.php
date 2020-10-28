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
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if ($_POST['deleteButton'] != 0){
            $deleteidINT = (int)$_POST['deleteButton'];
            $delete = "DELETE FROM cart_product WHERE id=$deleteidINT";
            $db->query($delete);
        }
         
        //this is to focus on the element that changed
        if (isset($_POST['focusInput'])){
            foreach ($_POST['focusInput'] as $value) {
                if ($value != 0){
                    $currentidINT = $value;
                break;
                }
            }
            foreach ($_POST as $key => $value) {
            //search for regex with blahem
            $idINT = (int)$key;
            $qty_INT = (int)$value;    
                
                $update = "UPDATE cart_product SET quantity = $qty_INT WHERE id = $idINT ";
                $db->query($update); 
            }
        }

        if (isset($_POST['minusButton'])){
            $currentidINT = (int)$_POST['minusButton'];
            //code to update database 
            $update = "UPDATE cart_product SET quantity = quantity-1 WHERE id = $currentidINT ";
            $db->query($update);
        }

        if (isset($_POST['plusButton'])){
            $currentidINT = (int)$_POST['plusButton'];
            //code to update database 
            $update = "UPDATE cart_product SET quantity = quantity+1  WHERE id = $currentidINT";
            $db->query($update);
        }
        //everytime an update is done, repopulate all data
        foreach ($_POST as $key => $value) {

            //update the key from inside the cart table!
            // key is producid , value is quantity, userid int ?
            $idINT = (int)$key;
            $qty_INT = (int)$value;

            /* $update = "UPDATE cart_product SET quantity = $qty_INT WHERE id = $idINT ";
            $db->query($update); */
            
            //query again to update according to the updates lmao..
            $query = "SELECT c.id,c.product_id,c.quantity,p.product_name,p.price FROM cart_product c,products p WHERE c.user_id = $user_idINT AND c.product_id = p.id"; 
            $result = $db->query($query);
            $totalPrice = 0;
            foreach ($result as $value) {
                $totalPrice += $value['quantity']*$value['price'];
            }
           
        }

        if (isset($currentidINT)){  
            echo "<script>location.href='#".$currentidINT."'</script>";
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
    <div class="container">
    <div class="rightColumn">
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
        foreach ($result as $value) {
        ?>    
        <tr>
            <td>
            <figure>
            <img src='images/productid<?php echo $value['product_id']; ?>.jpg' alt='cart-image' width='100px' height='100px'>
            <figcaption><?php $value['product_name']; ?></figcaption>
            </td>
            <td>
            <button style='vertical-align:top' class='minusButton' name='minusButton' value=<?php echo $value['id']; ?> id='buttonMinus<?php echo $value['id']?>' <?php if ($value['quantity'] == '1'){ echo "disabled";} ?>>-</button>&nbsp;
            <input type='number' id=<?php echo $value['id']; ?> class='product-qty-input qtyInput'  name='<?php echo $value['id'] ?>' value='<?php echo $value['quantity'] ?>' min='1' >
            &nbsp;<button style='vertical-align:top' class='plusButton' id='buttonPlus<?php echo $value['id'] ?>' name='plusButton' value='<?php echo $value['id'] ?>'>+</button>&nbsp;
            &nbsp;<button name='deleteButton' value='<?php echo $value['id'] ?>' style='vertical-align:top ; color:red' type='submit'>X</button>
            <input type='hidden' id='input<?php echo $value['id']; ?>' value="<?php echo $value['price'] ?>">
            <input type='hidden' id='change<?php echo $value['id']; ?>' name='focusInput[]'>
            </td>
            <td id='price<?php echo $value['id'];?>' >$<?php echo $value['price']*$value['quantity'];?>        
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
		
		<br><br><p style="text-align:center;">Based on the items in your cart, you may also like<br><br>
		
		<?php
		
		//Recommendations = Suggest product from the same category? Limit items shown to 4.
		
		include "dbconnect.php";

		if(isset($_GET['type'])){
			$category = $_GET['type'];
			$query = "SELECT * FROM products WHERE category =\"$category\" LIMIT 4";
			$result = $db->query($query);
			if (!$result){
				echo("Error description: " .$db->error. "<br>");
			}
		}

		else {
		$query = "SELECT * FROM products LIMIT 4";
		$result = $db->query($query);
		#var_dump($result);

		}
		?>

		<div class="rightColumn" style="max-width:80%">
			<?php     
			foreach ($result as $value) {

				echo "<div class='product'>";
				echo "<a href='product.php?id=".$value['id']."'>";
				echo "<img class='product-image' src='images/productid".$value['id'].".jpg' alt=''>";
				echo "<span class='product-desc' style='color: black; font-weight: bold'>".$value['product_name']."</span><br>";
				echo "$","<class='product-price'>".$value['price']."<br>";
				echo "</div>";
			}

			echo "</div>";
			
			?>
		</div>
		
    </div>
    </div>
</body>
</html>


