<?php
    $title = "Dashboard";
    include_once('../classes/Users.php');
    $user = new Users();
    $name = $_SESSION['student_name'];
    $email = $_SESSION['student_email'];
    $password = $_SESSION['student_password'];

    if (!isset($email) && !isset($password)) {
        header("Location: ../index.php");
        exit();
    }

    #LOGOUT
    if(isset($_GET['logout'])){
        $user->logout();
    }
?>

<!-- HEADER -->
<?php include_once("includes/header.php"); ?>
    
        <!-- Begin page -->
        <div id="layout-wrapper">
            
            <!-- TOPBAR -->
            <?php include_once("includes/topbar.php"); ?>

            <!-- ========== Left Sidebar Start ========== -->
            <?php include_once("includes/sidebar.php"); ?>
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">
                        
                        <?php 
                            if(isset($view)){
                                if($view == "dashboard"){
                                    require("pages/page_dashboard.php");
                                }elseif($view == "manage_exam"){
                                    require("pages/page_manage_exam.php");
                                }elseif($view == "manage_notice"){
                                    require("pages/page_manage_notice.php");
                                }elseif($view == "edit_book"){
                                    require("pages/page_edit_book.php");
                                }elseif($view == "manage_books"){
                                    require("pages/page_manage_books.php");
                                }elseif($view == "add_thesis_paper"){
                                    require("pages/page_add_thesis_paper.php");
                                }elseif($view == "manage_thesis_paper"){
                                    require("pages/page_manage_thesis_paper.php");
                                }elseif($view == "edit_thesis_paper"){
                                    require("pages/page_edit_thesis_paper.php");
                                }elseif($view == "add_question_paper"){
                                    require("pages/page_add_question_paper.php");
                                }elseif($view == "manage_question_paper"){
                                    require("pages/page_manage_question_paper.php");
                                }elseif($view == "edit_question_paper"){
                                    require("pages/page_edit_question_paper.php");
                                }elseif($view == "manage_profile"){
                                    require("pages/page_manage_profile.php");
                                }elseif($view == "add_notes"){
                                    require("pages/page_add_notes.php");
                                }elseif($view == "manage_notes"){
                                    require("pages/page_manage_notes.php");
                                }elseif($view == "edit_notes"){
                                    require("pages/page_edit_notes.php");
                                }
                            }
                        ?>
                       
                    </div>
                    
                </div>
                <!-- End Page-content -->
               
                <?php include_once("includes/footer.php"); ?>

            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

<?php include_once("includes/scripts.php"); ?>