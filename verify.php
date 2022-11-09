<?php
	require "mail.php";
    require "functions.php";
	check_login();

    $errors = array();
    
    #GET activates when page refreshes
    if($_SERVER['REQUEST_METHOD'] == "GET" && !check_verified()) {
        $vars['code'] = rand(10000, 99999);
        $vars['expires'] = (time() + 600);   #10 minutes to expire
        $vars['email'] = $_SESSION['USER']->email;

        $query = "insert into account_codes (code, expires, email) values (:code, :expires, :email)";
        execute_query($query, $vars);

        $message = "Your Featherweights code is " . $vars['code'];
        $subject = "Featherweights verification code";
        $recipient = $vars['email'];
        send_mail($recipient, $subject, $message);
    }

    if($_SERVER['REQUEST_METHOD'] == "POST") {
        if(!check_verified()) {
            #prepared statements
            $query = "select * from account_codes where code = :code && email = :email";
            $vars = array();
            $vars['email'] = $_SESSION['USER']->email;
            $vars['code'] = $_POST['code'];
            $row = execute_query($query, $vars);
            if(is_array($row)) {
                #correct code
                $row = $row[0];
                $time = time();
                if($row->expires > $time) {
                    #didn't expire
                    #$id = $row->id;    this gets the code id, not the user id
                    $id = $_SESSION['USER']->id;
                    $query = "update users set email_verified = email where id = '$id' limit 1";
                    execute_query($query);

                    header("Location: home.php");
                    die;
                }
                else {
                    echo "Code has expired";
                }
            }
            else {
                echo "Code is wrong";
            }
        }
        else {
            echo "You're already verified";
        }

    }
?>

<!DOCTYPE html>
<html>
<head>
	<title>Featherweights</title>
</head>
<body>
	<a href="logout.php">Logout</a>
    <br>
    <a href="home.php">Home</a>
	<h1>Verify</h1>

    <div>
        <br>Please input the 5-letter code sent to your email<br>
        <div>
            <?php if(count($errors) > 0): ?>            <!-- can be summarized -->
                <?php foreach ($errors as $error): ?>
                    <?= $error?> <br>
                <?php endforeach;?>
            <?php endif;?>
        </div>
        <form method = "post">
            <input type = "text" name = "code" placeholder = "Enter the code"><br><br>
            <br>
            <input type = "submit" value = "Verify"><br><br>
        </form>
    </div>
</body>
</html>