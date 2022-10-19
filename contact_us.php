<?php require_once("include/header.php"); ?>
<?php require_once("include/navigation.php"); ?>

<!-- <section class="py-7"> -->
<section class="container pt-7 pb-4">
    <div class="row justify-content-center">
        <div class="col-sm-12 col-md-8 col-lg-6">
            <div class="card bg-white shadow-soft border rounded border-light  overflow-hidden">
                <div class="card-body">
                    <div class="row">

                        <div class="text-center mb-2">
                            <div class="h3 font-weight-light">Contact Form</div>
                        </div>

                        <div class="">

                            <div class="col-12 my-3">
                                <i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;
                                <span><strong>Address </strong>: Ahmedabad, Gujarat, India</span>
                            </div>

                            <div class="col-12 my-3"><i class="fa fa-phone" aria-hidden="true"></i>
                                &nbsp;<span><strong>Let's Talk </strong>: +91 8834756342</span></div>

                            <div class="col-12 my-3"><i class="fa fa-envelope" aria-hidden="true"></i>
                                &nbsp;<span><strong>General
                                        Support </strong>: bidderspoint@gmail.com</span>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once("include/footer.php"); ?>

<!-- <script>
$(document).ready(function() {

    $("#contactForm").on("submit", function(e) {
        e.preventDefault();
        var email = $("#email").val();
        var name = $("#name").val();
        var message = $("#message").val();

        if (email == "" || name == "" || message == "") {
            error_message("All fields are required.");
        } else if (email.indexOf("@") == "-1") {
            error_message("Enter valid email address.");
        } else {
            $.ajax({
                url: "php-files/ajax_contact_us.php",
                type: "POST",
                data: {
                    email: email,
                    name: name,
                    message: message
                },
                success: function(result) {
                    // alert(result);
                    if (result == "1") {
                        success_message("Our team will contact you soon.");
                        $(this).trigger('reset');
                    } else if (result == "0") {
                        error_message("Something went wrong.");
                    }
                }
            })
        }
    });
});
</script> -->