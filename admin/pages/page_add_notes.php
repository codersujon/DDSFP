<?php
    $title = "Add Notes";
    include_once(__DIR__ . '/../../classes/Courses.php');
    include_once(__DIR__ . '/../../classes/Notes.php');
    $name  = $_SESSION['admin_name'];
    $course = new Courses();
    $note = new Notes();
    $courses = $course->manage_course();

    if(isset($_POST['add_note'])){
        $note->add_note($_POST, $_FILES);
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
                    <a href="manage_notes.php" class="btn btn-primary btn-sm">View Notes List</a>
                </div>
                                       
                <form class="needs-validation" novalidate="" method="POST" action="" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="validationCustom01" class="form-label">Title</label>
                                <input type="text" class="form-control" id="validationCustom01" placeholder="Enter question paper title" required="" name="title">
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
                                <label for="validationCustom01" class="form-label">Upload File</label>
                                <input type="file" class="form-control" id="validationCustom01" required="" name="upload_file">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="validationCustom01" class="form-label">Uploaded Date</label>
                                <input type="datetime-local" class="form-control" id="validationCustom01" required="" name="uploaded_at">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="validationCustom02" class="form-label">Uploaded By Role</label>
                               <select name="uploadedByRole" class="form-control select2" id="validationCustom02" required="">
                                    <option value="">--- Select Uploaded Role ---</option>
                                    <?php 
                                        $SecltFaculty = ($name === "faculty_name") ? 'selected' : '';
                                        $SecltStudent = ($name === "student_name") ? 'selected' : '';
                                    ?>
                                    <option value="faculty" <?= $SecltFaculty; ?>>Faculty</option>
                                    <option value="student" <?= $SecltStudent; ?>>Student</option>
                                </select>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <button class="btn btn-primary" type="submit" name="add_note">Submit</button>
                    </div>
                </form>
                                 
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->