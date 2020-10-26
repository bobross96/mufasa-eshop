<?php 



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
            <p>Address: </p>
        
    
    </div>
    </div>
</body>
</html>