<?php



//imagine this is db result
$dbResults

foreach ($dbResults as $key => $value) {

    
?>


<div class="product">
    <img src="productid<?php echo $value['id']; ?>" alt="" srcset="">
    <span><?php echo $value['product_description'] ?></span>
</div>


<?php

}


?>
