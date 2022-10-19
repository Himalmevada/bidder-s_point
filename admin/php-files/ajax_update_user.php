<?php

ob_start();
session_start();

require_once("../../include/db_conn.php");

// echo "error_message('All fields are required.')";

if (isset($_POST['user_id'])) {

    $user_id = $_POST['user_id'];
    $user_email = $_POST['update_user_email'];
    $user_password = $_POST['update_user_password'];
    $user_phone = $_POST['update_user_phone'];

    if ($_POST['update_user_password'] == "") {

        $query = "SELECT * FROM users WHERE user_id = ?";
        $queryStmt = $conn->prepare($query);
        $result = $queryStmt->execute([$user_id]);

        while ($row = $queryStmt->fetch(PDO::FETCH_OBJ)) {
            $old_user_password = $row->user_password;
        }

        $new_user_password = $old_user_password;
    } else {

        $new_user_password = password_hash($user_password, PASSWORD_BCRYPT);
    }

    $user_image_name = $_FILES['update_user_image']['name'];

    // UPDATE USER DATA IN DATABASE -------->


    if ($user_image_name == "") {

        $insertQuery = "UPDATE users SET user_password = ?, user_email = ?, user_phone = ? WHERE user_id = ?";
        $insertStmt = $conn->prepare($insertQuery);
        $result = $insertStmt->execute([$new_user_password, $user_email, $user_phone, $user_id]);

        if ($result) {

            $_SESSION['user_email'] = $user_email;

            echo "1";
        } else {
            echo "0";
        }
    } else {

        $user_image = $_FILES['update_user_image'];
        $user_image_name = $_FILES['update_user_image']['name'];
        $img_temp_name = $_FILES['update_user_image']['tmp_name'];
        $img_extension = pathinfo($user_image_name, PATHINFO_EXTENSION);
        $valid_extension = ['jpg', 'jpeg', 'png'];
        $img_size = $_FILES['update_user_image']['size'];

        $isValidType = in_array($img_extension, $valid_extension);

        if ($isValidType && $img_size < 2097152) {

            // $new_name = rand() . "." . $img_extension;
            // $image_path = "../../images/" . $new_name;
            // $path = "images/" . $new_name;

            $image_path = "./../images/user-image/" . $user_image_name;

            move_uploaded_file($img_temp_name, $image_path);

            $insertQuery = "UPDATE users SET user_password = ?, user_email = ?, user_phone = ?, user_image = ? WHERE user_id = ?";
            $insertStmt = $conn->prepare($insertQuery);
            $result = $insertStmt->execute([$new_user_password, $user_email, $user_phone, $user_image_name, $user_id]);

            if ($result) {

                $_SESSION['user_email'] = $user_email;
                $_SESSION['user_image'] = $user_image_name;

                echo "1";
            } else {
                echo "0";
            }
        } else {
            echo "invalid";
        }
    }
}