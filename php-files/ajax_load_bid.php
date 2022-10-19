<?php

session_start();
require_once("../include/db_conn.php");

if (isset($_POST['bid_product_id'])) {

    // $user_id = $_SESSION['user_id'];
    $bid_product_id = $_POST['bid_product_id'];
    // $bid_product_id = 17;

    $select_bid_query = "SELECT * FROM bids WHERE bid_product_id = ?";
    $select_bid_stmt = $conn->prepare($select_bid_query);
    $bid_result = $select_bid_stmt->execute([$bid_product_id]);


    if ($select_bid_stmt->rowCount() > 0) {

        $output = '
            <table class="table table-hover table-dark">
                <thead class="thead-dark">
                    <tr>
                        <th>Bidder Name</th>
                        <th>Bid Amount</th>
                        <th>Bid Date</th>
                    </tr>
                </thead>
                <tbody>';

        while ($row = $select_bid_stmt->fetch(PDO::FETCH_OBJ)) {

            $bid_user_id =  $row->bid_user_id;
            $bid_date =  date("d-M-Y", strtotime($row->bid_date));

            $select_user_query = "SELECT * FROM users WHERE user_id = ?";
            $select_user_stmt = $conn->prepare($select_user_query);
            $user_result = $select_user_stmt->execute([$bid_user_id]);

            while ($user_data = $select_user_stmt->fetch(PDO::FETCH_OBJ)) {
                $username = $user_data->username;
            }

            $output .= "
            <tr class='text-soft'>    
                <td>$username</td>
                <td>$row->bid_amount <i class='fas fa-rupee-sign'></i></td>
                <td>$bid_date</td>
            </tr>";
        }

        $output .= "
            </tbody>
        </table>";

        echo $output;
    } else {
        echo "no_data";
    }
}