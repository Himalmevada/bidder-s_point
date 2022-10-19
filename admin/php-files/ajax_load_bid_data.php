<?php

session_start();

require_once("../../include/db_conn.php");

if (isset($_SESSION["user_id"])) {

    $data = false;
    $user_id = $_SESSION["user_id"];

    $select_bid_query = "SELECT * FROM bids";
    $select_bid_stmt = $conn->prepare($select_bid_query);
    $bid_result = $select_bid_stmt->execute();

    if ($select_bid_stmt->rowCount() > 0) {

        $output = '
                <table class="table table-hover table-white">
                    <thead class="thead-dark">
                        <tr>
                            <th>Product Id</th>
                            <th>Product Image</th>
                            <th>Product Name</th>
                            <th>Auctioneer Name</th>
                            <th>Bidder Name</th>
                            <th>Product Amount</th>
                            <th>Bid Amount</th>
                            <th>Bid Date</th>
                            <th class="text-center" colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tbody>';

        while ($row = $select_bid_stmt->fetch(PDO::FETCH_OBJ)) {

            $bid_id =  $row->bid_id;
            $bid_product_id =  $row->bid_product_id;
            $bid_user_id =  $row->bid_user_id;
            $bid_date =  date("d-M-Y", strtotime($row->bid_date));;

            $select_user_query = "SELECT * FROM users WHERE user_id = ?";
            $select_user_stmt = $conn->prepare($select_user_query);
            $user_result = $select_user_stmt->execute([$bid_user_id]);

            while ($user_data = $select_user_stmt->fetch(PDO::FETCH_OBJ)) {
                $bidder_name = $user_data->username;
            }

            $select_product_query = "SELECT * FROM products WHERE product_id = ? AND !winner > 0";
            $select_product_stmt = $conn->prepare($select_product_query);
            $product_result = $select_product_stmt->execute([$bid_product_id]);

            if ($select_product_stmt->rowCount() > 0) {

                while ($product_data = $select_product_stmt->fetch(PDO::FETCH_OBJ)) {
                    $product_id = $product_data->product_id;
                    $product_name = $product_data->product_name;
                    $product_price = $product_data->product_price;
                    $image_path = "./../images/product-image/" . $product_data->product_image;
                    $product_user_id = $product_data->product_user_id;
                };

                $select_user_query = "SELECT * FROM users WHERE user_id = ?";
                $select_user_stmt = $conn->prepare($select_user_query);
                $user_result = $select_user_stmt->execute([$product_user_id]);

                while ($user_data = $select_user_stmt->fetch(PDO::FETCH_OBJ)) {
                    $auctioneer_name = $user_data->username;
                }

                $output .= "
                    <tr>    
                        <td>$product_id</td>
                        <td><img src='$image_path' width='100px' height='50px'></td>
                        <td>$product_name</td>
                        <td>$auctioneer_name</td>
                        <td>$bidder_name</td>
                        <td>$product_price <i class='fas fa-rupee-sign'></i></td>
                        <td>$row->bid_amount <i class='fas fa-rupee-sign'></i></td>
                        <td>$bid_date</td>";
                if (isset($_POST['opt'])) {
                    $output .= "
                    <td class='pr-1'>
                        <button class='btn btn-sm btn-primary edit_bid_btn' data-bidid='{$bid_id}' data-price='{$product_price}'><span class='fas fa-edit mr-2'></span>Edit Bid</button>
                    </td>
                    <td class='pl-1'>
                        <button class='btn btn-sm btn-danger delete_bid_btn' data-bidid='{$bid_id}'><span class='fas fa-trash-alt mr-2'></span>Delete Bid</button>
                    </td>
                    </tr>";
                } else {
                    $output .= "
                    <td class='pr-1'>
                        <button class='btn btn-sm btn-tertiary accept_bid_btn' data-userid='{$bid_user_id}' data-id='{$product_id}'><span class='fas fa-check mr-2'></span>Accept Bid</button>
                    </td>
                    <td class='pl-1'>
                        <button class='btn btn-sm btn-info bidder_details_btn' data-userid='{$bid_user_id}'><span class='fas fa-eye mr-2'></span>Bidder Details</button>
                    </td>
                    </tr>";
                }
                $data = true;
            }
        }

        $output .= "
            </tbody>
            </table>";
        // echo $output;

        if (!$data) {
            echo "There is no data.";
        } else {
            echo $output;
        }
    }
}