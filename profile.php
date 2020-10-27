<?php 

//header alr got session police and db connect lmao
include 'sessionPolice.php';
include 'dbconnect.php';

$user_idINT = (int)$_SESSION['user_id'];


if ( isset($_POST['update'])){
    $newAddress = $_POST['addressInput'];
    $newPostalCode = $_POST['postalCodeInput'];
    $newEmail = $_POST['emailInput'];
    $updateDB = "UPDATE users SET address = '$newAddress', postal_code = '$newPostalCode', email = '$newEmail' WHERE id = $user_idINT";
    $db -> query($updateDB);

    $userInfo = "SELECT * FROM users WHERE id = $user_idINT";
    $result = $db->query($userInfo);
    $row = $result -> fetch_assoc();

}

else {
$userInfo = "SELECT * FROM users WHERE id = $user_idINT";
$result = $db->query($userInfo);
$row = $result -> fetch_assoc();

}



?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="css/profile.css">
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
    <form action="" method='POST'>
    <div class="rightColumn">
        
        
            <p>User name: <?php echo $_SESSION['valid_user']; ?></p>
            <p>Email: <input id="emailInput" name="emailInput" type="text" value="<?php echo $row['email']; ?>" readonly required><button type='button' id="emailEdit" >Edit</button></p> 
            <p>Address: <input id="addressInput" name="addressInput" type="text" value="<?php echo $row['address']; ?>" readonly required><button type='button' id="addressEdit" >Edit</button></p> 
            <p>Postal Code: <input id="postalCodeInput" name="postalCodeInput" type="text" value="<?php echo $row['postal_code']; ?>" readonly required><button type='button' id="postalCodeEdit">Edit</button></p> 
            <button id="submitButton" type="submit" value="Update" name="update" style="display:none" >Update</button>
    </div>
    </form>
    </div>
    <script src="javascript/profile.js"></script>
</body>
</html>