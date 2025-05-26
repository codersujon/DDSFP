<?php
    $title = "Add Department";
    include_once(__DIR__ . '/../../classes/Departments.php');
    $dpt = new Departments();

    if(isset($_POST['add_department'])){
        $dpt->add_department($_POST);
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
                    <a href="manage_department.php" class="btn btn-primary btn-sm">Departments List</a>
                </div>
                                       
                <form class="needs-validation" novalidate="" method="POST" action="">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="validationCustom01" class="form-label">Department Name</label>
                                <input type="text" class="form-control" id="validationCustom01" placeholder="Enter Department Name" required="" name="dpt_name">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="validationCustom02" class="form-label">Department Phone</label>
                                <input type="text" class="form-control" id="validationCustom02" placeholder="Enter Phone" required="" name="dpt_phone">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="validationCustom02" class="form-label">Established Year</label>
                                <input type="date" class="form-control" id="validationCustom02" required="" name="esta_year">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="validationCustom02" class="form-label">Head Of Department</label>
                                <input type="text" class="form-control" id="validationCustom02" required="" name="head_of_dpt" placeholder="Enter Department Head">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="validationCustom02" class="form-label">Office Building</label>
                                <input type="text" class="form-control" id="validationCustom02" placeholder="Enter Office Location" required="" name="office_location">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <input class="btn btn-primary" type="submit" name="add_department"></input>
                    </div>
                </form>
                                 
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->