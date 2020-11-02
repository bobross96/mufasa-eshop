<?php 
	include 'dbconnect.php';
	session_start();
    //this starts session and loads the session login thingy from login
	//get the query param, then select from database info about that product
    
    $product_id = $_GET['id'];
    $query = "SELECT * from products WHERE id = ".$product_id."";
    $result = $db->query($query);
   
    $row = $result -> fetch_assoc();


	
    if(isset($_POST['quantity']) && $_POST['quantity'] > 0){
		if (!isset($_SESSION['valid_user'])){
			echo "<script>window.location.href='login.php'</script>";
		}

        #code to insert item into cart
        //need to convert these values to int to insert into cart db table 
		
		$qtyINT = (int)$_POST['quantity'];
        $product_idINT = (int)$product_id;
		$useridINT = (int)$_SESSION['user_id'];
		$totalQtyInCart = $_SESSION['cart'][$product_idINT] + $qtyINT;  
		$stock_INT = (int)$row['stock'];

		if ($qtyInt > $stock_INT){
			echo "<script>alert('Selected quantity exceeds currenasdasdt stock level. Please try again.');</script>";
		}

		else if ($totalQtyInCart > $stock_INT){
			echo "<script>alert('Quantity in cart exceeds current stock level. Please check cart.');</script>";
		}
		else {
	
			$_SESSION['cart'][$product_idINT] += $qtyINT;
			if(($db->affected_rows) == 0){

				$insert = "INSERT INTO cart_product VALUES (NULL,$qtyINT,$product_idINT,$useridINT)";

				$db->query($insert);
			
			}
			echo "<script>alert('Item successfully added to cart.')</script>";
		}
        
    }

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
    <link rel="stylesheet" href="index.css">
	<link rel="stylesheet" href="css/product.css">
    <script type="module" src="javascript/product.js"></script>
	
</head>
<body>

    <?php include 'header.php' ?>
    <div class="container">
    <?php include 'categoryBar.php' ?>
    <div class="rightColumn">
		
	
	<div class="card">
	  <div style="width:40%">
	  <img src=images/productid<?php echo $row['id'] ?>.jpg style="width:100%">
	  </div>
	  <div style="max-width: 400px">
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
	</div>
</body>
</html>