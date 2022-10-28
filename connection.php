<?php

$dbhost = "localhost";
$dbuser = "root";           #default user
$dbpass = "lsyxgjrHZHGe556!";
$dbname = "accounts_db";

if(!$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname, 3307))
{
    die("<- Failed to connect to database ->");
}