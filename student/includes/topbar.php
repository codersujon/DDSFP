 <?php 
    include_once(__DIR__ . '/../../classes/Users.php');
    $user = new Users();
    $email = $_SESSION['student_email'];
    $data = $user->user_profile($email);
    $row = mysqli_fetch_assoc($data);
    $_SESSION['profile_image'] = $row['upload_image'];
?>

<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="dashboard.php" class="logo logo-dark text-light">
                    <span class="logo-sm">
                        <img src="assets/images/JSTU.png" alt="logo-sm" height="50"> 
                        <strong>UDMS</strong>
                    </span>
                    <span class="logo-lg">
                        <img src="assets/images/JSTU.png" alt="logo-dark" height="50"> 
                        <strong>UDMS</strong>
                    </span>
                </a>

                <a href="dashboard.php" class="logo logo-light text-light">
                    <span class="logo-sm">
                        <img src="assets/images/JSTU.png" alt="logo-sm-light" height="30">
                    </span>
                    <span class="logo-lg">
                        <img src="assets/images/JSTU.png" alt="logo-light" height="50">
                        <strong>DDSFP</strong>
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                <i class="ri-menu-2-line align-middle"></i>
            </button>
        </div>

        <div class="d-flex">

            <div class="dropdown d-inline-block d-lg-none ms-2">
                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="ri-search-line"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                    aria-labelledby="page-header-search-dropdown">
        
                    <form class="p-3">
                        <div class="mb-3 m-0">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search ...">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit"><i class="ri-search-line"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="dropdown d-none d-lg-inline-block ms-1">
                <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                    <i class="ri-fullscreen-line"></i>
                </button>
            </div>

            <div class="dropdown d-inline-block user-dropdown">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user" src="../uploads/users/<?= $_SESSION['profile_image'];?>"
                        alt="Header Avatar">
                    <span class="d-none d-xl-inline-block ms-1"><?= $name;?></span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <a class="dropdown-item" href="manage_profile.php"><i class="ri-user-line align-middle me-1"></i> Profile</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" href="?logout=logout"><i class="ri-shut-down-line align-middle me-1 text-danger"></i> Logout</a>
                </div>
            </div>

        </div>
    </div>
</header>