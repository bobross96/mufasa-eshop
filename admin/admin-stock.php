<?php

include '../dbconnect.php';
include 'sessionPolice.php';



if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $newStock_INT = (int)$_POST['stock-input'];
    $id_INT = (int)$_POST['stockChanged'];

    $updateStockQuery = "UPDATE products SET stock = $newStock_INT WHERE id = $id_INT";
    $db -> query($updateStockQuery);

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
    <title>Stock</title>
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <?php include 'header.php' ;?>
    
    <div class="container">
    <div>
        <nav>
        <ul><a href="admin-stock.php">Manage Stock</a></ul>
        <ul><a href="admin-orders.php">Manage Order Status</a></ul>
        </nav>

    </div>
    <div class="listrightColumn">
        <h2>Stock</h2>
        
        <table style="margin:auto">
            <tr>
                <th>Product</th>
                <th>Stock</th>
            </tr>



        
        <?php

        foreach ($result as $value) {
        ?>
        <form id="updateForm<?php echo $value['id']; ?>" action="<?php echo $_SERVER['SELF']?>" method="POST">    
            <tr>
                <td>
                <figure>
                    <img src='../images/productid<?php echo $value['id']; ?>.jpg' alt='cart-image' width='100px' height='100px'>
                    <figcaption>
                        <?php echo $value['product_name']; ?>
                    </figcaption>
                </figure>
                </td>
                <td>
                    <div class="stock-container">
                        <button class="minusButton" id="minusButton<?php echo $value['id']; ?>">-</button>
                        <input name="stock-input" class="stock-input" id='<?php echo $value['id']; ?>' type="number"  value='<?php echo $value['stock'] ?>' min='0' onchange="this.form.submit()">
                        <button class="plusButton" id="plusButton<?php echo $value['id']; ?>">+</button>
                        <input type="hidden" name="stockChanged" id="id<?php echo$value['id']; ?>">
                    </div>
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