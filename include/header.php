<?php require_once("include/db_conn.php") ?>

<?php

ob_start();
session_start();

if (isset($_SESSION['username']) && isset($_SESSION['user_role']) && $_SESSION['user_role'] == "bidder") {
    if ((time() - $_SESSION['session_time']) > 1200) {  //after 20 minute user will automatically logout.
        header("Location: ./include/logout.php");
    }
}

?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- Primary Meta Tags -->
    <title>Bidder's Point</title>

    <!-- Fontawesome -->
    <link type="text/css" href="./vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" />

    <!-- Notyf -->
    <link type="text/css" href="./vendor/notyf/notyf.min.css" rel="stylesheet" />

    <link type="text/css" href="./css/volt.css" rel="stylesheet" />

    <style>
    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }
    </style>

</head>

<body>