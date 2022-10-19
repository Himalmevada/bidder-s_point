<?php require_once("include/header.php"); ?>
<?php require_once("include/navigation.php"); ?>

<main class="pt-7 pb-4">

    <!-- Section -->
    <section class="d-flex align-items-center">
        <div class="container">
            <div class="row justify-content-center form-bg-image">
                <div class="col-12 d-flex align-items-center justify-content-center">
                    <div class="my-3 my-lg-0 bg-white shadow-soft border rounded border-light p-4 p-lg-5 w-100 fmxw-500">
                        <div class="text-center text-md-center mb-4 mt-md-0">
                            <h1 class="mb-0 h3">Create an account</h1>
                        </div>

                        <form id="register_form" method="POST" class="mt-4">

                            <div class="form-group mb-4">
                                <label for="username">Your Username</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon2">
                                        <span class="fas fa-user"></span>
                                    </span>
                                    <input type="text" placeholder="John Doe" class="form-control" id="username" name="username" autofocus>
                                </div>
                            </div>

                            <div class="form-group mb-4">
                                <label for="user_email">Your Email</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1">
                                        <span class="fas fa-envelope"></span></span>
                                    </span>
                                    <input type="email" class="form-control" placeholder="example@company.com" id="user_email" name="user_email">
                                </div>
                            </div>


                            <div class="form-group mb-4">
                                <label for="user_password">Your Password</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon2">
                                        <span class="fas fa-unlock-alt"></span>
                                    </span>
                                    <input type="password" placeholder="Password" class="form-control" id="user_password" name="user_password">
                                </div>
                            </div>

                            <div class="form-group mb-4">
                                <label for="user_phone">Phone No.</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon2">
                                        <span class="fas fa-phone-alt"></span>
                                    </span>
                                    <input type="number" placeholder="9999999999" class="form-control" id="user_phone" name="user_phone">
                                </div>
                            </div>

                            <div class="form-group mb-4">

                                <label class="form-label">I want to be</label>

                                <select class="form-control" name="user_role" id="user_role">
                                    <option value="0">Select Your Role</option>
                                    <option value="auctioneer">Auctioneer</option>
                                    <option value="bidder">Bidder</option>
                                </select>

                            </div>


                            <div class="d-grid">
                                <button id="signup_btn" name="signup_btn" type="submit" class="btn btn-gray-800 w-100">Sign up</button>
                            </div>

                        </form>

                        <div class="d-flex justify-content-center align-items-center mt-4">
                            <span class="font-weight-normal">
                                Already have an account?
                                <a href="./login.php" class="font-weight-bold">Login here</a>
                            </span>
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

        $("#signup_btn").on("click", function(e) {

            e.preventDefault();

            var username = $("#username").val();
            var user_email = $("#user_email").val();
            var user_password = $("#user_password").val();
            var user_role = $("#user_role").val();
            var user_phone = $("#user_phone").val();

            if (username == "" || user_email == "" || user_password == "" || user_role == 0 || user_phone ==
                "") {
                error_message("All fields are required.");
            } else if (user_email.indexOf("@") == -1) {
                error_message("Enter valid email address.");
            } else if (user_phone.length < 10 || user_phone.length > 10) {
                error_message("Enter valid phone number.");
            } else {
                $("#register_form").trigger("reset");

                // console.table(username, user_email, user_password, user_role);

                $.ajax({
                    url: "php-files/ajax_register.php",
                    type: "POST",
                    data: {
                        username: username,
                        user_email: user_email,
                        user_password: user_password,
                        user_role: user_role,
                        user_phone: user_phone,
                    },
                    // $("#register_form").serialize(),
                    success: function(result) {
                        // alert(result);
                        if (result == "0") {
                            error_message("Query Failed.");
                        } else if (result == "taken") {
                            error_message("Username already taken please use another name.");
                        } else {
                            success_message("Registeration successful.");
                        }
                        // success_message("Registeration Successfully.");
                    }
                })
            }
        });


    })
</script>