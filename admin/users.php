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
                        <h4 class="mt-2">Manage Users</h4>
                    </div>
                    <?php require_once("./include/admin_fixed_nav.php"); ?>
                </div>

                <li role="separator" class="dropdown-divider mt-1 mb-3 border-dark"></li>

                <button class="btn btn-secondary text-dark mb-3" data-toggle="modal" data-target="#add-product-form">
                    <span class="fas fa-plus mr-2"></span>Add User
                </button>

                <div class="modal fade pr-0 pr-md-1" id="add-product-form" tabindex="-1" role="dialog"
                    aria-labelledby="modal-form" aria-hidden="true">
                    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header d-flex align-items-center">
                                <h2 class="h5 modal-title">User Detail</h2>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body p-2">
                                <div class="card border-light border-0">
                                    <div class="card-body">
                                        <!-- Form -->
                                        <form id="add_user_form" method="POST" name="add_user_form">

                                            <div class="mb-3">
                                                <div>
                                                    <label for="username">Username</label>
                                                    <input type="text" class="form-control" id="username"
                                                        name="username" placeholder="Enter Username">
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <div class="form-group">
                                                    <label for="user_email">Email</label>
                                                    <input type="email" class="form-control" id="user_email"
                                                        name="user_email" placeholder="name@email.com">
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <div class="form-group">
                                                    <label for="user_image">User Image</label> <span
                                                        class="font-small font-weight-bold text-muted">(Type : PNG, JPG,
                                                        JPEG) (Size : 2mb)</span>
                                                    <input type="file" class="form-control" id="user_image"
                                                        name="user_image">
                                                </div>
                                            </div>

                                            <div id="image_cover" class="mb-3">

                                                <div id="show_user_image"></div>

                                            </div>

                                            <div class="mb-3">
                                                <div class="form-group">
                                                    <label for="user_password">User Password</label><span
                                                        class="font-small font-weight-bold text-muted"> (Encrypted
                                                        Password)</span>
                                                    <input type="password" class="form-control" id="user_password"
                                                        name="user_password">
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <div class="form-group">
                                                    <label for="user_phone">User Phone</label>
                                                    <input type="number" placeholder="1234567890" class="form-control"
                                                        id="user_phone" name="user_phone">
                                                </div>
                                            </div>

                                            <div class="mb-3">

                                                <label class="form-label">I want to be</label>

                                                <select class="form-control" name="user_role" id="user_role">
                                                    <option value="0">Select Your Role</option>
                                                    <option value="auctioneer">Auctioneer</option>
                                                    <option value="bidder">Bidder</option>
                                                </select>

                                            </div>

                                            <div id="user_button" class="mt-2">
                                                <button type="submit" id="add_user_btn" class="btn btn-primary">Add
                                                    User</button>
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

                <div id="edit_user_form_modal"></div>

            </main>
        </div>
    </div>
</div>

<?php require_once("./include/admin_footer.php"); ?>

<script>
$(document).ready(function() {

    function load_users_table() {
        $.ajax({
            url: "php-files/ajax_load_all_users_data.php",
            type: "POST",
            success: function(result) {
                $("#table-data").html(result);
            }
        });
    };

    load_users_table();


    // ADD USER FORM DATA --------------------->

    $("#add_user_form").on("submit", function(e) {

        e.preventDefault();

        var username = $("#username").val();
        var user_email = $("#user_email").val();
        var user_image = $("#user_image").val();
        var user_password = $("#user_password").val();
        var user_phone = $("#user_phone").val();
        var user_role = $("#user_role").val();

        var formData = new FormData(this);

        if (username == "" || user_email == "" || user_password == "" || user_role == 0 || user_phone ==
            "" || user_image == "") {
            error_message("All fields are required.");
        } else if (user_email.indexOf("@") == -1) {
            error_message("Enter valid email address.");
        } else if (user_phone.length < 10 || user_phone.length > 10) {
            error_message("Enter valid phone number.");
        } else {
            $.ajax({
                url: "php-files/ajax_add_user.php",
                type: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                success: function(result) {
                    // alert(result);
                    if (result == "1") {
                        success_message("User added sucessfully.");
                        $("#add_user_form").trigger('reset');
                        load_users_table();
                    } else if (result == "0") {
                        error_message("Query Failed.");
                    } else if (result == "invalid") {
                        error_message("Invalid image type or image is too big.");
                    } else if (result == "taken") {
                        error_message("Username already taken please use another name.");
                    } else {
                        error_message("Something went wrong.");
                    }
                }
            });
        }
    });


    // MODAL FORM GET DATA --------------------->
    var user_id = 0;
    $(document).on("click", ".edit_user_btn", function(e) {

        user_id = $(this).data("id");
        // alert(user_id);

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
                    $("#edit_user_form_modal").html(result);
                    $('#update-user-form').modal('show');
                }
            }
        });
    });


    // Delete user ------------------------->
    $(document).on("click", ".delete_user_btn", function(e) {

        user_id = $(this).data("id");
        // alert(user_id);

        if (confirm("Are you sure you want to delete?")) {

            $.ajax({
                url: "php-files/ajax_delete_user.php",
                type: "POST",
                // dataType: "JSON",
                data: {
                    user_id: user_id
                },
                success: function(result) {
                    if (result == "0") {
                        error_message("Query Failed.");
                    } else {
                        success_message("User deleted successfully.");
                        load_users_table();
                    }
                }
            });
        }
    });



    // UPDATE USER FORM DATA ------------------>

    $(document).on("submit", "#update_user_form", function(e) {

        e.preventDefault();

        var user_email = $("#update_user_email").val();
        var user_image = $("#update_user_image").val();
        var user_password = $("#update_user_password").val();
        var user_phone = $("#update_user_phone").val();

        var formData = new FormData(this);
        formData.append('user_id', user_id);

        if (user_email == "" || user_phone == "") {
            error_message("All fields are required.");
        } else if (user_email.indexOf("@") == -1) {
            error_message("Enter valid email address.");
        } else if (user_phone.length < 10 || user_phone.length > 10) {
            error_message("Enter valid phone number.");
        } else {
            $.ajax({
                url: "php-files/ajax_update_user.php",
                type: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                success: function(result) {
                    // alert(result);                   
                    if (result == "1") {
                        success_message("User Updated sucessfully.");
                        $("#update_user_form").trigger('reset');
                        $('#update-user-form').modal('hide');
                        load_users_table();
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
    // var user_id = 0;
    // $(document).on("click", ".edit_btn", function(e) {

    //     user_id = $(this).data("id");

    //     $.ajax({

    //         url: "php-files/ajax_fetch_productData.php",
    //         type: "POST",
    //         // dataType: "JSON",
    //         data: {
    //             product_id: product_id
    //         },
    //         success: function(result) {
    //             if (result == "0") {
    //                 error_message("Query Failed.");
    //             } else {
    //                 $("#edit_product_form_modal").html(result);
    //                 $('#update-product-form').modal('show');
    //             }
    //         }
    //     });
    // });

    // // UPDATE FORM DATA --------------------->
    // $(document).on("submit", "#update_product_form", function(e) {

    //     e.preventDefault();

    //     // alert(product_id);
    //     var edit_product_name = $("#edit_product_name").val();
    //     var edit_product_end_time = $("#edit_product_end_time").val();
    //     var edit_product_desc = $("#edit_product_desc").val();
    //     var edit_product_price = $("#edit_product_price").val();
    //     var edit_product_image = $("#edit_product_image").val();

    //     var formData = new FormData(this);
    //     formData.append('product_id', product_id);

    //     if (edit_product_name == "" || edit_product_end_time == "" || edit_product_desc == "" ||
    //         edit_product_price == "") {
    //         error_message("All fields are required.");
    //     } else {
    //         $.ajax({
    //             url: "php-files/ajax_update_product.php",
    //             type: "POST",
    //             data: formData,
    //             contentType: false,
    //             cache: false,
    //             processData: false,
    //             success: function(result) {
    //                 // alert(result);
    //                 if (result == "1") {
    //                     success_message("Product Updated sucessfully.");
    //                     $("#update_product_form").trigger('reset');
    //                     $('#update-product-form').modal('hide');
    //                     load_table_data();
    //                 } else if (result == "0") {
    //                     error_message("Query Failed.");
    //                 } else if (result == "invalid") {
    //                     error_message("Invalid image type or image is too big.");
    //                 } else {
    //                     error_message("Something went wrong.");
    //                 }
    //             }
    //         });
    //     }
    // });

    // $(document).on("click", ".delete_btn", function(e) {

    //     var product_id = $(this).data("id");
    //     // alert(product_id);

    //     if (confirm("Are you sure you want to delete?")) {

    //         $.ajax({

    //             url: "php-files/ajax_delete_product.php",
    //             type: "POST",
    //             data: {
    //                 product_id: product_id
    //             },
    //             success: function(result) {

    //                 if (result == "1") {
    //                     success_message("Product deleted successfully.");
    //                     load_table_data();

    //                 } else {
    //                     error_message("Query Failed.");
    //                 }

    //             }
    //         });
    //     }
    // });
});
</script>