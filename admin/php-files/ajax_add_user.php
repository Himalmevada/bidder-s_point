<?php

require_once("../../include/db_conn.php");

$username = $_POST['username'];
$user_email = $_POST['user_email'];
$user_image = $_FILES['user_image'];
$user_password = $_POST['user_password'];
$user_role = $_POST['user_role'];
$user_phone = $_POST['user_phone'];

$select_query = "SELECT * FROM users";
$select_stmt = $conn->prepare($select_query);
$result = $select_stmt->execute();

if (!$result) {
    echo "0";
} else {

    $taken_username = "";

    while ($row = $select_stmt->fetch(PDO::FETCH_ASSOC)) {
        $taken_username = $row['username'];
        if ($taken_username == $username) {
            $taken_username = "taken";
            break;
        }
    }
}

if ($taken_username == "taken") {
    echo "taken";
} else {

    $user_image_name = $_FILES['user_image']['name'];
    $hash_password = password_hash($user_password, PASSWORD_BCRYPT);

    // INSERT DATA IN DATABASE -------->

    // if ($user_image_name == "") {

    //     $insertQuery = "INSERT INTO users(username, user_password, user_email, user_phone, user_role) VALUES(?,?,?,?,?)";
    //     $insertStmt = $conn->prepare($insertQuery);
    //     $result = $insertStmt->execute([$username, $hash_password, $user_email, $user_phone, $user_role]);

    //     if ($result) {
    //         echo "1";
    //     } else {
    //         echo "0";
    //     }
    // } else {

    $user_image = $_FILES['user_image'];
    $user_image_name = $_FILES['user_image']['name'];
    $img_temp_name = $_FILES['user_image']['tmp_name'];
    $img_extension = pathinfo($user_image_name, PATHINFO_EXTENSION);
    $valid_extension = ['jpg', 'jpeg', 'png'];
    $img_size = $_FILES['user_image']['size'];

    $isValidType = in_array($img_extension, $valid_extension);

    if ($isValidType && $img_size < 5242880) {

        $image_path = "./../images/user-image/" . $user_image_name;

        move_uploaded_file($img_temp_name, $image_path);

        $insert_query = "INSERT INTO users(username, user_password, user_email, user_phone, user_image, user_role) VALUES(?,?,?,?,?,?)";
        $insert_stmt = $conn->prepare($insert_query);
        $result = $insert_stmt->execute([$username, $hash_password, $user_email, $user_phone, $user_image_name, $user_role]);

        if ($result) {
            echo "1";
        } else {
            echo "0";
        }
    } else {
        echo "invalid";
    }
    // }
}