<div id="fixed-nav" class="d-none d-md-flex">
    <div class="ml-auto">
        <a type="button" href="#" class="dropdown-toggle dropdown-toggle-split p-0 " data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">

            <div class="d-flex align-items-center">
                <img class="user-avatar md-avatar rounded-circle" alt="user_image"
                    src="../images/user-image/<?php echo $_SESSION['user_image']; ?>" />
                <div class="ml-2 text-dark">
                    <span
                        class="mb-0 font-small font-weight-bold text-capitalize"><?php echo $_SESSION['username']; ?></span>
                </div>
                <span class="ml-2 fas fa-angle-down dropdown-arrow"></span>
                <span class="sr-only">Toggle Dropdown</span>
            </div>
        </a>
        <div class="dropdown-menu">
            <a class="dropdown-item font-weight-bold" href="./profile.php"><span class="far fa-user-circle"></span>My
                Profile</a>
            <a class="dropdown-item font-weight-bold" href="../include/logout.php"><span
                    class="fas fa-sign-out-alt text-danger"></span>Logout</a>
        </div>
    </div>
</div>