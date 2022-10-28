<?php 
session_start();
	include("connection.php");
	include("functions.php");

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$user_name = $_POST['user_name'];
		$password = $_POST['password'];
        $valid = TRUE;
        if(empty($user_name || empty($password)))
        {
            echo "Username or password can't be empty";
            $valid = FALSE;
        }
        $query = "select * from users where user_name = '$user_name' limit 1";
        $result = mysqli_query($con, $query);
        if(mysqli_num_rows($result) > 0 && $valid) {
            echo "Username already exists";
            $valid = FALSE;
        }

		if($valid)
		{
			//save to database
			$user_id = random_num(20);
			$query = "insert into users (user_id,user_name,password) values ('$user_id','$user_name','$password')";

			mysqli_query($con, $query);

			header("Location: login.php");
			die;
		}
        // else
		// {
		// 	echo "WEIRD INPUT DETECTED!!!!!";
		// }
	}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Signup</title>
</head>
<body>
	<div id="box">
		
		<form method="post">
			<div>Sign-up</div>

			<input id="text" type="text" name="user_name"><br><br>
			<input id="text" type="password" name="password"><br><br>

			<input id="button" type="submit" value="Signup"><br><br>

			<a href="login.php">Click to Login</a><br><br>
		</form>
	</div>
</body>
</html>