<?php
session_start();

if (isset($_SESSION['valid_user'])){
    #echo "logged in as ".$_SESSION['valid_user'];
}

else {
    #echo "not logged in".$_SESSION['valid_user'];
    echo "<script>window.location.href='login.php'</script>";

}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <div class="container">
    <?php include 'header.php' ?>
    <?php include 'categoryBar.php' ?>
    <?php include 'content.php'?>
    </div>
</body>
</html>