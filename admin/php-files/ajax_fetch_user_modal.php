<?php

session_start();
require_once("../../include/db_conn.php");

if (isset($_POST['user_id'])) {

    $user_id  = $_POST['user_id'];

    $select_user = "SELECT * FROM users WHERE user_id = ?";
    $select_user_stmt = $conn->prepare($select_user);
    $result = $select_user_stmt->execute([$user_id]);

    $output = "";

    if ($result) {

        while ($row = $select_user_stmt->fetch(PDO::FETCH_OBJ)) {

            $image_path = "./../images/user-image/" . $row->user_image;

            $output .= "
            <div class='modal fade pr-0 pr-md-1' id='update-user-form' tabindex='-1' role='dialog' aria-labelledby='modal-form'
                    aria-hidden='true'>  
                <div class='modal-dialog modal-md modal-dialog-centered' role='document'>
                    <div class='modal-content'>
                        <div class='modal-header d-flex align-items-center'>
                            <h2 class='h5 modal-title'>User Update Detail</h2>
                            <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>
                        <div class='modal-body p-2'>
                            <div class='card border-light border-0'>
                                <div class='card-body'>
                                    <!-- Form -->
                                    <form id='update_user_form' method='POST' name='update_user_form'>
                                        
                                        <div class='mb-3'>
                                            <div>
                                                <label for='update_username'>Username</label>
                                                <input type='text' class='form-control' id='update_username'
                                                    name='update_username' value='{$row->username}' readonly>
                                            </div>
                                        </div>

                                        <div class='mb-3'>
                                            <div class='form-group'>
                                                <label for='update_user_email'>Email</label>
                                                <input type='email' class='form-control' id='update_user_email'
                                                    name='update_user_email' value='{$row->user_email}'>
                                            </div>
                                        </div>

                                        <div class='mb-3'>
                                            <div class='form-group'>
                                                <label for='update_user_image'>User Image</label> <span
                                                    class='font-small font-weight-bold text-muted'>(Type : PNG, JPG,
                                                    JPEG) (Size : 2mb)</span>
                                                <input type='file' class='form-control' id='update_user_image'
                                                    name='update_user_image'>
                                            </div>
                                        </div>


                                        <div class='mb-2' id='show_image'>
                                                <img class='rounded rounded-3' src='{$image_path}' width='70px' height='60px'>
                                        </div>

                                        <div class='mb-3'>
                                            <div class='form-group'>
                                                <label for='update_user_password'>User Password</label><span
                                                    class='font-small font-weight-bold text-muted'> (Encrypted
                                                    Password)</span>
                                                <input type='password' class='form-control' id='update_user_password'
                                                    name='update_user_password'>
                                            </div>
                                        </div>

                                        <div class='mb-3'>
                                            <div class='form-group'>
                                                <label for='update_user_phone'>User Phone</label>
                                                <input type='number' value='{$row->user_phone}' class='form-control'
                                                    id='update_user_phone' name='update_user_phone'>
                                            </div>
                                        </div>

                                    
                                        <div id='user_button' class='mt-2'>
                                            <button type='submit' data-id='{$row->user_id}' id='update_user_btn' class='btn btn-primary'>Update
                                                User</button>
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