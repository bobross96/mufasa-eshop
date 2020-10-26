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

        //check if previous product is inside

        $update = "UPDATE cart_product SET quantity = quantity + $qtyINT WHERE product_id = $product_idINT AND user_id = $useridINT ";

        $result = $db->query($update);
        
        //if product id was not in cart , will insert instead
        if(($db->affected_rows) == 0){

            $insert = "INSERT INTO cart_product VALUES (NULL,$qtyINT,$product_idINT,$useridINT)";

            $db->query($insert);
           
        }

        echo "<script>alert('Item successfully added to cart')</script>";

        

        
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
</head>
<body>

    <?php include 'header.php' ?>
    <div class="container">
    <?php include 'categoryBar.php' ?>
    <div class="rightColumn">
    <?php
    echo "<div class='product'>";
    echo "<img class='product-image' src='images/productid".$row['id'].".jpg' alt=''>";
    echo "<span class='product-desc'>".$row['product_name']."</span><br>";
    echo "<span class='product-price'>".$row['price']."</span>";
    echo "</div>";
  
    ?>

    <div class="product product-details">
    <?php echo $row['description'] ?><br><br>
    <span>Order Quantity</span><br><br>
    <form action="" method="POST">
    <input type="number" id="purchaseQty" class="quantity" name="quantity" min="0" value="1">
    <br><br>
    
    <input type="submit" value="Add to cart">
    </form>
    </div>
     </div>
    </div>
</body>
</html>