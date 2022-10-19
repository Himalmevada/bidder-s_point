<?php

session_start();

require_once("../../include/db_conn.php");

if (isset($_POST['user_id'])) {

    $user_id = $_POST['user_id'];

    $deleteQuery = "DELETE FROM users WHERE user_id = ?";
    $deleteStmt = $conn->prepare($deleteQuery);
    $result = $deleteStmt->execute([$user_id]);

    if ($result) {
        echo 1;
    } else {
        echo 0;
    }
}