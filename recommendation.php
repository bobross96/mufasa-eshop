<div class="container" style="text-align:center; min-width:85%">
		<?php
		
		//Recommendations = Suggest product from the same category? Limit items shown to 4.
		
		if ($cartItemsQty == 0){
			$class='class="hidden"';
		}
		else if ($cartItemsQty > 0){
		echo "<br><br><p style='text-align:center'>Based on the items in your cart, you may also like<br><br>";
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
		};
		
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