<?php

session_start();

require_once("../../include/db_conn.php");

// echo "error_message('All fields are required.')";

if (isset($_POST['product_id'])) {


    $user_id = $_SESSION['user_id'];
    $product_name = $_POST['edit_product_name'];
    $product_desc = $_POST['edit_product_desc'];
    $product_price = $_POST['edit_product_price'];
    // $product_end_time = $_POST['edit_product_end_time'];

    $user_id = $_SESSION['user_id'];
    $product_id = $_POST['product_id'];

    // print_r($_FILES['edit_product_image']);

    $product_image_name = $_FILES['edit_product_image']['name'];

    // INSERT DATA IN DATABASE -------->

    if ($product_image_name == "") {

        $insertQuery = "UPDATE products SET product_name = ?, product_desc = ?, product_price = ? WHERE product_id = ? AND product_user_id = ?";
        $insertStmt = $conn->prepare($insertQuery);
        $result = $insertStmt->execute([$product_name, $product_desc, $product_price, $product_id, $user_id]);

        if ($result) {
            echo "1";
        } else {
            echo "0";
        }
    } else {

        $product_image = $_FILES['edit_product_image'];
        $product_image_name = $_FILES['edit_product_image']['name'];
        $img_temp_name = $_FILES['edit_product_image']['tmp_name'];
        $img_extension = pathinfo($product_image_name, PATHINFO_EXTENSION);
        $valid_extension = ['jpg', 'jpeg', 'png'];
        $img_size = $_FILES['edit_product_image']['size'];

        $isValidType = in_array($img_extension, $valid_extension);

        if ($isValidType && $img_size < 5242880) {

            // $new_name = rand() . "." . $img_extension;
            // $image_path = "../../images/" . $new_name;
            // $path = "images/" . $new_name;

            $image_path = "./../../images/product-image/" . $product_image_name;

            move_uploaded_file($img_temp_name, $image_path);

            $insertQuery = "UPDATE products SET product_name = ?, product_desc = ?, product_price = ?, product_image = ? WHERE product_id = ? AND product_user_id = ?";
            $insertStmt = $conn->prepare($insertQuery);
            $result = $insertStmt->execute([$product_name, $product_desc, $product_price, $product_image_name, $product_id, $user_id]);

            if ($result) {
                echo "1";
            } else {
                echo "0";
            }
        } else {
            echo "invalid";
        }
    }
}