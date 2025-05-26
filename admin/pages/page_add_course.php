<?php
    $title = "Add Course";
    include_once(__DIR__ . '/../../classes/Departments.php');
    include_once(__DIR__ . '/../../classes/Programs.php');
    include_once(__DIR__ . '/../../classes/Faculties.php');
    include_once(__DIR__ . '/../../classes/Courses.php');
    $dpt = new Departments();
    $program = new Programs();
    $faculty = new Faculties();
    $course = new Courses();
    $departments = $dpt->manage_department();
    $programs = $program->manage_program();
    $faculties = $faculty->manage_faculty();


    if(isset($_POST['add_course'])){
        $course->add_course($_POST);
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
                    <a href="manage_course.php" class="btn btn-primary btn-sm">Course List</a>
                </div>
                                       
                <form class="needs-validation" novalidate="" method="POST" action="">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="validationCustom01" class="form-label">Course Name</label>
                                <input type="text" class="form-control" id="validationCustom01" placeholder="Enter Course Name" required="" name="course_name">
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
                                        <option value="<?= $dept['id']; ?>"><?= htmlspecialchars($dept['name']); ?></option>
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
                                <input type="text" class="form-control" id="validationCustom02" placeholder="Ex: 3" required="" name="credits">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="validationCustom02" class="form-label">Semester</label>
                                <input type="text" class="form-control" id="validationCustom02" required="" name="semester" placeholder="Ex: 2">
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
                                        <option value="<?= $prg['id']; ?>"><?= htmlspecialchars($prg['program_name']); ?></option>
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
                                        <option value="<?= $faculty['id']; ?>"><?= htmlspecialchars($faculty['name']); ?></option>
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
                                <input type="text" class="form-control" id="validationCustom02" required="" placeholder="Ex: CS101" name="course_code">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <button class="btn btn-primary" type="submit" name="add_course">Submit</button>
                    </div>
                </form>
                                 
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->