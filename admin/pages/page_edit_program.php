<?php
    $title = "Edit Faculty";
    include_once(__DIR__ . '/../../classes/Departments.php');
    include_once(__DIR__ . '/../../classes/Programs.php');
    $dpt = new Departments();
    $program = new Programs();
    $departments = $dpt->manage_department();


    if (isset($_POST['update_program'])) {
        if ($program->update_program($_POST)) {
            header("Location: manage_program.php");
            exit;
        }
    }

    $id = $_GET['id'];
    $data = $program->edit_program($id);
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
                    <a href="manage_program.php" class="btn btn-primary btn-sm">Program List</a>
                </div>
                                       
                <form class="needs-validation" novalidate="" method="POST" action="">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="validationCustom01" class="form-label">Program Name</label>
                                <input type="hidden" class="form-control" name="id" value="<?= $row['id'];?>">
                                <input type="text" class="form-control" id="validationCustom01" value="<?= $row['program_name'];?>" required="" name="program_name">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="validationCustom02" class="form-label">Level</label>
                                <input type="text" class="form-control" id="validationCustom02" value="<?= $row['level'];?>" required="" name="level">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="validationCustom02" class="form-label">Duration Years</label>
                                <input type="text" class="form-control" id="validationCustom02" required="" name="duration_years" value="<?= $row['duration_years'];?>">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="validationCustom02" class="form-label">Total Credits</label>
                                <input type="text" class="form-control" id="validationCustom02" required="" placeholder="Ex: 140" name="total_credits" value="<?= $row['total_credits'];?>">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="validationCustom02" class="form-label">Department</label>
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
                                <label for="validationCustom02" class="form-label">Program Code</label>
                                <input type="text" class="form-control" id="validationCustom02" required="" value="<?= $row['program_code'];?>" name="program_code">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <button class="btn btn-success" type="submit" name="update_program">Update</button>
                    </div>
                </form>
                                 
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

