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
	<?php else:?>
		<br><br>
		<div>You're verified!</div>
	<?php endif;?>
	<div>
		You are part of 
		<?php
			$query = "SELECT COUNT(*) FROM users";
			$vars = array();
			$num_users = execute_query($query, $vars);
			$num_users = $num_users[0];
			foreach($num_users as $key => $value) {
				print $value;
			}

		?>
		 total Featherweights accounts!
	</div>
	<br>
	<br>
</body>
</html>