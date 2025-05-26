<?php
    $title = "Edit Course";
    include_once(__DIR__ . '/../../classes/Departments.php');
    include_once(__DIR__ . '/../../classes/Programs.php');
    include_once(__DIR__ . '/../../classes/Courses.php');
    include_once(__DIR__ . '/../../classes/Faculties.php');
    $program = new Programs();
    $programs = $program->manage_program();
    $dpt = new Departments();
    $departments = $dpt->manage_department();
    $course = new Courses();
    $courses = $course->manage_course();
    $faculty = new Faculties();
    $faculties = $faculty->manage_faculty();

    if (isset($_POST['update_course'])) {
        if ($course->update_course($_POST, $_FILES)) {
            header("Location: manage_course.php");
            exit;
        }
    }

    $id = $_GET['id'];
    $data = $course->edit_course($id);
    $row = mysqli_fetch_assoc($data);

    // NOW include topbar and output HTML
    include_once(__DIR__ . '/../includes/topbar.php');

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
                    <a href="manage_course.php" class="btn btn-primary btn-sm">Course List</a>
                </div>
                                       
                <form class="needs-validation" novalidate="" method="POST" action="">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="validationCustom01" class="form-label">Course Name</label>
                                <input type="hidden" name="id" value="<?= $row['id'];?>">
                                <input type="text" class="form-control" id="validationCustom01" value="<?= $row['course_name'];?>" required="" name="course_name">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="validationCustom02" class="form-label">Department Name</label>
                                <select name="department_id" class="form-control select2" id="validationCustom02" required="">
                                    <option value="">--- Select Department ---</option>
                                    <?php foreach ($departments as $dept): ?>
                                        <option value="<?= $dept['id']; ?>" <?= ($dept['id'] == $row['department_id']) ? 'selected' : ''; ?>><?= htmlspecialchars($dept['name']); ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="validationCustom02" class="form-label">Credits</label>
                                <input type="text" class="form-control" id="validationCustom02" placeholder="Ex: 3" required="" name="credits" value="<?= $row['credits'];?>">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="validationCustom02" class="form-label">Semester</label>
                                <input type="text" class="form-control" id="validationCustom02" required="" name="semester" value="<?= $row['semester'];?>">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="validationCustom02" class="form-label">Program Name</label>
                                <select name="program_id" class="form-control select2" id="validationCustom02" required="">
                                    <option value="">--- Select Program ---</option>
                                    <?php foreach ($programs as $prg): ?>
                                        <option value="<?= $prg['id']; ?>" <?= ($prg['id'] == $row['program_id']) ? 'selected' : ''; ?>><?= htmlspecialchars($prg['program_name']); ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="validationCustom02" class="form-label">Instructor</label>
                                <select name="faculty_id" class="form-control select2" id="validationCustom02" required="">
                                    <option value="">--- Select Instructor ---</option>
                                    <?php foreach ($faculties as $faculty): ?>
                                        <option value="<?= $faculty['id'];?>" <?= ($faculty['id'] == $row['faculty_id']) ? 'selected' : ''; ?>><?= htmlspecialchars($faculty['name']); ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="validationCustom02" class="form-label">Course Code</label>
                                <input type="text" class="form-control" id="validationCustom02" required="" value="<?= $row['course_code'];?>" name="course_code">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <button class="btn btn-success" type="submit" name="update_course">Update</button>
                    </div>
                </form>
                                 
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
