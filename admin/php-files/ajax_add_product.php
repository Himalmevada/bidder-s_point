<?php

session_start();

require_once("../../include/db_conn.php");

$product_name = $_POST['product_name'];
$product_desc = $_POST['product_desc'];
$product_price = $_POST['product_price'];
$product_create_date = date("Y/m/d");
// $product_end_time = $_POST['product_end_time'];
$product_status = 'active';
$user_id = $_SESSION['user_id'];

// INSERT DATA IN DATABASE -------->

$product_image = $_FILES['product_image'];
$product_image_name = $_FILES['product_image']['name'];
$img_temp_name = $_FILES['product_image']['tmp_name'];
$img_extension = pathinfo($product_image_name, PATHINFO_EXTENSION);
$valid_extension = ['jpg', 'jpeg', 'png'];
$img_size = $_FILES['product_image']['size'];

$isValidType = in_array($img_extension, $valid_extension);

if ($isValidType && $img_size < 5242880) {

    // $new_name = rand() . "." . $img_extension;
    // $image_path = "../../images/" . $new_name;
    // $path = "images/" . $new_name;

    $image_path = "./../../images/product-image/" . $product_image_name;

    $image_upload = move_uploaded_file($img_temp_name, $image_path);

    $insertQuery = "INSERT INTO products(product_name, product_desc, product_price, product_image, product_create_date, product_status, product_user_id) VALUES(?,?,?,?,?,?,?)";
    $insertStmt = $conn->prepare($insertQuery);
    $result = $insertStmt->execute([$product_name, $product_desc, $product_price, $product_image_name, $product_create_date, $product_status, $user_id]);

    if ($result) {
        echo "1";
    } else {
        echo "0";
    }
} else {
    echo "invalid";
}