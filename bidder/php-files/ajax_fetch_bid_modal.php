<?php

require_once("../../include/db_conn.php");

if (isset($_POST['bid_id'])) {

    $bid_id = $_POST['bid_id'];

    $select_bid_query = "SELECT * FROM bids WHERE bid_id = ?";
    $select_bid_stmt = $conn->prepare($select_bid_query);
    $result = $select_bid_stmt->execute([$bid_id]);

    $output = "";

    if ($result) {

        while ($row = $select_bid_stmt->fetch(PDO::FETCH_OBJ)) {

            $output .= "
                <div class='modal fade pr-0 pr-md-1' id='bid-update-form' tabindex='-1' role='dialog' aria-labelledby='modal-form'
                    aria-hidden='true'>
                    <div class='modal-dialog  modal-dialog-centered' role='document'>
                        <div class='modal-content'>
                            
                            <div class='modal-header d-flex align-items-center'>
                                <h2 class='h5 modal-title'>Bid Update Form</h2>
                                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button>
                            </div>

                            <div class='modal-body p-2 py-1'>
                                <div class='card border-light border-0'>
                                    <div class='card-body'>
                                    
                                    <form type='POST' id='update_bid_form'>
                                        <div class='mb-3'>
                                            <label for='edit_bid_amount'>Bid Amount : </label>
                                            <input type='number' class='form-control' id='edit_bid_amount' value='$row->bid_amount'>
                                        </div>
                                            
                                        <button type='submit' class='btn btn-primary' id='update_bid_btn'>Update Bid</button>
                                            
                                    </form>
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