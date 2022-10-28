<?php
// session_start();
//     include("connection.php");
//     include("functions.php");

//     if($_SERVER['REQUEST_METHOD'] == "POST")
//     {
//         #something was posted, so collect data from post variable
//         $user_name = $_POST['user_name'];
//         $password = $_POST['password'];

//         if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
//         {
//             #save to database
//             $user_id = random_num(20);
//             $query = "insert into users (user_id, user_name, password) values ('$user_id', '$user_name', '$password')";
//             #id and date will be created by MySQL, not us
//             mysqli_query($con, $query);
//             header("Location: login.php");      #created account, now login
//             die;
//         }
//         else
//         {
//             echo "Please FOLLOW THE RULES THAT I'LL POST LATER";
//         }
//     }
?>
<!-- 
<!DOCTYPE html>
<html>
<head>
    <title>Signup</title>
</head>
<body>
    <div id = "box">
        <form method = "post">
            <div>Signup</div>
            <input type = "text" name = "user_name"><br><br>
            <input type = "password" name = "password"><br><br>
            <input type = "submit" value = "Signup"><br><br>

            <a href = "login.php">Already have an account?</a><br><br>
        </form>
    </div>
</body>
</html> -->

<?php 
session_start();

	include("connection.php");
	include("functions.php");


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$user_name = $_POST['user_name'];
		$password = $_POST['password'];

		if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
		{

			//save to database
			$user_id = random_num(20);
			$query = "insert into users (user_id,user_name,password) values ('$user_id','$user_name','$password')";

			mysqli_query($con, $query);

			header("Location: login.php");
			die;
		}else
		{
			echo "Please enter some valid information!";
		}
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