<?php
    $title = "Edit Book";
    include_once(__DIR__ . '/../../classes/Departments.php');
    include_once(__DIR__ . '/../../classes/Books.php');
    include_once(__DIR__ . '/../../classes/Courses.php');
    $Book = new Books();
    $dpt = new Departments();
    $departments = $dpt->manage_department();
    $course = new Courses();
    $courses = $course->manage_course();

    if (isset($_POST['update_book'])) {
        if ($Book->update_book($_POST, $_FILES)) {
            header("Location: manage_book.php");
            exit;
        }
    }

    $id = $_GET['id'];
    $data = $Book->edit_book($id);
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
                    <a href="manage_books.php" class="btn btn-primary btn-sm">Book List</a>
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
                                <label for="validationCustom01" class="form-label">Author</label>
                                <input type="text" class="form-control" id="validationCustom01" value="<?= $row['author'];?>" required="" name="author">
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
                                <label for="validationCustom01" class="form-label">Upload Date</label>
                                 <input type="date" class="form-control" id="validationCustom02" required="" name="upload_date" value="<?= date('Y-m-d', strtotime($row['upload_date'])) ?>">

                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="validationCustom01" class="form-label">Uploaded By</label>
                                <input type="text" class="form-control" id="validationCustom01" required="" name="uploaded_by" value="<?php echo $name; ?>">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                         <div class="col-md-6">
                            <div class="mb-3">
                                <label for="validationCustom01" class="form-label">Upload File</label>
                                <input type="file" class="form-control" id="validationCustom01" required="" name="upload_file" accept=".pdf" value="<?= $row['upload_file'];?>">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="validationCustom02" class="form-label">Status</label>
                               <select name="is_active" class="form-control select2" id="validationCustom02" required="">
                                    <option value="">--- Select Status ---</option>
                                      <option value="1" <?= $row['is_active'] == "1" ? 'selected' : '' ?>>Active</option>
                                    <option value="0" <?= $row['is_active'] == "0" ? 'selected' : '' ?>>Inactive</option>
                                </select>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <button class="btn btn-success" type="submit" name="update_book">Update</button>
                    </div>
                </form>
                                 
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

