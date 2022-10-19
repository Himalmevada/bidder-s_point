<?php

session_start();
require_once("../include/db_conn.php");
// require_once("../include/bidder_header.php");

if (isset($_POST['bid_product_id']) && isset($_SESSION['user_role']) && ($_SESSION['user_role'] == "bidder" || $_SESSION['user_role'] == "admin")) {

    $bid_product_id = $_POST['bid_product_id'];
    $bid_user_id = $_SESSION['user_id'];
    $bid_amount = $_POST['bid_amount'];
    $bid_date = date("Y/m/d");

    $check_query = "SELECT * FROM bids WHERE bid_product_id = ? AND bid_user_id = ?";
    $check_stmt = $conn->prepare($check_query);
    $check_result = $check_stmt->execute([$bid_product_id, $bid_user_id]);

    if ($check_stmt->rowCount() > 0) {
        echo "given";
    } else {

        $product_query = "SELECT * FROM products";
        $product_stmt = $conn->prepare($product_query);
        $result = $product_stmt->execute();

        while ($pr_row = $product_stmt->fetch(PDO::FETCH_OBJ)) {
            $pr_id = $pr_row->product_id;

            if ($bid_product_id == $pr_id) {
                $pr_user_id = $pr_row->product_user_id;
            }
        }

        $add_bid_query = "INSERT INTO bids(bid_amount, bid_product_id, bid_user_id, bid_date) VALUES(?,?,?,?)";
        $add_bid_stmt = $conn->prepare($add_bid_query);
        $result = $add_bid_stmt->execute([$bid_amount, $bid_product_id, $bid_user_id, $bid_date]);

        if ($result) {
            echo "1";
        } else {
            echo "0";
        }
    }
}