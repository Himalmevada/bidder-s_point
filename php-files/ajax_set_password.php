<?php

require_once("../include/db_conn.php");

if (isset($_POST['selector']) && isset($_POST['token_validator']) && isset($_POST['password'])) {

    $selector = $_POST['selector'];
    $token_validator = $_POST['token_validator'];
    $password = $_POST['password'];
    // $confirm_password = $_POST['confirm_password'];

    $current_date = date("U");

    $selectPwd = "SELECT * FROM pwd_reset WHERE pwd_reset_selector = ? AND pwd_reset_expires >= ?";
    $selectPwdStmt = $conn->prepare($selectPwd);
    $result = $selectPwdStmt->execute([$selector, $current_date]);

    if (!$result) {
        echo "0";
        exit();
    }

    $row = $selectPwdStmt->fetch(PDO::FETCH_OBJ);

    if ($selectPwdStmt->rowCount() == 0) {
        echo "expire";
        exit();
    } else {

        $tokenBin = hex2bin($token_validator);
        $tokenCheck = password_verify($tokenBin, $row->pwd_reset_token);

        if ($tokenCheck === false) {
            echo "expire";
            exit();
        } else if ($tokenCheck === true) {
            $tokenEmail = $row->pwd_reset_email;
            $new_password_hash = password_hash($password, PASSWORD_DEFAULT);

            $updatePwd = "UPDATE users SET user_password=? WHERE user_email=?";
            $updatePwdStmt = $conn->prepare($updatePwd);
            $result = $updatePwdStmt->execute([$new_password_hash, $tokenEmail]);

            if (!$result) {
                echo "0";
                exit();
            }
        }

        $deleteEmail = "DELETE FROM pwd_reset WHERE pwd_reset_email = ?";
        $deleteEmailStmt = $conn->prepare($deleteEmail);
        $result = $deleteEmailStmt->execute([$tokenEmail]);

        if (!$result) {
            echo "0";
            exit();
        } else {
            echo "1";
        }
    }
}