<?php

$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "auction";

// DEFINE('DB_HOST',$db['db_host']);
// DEFINE('DB_USER',$db['db_user']);
// DEFINE('DB_PASS',$db['db_pass']);
// DEFINE('DB_NAME',$db['db_name']);

$conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);

if (!$conn) {
    die("Connection not established");
}