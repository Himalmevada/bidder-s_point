<!-- NAVIGATION BAR -->

<header class="header-global fixed-top">
    <nav id="navbar-main" aria-label="Primary navigation"
        class="navbar navbar-main navbar-expand-md navbar-theme-primary pt-4 navbar-dark">
        <div class="container position-relative">
            <a class="navbar-brand text-white border-top border-bottom" href="./index.php">Bidder's Point</a>
            <div class="navbar-collapse ml-md-auto collapse" id="navbar_global">
                <div class="navbar-collapse-header">
                    <div class="row">
                        <div class="col-6 collapse-brand">
                            <a href="./index.html">
                                <span class="fas fa-bid"></span>
                            </a>
                        </div>
                        <div class="col-6 collapse-close">
                            <a href="#navbar_global" class="fas fa-times collapsed" data-toggle="collapse"
                                data-target="#navbar_global" aria-controls="navbar_global" aria-expanded="false"
                                title="close" aria-label="Toggle navigation"></a>
                        </div>
                    </div>
                </div>
                <ul class="navbar-nav navbar-nav-hover align-items-lg-center">
                    <?php

                    require_once("./include/db_conn.php");

                    // ob_start();
                    // session_start();

                    if (isset($_SESSION['username']) && isset($_SESSION['user_role']) && ($_SESSION['user_role'] == "bidder" || $_SESSION['user_role'] == "admin")) {
                        $role = $_SESSION['user_role'];
                        echo "
                        <li class='nav-item'>
                            <a href='./contact_us.php' class='nav-link'>Contact Us</a>
                        </li>
                        <li class='nav-item'>
                            <a href='./$role/index.php' class='nav-link'>Go to Dashboard</a>
                        </li>
                        <li class='nav-item'>
                            <a href='./include/logout.php' class='nav-link text-danger'>Logout</a>
                        </li>
                        ";
                    } else {
                        echo "
                        <li class='nav-item'>
                            <a href='./login.php' class='nav-link'>Login</a>
                        </li>
                        <li class='nav-item'>
                            <a href='./register.php' class='nav-link'>Register</a>
                        </li>
                        <li class='nav-item'>
                            <a href='./contact_us.php' class='nav-link'>Contact Us</a>
                        </li>
                        ";
                    }



                    ?>

                    <!-- <li class="nav-item mr-2">
                        <a href="./login.php" class="nav-link">Login</a>
                    </li>
                    <li class="nav-item">
                        <a href="./register.php" class="nav-link">Register</a>
                    </li>
                    <li class="nav-item mr-2">
                        <a href="./contact.php" class="nav-link">Contact Us</a>
                    </li> -->
                </ul>
            </div>

            <div class="d-flex align-items-center ml-auto ml-md-0">
                <button class="navbar-toggler ml-2 collapsed" type="button" data-toggle="collapse"
                    data-target="#navbar_global" aria-controls="navbar_global" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>

        </div>
    </nav>
</header>