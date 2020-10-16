

<?php
 include 'sessionPolice.php';
?>
<div style="margin:auto" >
<div style="margin-bottom:1em;display:flex;justify-content:space-between">
    <span style="">Welcome <?php echo $_SESSION['valid_user'] ?></span>
    <span style="">Home Page</span>
    <a href="logout.php"><span style="">Logout</span></a>
</div>
<div style="border-style: groove; padding:20px">

    <a href="member.php"><img style="padding: 0px 16px;vertical-align: middle;" src="images/logo.jpg" alt="logo" width="100px" height="100px"></a>
    <span><label for="search">Search</label><input name="search" type="text" style="width:70%;padding: 16px 16px;vertical-align: middle;" ></span>
    <a href="cart.php"><span style="padding: 16px 16px;min-width:40%" ><img src="images/cart.svg" alt="carty" width="50px" height="50px" style="vertical-align: middle;"> Cart</span></a>
</div>
</div>