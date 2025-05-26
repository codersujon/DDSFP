<?php
    $title = "Edit Thesis Paper";
    include_once(__DIR__ . '/../../classes/Departments.php');
    include_once(__DIR__ . '/../../classes/ThesisPapers.php');
    include_once(__DIR__ . '/../../classes/Students.php');
    $student = new Students();
    $students = $student->manage_student();
    $dpt = new Departments();
    $departments = $dpt->manage_department();
    $tp = new ThesisPapers();

    if (isset($_POST['update_tp'])) {
        if ($tp->update_tp($_POST, $_FILES)) {
            header("Location: manage_thesis_paper.php");
            exit;
        }
    }

    $id = $_GET['id'];
    $data = $tp->edit_tp($id);
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
                    <a href="manage_thesis_paper.php" class="btn btn-primary btn-sm">Thesis Paper List</a>
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
                                <label for="validationCustom02" class="form-label">Student Name</label>
                                <select name="student_id" class="form-control select2" id="validationCustom02" required="">
                                    <option value="">--- Select Student ---</option>
                                    <?php foreach ($students as $student): ?>
                                        <option value="<?= $student['id']; ?>" <?= ($student['id'] == $row['student_id']) ? 'selected' : ''; ?>><?= htmlspecialchars($student['student_name']); ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="validationCustom01" class="form-label">Submission Date</label>
                                <input type="date" class="form-control" id="validationCustom01" required="" value="<?= $row['submission_date'];?>" name="submission_date" >
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="validationCustom01" class="form-label">Supervisor name</label>
                                <input type="text" class="form-control" id="validationCustom01" value="<?= $row['supervisor_name'];?>" required="" name="supervisor_name">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                         <div class="col-md-6">
                            <div class="mb-3">
                                <label for="validationCustom01" class="form-label">Upload File (pdf, doc, docx, ppt, pptx, txt, zip, rar)</label>
                                <input type="file" class="form-control" id="validationCustom01" required="" name="upload_file" value="<?= $row['upload_file'];?>">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="validationCustom02" class="form-label">Approval Status</label>
                               <select name="is_approval" class="form-control select2" id="validationCustom02" required="">
                                    <option value="">--- Select Status ---</option>
                                    <option value="pending" <?= $row['approved_status'] == 'pending'? 'selected':''?>>Pending</option>
                                    <option value="approved" <?= $row['approved_status'] == 'approved'? 'selected':''?>>Approved</option>
                                    <option value="rejected" <?= $row['approved_status'] == 'rejected'? 'selected':''?>>Rejected</option>
                                </select>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <button class="btn btn-success" type="submit" name="update_tp">Update</button>
                    </div>
                </form>
                                 
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->