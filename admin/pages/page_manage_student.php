<?php
    $title = "Manage Student";
    include_once(__DIR__ . '/../../classes/Students.php');
    $student = new Students();

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $student->delete_student($id);
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
                    <a href="add_student.php" class="btn btn-primary btn-sm">Add Student</a>
                </div>
               
                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                    <tr>
                        <th>#Id</th>
                        <th>Student Name</th>
                        <!-- <th>Department ID</th> -->
                        <th>Program ID</th>
                        <th>Gender</th>
                        <th>Email</th>
                        <th>Date of Birth</th>
                        <th>Phone</th>
                        <th>Enrollment Year</th>
                        <th>Semester</th>
                        <th>Address</th>
                        <th>Actions</th>
                    </tr>
                    </thead>

                    <tbody>
                        <?php 
                            $students  = $student->manage_student();

                            if (mysqli_num_rows($students) > 0) {
                                // Convert result to an array of objects
                                $students = mysqli_fetch_all($students, MYSQLI_ASSOC);
                                $i = 1;

                                foreach ($students as $student): ?>
                                   <tr>
                                        <td>STD-<?= $i++ ?></td>
                                        <td><?= htmlspecialchars($student['student_name']) ?></td>
                                        <!-- <td>DTP-<?= htmlspecialchars($student['department_id']) ?></td> -->
                                        <td>PRG-<?= htmlspecialchars($student['program_id']) ?></td>
                                        <td><?= htmlspecialchars($student['gender']) ?></td>
                                        <td><?= htmlspecialchars($student['email']) ?></td>
                                        <td><?= date('j F Y', strtotime($student['dob'])) ?></td>
                                        <td><?= htmlspecialchars($student['phone']) ?></td>
                                        <td><?= htmlspecialchars($student['enrollment_year']) ?></td>
                                        <td><?= htmlspecialchars($student['semester']) ?></td>
                                        <td><?= htmlspecialchars($student['address']) ?></td>
                                        <td>
                                            <a href="edit_student.php?id=<?= $student['id'];?>" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                            <a href="?id=<?= $student['id'];?>" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
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
