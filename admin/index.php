<?php require_once("include/admin_header.php"); ?>

<?php require_once("../include/db_conn.php"); ?>

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

            <?php require_once("include/admin_navigation.php"); ?>

            <main class="content">

                <div class="d-flex justify-content-between mt-4">
                    <div>
                        <h3>Welcome <em class="text-blue"><?php echo $_SESSION['username']; ?></em>
                        </h3>
                        <h4 class="mt-2">Dashboard</h4>
                    </div>
                    <?php require_once("include/admin_fixed_nav.php"); ?>
                </div>

                <li role="separator" class="dropdown-divider mb-4 border-dark"></li>

                <div class="row">

                    <div class="col-xl-4 col-sm-6 mb-3">

                        <div class="card border-light shadow-sm">

                            <div class="card-body">

                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="col">
                                        <h2 class="h5">Products</h2>
                                        <h3 class="mb-1">
                                            <?php

                                            $query = "SELECT * FROM products";
                                            $stmt = $conn->prepare($query);
                                            $result = $stmt->execute();

                                            echo $stmt->rowCount();

                                            ?>
                                        </h3>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape icon-md icon-shape-info rounded">
                                            <i class="fas fa-boxes fa-2x"></i>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div
                                class="card-footer d-flex align-items-center justify-content-between bg-gradient-white py-2">
                                <a class="small stretched-link text-decoration-none my-1" href="./product.php">View
                                    Products</a>
                                <div class="small my-1">
                                    <i class="fas fa-angle-right"></i>
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="col-xl-4 col-sm-6 mb-3">

                        <div class="card border-light shadow-sm">

                            <div class="card-body">

                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="col">
                                        <h2 class="h5">Total Bids</h2>
                                        <h3 class="mb-1">
                                            <?php

                                            $user_id = $_SESSION['user_id'];

                                            $select_bid_query = "SELECT * FROM bids";
                                            $select_bid_stmt = $conn->prepare($select_bid_query);
                                            $bid_result = $select_bid_stmt->execute();

                                            if ($select_bid_stmt->rowCount() > 0) {
                                                $i = 0;
                                                while ($row = $select_bid_stmt->fetch(PDO::FETCH_OBJ)) {

                                                    $bid_user_id =  $row->bid_user_id;
                                                    $bid_product_id =  $row->bid_product_id;

                                                    $select_user_query = "SELECT * FROM users WHERE user_id = ?";
                                                    $select_user_stmt = $conn->prepare($select_user_query);
                                                    $user_result = $select_user_stmt->execute([$bid_user_id]);

                                                    $select_product_query = "SELECT * FROM products WHERE product_id = ? AND !winner > 0";
                                                    $select_product_stmt = $conn->prepare($select_product_query);
                                                    $product_result = $select_product_stmt->execute([$bid_product_id]);

                                                    if ($select_product_stmt->rowCount() > 0) {
                                                        $i = $i + 1;
                                                    }
                                                }
                                                echo $i;
                                            }

                                            ?>
                                        </h3>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape icon-md icon-shape-info rounded">
                                            <i class="fas fa-gavel fa-2x"></i>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div
                                class="card-footer d-flex align-items-center justify-content-between bg-gradient-white py-2">
                                <a class="small stretched-link text-decoration-none my-1" href="check_bids.php">View
                                    Bids</a>
                                <div class="small my-1">
                                    <i class="fas fa-angle-right"></i>
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="col-xl-4 col-sm-6 mb-3">

                        <div class="card border-light shadow-sm">

                            <div class="card-body">

                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="col">
                                        <h2 class="h5">Winners</h2>
                                        <h3 class="mb-1">
                                            <?php

                                            $query = "SELECT * FROM products WHERE winner > 0";
                                            $stmt = $conn->prepare($query);
                                            $result = $stmt->execute();

                                            echo $stmt->rowCount();

                                            ?>
                                        </h3>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape icon-md icon-shape-info rounded">
                                            <i class="fas fa-trophy fa-2x"></i>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div
                                class="card-footer d-flex align-items-center justify-content-between bg-gradient-white py-2">
                                <a class="small stretched-link text-decoration-none my-1" href="winner_list.php">View
                                    Winner</a>
                                <div class="small my-1">
                                    <i class="fas fa-angle-right"></i>
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="col-xl-4 col-sm-6 mb-3">

                        <div class="card border-light shadow-sm">

                            <div class="card-body">

                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="col">
                                        <h2 class="h5">Users</h2>
                                        <h3 class="mb-1">
                                            <?php

                                            $query = "SELECT * FROM users";
                                            $stmt = $conn->prepare($query);
                                            $result = $stmt->execute();

                                            echo $stmt->rowCount();

                                            ?>
                                        </h3>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape icon-md icon-shape-info rounded">
                                            <i class="fas fa-users fa-2x"></i>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div
                                class="card-footer d-flex align-items-center justify-content-between bg-gradient-white py-2">
                                <a class="small stretched-link text-decoration-none my-1" href="users.php">View
                                    Users</a>
                                <div class="small my-1">
                                    <i class="fas fa-angle-right"></i>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>

            </main>
        </div>
    </div>
</div>

<?php require_once("include/admin_footer.php"); ?>