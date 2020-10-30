<?php 
    include 'dbconnect.php';
    //this starts session and loads the session login thingy from login
    include 'sessionPolice.php';
//get the query param, then select from database info about that product
    
    $product_id = $_GET['id'];
    $query = "SELECT * from products WHERE id = ".$product_id."";
    $result = $db->query($query);
   
    $row = $result -> fetch_assoc();


	
    if(isset($_POST['quantity']) && $_POST['quantity'] > 0){
        #code to insert item into cart
        //need to convert these values to int to insert into cart db table 
        $qtyINT = (int)$_POST['quantity'];
        $product_idINT = (int)$product_id;
		$useridINT = (int)$_SESSION['user_id'];
		
		if ($qtyINT > $row['stock']){
			echo "<script>alert('Please order below the stock value');</script>";
		}

		else {
		

			/* $addToCart = [
				'product_id' => $product_idINT,
				'quantity' => $qtyINT
			]; */
			$_SESSION['cart'][$product_idINT] += $qtyINT;
			

			//$update = "UPDATE cart_product SET quantity = quantity + $qtyINT WHERE product_id = $product_idINT AND user_id = $useridINT ";

			//$result = $db->query($update);
			
			//if product id was not in cart , will insert instead
			if(($db->affected_rows) == 0){

				$insert = "INSERT INTO cart_product VALUES (NULL,$qtyINT,$product_idINT,$useridINT)";

				$db->query($insert);
			
			}

			echo "<script>alert('Item successfully added to cart')</script>";

		}
        

        
    }
    // access other properties like row['column_name']

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
    <link rel="stylesheet" href="index.css">
    <script type="module" src="javascript/product.js"></script>
	<style>
	.card {
	  max-width: 300px;
	  margin: auto;
	  text-align: center;
	  font-family: arial;
	}

	.price {
	  color: grey;
	  font-size: 22px;
	}

	.card button {
	  border: none;
	  outline: 0;
	  padding: 12px;
	  color: white;
	  background-color: #000;
	  text-align: center;
	  cursor: pointer;
	  width: 100%;
	  font-size: 18px;
	}

	.card button:hover {
	  opacity: 0.7;
	}

	.card button:disabled {
		opacity : 0.4
	}
	
	input[type=number]{
    width: 50px;
	height: 50px;
	text-align: center;
	font-size:20px;
	} 
	
	input[type=number]::-webkit-inner-spin-button, 
	input[type=number]::-webkit-outer-spin-button {  

    opacity: 1;

}
	</style>
</head>
<body>

    <?php include 'header.php' ?>
    <div class="container">
    <?php include 'categoryBar.php' ?>
    <div class="rightColumn">
	
	<div class="card">
	  <img src=images/productid<?php echo $row['id'] ?>.jpg style="width:100%">
	  <h1><?php echo $row['product_name'] ?></h1>
	  <p class="price">$<?php echo $row['price'] ?><br></p>
	  <p><?php echo $row['description'] ?><br></p>
	  <p>Stock: <span id="stock"><?php echo $row['stock'] ?></span></p>
	  <form action="" method="POST">
	  <input type="number" id="purchaseQty" class="quantity" name="quantity" min="1" max="99" value="1">
	  <p><button type="submit" id="submitButton" value="Add to cart">Add to Cart</button></p>
	  </form>
	</div>
	
	
     </div>
    </div>
</body>
</html>