<?php require_once("./include/bidder_header.php"); ?>

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

            <?php require_once("./include/bidder_navigation.php"); ?>

            <main class="content">

                <div class="d-flex justify-content-between mt-4">
                    <div>
                        <h4 class="mt-2">Manage Profile</h4>
                    </div>
                    <?php require_once("./include/bidder_fixed_nav.php"); ?>
                </div>

                <li role="separator" class="dropdown-divider mt-1 mb-3 border-dark"></li>

                <div class="row">
                    <div class="col-12 col-xl-8">
                        <div class="card card-body bg-white border-light shadow-sm mb-4">

                            <form method="POST" id="profile_form" enctype="multipart/form-data">

                                <div class="mb-3">
                                    <div>
                                        <label for="username">Username</label>
                                        <input type="text" class="form-control" id="username" name="username" readonly>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="form-group">
                                        <label for="user_email">Email</label>
                                        <input type="email" class="form-control" id="user_email" name="user_email"
                                            placeholder="name@email.com">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="form-group">
                                        <label for="user_image">User Image</label> <span
                                            class="font-small font-weight-bold text-muted">(Type : PNG, JPG,
                                            JPEG) (Size : 2mb)</span>
                                        <input type="file" class="form-control" id="user_image" name="user_image"
                                            placeholder="name@email.com">
                                    </div>
                                </div>

                                <div id="image_cover" class="mb-3">

                                    <div id="show_user_image"></div>

                                </div>

                                <div class="mb-3">
                                    <div class="form-group">
                                        <label for="user_password">User Password</label><span
                                            class="font-small font-weight-bold text-muted"> (Encrypted Password)</span>
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


                                <div class="mt-3">
                                    <button type="submit" id="update_profile_btn" class="btn btn-secondary">Update
                                        Profile</button>
                                </div>

                            </form>
                        </div>
                    </div>

                </div>

            </main>
        </div>
    </div>
</div>

<?php require_once("./include/bidder_footer.php"); ?>

<script>
$(document).ready(function() {

    function load_user_data() {

        $.ajax({
            url: "php-files/ajax_load_user_data.php",
            type: "POST",
            dataType: "JSON",
            success: function(result) {
                if (result == "0") {
                    error_message("Query Failed.");
                } else {
                    // alert(result);
                    $.each(result, function(key, value) {

                        $("#username").val(value.username);
                        $("#user_email").val(value.user_email);
                        $("#user_phone").val(value.user_phone);
                        // $("#user_image").val(value.user_image);
                        // $("#user_password").val(value.user_password);

                        $("#image_cover").show();

                        if (value.user_image == "") {
                            $("#show_user_image").html(
                                "<div class='alert alert-info py-2 text-white col-4'>Image is not available.</div>"
                            );
                        } else {
                            $("#show_user_image").html(
                                `<img class='img-fluid' width='70px' alt='user_image' src='./../images/user-image/${value.user_image}'>`
                            );
                        }

                    });
                }
            }
        });
    }
    load_user_data();


    $("#profile_form").on("submit", function(e) {

        e.preventDefault();

        var user_email = $("#user_email").val();
        var user_image = $("#user_image").val();
        var user_password = $("#user_password").val();
        var user_phone = $("#user_phone").val();

        var formData = new FormData(this);

        if (user_email == "" || user_phone == "") {
            error_message("All fields are required.");
        } else if (user_email.indexOf("@") == -1) {
            error_message("Enter valid email address.");
        } else if (user_phone.length < 10 || user_phone.length > 10) {
            error_message("Enter valid phone number.");
        } else {
            $.ajax({
                url: "php-files/ajax_update_profile.php",
                type: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                success: function(result) {
                    // alert(result);
                    if (result == "1") {
                        success_message("User Updated sucessfully.");
                        $("#user_password").val("");
                        load_user_data();
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

});
</script>