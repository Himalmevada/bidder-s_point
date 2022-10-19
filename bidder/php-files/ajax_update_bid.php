<?php

require_once("../../include/db_conn.php");

if (isset($_POST['bid_id'])) {

    $bid_id = $_POST['bid_id'];
    $edit_bid_amount = $_POST['edit_bid_amount'];

    $update_bid_query = "UPDATE bids SET bid_amount = ? WHERE bid_id = ?";
    $update_bid_stmt = $conn->prepare($update_bid_query);
    $result = $update_bid_stmt->execute([$edit_bid_amount, $bid_id]);

    if ($result) {
        echo "1";
    } else {
        echo "0";
    }
}