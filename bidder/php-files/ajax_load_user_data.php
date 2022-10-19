<?php

session_start();
require_once("../../include/db_conn.php");

if (isset($_SESSION['user_id'])) {

    $user_id = $_SESSION['user_id'];
    $selectQuery = "SELECT * FROM users WHERE user_id = ?";
    $selectStmt = $conn->prepare($selectQuery);
    $result = $selectStmt->execute([$user_id]);

    if ($selectStmt->rowCount() > 0 && $result) {
        $output = $row = $selectStmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($output);
    } else {
        "0";
    }
}