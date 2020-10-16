<?php 
include "dbconnect.php";

if (isset($_POST['username'])){
    //var_dump($_POST['submit']);
    
    $login_error;
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $sql = "SELECT * from users WHERE username='$username' and password='$password'";

    $result = $db -> query($sql);
    $row = $result -> fetch_assoc();
    

    //returns a query
    if ($result->num_rows>0){
        session_start();
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['valid_user'] = $username;
        echo $row["id"];
        echo $_SESSION["user_id"];
        echo "Successfully logged in ".$username." .Redirecting...";
        echo "<script>setTimeout(function(){window.location.href='member.php'},1000)</script>";
        
        
    }

    else {
        echo "$result->error_log";
        $login_error = 'Login failed. Please try again';
        
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
    <h3>
    <?php
    echo $login_error;
    ?>
    </h3>
    
    <div style="text-align:center">
    <h2 style="font-style:italic">Mufasa Electronics</h2>
    <img src="images/logo.jpg" alt="logo">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
    Username: <br>
    <input type="text" name="username" required><br>
    Password: <br>
    <input type="password" name="password" required><br>
    
    <input type="submit" name="submit" value="Submit">
    <input type="reset" name="reset" value="Reset">
    </form>
    </div>
</body>
</html>