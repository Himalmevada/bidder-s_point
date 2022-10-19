<?php

require_once("../include/db_conn.php");

if (isset($_COOKIE['user_email']) && isset($_COOKIE['user_password'])) {
    echo $_COOKIE['user_email'] . "," . $_COOKIE['user_password'];
}