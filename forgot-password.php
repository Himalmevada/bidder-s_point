<?php require_once("include/header.php"); ?>

<main>

    <!-- Section -->
    <section class="vh-lg-100 bg-soft d-flex align-items-center">
        <div class="container">
            <div class="row justify-content-center form-bg-image">
                <div class="col-12 d-flex align-items-center justify-content-center">
                    <div
                        class="signin-inner my-3 my-lg-0 bg-white shadow-soft border rounded border-light p-4 p-lg-5 w-100 fmxw-500">
                        <h1 class="h3">Reset your password?</h1>
                        <p class="mb-4">
                            An email will be send to you with instructions on how to reset your password.
                        </p>
                        <form action="#">
                            <!-- Form -->
                            <div class="mb-4">
                                <label for="email">Your Email</label>
                                <div class="input-group">
                                    <input type="email" class="form-control" id="email" autofocus>
                                </div>
                            </div>
                            <!-- End of Form -->
                            <button type="submit" id="forgot_pass_btn" class="btn btn-block btn-primary">Reset password
                                by Mail</button>
                        </form>
                        <div class="d-flex justify-content-center align-items-center mt-4">
                            <span class="font-weight-normal">
                                Go back to the
                                <a href="./login.php" class="font-weight-bold">login page</a>
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

    $("#forgot_pass_btn").on("click", function(e) {
        e.preventDefault();
        let email = $("#email").val();
        if (email == "") {
            error_message("Email is required.");
        } else if (email.indexOf("@") == "-1") {
            error_message("Enter valid email address.");
        } else {
            // window.location.href = "";
            $.ajax({
                url: "php-files/ajax_forgot_password_func.php",
                type: "POST",
                data: {
                    email: email
                },
                success: function(result) {
                    // alert(result);
                    if (result == "1") {
                        success_message(
                            `Reset password link send to <span class='font-weight-bold text-dark'>${email}</span>`
                        );
                        setInterval(function() {
                            window.location.href = "./login.php";
                        }, 3000);
                    } else if (result == "no_found") {
                        error_message("Email doesn't exist!.");
                    } else {
                        error_message("Something went wrong.");
                    }
                }
            })
        }
    });
});
</script>