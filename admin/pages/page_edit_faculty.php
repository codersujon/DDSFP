<?php
    $title = "Edit Faculty";
    include_once(__DIR__ . '/../../classes/Departments.php');
    include_once(__DIR__ . '/../../classes/Faculties.php');
    $dpt = new Departments();
    $faculty = new Faculties();
    $departments = $dpt->manage_department();

    $faculty = new Faculties();

    if (isset($_POST['update_faculty'])) {
        if ($faculty->update_faculty($_POST)) {
            header("Location: manage_faculty.php");
            exit;
        }
    }

    $id = $_GET['id'];
    $data = $faculty->edit_faculty($id);
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
                    <a href="manage_faculty.php" class="btn btn-primary btn-sm">View Faculties</a>
                </div>
                                       
                <form class="needs-validation" novalidate="" method="POST" action="">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="validationCustom01" class="form-label">Name</label>
                                <input type="hidden" class="form-control" name="id" value="<?= $row['id'];?>">
                                <input type="text" class="form-control" id="validationCustom01" placeholder="Enter Name" required="" name="faculty_name" value="<?= $row['name'];?>">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="validationCustom02" class="form-label">Email</label>
                                <input type="email" class="form-control" id="validationCustom02" placeholder="Enter Email" required="" name="faculty_email" value="<?= $row['email'];?>">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="validationCustom02" class="form-label">Phone</label>
                                <input type="text" class="form-control" id="validationCustom02" placeholder="Enter Phone" required="" name="faculty_phone" value="<?= $row['phone'];?>">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="validationCustom02" class="form-label">Designation</label>
                                <input type="text" class="form-control" id="validationCustom02" placeholder="Enter designation" required="" name="faculty_designation" value="<?= $row['designation'];?>">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="validationCustom02" class="form-label">Hiring Date</label>
                                <input type="date" class="form-control" id="validationCustom02" required="" name="hire_date" value="<?= $row['hire_date'];?>">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="validationCustom02" class="form-label">Salary</label>
                                <input type="text" class="form-control" id="validationCustom02" required="" placeholder="Enter salary" name="salary" value="<?= $row['salary'];?>">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="validationCustom02" class="form-label">Department</label>
                                <select name="department_id" class="form-control select2" id="validationCustom02" required="">
                                    <option value="">--- Select Department ---</option>
                                    <?php foreach ($departments as $dept): ?>
                                        <option value="<?= $dept['id']; ?>" <?= ($dept['id'] == $row['department_id']) ? 'selected' : ''; ?>>
                                            <?= htmlspecialchars($dept['name']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <button class="btn btn-success" type="submit" name="update_faculty">Update</button>
                    </div>
                </form>
                                 
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

