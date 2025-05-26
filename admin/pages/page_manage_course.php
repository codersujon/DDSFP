<?php
    $title = "Manage Course";
    include_once(__DIR__ . '/../../classes/Courses.php');
    $course = new Courses();

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $course->delete_course($id);
    }
?>

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0"><?= $title; ?></h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                    <li class="breadcrumb-item active"><?= $title; ?></li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <div class="d-flex justify-content-between mb-3">
                    <h4 class="card-title"><?= $title; ?></h4>
                    <a href="add_course.php" class="btn btn-primary btn-sm">Add Course</a>
                </div>
               
                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                    <tr>
                        <th>#Course_ID</th>
                        <th>Course Name</th>
                        <th>Department ID</th>
                        <th>Program Name</th>
                        <th>Instructor</th>
                        <th>Credits</th>
                        <th>Semester</th>
                        <th>Course Code</th>
                        <th>Actions</th>
                    </tr>
                    </thead>

                    <tbody>
                        <?php 
                            $courses  = $course->manage_course();

                            if (mysqli_num_rows($courses) > 0) {
                                // Convert result to an array of objects
                                $courses = mysqli_fetch_all($courses, MYSQLI_ASSOC);
                                $i = 1;

                                foreach ($courses as $course): ?>
                                   <tr>
                                        <td>CRS-<?= $i++ ?></td>
                                        <td><?= htmlspecialchars($course['course_name'])?></td>
                                        <td>DPT-<?= htmlspecialchars($course['department_id'])?></td>
                                        <td><?= htmlspecialchars($course['program_name'])?></td>
                                        <td><?= htmlspecialchars($course['faculty_name'])?></td>
                                        <td><?= htmlspecialchars($course['credits'])?></td>
                                        <td><?= htmlspecialchars($course['semester']) ?></td>
                                        <td><?= htmlspecialchars($course['course_code'])?></td>
                                        <td>
                                            <a href="edit_course.php?id=<?= $course['id'];?>" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                            <a href="?id=<?= $course['id'];?>" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach;
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
