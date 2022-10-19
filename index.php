<!-- <?php #require_once("include/db_conn.php"); 
        ?> -->
<?php require_once("include/header.php"); ?>
<?php require_once("include/navigation.php"); ?>



<main>

    <section class="section-header bg-primary text-white py-7">
        <div class="container p-0">
            <div class="d-flex align-items-center justify-content-center">
                <div
                    class="col-12 row align-items-center justify-content-between px-3 text-center text-md-left px-md-0">

                    <div class="col-md-5 mb-4 mb-md-0 mt-0">

                        <h2 class="h1">Bidder's Point</h2>
                        <p class="font-weight-light h4">India's No. 1 online auction
                            platform.</p>

                    </div>

                    <div class="col-md-7 my-4 my-md-0">
                        <img src="images/auction.png" class="image-fluid" alt="bidding_platform_image">
                    </div>

                </div>
            </div>
        </div>
    </section>

    <section class="section section-sm pt-0">
        <div class="container">

            <div class="row justify-content-center my-5">
                <div class="col-12 text-center">
                    <h2 class="h1 px-lg-5">More Information</h2>
                    <p class="lead px-lg-10">Every page from Volt has been carefully built to provide all the
                        necessary pages your startup will require</p>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-6 col-md-3 text-center">
                    <div
                        class="icon icon-shape icon-lg bg-white shadow-lg border-light rounded-circle icon-secondary mb-4">
                        <div class="h4 m-0 p-0 text-secondary">100K+</div>
                    </div>
                    <h4 class="font-weight-bold">Auctioneer</h4>
                </div>
                <div class="col-6 col-md-3 text-center">
                    <div
                        class="icon icon-shape icon-lg bg-white shadow-lg border-light rounded-circle icon-secondary mb-4">
                        <div class="h4 m-0 p-0 text-secondary">200K+</div>
                    </div>
                    <h4 class="font-weight-bold">Bidder</h4>
                </div>
                <div class="col-6 col-md-3 text-center">
                    <div
                        class="icon icon-shape icon-lg bg-white shadow-lg border-light rounded-circle icon-secondary mb-4">
                        <div class="h4 m-0 p-0 text-secondary">1K+</div>
                    </div>
                    <h4 class="font-weight-bold">Total Product</h4>
                </div>
                <div class="col-6 col-md-3 text-center">
                    <div
                        class="icon icon-shape icon-lg bg-white shadow-lg border-light rounded-circle icon-secondary mb-4">
                        <div class="h4 m-0 p-0 text-secondary">50K+</div>
                    </div>
                    <h4 class="font-weight-bold">Total Bids</h4>
                </div>
            </div>
        </div>
    </section>

    <section class="section  bg-primary text-white">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-12 text-center">
                    <h2 class="h1 px-lg-5">Awesome Products</h2>
                </div>
            </div>

            <div id="product-data" class="row">


            </div>

        </div>
    </section>

</main>

<footer class="footer py-5 bg-white">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <span class="h5 mb-3 d-block">Bidder's Point</span>
                <p class="text-left">The purpose of introducing Bidder's Point is used to turn auction into
                    digitally, so auctioneer and
                    bidder can securely sell and purchase through digital platform without going to anywhere</p>
            </div>
            <div class="col-md-4 ml-auto mt-3 mt-md-0">
                <span class="h5 mb-3 d-block">Subscribe</span>
                <form action="#">
                    <div class="form-row mb-2">
                        <div class="col-12">
                            <input type="email" class="form-control mb-2" placeholder="example@company.com" name="email"
                                aria-label="Subscribe form" required>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-secondary text-dark shadow-soft btn-block"
                                data-loading-text="Sending">
                                <span>Subscribe</span>
                            </button>
                        </div>
                    </div>
                </form>
                <p class="text-muted font-small m-0">We'll never share your details. See our <a class="text-dark"
                        href="#">Privacy Policy</a></p>
            </div>
        </div>
    </div>
</footer>

<?php require_once("include/footer.php"); ?>

<script>
$(document).ready(function() {

    function load_product() {
        $.ajax({
            url: "php-files/ajax_load_product.php",
            type: "POST",
            success: function(result) {
                $("#product-data").html(result);
            }
        });
    }

    load_product();
})
</script>