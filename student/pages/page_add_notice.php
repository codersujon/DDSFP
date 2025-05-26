<?php
    $title = "Add Notice";
    include_once(__DIR__ . '/../../classes/Notices.php');

    $Notice = new Notices();

    if(isset($_POST['add_notice'])){
        $Notice->add_notice($_POST);
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
                    <a href="manage_program.php" class="btn btn-primary btn-sm">Program List</a>
                </div>
                                       
                <form class="needs-validation" novalidate="" method="POST" action="">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="validationCustom01" class="form-label">Title</label>
                                <input type="text" class="form-control" id="validationCustom01" placeholder="Enter Notice Title" required="" name="title">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="validationCustom02" class="form-label">Notice Type</label>
                                <select name="notice_type" class="form-control select2" id="validationCustom02" required="">
                                    <option value="">--- Select Notice Type ---</option>
                                    <option value="General">General</option>
                                    <option value="Academic">Academic</option>
                                    <option value="Administrative">Administrative</option>
                                    <option value="Financial">Financial</option>
                                </select>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                          <div class="col-md-6">
                            <div class="mb-3">
                                <label for="validationCustom02" class="form-label">Target Audidence</label>
                                <select name="target_audience" class="form-control select2" id="validationCustom02" required="">
                                    <option value="">--- Select Target Audience ---</option>
                                    <option value="Students">Students</option>
                                    <option value="Faculty">Faculty</option>
                                    <option value="All">All</option>
                                </select>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                         <div class="col-md-6">
                            <div class="mb-3">
                                <label for="validationCustom01" class="form-label">Date of Post</label>
                                <input type="date" class="form-control" id="validationCustom01" required="" name="date_posted">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="validationCustom01" class="form-label">Description</label>
                                <textarea cols="10" rows="3" required="" name="description" class="form-control" id="validationCustom01"></textarea>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="validationCustom01" class="form-label">Valid Post Until</label>
                                <input type="date" class="form-control" id="validationCustom01" required="" name="valid_until">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="validationCustom02" class="form-label">Attachment URL</label>
                                <input type="text" class="form-control" id="validationCustom02" placeholder="Ex: Attachment Url" required="" name="attachment_url">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="validationCustom02" class="form-label">Status</label>
                               <select name="status" class="form-control select2" id="validationCustom02" required="">
                                    <option value="">--- Select Status ---</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <button class="btn btn-primary" type="submit" name="add_notice">Submit</button>
                    </div>
                </form>
                                 
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->