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
        echo "<script>alert('Successfully logged in ".$username."')</script>";
        echo "<script>window.location.href='member.php'</script>";
        
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
    <title>Login</title>
	<style>
			* {box-sizing: border-box}

		/* Add padding to containers */
		.container {
		  padding: 16px;
		}

		/* Full-width input fields */
		input[type=text], input[type=password] {
		  width: 20%;
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
		  background-color: #4CAF50;
		  color: white;
		  padding: 16px 20px;
		  margin: 8px 0;
		  border: none;
		  cursor: pointer;
		  width: 20%;
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
    
    <div style="text-align:center">
    <h2>Login Page</h2>
    <img src="images/login.jpg" alt="login" width="300px" height="200px">
	<p>Need an account? <a href="register.php">Register here.</a></p>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
    Username: <br>
    <input type="text" name="username" required><br>
    Password: <br>
    <input type="password" name="password" required><br>
    
	<button name="submit" type="submit" class="loginbtn" value="Submit">Login</button>
    </form>
    </div>
</body>
</html>
