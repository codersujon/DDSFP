<?php
    $title = "Add Exam";
    include_once(__DIR__ . '/../../classes/Programs.php');
    include_once(__DIR__ . '/../../classes/Courses.php');
    include_once(__DIR__ . '/../../classes/Exams.php');
    $program = new Programs();
    $course = new Courses();
    $Exam = new Exams();
    $programs = $program->manage_program();
    $courses = $course->manage_course();

    if(isset($_POST['add_exam'])){
        $Exam->add_exam($_POST);
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
                    <a href="manage_program.php" class="btn btn-primary btn-sm">Exam List</a>
                </div>
                                       
                <form class="needs-validation" novalidate="" method="POST" action="">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="validationCustom01" class="form-label">Exam Title</label>
                                <input type="text" class="form-control" id="validationCustom01" placeholder="Enter Exam Title" required="" name="exam_title">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="validationCustom01" class="form-label">Exam Type</label>
                                <input type="text" class="form-control" id="validationCustom01" placeholder="Enter Exam Type" required="" name="exam_type">
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
                                <label for="validationCustom02" class="form-label">Course Name</label>
                                <select name="course_id" class="form-control select2" id="validationCustom02" required="">
                                    <option value="">--- Select Course ---</option>
                                    <?php foreach ($courses as $course): ?>
                                        <option value="<?= $course['id']; ?>"><?= htmlspecialchars($course['course_name']); ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="validationCustom02" class="form-label">Exam Date</label>
                                <input type="date" class="form-control" id="validationCustom02" required="" name="exam_date">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="validationCustom02" class="form-label">Start Time</label>
                                <input type="time" class="form-control" id="validationCustom02" required="" placeholder="Ex: 10:00 AM" name="start_time">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="validationCustom02" class="form-label">End Time</label>
                                <input type="time" class="form-control" id="validationCustom02" required="" placeholder="Ex: 10:00 AM" name="end_time">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="validationCustom01" class="form-label">Location</label>
                                <input type="text" class="form-control" id="validationCustom01" placeholder="Enter location" required="" name="location">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                         <div class="col-md-6">
                            <div class="mb-3">
                                <label for="validationCustom01" class="form-label">Total Marks</label>
                                <input type="text" class="form-control" id="validationCustom01" placeholder="Ex: 100" required="" name="total_marks">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="validationCustom01" class="form-label">Passing Marks</label>
                                <input type="text" class="form-control" id="validationCustom01" placeholder="Ex: 40" required="" name="passing_marks">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="validationCustom02" class="form-label">Semester</label>
                                <input type="text" class="form-control" id="validationCustom02" required="" name="semester" placeholder="Ex: 2">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <button class="btn btn-primary" type="submit" name="add_exam">Submit</button>
                    </div>
                </form>
                                 
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->