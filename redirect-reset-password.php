<?php
if (isset($_GET['selector']) && isset($_GET['token_validator']) && !empty($_GET['selector']) && !empty($_GET['token_validator'])) {

?>

<?php require_once("include/header.php"); ?>

<main>
    <!-- Section -->
    <section class="vh-lg-100 bg-soft d-flex align-items-center">
        <div class="container">
            <div class="row justify-content-center form-bg-image">
                <div class="col-12 d-flex align-items-center justify-content-center">
                    <div
                        class="signin-inner my-3 my-lg-0 bg-white shadow-soft border rounded border-light p-4 p-lg-5 w-100 fmxw-500">
                        <h1 class="h3">Reset your password</h1>
                        <form method="POST">
                            <!-- Form -->
                            <input type="hidden" class="form-control" id="selector"
                                value="<?php echo $_GET['selector']; ?>">
                            <input type="hidden" class="form-control" id="token_validator"
                                value="<?php echo $_GET['token_validator']; ?>">

                            <div class="mb-4">
                                <div class="mb-3">
                                    <label for="password">New Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="password" autofocus>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="password">Confirm Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="confirm_password">
                                    </div>
                                </div>
                            </div>
                            <!-- End of Form -->
                            <button type="submit" id="reset_pass_btn" class="btn btn-block btn-primary">Reset
                                password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>


<?php require_once("include/footer.php"); ?>

<script>
$(document).ready(function() {

    $("#reset_pass_btn").on("click", function(e) {

        e.preventDefault();

        // var urlString = (window.location).href;
        // var paramString = urlString.split('?')[1];
        // var param_arr = paramString.split('&');
        // var data = [];

        // for (let i = 0; i < param_arr.length; i++) {
        //     var pair = param_arr[i].split('=');
        //     data[i] = pair[1];
        // }


        let selector = $("#selector").val();
        let token_validator = $("#token_validator").val();
        let password = $("#password").val();
        let confirm_password = $("#confirm_password").val();
        if (password == "" || confirm_password == "") {
            error_message("All fields are required.");
        } else if (password !== confirm_password) {
            error_message("Password and Confirm Password must be same.");
        } else {
            $.ajax({
                url: 'php-files/ajax_set_password.php',
                type: 'POST',
                data: {
                    selector: selector,
                    token_validator: token_validator,
                    password: password,
                    // confirm_password: confirm_password
                },
                success: function(result) {
                    if (result == "expire") {
                        error_message("You need to re-submit your reset password.");
                    } else if (result == "0") {
                        error_message("You need to re-submit your reset password.");
                    } else if (result = "1") {
                        success_message("Your password is suceessfully reset.");
                        setInterval(function() {
                            window.location.href = "./login.php";
                        }, 3000)
                    }
                }
            })
        }
    });
});
</script>

<?php

} else {
    header("Location: ./login.php");
}

?>