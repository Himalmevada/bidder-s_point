<?php

session_start();

require_once("../../include/db_conn.php");

if (isset($_POST['product_id'])) {

    $product_id = $_POST['product_id'];
    $user_id = $_SESSION['user_id'];

    $deleteQuery = "DELETE FROM products WHERE product_id = ? AND product_user_id = ?";
    $deleteStmt = $conn->prepare($deleteQuery);
    $result = $deleteStmt->execute([$product_id, $user_id]);

    if ($result) {
        echo 1;
    } else {
        echo 0;
    }
}