<?php

require_once("../include/db_conn.php");

if (isset($_POST['email']) && !empty($_POST['email']) && !empty($_POST['message'])) {

    $to = "bidderspoint@gmail.com";
    $subject = "Query";
    $message = $_POST['message'];
    $headers = "From:" . $_POST['email'];

    if (mail($to, $subject, $message, $headers)) {
        echo "1";
    } else {
        echo "0";
    }
}