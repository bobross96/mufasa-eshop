

<?php
 
 include 'dbconnect.php';

 
 if (isset($_SESSION['valid_user'])){
	 $username = $_SESSION['valid_user'];
	 }
 else {
	 $username = "Guest";
 }
 $userID = (int)$_SESSION['user_id'];
 $cartItemsQty = 0;
 foreach ($_SESSION['cart'] as $key => $value) {
	 $cartItemsQty += $value;
 }

 
 

	
 //test

?>

<div class="header">
	<div style="margin:auto; box-shadow: 0 4px 2px -2px rgba(206,206,206,0.37)">
	<form action="index.php" method="GET">
	<div class="top-header-container">
		<div style="padding-left: 10%">
		 </a>	
		</div>
		<div style="padding-right: 13%">
			<a href="profile.php"><span style="padding-left:1em; color: whitesmoke;"><img src="images/userWhite.svg" alt="bye" width="20em" height="18em" style="vertical-align: middle; text-align: right; margin-right: 4px ; ">Hello <?php echo $username; ?></span>
			<a href="order_history.php"><span style="padding-left:1em ; color: whitesmoke;"><img src="images/boxWhite.svg" alt="bye" width="20em" height="20em" style="vertical-align: middle; text-align: right; margin-right: 2px;">Order History</span>
			<?php if (isset($_SESSION['valid_user'])){
				?>
				<a href="logout.php"><span style="padding-left:1em; padding-right:16px; color: whitesmoke;"><img src="images/logoutWhite.svg" alt="bye" width="20em" height="20em" style="vertical-align: middle; text-align: right; margin-right: 2px">Logout</span></a>
			<?php
			}
			else {
				?>
				<a href="logout.php"><span style="padding-left:1em; padding-right:16px; color: whitesmoke;"><img src="images/loginWhite.svg" alt="bye" width="20em" height="20em" style="vertical-align: middle; text-align: right; margin-right: 2px">Login</span></a>
				<?php
			} 
			
			?>
			
		</div>
	</div>


	<div class="bottom-header-container">
		<div style="border-style: none; padding:10px; text-align: center; min-width:800px; box-shadow: 0 4px px -2px rgba(206,206,206,0.37);">
		<a href="index.php"><img style="padding: 0px 16px; vertical-align: middle" src="images/logo.png" alt="logo" width="129vw" height="100vh"></a>
		<span><label for="search"></label><input name="search" type="text" placeholder="Search for your products here" 
		style="width:40%;padding: 16px 16px;margin-left: 2%;vertical-align: middle; border: 2px solid #ccc;border-radius: 4px;"></span>
		<button type="submit" class="search-button" style=""><img src="images/search.svg" width="15px"  height="15px" alt="" srcset=""></button>
		<a href="cart.php" style="text-decoration: none; color: black; vertical-align: middle">
		<span style="padding: 16px 16px;min-width:40%; margin-left: 2%; margin-right: 2%; font-size: 20px; vertical-align: middle">
		<img src="images/cartOrange.svg" alt="carty" width="40px" height="40px" style="vertical-align: middle; position: relative;">
		<span style="position:absolute; padding: 4px; border-radius: 50%;margin-top:25px;  margin-left:3px; vertical-align:top; background-color : #f57224;; font-size : 80%; color : whitesmoke"><?php echo $cartItemsQty; ?></span>
		</span></a>
		</div>

	</div>
	</form>
	</div>
</div>

