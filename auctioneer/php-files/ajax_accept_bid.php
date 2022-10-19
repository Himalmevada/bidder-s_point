<?php

session_start();

require_once("../../include/db_conn.php");

$bid_product_id = $_POST['bid_product_id'];
$bid_user_id = $_POST['bid_user_id'];

// DELETE DATA IN DATABASE -------->

$delete_query = "DELETE FROM bids WHERE bid_product_id = ? AND bid_user_id NOT IN (?)";
$delete_stmt = $conn->prepare($delete_query);
$result = $delete_stmt->execute([$bid_product_id, $bid_user_id]);

$delete_query = "UPDATE products SET product_status = ? WHERE product_id = ?";
$delete_stmt = $conn->prepare($delete_query);
$result = $delete_stmt->execute(["disabled", $bid_product_id]);

$delete_query = "UPDATE products SET winner = ? WHERE product_id = ?";
$delete_stmt = $conn->prepare($delete_query);
$result = $delete_stmt->execute([$bid_user_id, $bid_product_id]);

if ($result) {
    echo "1";
} else {
    echo "0";
}