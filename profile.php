<?php 

//header alr got session police and db connect lmao
include 'sessionPolice.php';
include 'dbconnect.php';

$user_idINT = (int)$_SESSION['user_id'];

$userInfo = "SELECT * FROM users WHERE id = $user_idINT";
$result = $db->query($userInfo);
$row = $result -> fetch_assoc();




?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    
    <?php
    include 'header.php';
 
    ?>
    <div class="container">
    <div id="left-column">
        <nav>
        <ul><a href="profile.php">Profile</a></ul>
        <ul><a href="order_history.php">Order history</a></ul>
        </nav>
    </div>
    <div class="rightColumn">
        
        
            <p>User name: <?php echo $_SESSION['valid_user']; ?></p>
            <p>Email:</p>
            <p>Address: <?php echo $row['address']; ?> </p>
        
    
    </div>
    </div>
</body>
</html>