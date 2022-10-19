<?php

require_once("../include/db_conn.php");

session_start();

if (isset($_SESSION['username']) && isset($_SESSION['user_role']) && ($_SESSION['user_role'] == "bidder" || $_SESSION['user_role'] == "admin")) {
    echo "1";
} else {
    echo "0";
}