<nav id="sidebarMenu" class="sidebar d-md-block bg-primary text-white collapse" data-simplebar>
    <div class="sidebar-inner px-4 pt-3">
        <div
            class="ml-2 user-card d-flex d-md-none align-items-center justify-content-between justify-content-md-center pb-4">
            <div class="d-flex align-items-center">
                <div class="user-avatar lg-avatar mr-4">
                    <img src="../images/user-image/<?php echo $_SESSION['user_image']; ?>"
                        class="card-img-top rounded-circle border-white" alt="user_image" />
                </div>
                <div class="d-block">
                    <a href="../include/logout.php" class="btn btn-secondary text-dark btn-xs"><span class="mr-2"><span
                                class="fas fa-sign-out-alt"></span></span>Log Out</a>
                </div>
            </div>

            <div class="collapse-close d-md-none">
                <a href="#sidebarMenu" class="fas fa-times" data-toggle="collapse" data-target="#sidebarMenu"
                    aria-controls="sidebarMenu" aria-expanded="true" aria-label="Toggle navigation"></a>
            </div>
        </div>

        <div class="p-2 d-none d-md-block">
            <a class="navbar-brand mr-lg-5" href="index.php">
                Bidder's Point
            </a>
        </div>

        <li role="separator" class="dropdown-divider mb-3 border-white d-none d-md-block"></li>

        <ul class="nav flex-column">
            <li class="nav-item <?php if (strpos($_SERVER['PHP_SELF'], "/index.php")) { ?>  active <?php   }  ?>">
                <a href="./index.php" class="nav-link">
                    <span class="sidebar-icon"><span class="fas fa-chart-pie"></span></span>
                    <span>Overview</span>
                </a>
            </li>
            <li class="nav-item <?php if (strpos($_SERVER['PHP_SELF'], "/product.php")) { ?>  active <?php   }  ?>">
                <a href="./product.php" class="nav-link">
                    <span class="sidebar-icon"><span class="fas fa-box"></span></span>
                    <span>Manage Product</span>
                </a>
            </li>
            <li class="nav-item <?php if (strpos($_SERVER['PHP_SELF'], "/check_bids.php")) { ?>  active <?php   }  ?>">
                <a href="./check_bids.php" class="nav-link">
                    <span class="sidebar-icon"><span class="fas fa-gavel"></span></span>
                    <span>Check Bids</span>
                </a>
            </li>
            <li class="nav-item <?php if (strpos($_SERVER['PHP_SELF'], "/winner_list.php")) { ?>  active <?php   }  ?>">
                <a href="./winner_list.php" class="nav-link">
                    <span class="sidebar-icon"><span class="fas fa-trophy"></span></span>
                    <span>Winner List</span>
                </a>
            </li>
            <li class="nav-item <?php if (strpos($_SERVER['PHP_SELF'], "/profile.php")) { ?>  active <?php   }  ?>">
                <a href="./profile.php" class="nav-link">
                    <span class="sidebar-icon"><span class="fas fa-user"></span></span>
                    <span>Profile</span>
                </a>
            </li>
        </ul>
    </div>
</nav>