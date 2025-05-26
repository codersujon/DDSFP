<?php
    $title = "Edit Notice";
    include_once(__DIR__ . '/../../classes/Notices.php');
    $Notice = new Notices();

    if (isset($_POST['update_notice'])) {
        if ($Notice->update_notice($_POST, $_FILES)) {
            header("Location: manage_notice.php");
            exit;
        }
    }

    $id = $_GET['id'];
    $data = $Notice->edit_notice($id);
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
                    <a href="manage_notice.php" class="btn btn-primary btn-sm">Notice List</a>
                </div>
                                       
                <form class="needs-validation" novalidate="" method="POST" action="" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="validationCustom01" class="form-label">Title</label>
                                 <input type="hidden" class="form-control" name="id" value="<?= $row['id'];?>">
                                <input type="text" class="form-control" id="validationCustom01" required="" name="title" value="<?= $row['title'];?>">
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
                                    <option value="General" <?= ($row['notice_type'] == 'General') ? 'selected' : '' ?>>General</option>
                                    <option value="Academic" <?= ($row['notice_type'] == 'Academic') ? 'selected' : '' ?>>Academic</option>
                                    <option value="Administrative" <?= ($row['notice_type'] == 'Administrative') ? 'selected' : '' ?>>Administrative</option>
                                    <option value="Financial" <?= ($row['notice_type'] == 'Financial') ? 'selected' : '' ?>>Financial</option>
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
                                    <option value="Students" <?= ($row['target_audience'] == 'Students') ? 'selected' : '' ?>>Students</option>
                                    <option value="Faculty" <?= ($row['target_audience'] == 'Faculty') ? 'selected' : '' ?>>Faculty</option>
                                    <option value="All" <?= ($row['target_audience'] == 'All') ? 'selected' : '' ?>>All</option>
                                </select>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                         <div class="col-md-6">
                            <div class="mb-3">
                                <label for="validationCustom01" class="form-label">Date of Post</label>
                                <input type="date" class="form-control" id="validationCustom01" required="" name="date_posted" value="<?= $row['date_posted'];?>">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="validationCustom01" class="form-label">Description</label>
                                <textarea cols="10" rows="3" required="" name="description" class="form-control" id="validationCustom01"><?= $row['description'];?></textarea>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="validationCustom01" class="form-label">Valid Post Until</label>
                                <input type="date" class="form-control" id="validationCustom01" required="" name="valid_until" value="<?= $row['valid_until'];?>">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="validationCustom01" class="form-label">Upload File (pdf, doc, docx, ppt, pptx, txt, zip, rar)</label>
                                <input type="file" class="form-control" id="validationCustom01" name="upload_file" value="<?= $row['upload_file'];?>">
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
                                    <option value="1" <?= $row['is_Active'] == "1" ? 'selected' : '' ?>>Active</option>
                                    <option value="0" <?= $row['is_Active'] == "0" ? 'selected' : '' ?>>Inactive</option>
                                </select>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <button class="btn btn-success" type="submit" name="update_notice">Update</button>
                    </div>
                </form>
                                 
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->