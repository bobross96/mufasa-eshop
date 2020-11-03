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
		$_SESSION['cart'] = array();

        echo $row["id"];
        echo $_SESSION["user_id"];
        echo "<script>window.location.href='index.php'</script>";
        
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
    <title>User Account - Mufasa</title>
	<style>
			* {box-sizing: border-box}

		body {
			background-color: #ef5734;
			background-image: linear-gradient(315deg, #ef5734 0%, #ffcc2f 74%);

		}

		/* Add padding to containers */
		.container {
		    position: absolute;
			left: 50%;
			top: 50%;
			transform: translate(-50%, -50%);
			background-color: whitesmoke;
			width: 50%
			
		}

		.flex-container {
			display:flex; 
			justify-content : center; 
			align-items:center
		}

		/* Full-width input fields */
		input[type=text], input[type=password] {
		  width: 95%;
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
		  background-color: #f57224;
		  color: white;
		  padding: 16px 20px;
		  margin: 8px 0;
		  border: none;
		  cursor: pointer;
		  width: 95%;
		  opacity: 0.9;
		  
		}

		.loginbtn:hover {
		  opacity:1;
		}

		/* Add a blue text color to links */
		a {
		  color: dodgerblue;
		}
		
	</style>
</head>
<body>
    <h3>
    <?php
    echo $login_error;
    ?>
    </h3>
    <div class="container">
    <div class="flex-container">
	<div>
    <!-- <h2>Login to your Mufasa account</h2> -->
    <img src="images/logo.png" alt="login" width="266px" height="200px">
	</div>
	<div style=" padding : 5% ; text-align:center">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
	<h2>Login to Mufasa Electronics</h2>
    <input type="text" name="username" placeholder="Username:" width="70" required ><br>
    <input type="password" name="password" placeholder="Password:" required><br>
    <button name="submit" type="submit" class="loginbtn" value="Submit">LOGIN</button>
	<p>New to Mufasa? <a href="register.php">Register here.</a></p>
	
    </form>
	</div>
    </div>
	</div>
</body>
</html>
