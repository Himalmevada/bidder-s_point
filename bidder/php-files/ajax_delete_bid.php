<?php

session_start();

require_once("../../include/db_conn.php");

if (isset($_POST['bid_id'])) {

    $bid_id = $_POST['bid_id'];

    $deleteQuery = "DELETE FROM bids WHERE bid_id = ?";
    $deleteStmt = $conn->prepare($deleteQuery);
    $result = $deleteStmt->execute([$bid_id]);

    if ($result) {
        echo 1;
    } else {
        echo 0;
    }
}