<?php

session_start();
require_once("../../include/db_conn.php");

if (isset($_SESSION['user_id'])) {

    $product_user_id = $_SESSION['user_id'];

    $selectQuery = "SELECT * FROM products ORDER BY product_id DESC";
    $selectStmt = $conn->prepare($selectQuery);
    $selectStmt->execute();

    if ($selectStmt->rowCount() > 0) {

        $output = '
        <table class="table table-hover table-data">
            <thead class="thead-dark">
                <tr>
                    <th>Product Id</th>
                    <th>Product Image</th>
                    <th>Product Name</th>
                    <th>Product Description</th>
                    <th>Product Price</th>
                    <th>Product Date</th>
                    <th>Product Status</th>
                    <th colspan="2" class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>';

        // <th>Product End Time</th>

        while ($row = $selectStmt->fetch(PDO::FETCH_OBJ)) {

            $image_path = "./../images/product-image/" . $row->product_image;
            //<td class='img-fluid'>{'../images/product-image/' . $row->product_image}</td>
            $product_create_date = date("d-M-Y", strtotime($row->product_create_date));

            $output .= "
                <tr>
                    <td>{$row->product_id}</td>
                    <td><img src='{$image_path}' width='100px' height='50px'></td>
                    <td>{$row->product_name}</td>
                    <td>{$row->product_desc}</td>
                    <td>{$row->product_price}</td>
                    <td>{$product_create_date}</td>
                    <td>{$row->product_status}</td>
                    <td class='pr-1'>
                        <button class='btn btn-sm btn-primary edit_btn' data-id='{$row->product_id}'><span class='fas fa-edit mr-2'></span>Edit</button>
                    </td>
                    <td class='pl-1'>
                        <button class='btn btn-sm btn-danger delete_btn' data-id='{$row->product_id}'><span class='fas fa-trash-alt mr-2'></span>Delete</button>
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
        // <td>{$row->product_end_time}</td>