<?php
    require_once("classes/Users.php");
    $user = new Users();

    if(isset($_POST['login'])){
        $user->login($_POST);
    }

    if(isset($_SESSION['admin_email']) && isset($_SESSION['admin_password'])){
        header("Location: admin/dashboard.php");
    }

?>

<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>LOGIN | D D S F P</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- App favicon -->
        <link rel="shortcut icon" href="./admin/assets/images/favicon.ico">

        <!-- Bootstrap Css -->
        <link href="./admin/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="./admin/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="./admin/assets/css/app.css" id="app-style" rel="stylesheet" type="text/css" />

    </head>

    <body class="auth-body-bg">
        <div class="bg-overlay"></div>
        <div class="wrapper-page">
            <div class="container-fluid p-0">
                <div class="card">
                    <div class="card-body">

                        <div class="text-center mt-4">
                            <div class="mb-3">
                                <a href="index.html" class="auth-logo">
                                    <img src="./admin/assets/images/JSTU.png" height="100" class="logo-dark mx-auto" alt="">
                                    <img src="./admin/assets/images/JSTU.png" height="100" class="logo-light mx-auto" alt="">
                                </a>
                            </div>
                        </div>
    
                        <h4 class="text-muted text-center font-size-18"><b>Login</b></h4>
    
                        <div class="p-3">
                            <form class="form-horizontal mt-3" action="" method="POST">
                                <!-- Display Message -->
                                <?php 
                                    if(isset($_SESSION['msg'])){ ?>


                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <?php echo $_SESSION['msg']; ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>

                                <?php
                                    }
                                ?>
                                
                                <div class="form-group mb-3 row">
                                    <div class="col-12">
                                        <select name="role" id="role" class="form-control select" required="">
                                            <option value="">--Select Role--</option>
                                            <option value="admin">Admin</option>
                                            <option value="faculty">Faculty</option>
                                            <option value="student">Student</option>
                                        </select>
                                    </div>
                                </div>
    
                                <div class="form-group mb-3 row">
                                    <div class="col-12">
                                        <input class="form-control" type="email" name="email" required="" placeholder="Email">
                                    </div>
                                </div>
    
                                <div class="form-group mb-3 row">
                                    <div class="col-12">
                                        <input class="form-control" type="password" name="password" required="" placeholder="Password">
                                    </div>
                                </div>
    
                                <div class="form-group mb-3 text-center row mt-3 pt-1">
                                    <div class="col-12">
                                        <input type="submit" value="Log In" class="btn btn-info w-100 waves-effect waves-light" name="login">
                                    </div>
                                </div>
    
                            </form>
                        </div>
                        <!-- end -->
                    </div>
                    <!-- end cardbody -->
                </div>
                <!-- end card -->
            </div>
            <!-- end container -->
        </div>
        <!-- end -->

        <!-- JAVASCRIPT -->
        <script src="./admin/assets/libs/jquery/jquery.min.js"></script>
        <script src="./admin/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="./admin/assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="./admin/assets/libs/simplebar/simplebar.min.js"></script>
        <script src="./admin/assets/libs/node-waves/waves.min.js"></script>

        <script src="./admin/assets/js/app.js"></script>

    </body>
</html>
