<?php

require_once("./include/db_conn.php");

if (isset($_REQUEST['p_id']) && $_REQUEST['p_id'] != "") {
    $product_id = $_REQUEST['p_id'];

    $select_user_query = "SELECT * FROM products WHERE product_id = ?";
    $select_user_stmt = $conn->prepare($select_user_query);
    $result = $select_user_stmt->execute([$product_id]);

    // $select_user_query = "SELECT * FROM products WHERE product_id = :product_id";
    // $select_user_stmt = $conn->prepare($select_user_query);
    // $result = $select_user_stmt->bindParam(':product_id', $product_id);

    if ($select_user_stmt->rowCount() > 0) {

        while ($row = $select_user_stmt->fetch(PDO::FETCH_OBJ)) {

?>


<?php require_once("include/header.php"); ?>
<?php require_once("include/navigation.php"); ?>


<section class="pt-7 ">

    <div class="container">
        <div class="row gx-4 gx-lg-5 align-items-center">

            <div class="col-md-6">
                <img class="card-img-top mb-5 mb-md-0 rounded"
                    src="./images/product-image/<?php echo $row->product_image; ?>" alt="product_image">
            </div>

            <div class="col-md-6">

                <h1 class="display-3 font-weight-bolder"><?php echo $row->product_name; ?></h1>

                <div class="font-size-5 mb-2">
                    <span class='font-weight-bolder'>Starting bid :</span>
                    <span class='text-gray'><?php echo $row->product_price; ?> <i class='fas fa-rupee-sign'></i></span>
                </div>

                <div class="mb-2">
                    <span class='font-weight-bolder'>Description :</span>
                    <span class='text-gray'><?php echo $row->product_desc; ?></span>
                </div>

                <form id="bid_form" method="POST">

                    <div class="mt-4 input-group" style='max-width:300px'>

                        <input type="number" id="product_bid" class="form-control">

                        <button type="submit" id="add_bid_btn" data-id='<?php echo $row->product_id; ?>'
                            data-price='<?php echo $row->product_price; ?>' class="btn btn-dark flex-shrink-0"
                            type="button">Add Bid
                        </button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<section class="my-5">

    <div class="container">
        <div class="card bg-gradient-primary text-white">
            <div class="card-body table-responsive" id="load_bids">
                <!-- <h4 class="card-title"> All Bids</h4> -->
                <!-- <hr> -->
            </div>
        </div>
    </div>

</section>

<?php require_once("include/footer.php"); ?>

<?php
        }
    } else {
        echo "No Product Found.";
    }
} else {
    header("Location: ./index.php");
}

?>

<script>
$(document).ready(function() {

    function load_bid() {

        var base_url = (window.location).href;
        var product_id = base_url.substring(base_url.lastIndexOf("=") + 1);

        // alert(product_id);
        $.ajax({
            url: "php-files/ajax_load_bid.php",
            type: "POST",
            data: {
                bid_product_id: product_id
            },
            success: function(result) {
                // alert(result);
                if (result == "no_data") {
                    $("#load_bids").html("<li class='list-style-none mb-2'>There is no bid.</li>")
                } else {
                    $("#load_bids").html(result);
                }
            }
        })
    }

    load_bid();

    $("#add_bid_btn").on("click", function(e) {

        // $("#bid_form").on("submit", function(e) {

        e.preventDefault();

        var product_id = $(this).data('id');
        var starting_bid = $(this).data('price');
        var product_bid = $("#product_bid").val();

        $.ajax({
            url: "php-files/ajax_check_session.php",
            type: "POST",
            success: function(result) {
                // alert(result);
                if (result == "1") {
                    add_bid();
                } else {
                    error_message("You have to be logged in as bidder to add bid.");
                }
            }
        })

        function add_bid() {

            if (product_bid == "") {
                error_message("Please enter your bid amount.");
            } else if (product_bid <= starting_bid) {
                error_message("Please enter higher bid then starting bid.");
            } else {
                $.ajax({
                    url: "php-files/ajax_add_bid.php",
                    type: "POST",
                    data: {
                        bid_product_id: product_id,
                        bid_amount: product_bid
                    },
                    success: function(result) {
                        // alert(result);
                        if (result == "1") {
                            success_message("Bid added sucessfully");
                            $("#bid_form").trigger('reset');
                            load_bid();
                        } else if (result == "given") {
                            error_message(
                                "You have alreay given bid. You can update from your Dashboard."
                            );
                            $("#bid_form").trigger('reset');
                        } else {
                            error_message("Query Failed");
                        }
                    }
                })
            }
        }
    })
})
</script>