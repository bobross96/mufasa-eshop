<?php

  include '../dbconnect.php';

  if (isset($_POST['email']) && isset($_POST['password'])){
    $login_error;
    $email = $_POST['email'];
    $password = md5($_POST['password']);
   

    $sql = "SELECT * from admin_users WHERE email='$email' and password='$password'";

      $result = $db -> query($sql);
      $row = $result -> fetch_assoc();
      

      //returns a query
      if ($result->num_rows>0){
          session_start();
          $_SESSION['admin_user_id'] = $row['id'];
          $_SESSION['valid_admin'] = $row['username'];

          echo $row["id"];
          echo $_SESSION["user_id"];
          echo "<script>window.location.href='admin-stock.php'</script>";
          
      }

      else {
          echo "$result->error_log";
          $login_error = 'Login failed. Please try again';
          
      }
  }

  




?>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <style>
        * {box-sizing: border-box}

    /* Add padding to containers */
    .container {
      
      text-align: center; 
      position: absolute;
			left: 50%;
			top: 50%;
			transform: translate(-50%, -50%);
			background-color: whitesmoke;
      width : 45%
    }

    /* Full-width input fields */
    input[type=text], input[type=password] {
      width: 30%;
		  padding: 15px;
      margin: 5px 0 22px 0;
      display: inline-block;
      border: none;
      background: #f1f1f1;
    }

    input[type=text]:focus, input[type=password]:focus {
      background-color: #ddd;
      outline: none;
    }

    /* Overwrite default styles of hr */
    hr {
      border: 1px solid #f1f1f1;
      margin-bottom: 25px;
    }

    /* Set a style for the submit/register button */
    .loginbtn {
      background-color: grey;
      color: white;
      padding: 16px 20px;
      margin: 8px 0;
      border: none;
      cursor: pointer;
      width: 30%;
      opacity: 0.9;
      
    }

    .loginbtn:hover {
      opacity:1;
    }

    .loginbtn:disabled {
      opacity : 0.5;
    }

    /* Add a blue text color to links */
    a {
      color: dodgerblue;
    }
    
</style>
    
    <div class="container">
        
        <h2>
        <?php
         echo $login_error;
    
        ?>

        </h2>
        <h2>Admin Page</h2>
        <div class="landing-page">
            <img src="../images/logo.png" width="200vx" height="150vh" alt="mufasa gif here">
        </div>
        <div style="text-align:center">
            <h2 style="font-style:italic">Login Page</h2>
           
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            
            <input id="email" type="text" name="email" placeholder="Email:" required onchange="validateEmail()"><br>
            <input type="password" name="password" placeholder="Password:" required><br>
            <button id="loginButton" name="submit" type="submit" class="loginbtn" value="Submit">Login</button>
            </form>
            </div>
    </div>
    
    <script src="javascript/loginValidation.js"></script>
</body>
</html>