<?php
    $title = "Edit Student";
    include_once(__DIR__ . '/../../classes/Departments.php');
    include_once(__DIR__ . '/../../classes/Programs.php');
    include_once(__DIR__ . '/../../classes/Students.php');
    $program = new Programs();
    $programs = $program->manage_program();
    $dpt = new Departments();
    $departments = $dpt->manage_department();
    $student = new Students();

    if (isset($_POST['update_student'])) {
        if ($student->update_student($_POST, $_FILES)) {
            header("Location: manage_student.php");
            exit;
        }
    }

    $id = $_GET['id'];
    $data = $student->edit_student($id);
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
                    <a href="manage_student.php" class="btn btn-primary btn-sm">Student List</a>
                </div>
                                       
                <form class="needs-validation" novalidate="" method="POST" action="">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="validationCustom01" class="form-label">Student Name</label>
                                <input type="hidden" name="id" value="<?= $row['id'];?>">
                                <input type="text" class="form-control" id="validationCustom01" value="<?= $row['student_name'];?>" required="" name="student_name">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="validationCustom02" class="form-label">Gender</label>
                                <select name="gender" class="form-control select2" id="validationCustom02" required="">
                                    <option value="">--- Select Gender ---</option>
                                    <option value="Male" <?php echo $row['gender'] == 'Male' ? 'selected':''?>>Male</option>
                                    <option value="Female" <?php echo $row['gender'] == 'Female' ? 'selected':''?>>Female</option>
                                    <option value="Others" <?php echo $row['gender'] == 'Others' ? 'selected':''?>>Others</option>
                                </select>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="validationCustom02" class="form-label">Departments</label>
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
                                <label for="validationCustom02" class="form-label">Programs</label>
                                <select name="program_id" class="form-control select2" id="validationCustom02" required="">
                                    <option value="">--- Select Program ---</option>
                                    <?php foreach ($programs as $prgm): ?>
                                        <option value="<?= $prgm['id']; ?>" <?= ($prgm['id'] == $row['program_id']) ? 'selected' : ''; ?>><?= htmlspecialchars($prgm['program_name']); ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="validationCustom02" class="form-label">Email</label>
                                <input type="email" class="form-control" id="validationCustom02" value="<?= $row['email'];?>" required="" name="student_email">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="validationCustom02" class="form-label">Date of Birth</label>
                                <input type="date" class="form-control" id="validationCustom02" required="" name="dob" value="<?= $row['dob'];?>">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="validationCustom02" class="form-label">Phone</label>
                                <input type="text" class="form-control" id="validationCustom02" value="<?= $row['phone'];?>" required="" name="student_phone">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="validationCustom02" class="form-label">Enrollment Year</label>
                                <input type="text" class="form-control" id="validationCustom02" value="<?= $row['enrollment_year'];?>" required="" name="enrollment_year">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="validationCustom02" class="form-label">Semester</label>
                                <input type="text" class="form-control" id="validationCustom02" required="" value="<?= $row['semester'];?>" name="semester">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label>Address</label>
                                <div>
                                    <textarea required="" class="form-control" rows="5" name="address"><?= $row['address'];?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <button class="btn btn-success" type="submit" name="update_student">Update</button>
                    </div>
                </form>
                                 
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->