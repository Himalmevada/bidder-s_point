<?php

require_once("../include/db_conn.php");

ob_start();
session_start();

if (isset($_POST['user_email']) && isset($_POST['user_password'])) {

    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];

    $select_user_query = "SELECT * FROM users WHERE user_email = ?";
    $select_user_stmt = $conn->prepare($select_user_query);
    $result = $select_user_stmt->execute([$user_email]);

    $db_user_email = "";
    $db_user_password = "";

    if ($select_user_stmt->rowCount() > 0) {

        while ($row = $select_user_stmt->fetch(PDO::FETCH_ASSOC)) {
            $db_user_id = $row['user_id'];
            $db_username = $row['username'];
            $db_user_email = $row['user_email'];
            $db_user_password = $row['user_password'];
            $db_user_image = $row['user_image'];
            $db_user_role = $row['user_role'];
        }

        $password_check = password_verify($user_password, $db_user_password);

        // if ($db_user_email === $user_email) {
        if ($db_user_email === $user_email && $password_check) {

            $_SESSION['user_id'] = $db_user_id;
            $_SESSION['username'] = $db_username;
            $_SESSION['user_email'] = $db_user_email;
            $_SESSION['user_image'] = $db_user_image;
            $_SESSION['user_role'] = $db_user_role;
            $_SESSION['session_time'] = time();

            setcookie('user_email', $db_user_email, time() + 7200, "/");
            setcookie('user_password', $user_password, time() + 7200, "/");

            // AUCTIONEER AND BIDDER LOGIN CONDITION.
            echo $db_user_role;
        } else {
            echo "invalid";
        }
    } else {
        echo "no_user";
    }
}