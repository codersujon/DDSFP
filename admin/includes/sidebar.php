 <?php 
    include_once(__DIR__ . '/../../classes/Users.php');
    $user = new Users();
    $email = $_SESSION['admin_email'];
    $data = $user->user_profile($email);
    $row = mysqli_fetch_assoc($data);
    $_SESSION['profile_image'] = $row['upload_image'];
?>

<div class="vertical-menu">

<div data-simplebar class="h-100">

    <!-- User details -->
    <div class="user-profile text-center mt-3">
        <div class="image">
            <img src="../uploads/users/<?= $_SESSION['profile_image'];?>" alt="User Avatar" class="avatar-md rounded-circle">
        </div>
        <div class="mt-3">
            <h4 class="font-size-16 mb-1"><?= $email;?></h4>
            <span class="text-muted"><i class="ri-record-circle-line align-middle font-size-14 text-success"></i> Online</span>
        </div>
    </div>


    <!--- Sidemenu -->
    <div id="sidebar-menu">
        <!-- Left Menu Start -->
        <ul class="metismenu list-unstyled" id="side-menu">
            <li class="menu-title">Pages</li>

            <li>
                <a href="dashboard.php" class="waves-effect">
                    <i class="ri-home-line"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="ri-dashboard-line"></i>
                    <span>Manage University</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="manage_notice.php">Manage Notice</a></li>
                    <li><a href="manage_books.php">All Books</a></li>
                    <li><a href="manage_thesis_paper.php">Thesis Paper</a></li>
                    <li><a href="manage_question_paper.php">Questions Paper</a></li>
                    <li><a href="manage_notes.php">All Notes Share</a></li>
                </ul>
            </li>
            <li>
                <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="ri-dashboard-line"></i>
                    <span>Departments</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="add_department.php">Add Department</a></li>
                    <li><a href="manage_department.php">Manage Department</a></li>
                </ul>
            </li>
            <li>
                <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="ri-dashboard-line"></i>
                    <span>Faculties</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="add_faculty.php">Add Faculty</a></li>
                    <li><a href="manage_faculty.php">Manage Faculty</a></li>
                </ul>
            </li>
            
            <li>
                <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="ri-dashboard-line"></i>
                    <span>Programs</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="add_program.php">Add Program</a></li>
                    <li><a href="manage_program.php">Manage Program</a></li>
                </ul>
            </li>
            <li>
                <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="ri-dashboard-line"></i>
                    <span>Courses</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="add_course.php">Add Course</a></li>
                    <li><a href="manage_course.php">Manage Course</a></li>
                </ul>
            </li>
            <li>
                <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="ri-dashboard-line"></i>
                    <span>Students</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="add_student.php">Add Student</a></li>
                    <li><a href="manage_student.php">Manage Student</a></li>
                </ul>
            </li>
            <li>
                <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="ri-dashboard-line"></i>
                    <span>Exam Details</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="add_exam.php">Add Exam</a></li>
                    <li><a href="manage_exam.php">Manage Exam</a></li>
                </ul>
            </li>
           
        </ul>
    </div>
    <!-- Sidebar -->
</div>
</div>