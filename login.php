<?php 
include("connection.php");
include("functions.php");

$errors = array();
if($_SERVER['REQUEST_METHOD'] == "POST") {
    $errors = login($_POST);

    if(count($errors) == 0) {
        header("Location: home.php");
        die;
    }
}

?>


<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
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
        <form method = "post">
            <div>Login</div>
            <input type = "email" name = "email" placeholder = "Email"><br><br>
            <input type = "password" name = "password" placeholder = "Password"><br><br>
            <input type = "submit" value = "Login"><br><br>

            <a href = "signup.php">Don't have an account?</a><br><br>
            <a href = "index.php">Homepage</a><br><br>
        </form>
    </div>
</body>
</html>