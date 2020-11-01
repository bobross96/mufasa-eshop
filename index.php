<?php
session_start();

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mufasa Electronics Online Store</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <?php include 'header.php' ?>
    <div class="container">
    <?php include 'categoryBar.php' ?>
    <?php include 'content.php'?>
    </div>
</body>
</html>