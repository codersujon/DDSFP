<?php
    $title = "Dashboard";
    include_once('../classes/Users.php');
    $user = new Users();
    $name = $_SESSION['admin_name'];
    $email = $_SESSION['admin_email'];
    $password = $_SESSION['admin_password'];

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
                                }elseif($view == "add_faculty"){
                                    require("pages/page_add_faculty.php");
                                }elseif($view == "manage_faculty"){
                                    require("pages/page_manage_faculty.php");
                                }elseif($view == "edit_faculty"){
                                    require("pages/page_edit_faculty.php");
                                }elseif($view == "add_department"){
                                    require("pages/page_add_department.php");
                                }elseif($view == "manage_department"){
                                    require("pages/page_manage_department.php");
                                }elseif($view == "edit_department"){
                                    require("pages/page_edit_department.php");
                                }elseif($view == "add_program"){
                                    require("pages/page_add_program.php");
                                }elseif($view == "manage_program"){
                                    require("pages/page_manage_program.php");
                                }elseif($view == "edit_program"){
                                    require("pages/page_edit_program.php");
                                }elseif($view == "add_course"){
                                    require("pages/page_add_course.php");
                                }elseif($view == "manage_course"){
                                    require("pages/page_manage_course.php");
                                }elseif($view == "edit_course"){
                                    require("pages/page_edit_course.php");
                                }elseif($view == "add_student"){
                                    require("pages/page_add_student.php");
                                }elseif($view == "manage_student"){
                                    require("pages/page_manage_student.php");
                                }elseif($view == "edit_student"){
                                    require("pages/page_edit_student.php");
                                }elseif($view == "add_exam"){
                                    require("pages/page_add_exam.php");
                                }elseif($view == "manage_exam"){
                                    require("pages/page_manage_exam.php");
                                }elseif($view == "edit_exam"){
                                    require("pages/page_edit_exam.php");
                                }elseif($view == "add_notice"){
                                    require("pages/page_add_notice.php");
                                }elseif($view == "manage_notice"){
                                    require("pages/page_manage_notice.php");
                                }elseif($view == "edit_notice"){
                                    require("pages/page_edit_notice.php");
                                }elseif($view == "add_book"){
                                    require("pages/page_add_book.php");
                                }elseif($view == "edit_book"){
                                    require("pages/page_edit_book.php");
                                }elseif($view == "manage_books"){
                                    require("pages/page_manage_books.php");
                                }elseif($view == "add_thesis_paper"){
                                    require("pages/page_add_thesis_paper.php");
                                }elseif($view == "manage_thesis_paper"){
                                    require("pages/page_manage_thesis_paper.php");
                                }elseif($view == "manage_question_paper"){
                                    require("pages/page_manage_question_paper.php");
                                }elseif($view == "add_question_paper"){
                                    require("pages/page_add_question_paper.php");
                                }elseif($view == "manage_profile"){
                                    require("pages/page_manage_profile.php");
                                }elseif($view == "edit_course"){
                                    require("pages/page_edit_course.php");
                                }elseif($view == "edit_thesis_paper"){
                                    require("pages/page_edit_thesis_paper.php");
                                }elseif($view == "edit_question_paper"){
                                    require("pages/page_edit_question_paper.php");
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