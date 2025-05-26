<?php
    $title = "Edit Notes";
    include_once(__DIR__ . '/../../classes/Courses.php');
    include_once(__DIR__ . '/../../classes/Notes.php');
    $course = new Courses();
    $courses = $course->manage_course();
   
    $note = new Notes();

    if (isset($_POST['update_note'])) {
        if ($note->update_note($_POST, $_FILES)) {
            header("Location: manage_notes.php");
            exit;
        }
    }

    $id = $_GET['id'];
    $data = $note->edit_note($id);
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
                    <a href="manage_notes.php" class="btn btn-primary btn-sm">View Notes List</a>
                </div>
                                       
                <form class="needs-validation" novalidate="" method="POST" action="" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="validationCustom01" class="form-label">Title</label>
                                <input type="hidden" name="id" value="<?= $row['id'];?>">
                                <input type="text" class="form-control" id="validationCustom01" value="<?= $row['title'];?>" required="" name="title">
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
                                        <option value="<?= $course['id']; ?>" <?= ($course['id'] == $row['course_id']) ? 'selected' : ''; ?>><?= htmlspecialchars($course['course_name']); ?></option>
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
                                <input type="file" class="form-control" id="validationCustom01" required="" name="upload_file" value="<?= $row['upload_file'];?>">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="validationCustom01" class="form-label">Uploaded Date</label>
                                <input type="datetime-local" class="form-control" id="validationCustom01" required="" name="uploaded_at" value="<?= $row['uploaded_at'];?>">
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
                                    <option value="faculty" <?= $row['uploaded_by_role'] == 'faculty'? 'selected':''?>>Faculty</option>
                                    <option value="student" <?= $row['uploaded_by_role'] == 'student'? 'selected':''?>>Student</option>
                                </select>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <button class="btn btn-success" type="submit" name="update_note">Update</button>
                    </div>
                </form>
                                 
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
