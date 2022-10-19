<?php require_once("./include/auctioneer_header.php"); ?>

<nav class="navbar navbar-dark navbar-theme-primary px-4 col-12 d-md-none">
    <a class="navbar-brand mr-lg-5" href="index.php">
        Bidder's Point
    </a>
    <div class="d-flex align-items-center">
        <button class="navbar-toggler d-md-none collapsed" type="button" data-toggle="collapse"
            data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav>

<div class="container-fluid bg-gradient-soft">

    <div class="row">
        <div class="col-12">

            <?php require_once("./include/auctioneer_navigation.php"); ?>

            <main class="content">

                <div class="d-flex justify-content-between mt-4">
                    <div>
                        <h4 class="mt-2">Check Bids</h4>
                    </div>
                    <?php require_once("./include/auctioneer_fixed_nav.php"); ?>
                </div>

                <li role="separator" class="dropdown-divider mt-1 mb-3 border-dark"></li>

                <!-- TABLE OF PRODUCTS -->

                <div class="card border-light shadow-sm mb-4">
                    <div class="card-body">
                        <div id="table-data" class="table-responsive pt-1">
                            <!-- TABLE DATA ADDED HERE -->
                        </div>
                    </div>
                </div>

                <div id="user_details_form_modal"></div>

            </main>
        </div>
    </div>
</div>

<?php require_once("./include/auctioneer_footer.php"); ?>

<script>
$(document).ready(function() {

    function load_bid_data() {
        $.ajax({
            url: "php-files/ajax_load_bid_data.php",
            type: "POST",
            success: function(result) {
                $("#table-data").html(result);
            }
        });
    };

    load_bid_data();

    $(document).on("click", ".accept_bid_btn", function(e) {

        var bid_product_id = $(this).data("id");
        var bid_user_id = $(this).data("userid");

        $.ajax({

            url: "php-files/ajax_accept_bid.php",
            type: "POST",
            data: {
                bid_user_id: bid_user_id,
                bid_product_id: bid_product_id
            },
            success: function(result) {

                if (result == "0") {
                    error_message("Query Failed.");
                } else if (result == "1") {
                    success_message("Bid Accepted.");
                    load_bid_data();
                } else {
                    error_message("Something went wrong.");
                }
            }
        });
    });

    $(document).on("click", ".bidder_details_btn", function(e) {

        user_id = $(this).data("userid");

        $.ajax({

            url: "php-files/ajax_fetch_user_modal.php",
            type: "POST",
            // dataType: "JSON",
            data: {
                user_id: user_id
            },
            success: function(result) {
                if (result == "0") {
                    error_message("Query Failed.");
                } else {
                    $("#user_details_form_modal").html(result);
                    $("#user-details-form").modal('show');
                }
            }
        });
    });
});
</script>