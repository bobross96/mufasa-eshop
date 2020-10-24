<!-- Load icon library -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<?php
 include 'sessionPolice.php';
 include 'dbconnect.php';

 

 $userID = (int)$_SESSION['user_id'];
 $select = "SELECT * FROM cart_product WHERE user_id = $userID ";
 $db->query($select);
 
 if(($db->affected_rows) > 0){
	 $cartItemsQty = $db->affected_rows;
	 //echo "poop";
 }
 else {
	//echo "poop";
	 $cartItemsQty = 0;
 }
	
 //test

?>

<!--<div style="margin:auto">
<div style="margin-bottom:1em;display:flex;justify-content:space-between">
    <span style="">Welcome <?php echo $_SESSION['valid_user'] ?></span>
	<a href="logout.php"><span style="" ><img src="images/logout.svg" alt="bye" width="30px" height="30px" style="vertical-align: middle; text-align: right; margin-right: 2px">Logout</span></a>
</div> -->


<div style="border-style: none; padding:10px; text-align: center; min-width:800px">
	<a href="member.php"><img style="padding: 0px 16px; vertical-align: middle" src="images/logo.jpg" alt="logo" width="100px" height="100px"></a>
    <span><label for="search"></label><input name="search" type="text" placeholder="Search for your products here" style="width:25%;padding: 16px 16px;margin-left: 2%;vertical-align: middle"></span>
	<button type="submit" style="padding: 16px 16px; vertical-align: middle"><i class="fa fa-search"></i></button>
    <a href="cart.php">
	<span style="padding: 16px 16px;min-width:40%; margin-left: 2%; margin-right: 2%" >
	<img src="images/cart.svg" alt="carty" width="50px" height="50px" style="vertical-align: middle; text-align: right">
	<?php echo $cartItemsQty; ?>
	</span></a>
	<span style="margin-right: 2%" ><img src="images/user.svg" alt="bye" width="30px" height="30px" style="vertical-align: middle; text-align: right; margin-right: 2px">Welcome <?php echo $_SESSION['valid_user'] ?></span></a>
	<a href="logout.php"><span style="" ><img src="images/logout.svg" alt="bye" width="30px" height="30px" style="vertical-align: middle; text-align: right; margin-right: 2px">Logout</span></a>
</div>

</div>