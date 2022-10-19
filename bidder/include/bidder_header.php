<?php ob_start() ?>
<?php session_start() ?>

<?php

if (isset($_SESSION['username']) && isset($_SESSION['user_role']) && $_SESSION['user_role'] == "bidder") {
    if ((time() - $_SESSION['session_time']) > 1200) {  //after 20 minute user will automatically logout.
        header("Location: ../include/logout.php");
    }
} else {
    header("Location: ../index.php");
}

?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- Primary Meta Tags -->
    <title>bidder Dashboard</title>

    <!-- Fontawesome -->
    <link type="text/css" href="../vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" />

    <!-- Notyf -->
    <link type="text/css" href="../vendor/notyf/notyf.min.css" rel="stylesheet" />

    <!-- Volt CSS -->
    <link type="text/css" href="../css/volt.css" rel="stylesheet" />
    <!-- <link type="text/css" href="../css/bootstrap.min.css" rel="stylesheet" /> -->
    <!-- <link type="text/css" href="../css/dataTables-bootstrap5.min.css" rel="stylesheet" /> -->

</head>

<body>