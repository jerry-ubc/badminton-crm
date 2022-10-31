<?php 
//session_start();
require "connection.php";
require "functions.php";

$errors = array();
if($_SERVER['REQUEST_METHOD'] == "POST") {
    $errors = signup($_POST);
    if(count($errors) == 0) {
        header("Location: login.php");
        die;
    }
}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Sign-up</title>
</head>
<body>
	<div>
        <div>
            <?php if(count($errors) > 0): ?>            <!-- can be summarized -->
                <?php foreach ($errors as $error): ?>
                    <?= $error?> <br>
                <?php endforeach;?>
            <?php endif;?>
        </div>
        <!-- <h2>A valid username: 
        </h2> -->
		<form method = "post">      <!-- Posts to $_SERVER['REQUEST_METHOD'] -->
			<div>Sign-up</div>
			<input type = "text" name = "username"  placeholder = "Username"><br>
			<input type = "text" name = "email"     placeholder = "Email"><br>
            <input type = "text" name = "password"  placeholder = "Password"><br>
            <input type = "text" name = "password2" placeholder = "Re-enter Password"><br>

			<input type = "submit" value = "Signup"><br><br>
			<a href = "login.php">Already have an account?</a><br><br>
		</form>
	</div>
</body>
</html>