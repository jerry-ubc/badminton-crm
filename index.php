<?php
#session variable accessible by any page on website (super global)
session_start();
    include("connection.php");
    include("functions.php");

    $user_data = check_login($con);     #con - connection to database
?>

<!DOCTYPE html>
<html>
<head>
	<title>Featherweights</title>
</head>
<body>
	<a href="logout.php">Logout</a>
	<h1>Index</h1>

	<br>
	Hello, <?php echo $user_data['user_name']; ?>
</body>
</html>