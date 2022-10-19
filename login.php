<?php require_once("include/header.php"); ?>
<?php require_once("include/navigation.php"); ?>

<main class="pt-7 pb-3">

    <!-- Section -->
    <section class="d-flex align-items-center">
        <div class="container">
            <div class="row justify-content-center form-bg-image">
                <div class="col-12 d-flex align-items-center justify-content-center">
                    <div
                        class="my-2 my-lg-0 bg-white shadow-soft border rounded border-light p-4 p-lg-5 w-100 fmxw-500">
                        <div class="text-center text-md-center mb-4 mt-md-0">
                            <h1 class="mb-0 h3">Sign in to our platform</h1>
                        </div>

                        <form id="login_form" method="POST" class="mt-4">
                            <!-- Form -->
                            <div class="form-group mb-4">
                                <label for="user_email">Your Email</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><span
                                            class="fas fa-envelope"></span></span>
                                    <input type="email" class="form-control" placeholder="example@company.com"
                                        id="user_email">
                                </div>
                            </div>
                            <!-- End of Form -->
                            <div class="form-group">
                                <!-- Form -->
                                <div class="form-group mb-4">
                                    <label for="user_password">Your Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon2"><span
                                                class="fas fa-unlock-alt"></span></span>
                                        <input type="password" placeholder="Password" class="form-control"
                                            id="user_password">
                                    </div>
                                </div>
                            </div>
                            <button id="signin_btn" type="submit" class="btn btn-block btn-primary">Sign in</button>
                        </form>

                        <div class="d-flex-column justify-content-between align-items-center mt-4">
                            <div class="font-weight-normal mb-1">
                                Not registered?
                                <a href="./register.php" class="font-weight-bold">Create account</a>
                            </div>
                            <div class="font-weight-normal">
                                Don't know password?
                                <a href="./forgot-password.php" class="font-weight-bold">Forgot Password</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php require_once("include/footer.php"); ?>

<script>
$(document).ready(function() {

    function load_login_details() {
        $.ajax({
            url: "php-files/ajax_load_login_data.php",
            type: "POST",
            success: function(result) {
                // alert(result);
                if (result != "0") {

                    var data = result.split(",");
                    $("#user_email").val(data[0]);
                    $("#user_password").val(data[1]);

                }
            }
        })
    }

    load_login_details();

    $("#signin_btn").on("click", function(e) {

        e.preventDefault();

        var user_email = $("#user_email").val();
        var user_password = $("#user_password").val();

        if (user_email == "" || user_password == "") {
            error_message("All fields are required.");

        } else if (user_email.indexOf("@") == -1) {
            error_message("Enter valid email address.");

        } else {

            $("#login_form").trigger("reset");

            // console.table(username, user_email, user_password, user_role);

            $.ajax({
                url: "php-files/ajax_login.php",
                type: "POST",
                data: {
                    user_email: user_email,
                    user_password: user_password
                },
                // $("#register_form").serialize(),
                success: function(result) {
                    if (result == "0") {
                        error_message("Query Failed.");
                    } else if (result == "no_user") {
                        error_message("Can't find user.");
                    } else if (result == "invalid") {
                        error_message("Invalid Login details.");
                    } else if (result == "auctioneer") {
                        success_message("Login successful.");
                        setInterval(function() {
                            window.location = './auctioneer/index.php';
                        }, 2000);
                    } else if (result == "bidder") {
                        success_message("Login successful.");
                        setInterval(function() {
                            window.location = "./index.php";
                        }, 2000);
                    } else if (result == "admin") {
                        success_message("Login successful.");
                        setInterval(function() {
                            window.location = "./index.php";
                        }, 2000);
                    }
                }
            })
        }
    });
})
</script>