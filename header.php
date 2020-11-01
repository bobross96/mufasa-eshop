<!-- Load icon library -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<?php
 include 'sessionPolice.php';
 include 'dbconnect.php';

 

 $userID = (int)$_SESSION['user_id'];
 $cartItemsQty = 0;
 foreach ($_SESSION['cart'] as $key => $value) {
	 $cartItemsQty += $value;
 }
 

	
 //test

?>

<!--<div style="margin:auto">
<div style="margin-bottom:1em;display:flex;justify-content:space-between">
    <span style="">Welcome <?php echo $_SESSION['valid_user'] ?></span>
	<a href="logout.php"><span style="" ><img src="images/logout.svg" alt="bye" width="30px" height="30px" style="vertical-align: middle; text-align: right; margin-right: 2px">Logout</span></a>
</div> -->

<div style="width:80%; margin:auto; box-shadow: 0 4px 2px -2px rgba(206,206,206,0.37); ">
<form action="" method="GET">
<div class="top-header-container">
 	<div style="padding: 0px 16px;">
	 <a href="profile.php" style="text-decoration: none; color: black; vertical-align: middle"><span>Welcome <?php echo $_SESSION['valid_user'] ?></span></a>	
	</div>
	<div>
		<span style="padding-left:1em"><img src="images/orderHistory.svg" alt="bye" width="20em" height="20em" style="vertical-align: middle; text-align: right; margin-right: 2px">Order History</span>
		<span style="padding-left:1em"><img src="images/profile.svg" alt="bye" width="20em" height="20em" style="vertical-align: middle; text-align: right; margin-right: 2px">Profile</span>
		<a href="logout.php"><span style="padding-left:1em"><img src="images/logout.svg" alt="bye" width="20em" height="20em" style="vertical-align: middle; text-align: right; margin-right: 2px">Logout</span></a>
	</div>
</div>

<div class="bottom-header-container">
	<div style="display:inline-block; width:90%">
	<a href="member.php"><img style="padding: 0px 16px; vertical-align: middle" src="images/logo.png" alt="logo" width="11%" height="5%"></a>
	<span class="search-bar"><label for="search"></label><input name="search" type="text" style="width:70%;padding: 10px 10px; line-height: 28px; "placeholder="Search for your products here"></span>
	<button type="submit" class="search-button"><i class="fa fa-search"></i></button>
	</div>
	
	<div style="display:inline-block;">
	<a href="cart.php" style="text-decoration: none; color: black; vertical-align: middle">
	<span>
	<img src="images/cart.svg" alt="carty" width="40px" height="40px" style="vertical-align: middle;">
	<?php echo $cartItemsQty; ?>
	</span></a>
	
	
	</div>
</div>
</form>
</div>


