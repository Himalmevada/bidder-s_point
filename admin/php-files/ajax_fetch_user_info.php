<?php

require_once("../../include/db_conn.php");

if (isset($_POST['user_id'])) {

    $user_id = $_POST['user_id'];

    $select_user_query = "SELECT * FROM users WHERE user_id = ?";
    $select_user_stmt = $conn->prepare($select_user_query);
    $result = $select_user_stmt->execute([$user_id]);

    $output = "";

    if ($result) {

        while ($row = $select_user_stmt->fetch(PDO::FETCH_OBJ)) {

            $output .= "
                <div class='modal fade pr-0 pr-md-1' id='user-details-form' tabindex='-1' role='dialog' aria-labelledby='modal-form'
                    aria-hidden='true'>
                    <div class='modal-dialog  modal-dialog-centered' role='document'>
                        <div class='modal-content'>
                            
                            <div class='modal-header d-flex align-items-center'>
                                <h2 class='h5 modal-title'>User Detail</h2>
                                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button>
                            </div>

                            <div class='modal-body p-2 py-1'>
                                <div class='card border-light border-0'>
                                    <div class='card-body'>
                                    
                                        <div class='mb-2'>
                                            <span class='text-primary'>Username : </span>
                                            <span class='text-gray'>$row->username</span>
                                        </div>
                                        
                                        <div class='mb-2'>
                                            <span class='text-primary'>Email : </span>
                                            <span class='text-gray'>$row->user_email</span>
                                        </div>
                                        
                                        <div class='mb-2'>
                                            <span class='text-primary'>Phone No. : </span>
                                            <span class='text-gray'>$row->user_phone</span>
                                        </div>
                                        
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
}