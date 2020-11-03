



<div class="container" style="text-align:center; min-width:85%">
		<?php
	
		//Recommendations = Suggest product from the same category? Limit items shown to 4.
		$id = $row['id'];
        $category = $row['category'];
        echo "<br><br><p style='text-align:center'>You may also like similar products like these<br><br>";
		$query = "SELECT * FROM products WHERE category =\"$category\"  LIMIT 4";
		$result = $db->query($query);

		
		
			echo "<div'. $class .'>";
			
			foreach ($result as $value) {

					echo "<div class='product'>";
					echo "<a href='product.php?id=".$value['id']."'>";
					echo "<img class='product-image' src='images/productid".$value['id'].".jpg' alt=''>";
					echo "<span class='product-desc' style='color: black; font-weight: bold'>".$value['product_name']."</span><br>";
					echo "$","<class='product-price'>".$value['price']."<br>";
					echo "</div>";
				}

				
		?>