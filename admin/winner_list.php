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
                        <h4 class="mt-2">Winner's List</h4>
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

            </main>
        </div>
    </div>
</div>

<?php require_once("./include/admin_footer.php"); ?>

<script>
$(document).ready(function() {

    function load_winner_data() {
        $.ajax({
            url: "php-files/ajax_load_winner_data.php",
            type: "POST",
            success: function(result) {
                $("#table-data").html(result);
            }
        });
    };

    load_winner_data();

});
</script>