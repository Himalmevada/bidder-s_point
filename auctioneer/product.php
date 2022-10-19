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
                        <h4 class="mt-2">Manage Products</h4>
                    </div>
                    <?php require_once("./include/auctioneer_fixed_nav.php"); ?>
                </div>

                <li role="separator" class="dropdown-divider mt-1 mb-3 border-dark"></li>

                <button class="btn btn-secondary text-dark mb-3" data-toggle="modal" data-target="#add-product-form">
                    <span class="fas fa-plus mr-2"></span>Add Product
                </button>

                <div class="modal fade pr-0 pr-md-1" id="add-product-form" tabindex="-1" role="dialog"
                    aria-labelledby="modal-form" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header d-flex align-items-center">
                                <h2 class="h5 modal-title">Product Detail</h2>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body p-2">
                                <div class="card border-light border-0">
                                    <div class="card-body">
                                        <!-- Form -->
                                        <form id="add_product_form" method="POST" name="add_product_form">
                                            <div class="row">

                                                <div class="form-group mb-4 col-lg">
                                                    <label for="product_name">Product
                                                        Name</label>
                                                    <div class="input-group">
                                                        <input type="text" id="product_name" name="product_name"
                                                            class="form-control" placeholder="">
                                                    </div>
                                                </div>

                                                <!-- <div class="form-group mb-4 col-lg-6">
                                                    <label for="product_end_time">Product
                                                        auction timer <small class="text-muted">(Hour)</small></label>
                                                    <div class="input-group">
                                                        <input type="number" id="product_end_time"
                                                            name="product_end_time" class="form-control" placeholder="">
                                                    </div>
                                                </div> -->

                                            </div>

                                            <div class="form-group mb-4">
                                                <label for="product_desc">Product
                                                    Description</label>
                                                <div class="input-group">
                                                    <textarea type="text" id="product_desc" name="product_desc"
                                                        class="form-control" placeholder=""></textarea>
                                                </div>
                                            </div>

                                            <div class="row">

                                                <div class="form-group mb-4 col-lg-6">
                                                    <label for="product_price">Product Price</label>
                                                    <div class="input-group">
                                                        <input type="number" id="product_price" name="product_price"
                                                            class="form-control" placeholder="">
                                                    </div>
                                                </div>

                                                <div class="form-group col-lg-6">
                                                    <label for="product_image">Product Image </label> <span
                                                        class="font-small font-weight-bold text-muted">(Type : PNG, JPG,
                                                        JPEG)(Size : 5mb)</span>
                                                    <div class="input-group">
                                                        <input type="file" id="product_image" name="product_image"
                                                            class="form-control" placeholder="">
                                                    </div>
                                                </div>

                                            </div>

                                            <div id="product_button" class="mt-4 mt-lg-0">
                                                <button type="submit" id="add_product_btn" class="btn btn-primary">Add
                                                    Product</button>
                                                <button type="button" class="btn btn-link text-danger ml-2"
                                                    data-dismiss="modal">Close</button>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- TABLE OF PRODUCTS -->

                <div class="card border-light shadow-sm mb-4">
                    <div class="card-body">
                        <div id="table-data" class="table-responsive pt-1">
                            <!-- TABLE DATA ADDED HERE -->
                        </div>
                    </div>
                </div>

                <div id="edit_product_form_modal"></div>

            </main>
        </div>
    </div>
</div>

<?php require_once("./include/auctioneer_footer.php"); ?>

<script>
$(document).ready(function() {

    function load_table_data() {
        $.ajax({
            url: "php-files/ajax_load_product_data.php",
            type: "POST",
            success: function(result) {
                $("#table-data").html(result);
            }
        });
    };

    load_table_data();


    // ADD FORM DATA --------------------->

    // $("#add_product_btn").on("click", function(e) {
    $("#add_product_form").on("submit", function(e) {

        e.preventDefault();

        // var formData = new FormData($("#add_product_form")[0]);

        var product_name = $("#product_name").val();
        // var product_end_time = $("#product_end_time").val();
        var product_desc = $("#product_desc").val();
        var product_price = $("#product_price").val();
        var product_image = $("#product_image").val();

        if (product_name == "" || product_desc == "" ||
            product_price == "" || product_image == "") {
            error_message("All fields are required.");
        } else {
            $.ajax({
                url: "php-files/ajax_add_product.php",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(result) {

                    if (result == "1") {
                        success_message("Product added sucessfully.");
                        $("#add_product_form").trigger('reset');
                        load_table_data();

                    } else if (result == "0") {
                        error_message("Query Failed.");
                    } else if (result == "invalid") {
                        error_message("Invalid image type or image is too big.");
                    } else {
                        error_message("Something went wrong.");
                    }
                }
            });
        }
    })

    // MODAL FORM GET DATA --------------------->
    var product_id = 0;
    $(document).on("click", ".edit_btn", function(e) {

        product_id = $(this).data("id");

        $.ajax({

            url: "php-files/ajax_fetch_product_modal.php",
            type: "POST",
            // dataType: "JSON",
            data: {
                product_id: product_id
            },
            success: function(result) {

                if (result == "0") {
                    error_message("Query Failed.");
                } else {

                    $("#edit_product_form_modal").html(result);
                    $('#update-product-form').modal('show');


                }
            }
        });
    });

    // UPDATE FORM DATA --------------------->
    $(document).on("submit", "#update_product_form", function(e) {

        e.preventDefault();

        // alert(product_id);
        var edit_product_name = $("#edit_product_name").val();
        // var edit_product_end_time = $("#edit_product_end_time").val();
        var edit_product_desc = $("#edit_product_desc").val();
        var edit_product_price = $("#edit_product_price").val();
        var edit_product_image = $("#edit_product_image").val();

        var formData = new FormData(this);
        formData.append('product_id', product_id);

        if (edit_product_name == "" || edit_product_desc == "" ||
            edit_product_price == "") {
            error_message("All fields are  required.");
        } else {
            $.ajax({
                url: "php-files/ajax_update_product.php",
                type: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                success: function(result) {
                    // alert(result);
                    if (result == "1") {
                        success_message("Product Updated sucessfully.");
                        $("#update_product_form").trigger('reset');
                        $('#update-product-form').modal('hide');
                        load_table_data();
                    } else if (result == "0") {
                        error_message("Query Failed.");
                    } else if (result == "invalid") {
                        error_message("Invalid image type or image is too big.");
                    } else {
                        error_message("Something went wrong.");
                    }
                }
            });
        }
    });

    $(document).on("click", ".delete_btn", function(e) {

        var product_id = $(this).data("id");
        // alert(product_id);

        if (confirm("Are you sure you want to delete?")) {

            $.ajax({

                url: "php-files/ajax_delete_product.php",
                type: "POST",
                data: {
                    product_id: product_id
                },
                success: function(result) {

                    if (result == "1") {
                        success_message("Product deleted successfully.");
                        load_table_data();

                    } else {
                        error_message("Query Failed.");
                    }
                }
            });
        }
    });
});
</script>

<!-- $.each(result, function(key, value) {
$("#product_id").val(value.product_id);
$("#product_name").val(value.product_name);
$("#product_end_time").val(
value.product_end_time);
$("#product_desc").val(value.product_desc);
$("#product_price").val(value.product_price);

$("#image_card").show();
if (value.item_image == "no_image") {
$("#preview_image").html(
"<div class='alert alert-info py-2'>Image is not available.</div>"
);
} else {
$("#preview_image").html(
`<img class='img-fluid' src='${value.item_image}'>`
);
}
$("#item_quantity").val(0);
}) -->