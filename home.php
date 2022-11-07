<?php
	include "functions.php";
	check_login()
?>

<!DOCTYPE html>
<html>
<head>
	<title>Featherweights</title>
</head>
<body>
	<a href="logout.php">Logout</a>
	<h1>Home</h1>
	<br>
	Welcome home <?= $_SESSION['USER']->username?>
	<?php if(!check_verified()):?>
		<br><br>
		<a href = "verify.php">
			<button>Verify profile</button>
		</a>
	<?php endif;?>
	<br>
	<br>
</body>
</html>