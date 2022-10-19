<?php require_once("./include/admin_header.php"); ?>

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

            <?php require_once("./include/admin_navigation.php"); ?>

            <main class="content">

                <div class="d-flex justify-content-between mt-4">
                    <div>
                        <h4 class="mt-2">Manage Bid</h4>
                    </div>
                    <?php require_once("./include/admin_fixed_nav.php"); ?>
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

                <div id="bid_update_form_modal"></div>

            </main>
        </div>
    </div>
</div>

<?php require_once("./include/admin_footer.php"); ?>

<script>
$(document).ready(function() {

    function load_bid_data() {
        $.ajax({
            url: "php-files/ajax_load_bid_data.php",
            type: "POST",
            data: {
                opt: '1'
            },
            success: function(result) {
                // alert(result);
                $("#table-data").html(result);
            }
        });
    };

    load_bid_data();


    $(document).on("click", ".delete_bid_btn", function(e) {

        var bid_id = $(this).data("bidid");
        // alert(product_id);
        // alert(bid_id);

        if (confirm("Are you sure you want to delete?")) {

            $.ajax({

                url: "php-files/ajax_delete_bid.php",
                type: "POST",
                data: {
                    bid_id: bid_id
                },
                success: function(result) {

                    if (result == "1") {
                        success_message("Bid deleted successfully.");
                        load_bid_data();

                    } else {
                        error_message("Query Failed.");
                    }

                }
            });
        }
    });

    var bid_id = 0;
    var product_price = 0;

    $(document).on("click", ".edit_bid_btn", function(e) {

        bid_id = $(this).data("bidid");
        product_price = $(this).data("price");

        $.ajax({

            url: "php-files/ajax_fetch_bid_modal.php",
            type: "POST",
            // dataType: "JSON",
            data: {
                bid_id: bid_id
            },
            success: function(result) {

                if (result == "0") {
                    error_message("Query Failed.");
                } else {

                    $("#bid_update_form_modal").html(result);
                    $('#bid-update-form').modal('show');
                }
            }
        });
    });

    // UPDATE FORM DATA --------------------->
    $(document).on("click", "#update_bid_btn", function(e) {

        e.preventDefault();

        var edit_bid_amount = $("#edit_bid_amount").val();

        if (edit_bid_amount == "") {
            error_message("Please enter your bid amount.");
        } else if (edit_bid_amount < product_price) {
            error_message("Please enter higher bid then starting bid.");
        } else {
            $.ajax({
                url: "php-files/ajax_update_bid.php",
                type: "POST",
                data: {
                    bid_id: bid_id,
                    edit_bid_amount: edit_bid_amount,
                },
                success: function(result) {
                    if (result == "less") {} else if (result == "1") {
                        success_message("Product Updated sucessfully.");
                        $('#bid-update-form').modal('hide');
                        load_bid_data();
                    } else if (result == "0") {
                        error_message("Query Failed.");
                    } else {
                        error_message("Something went wrong.");
                    }
                }

            })
        }


    });

});
</script>