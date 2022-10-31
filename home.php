<?php
	include "functions.php";
	check_login();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Featherweights</title>
</head>
<body>
	<a href="logout.php">Logout</a>
	<h1>Home</h1>
	<?php 
	if(check_login(false)) {
		echo "Welcome home " . $_SESSION['USER']->username;
	}
	?>
</body>
</html>