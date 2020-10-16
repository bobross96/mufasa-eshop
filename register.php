<?php 
include "dbconnect.php";

if (isset($_POST['submit'])){
    //var_dump($_POST['submit']);
    if ($_POST['password'] != $_POST['password2']){
        echo "<script>alert('passwords do not match');</script>";
        header("Refresh:0");
    }

    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $sql = "INSERT INTO users (username,password) VALUES ('$username','$password')";

    $result = $db -> query($sql);

    if (!$result){
        echo "$result->error_log";
    }

    else {
        echo "Successfully register".$username;
        echo "<script>setTimeout(function(){window.location.href='member.php'},1000)</script>";
        //redirect to member page
    }




}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>Document</title>
</head>
<body>
    <div style="text-align:center">
    <h2 style="font-style:italic">Mufasa Electronics</h2>
    <img src="images/register.jpg" alt="register image">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
    Username: <br>
    <input type="text" name="username" required><br>
    Password: <br>
    <input type="password" name="password" required><br>
    Confirm Password: <br>
    <input type="password" name="password2" required><br>
    
    <input type="submit" name="submit" value="Submit">
    <input type="reset" name="reset" value="Reset">
    </form>
    </div>
</body>
</html>