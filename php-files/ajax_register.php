<?php

require_once("../include/db_conn.php");

if (isset($_POST['user_email']) && isset($_POST['user_password'])) {

    $username = $_POST['username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    $user_role = $_POST['user_role'];
    $user_phone = $_POST['user_phone'];

    $select_query = "SELECT * FROM users";
    $select_stmt = $conn->prepare($select_query);
    $result = $select_stmt->execute();

    if (!$result) {
        echo "0";
    } else {

        $taken_username = "";

        while ($row = $select_stmt->fetch(PDO::FETCH_ASSOC)) {
            $taken_username = $row['username'];
            if ($taken_username == $username) {
                $taken_username = "taken";
                break;
            }
        }
    }

    if ($taken_username == "taken") {
        echo "taken";
    } else {

        $hash_password = password_hash($user_password, PASSWORD_BCRYPT);

        $register_query = "INSERT INTO users(username, user_password, user_email, user_phone, user_role) VALUES(?,?,?,?,?)";
        $register_query_stmt = $conn->prepare($register_query);
        $result = $register_query_stmt->execute([$username, $hash_password, $user_email, $user_phone, $user_role]);

        if ($result) {
            echo "1";
        } else {
            echo "0";
        }
    }
}