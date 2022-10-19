<?php

session_start();
require_once("../../include/db_conn.php");

if (isset($_POST['product_id']) || $_SESSION['user_id']) {

    $product_id = $_POST['product_id'];

    $selectProduct = "SELECT * FROM products WHERE product_id = ?";
    $selectProductStmt = $conn->prepare($selectProduct);
    $result = $selectProductStmt->execute([$product_id]);

    $output = "";

    if ($result) {

        while ($row = $selectProductStmt->fetch(PDO::FETCH_OBJ)) {

            $image_path = "./../images/product-image/" . $row->product_image;

            $output .= "<div class='modal fade pr-0 pr-md-1' id='update-product-form' tabindex='-1' role='dialog' aria-labelledby='modal-form'
                    aria-hidden='true'>
                    <div class='modal-dialog modal-lg modal-dialog-centered' role='document'>
                        <div class='modal-content'>
                            <div class='modal-header d-flex align-items-center'>
                                <h2 class='h5 modal-title'>Product Update Detail</h2>
                                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button>
                            </div>
                            <div class='modal-body p-2'>
                                <div class='card border-light border-0'>
                                    <div class='card-body'>
                                        <!-- Form -->
                                        <form id='update_product_form' method='POST' name='update_product_form'>
                                            <div class='row'>

                                                <div class='form-group mb-4 col-lg'>
                                                    <label for='edit_product_name'>Product
                                                        Name</label>
                                                    <div class='input-group'>
                                                        <input type='text' id='edit_product_name' name='edit_product_name'
                                                            class='form-control' value='{$row->product_name}'>
                                                    </div>
                                                </div>

                                                
                                                </div>

                                            <div class='form-group mb-4'>
                                                <label for='edit_product_desc'>Product
                                                    Description</label>
                                                <div class='input-group'>
                                                    <input type='text' id='edit_product_desc' name='edit_product_desc'
                                                        class='form-control' value='{$row->product_desc}'>
                                                </div>
                                            </div>

                                            <div class='row'>

                                            <div class='form-group mb-4 col-lg-6'>
                                                    <label for='edit_product_price'>Product Price</label>
                                                    <div class='input-group'>
                                                    <input type='number' id='edit_product_price' name='edit_product_price'
                                                    class='form-control' value='{$row->product_price}'>
                                                    </div>
                                                    </div>
                                                    
                                                <div class='form-group col-lg-6'>
                                                    <label for='edit_product_image'>Product Image </label> <span
                                                        class='font-small font-weight-bold text-muted'>(Type : PNG, JPG,
                                                        JPEG)(Size : 10mb)</span>
                                                    <div class='input-group'>
                                                        <input type='file' id='edit_product_image' name='edit_product_image'
                                                            class='form-control'>
                                                    </div>
                                                </div>

                                            </div>
                                            
                                            <div class='mb-4 mt-4 mt-lg-0' id='show_image'>
                                                <img class='img-fluid' width='350px' src='{$image_path}'>
                                            </div> 
                                             

                                            <div id='product_button'>
                                            <button type='submit' data-id='{$product_id}' id='update_product_btn' class='btn btn-primary'>Update
                                                    Product</button>
                                                <button type='button' class='btn btn-link text-danger ml-2'
                                                    data-dismiss='modal'>Close</button>
                                            </div>
                                            
                                            </form>
                                            </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>";
        }
        echo $output;
    } else {
        echo "0";
    }

    // if ($result) {
    //     $output = $selectProductStmt->fetchAll(PDO::FETCH_ASSOC);
    //     echo json_encode($output);
    // } else {
    //     echo "0";
    // }

}
// <div class='form-group mb-4 col-lg-6'>
//     <label for='edit_product_end_time'>Product
//         end time <small class='text-muted'>(Hour)</small></label>
//     <div class='input-group'>
//         <input type='number' id='edit_product_end_time'
//             name='edit_product_end_time' class='form-control'
//             value='{$row->product_end_time}'>
//     </div>
// </div>