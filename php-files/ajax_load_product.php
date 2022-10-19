<?php

require_once("../include/db_conn.php");

$select_user_query = "SELECT * FROM products WHERE product_status = 'active'";
$select_user_stmt = $conn->prepare($select_user_query);
$result = $select_user_stmt->execute();

if ($select_user_stmt->rowCount() > 0) {

    while ($row = $select_user_stmt->fetch(PDO::FETCH_OBJ)) {
        echo "<div class='col-md-4 col-lg-3 mb-5'>
                    <div class='card h-100'>
                        <img class='card-img-top' src='./images/product-image/{$row->product_image}' alt='product_image'>
                        <div class='card-body p-4'>
                            <div class='text-black'>
                                <h5 class='font-weight-bolder'>$row->product_name</h5>
                                <div>
                                    <span class='font-weight-bolder'>Starting bid :</span>
                                    <span class='font-weight-bold text-gray'>$row->product_price <i class='fas fa-rupee-sign'></i></span>
                                </div>
                            </div>
                        </div>
                        <div class='card-footer p-4 pt-0 border-top-0 bg-transparent'>
                            <div><a href='./product.php?p_id={$row->product_id}' id='bid_btn' class='btn btn-gray mt-auto' data-id='$row->product_id'>Add
                                    Bid</a>
                            </div>
                        </div>
                    </div>
                </div>";
    }
} else {
    echo "<h2 class='text-info'>There is no data.<h2>";
}