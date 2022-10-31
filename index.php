<?php
#session variable accessible by any page on website (super global)
//session_start();
    include("connection.php");
    include("functions.php");

    #$user_data = check_login($con);     #con - connection to database
?>

<!DOCTYPE html>
<html>
<head>
	<title>Featherweights</title>
</head>
<body>
	<a href="login.php">Login</a>
	<h1>Index</h1>

	<br>
	Welcome to Featherweights
</body>
</html>