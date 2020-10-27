<?php
include "dbconnect.php";

if(isset($_GET['type'])){
    $category = $_GET['type'];
    $query = "SELECT * FROM products WHERE category =\"$category\"";
    $result = $db->query($query);
    if (!$result){
        echo("Error description: " .$db->error. "<br>");
    }
}

else {
$query = "SELECT * FROM products";
$result = $db->query($query);
#var_dump($result);

}
?>

<div class="rightColumn">
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