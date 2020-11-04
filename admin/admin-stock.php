<?php

include '../dbconnect.php';
include 'sessionPolice.php';



if ($_SERVER["REQUEST_METHOD"] == "POST"){

    if(isset($_POST['stock-input'])){
        $newStock_INT = (int)$_POST['stock-input'];
        $id_INT = (int)$_POST['stockChanged'];

        $updateStockQuery = "UPDATE products SET stock = $newStock_INT WHERE id = $id_INT";
        $db -> query($updateStockQuery);    
    }

    if(isset($_POST['price'])){
        $newPrice_INT = (int)$_POST['price'];
        $id_INT = (int)$_POST['stockChanged'];

        $updatePriceQuery = "UPDATE products SET price = $newPrice_INT WHERE id = $id_INT";
        $db -> query($updatePriceQuery);
    }

}


$productQuery = "SELECT * FROM products";
$result = $db->query($productQuery);




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
    <title>Products</title>
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <?php include 'header.php' ;?>
    
    <div class="container">
    <div>
        <nav>
            <ul>
                <a href="admin-stock.php"><li class="li-category selected-nav">Manage Stock</li></a>
                <a href="admin-orders.php"><li class="li-category">Manage Orders</li></a>
            </ul>
        </nav>

    </div>
    <div class="listrightColumn">
        <h2 style="text-align:center">Stock</h2>
        
        <table style="margin:auto">
        <tr>
            <td>Product</td>
            <td>Stock</td>
            <td>Price</td>
        </tr>
        
        <?php

        foreach ($result as $value) {
        ?>
        <form id="updateForm<?php echo $value['id']; ?>" action="<?php echo $_SERVER['SELF']?>" method="POST">    
            <tr>
                <td style="max-width:50px;">
                <figure>
                    <img src='../images/productid<?php echo $value['id']; ?>.jpg' alt='cart-image' width='100px' height='100px'>
                    <figcaption>
                        <?php echo $value['product_name']; ?>
                    </figcaption>
                </figure>
                </td>
                <td>
                    
                        <button class="minusButton" id="minusButton<?php echo $value['id']; ?>">-</button>
                        <input name="stock-input" class="stock-input" id='<?php echo $value['id']; ?>' type="number"  value='<?php echo $value['stock'] ?>' min='0'>
                        <button class="plusButton" id="plusButton<?php echo $value['id']; ?>">+</button>
                        <input type="hidden" name="stockChanged" id="id<?php echo$value['id']; ?>">
                    
                </td>
                <td>
                    $ <input type="number" name="price" id="price<?php echo $value['id']; ?>" class="price-input" value='<?php echo $value['price'] ?>' > 

                </td>
            </tr>
        </form>

        <?php
        }

        ?>

        </table>
        

    </div>
    </div>

    <script src="javascript/admin-stock.js"></script>
</body>
</html>