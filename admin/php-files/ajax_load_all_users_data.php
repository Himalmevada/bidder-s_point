<?php

session_start();
require_once("../../include/db_conn.php");

if (isset($_SESSION['user_id'])) {

    $product_user_id = $_SESSION['user_id'];

    $selectQuery = "SELECT * FROM users";
    $selectStmt = $conn->prepare($selectQuery);
    $selectStmt->execute();

    if ($selectStmt->rowCount() > 0) {

        $output = '
        <table class="table table-hover table-data">
            <thead class="thead-dark">
                <tr>
                    <th>User Id</th>
                    <th>User Image</th>
                    <th>User Name</th>
                    <th>User Email</th>
                    <th>User Phone</th>
                    <th colspan="2" class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>';

        while ($row = $selectStmt->fetch(PDO::FETCH_OBJ)) {

            $image_path = "images/user-image/" . $row->user_image;

            $output .= "
                <tr>
                    <td>{$row->user_id}</td>
                    <td><img class='rounded rounded-3' src='{$image_path}' width='70px' height='60px'></td>
                    <td>{$row->username}</td>
                    <td>{$row->user_email}</td>
                    <td>{$row->user_phone}</td>
                    <td class='pr-1'>
                        <button class='btn btn-sm btn-primary edit_user_btn' data-id='{$row->user_id}'><span class='fas fa-edit mr-2'></span>Edit</button>
                    </td>
                    <td class='pr-1'>
                        <button class='btn btn-sm btn-danger delete_user_btn' data-id='{$row->user_id}'><span class='fas fa-edit mr-2'></span>Delete</button>
                    </td>
                </tr>";
        }
        $output .= "
            </tbody>
        </table>";

        echo $output;
    } else {
        echo "There is no data.";
    }
}
// <td class='pl-1'>
//     <button class='btn btn-danger delete_btn' data-id='{$row->product_id}'><span class='fas fa-trash-alt mr-2'></span>Delete</button>
// </td>