<?php 
include "dbconnect.php";

if (isset($_POST['submit'])){
    //var_dump($_POST['submit']);
    if ($_POST['password'] != $_POST['password2']){
        echo "<script>alert('passwords do not match');</script>";
        header("Refresh:0");
	}
	else {
		$username = str_replace(' ', '', $_POST['username']);
		$password = md5($_POST['password']);
		//check if username is already taken or email has already been registered
		$checkExistingUsername = "SELECT * FROM users WHERE username = '$username'";
		$db -> query($checkExistingUsername);
		if(($db->affected_rows) > 0){
			echo "<script>alert('username has already been taken!')</script>";
		} 

		else {
			$sql = "INSERT INTO users (username,password) VALUES ('$username','$password')";

			$result = $db -> query($sql);

			if (!$result){
			echo "$result->error_log";
			}

			else {

				$sql = "SELECT * from users WHERE username='$username' and password='$password'";

				$result = $db -> query($sql);
				$row = $result -> fetch_assoc();

				session_start();
				$_SESSION['user_id'] = $row['id'];
				$_SESSION['valid_user'] = $username;
				$_SESSION['cart'] = array();

				
				// if need can just redirect to the start page later
				echo "<script>alert('Successfully registered ".$username."')</script>";
				echo "<script>location.href='index.php'</script>";
				//redirect to member page
			}
		}

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
		 background-color: #b3cdd1;
		 background-image: linear-gradient(315deg, #b3cdd1 0%, #9fa4c4 74%);

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
		.registerbtn {
		  background-color: #f57224;
		  color: white;
		  padding: 16px 20px;
		  margin: 8px 0;
		  border: none;
		  cursor: pointer;
		  width: 95%;
		  opacity: 0.9;
		}

		.registerbtn:hover {
		  opacity:1;
		}

		/* Add a blue text color to links */
		a {
		  color: dodgerblue;
		}
	</style>
</head>
<body>
    <div class="container">
    <div class="flex-container"> 
		<div>
		
		<img src="images/logo.png" alt="register image" width="266px" height="200px">
		</div>
		<div style="padding : 5% ; text-align:center">
		<h2>Create a Mufasa Profile</h2>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
		<input type="text" name="username" placeholder="Username:" required><br>
		<input type="password" name="password" placeholder="Password:" required><br>
		<input type="password" name="password2" placeholder="Confirm Password:" required><br>
		<button name="submit" type="submit" class="registerbtn" value="Submit">REGISTER</button>
		<p>Already have an account? <a href="login.php">Sign in here.</a></p>
		</form>
		</div>
	</div>
	
    </div>
</body>
</html>