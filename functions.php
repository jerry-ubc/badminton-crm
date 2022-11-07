<?php
session_start();

function signup($data) {
    $errors = array();
    if(!preg_match('/^[a-zA-Z\d_]{2,20}$/i', $data['username'])) {
        $errors[] = "Please enter a valid USERNAME";
    }
    if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid EMAIL";
    }

    //DOUBLE CHECK THIS SYNTAX!!!!!!!!!!!!!!!
    $query = "select * from users where email = :email limit 1";
    $email = array();
    $email['email'] = $data['email'];
    $result = execute_query($query, $email);
    if($result) {
        $errors[] = "That email is already in use";
    }

    if(strlen(trim($data['password'])) < 5) {
        $errors[] = "Password must be at least 5 characters long";
    }
    if(strlen(trim($data['password'])) > 50) {
        $errors[] = "Password must not be longer than 50 characters";
    }
    if($data['password'] != $data['password2']) {
        $errors[] = "Passwords must match";
    }
    if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{5,50}$/', $data['password'])) {
        $errors[] = "Password sequence invalid";
    }

    #save to database
    if(count($errors) == 0) {
        $arr['username'] = $data['username'];
        $arr['email'] =    $data['email'];
        $arr['password'] = hash('sha256', $data['password']);
        $arr['date'] = date("Y-m-d H:i:s");
        $query = "insert into users (username, email, password, date) 
        value(:username, :email, :password, :date)";
        #prepared statement
        execute_query($query, $arr);
    }

    return $errors;
}

function login($data) {
    $errors = array();

    if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid EMAIL";
    }

    #check
    if(count($errors) == 0) {
        $arr['email'] =    $data['email'];
        $password = hash('sha256', $data['password']);
        #prepared statements
        $query = "select * from users where email = :email limit 1";
        $row = execute_query($query, $arr);
        if(is_array($row)) {
            $row = $row[0];
            if($password === $row->password) {
                $_SESSION['USER'] = $row;
                $_SESSION['LOGGED_IN'] = true;
            }
            else {
                $errors[] = "That account does not exist";
            }
        }
        else {
            $errors[] = "That account does not exist";
        }
    }

    return $errors;
}

function execute_query($query, $variables = array()) {
    $server = "mysql:host=localhost;dbname=accounts_db;port=3307";
    $con = new PDO($server, 'root', 'lsyxgjrHZHGe556!');

    if(!$con) {
        return false;
    }

    $statement = $con -> prepare($query);
    $check = $statement -> execute($variables);

    if($check) {
        $data = $statement -> fetchAll(PDO::FETCH_OBJ);
        if(count($data) > 0) {
            return $data;
        }
    }
    return false;
}

function check_login($redirect = true) {
    if(isset($_SESSION['USER']) && isset($_SESSION['LOGGED_IN'])) {
        return true;
    }
    if($redirect) {
        header("Location: login.php");
        die;
    }
    else {
        return false;
    }
}

function check_verified() {
    $id = $_SESSION['USER']->id;
    $query = "select * from users where id = '$id' limit 1";
    $row = execute_query($query);

    if(is_array($row)) {
        $row = $row[0];
        #returns first item from $row, which is always an array
        if($row->email == $row->email_verified) {
            return true;
        }
    }
        return false;
}

function random_num($length) {
	$text = "";
    $minimum_cap = 5;   
    if ($length < $minimum_cap) {
        $length = $minimum_cap;
    }
	$len = rand(4,$length);
	for ($i=0; $i < $len; $i++) { 
		$text .= rand(0,9);
	}
	return $text;
}