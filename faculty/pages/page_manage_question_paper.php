<?php
    $title = "Manage Question Paper";
    include_once(__DIR__ . '/../../classes/QuestionPapers.php');
    $qp = new QuestionPapers();

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $qp->delete_qp($id);
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
                    <a href="add_question_paper.php" class="btn btn-primary btn-sm">Add Question Paper</a>
                </div>
               
                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                    <tr>
                        <th>#QP_ID</th>
                        <th>Department Name</th>
                        <th>Course Name</th>
                        <th>QP Title</th>
                        <th>Semester</th>
                        <th>Year</th>
                        <th>Upload Date</th>
                        <th>Uploaded File</th>
                        <th>Uploaded By</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>

                    <tbody>
                        <?php 
                            $qps  = $qp->manage_qp();

                            if (mysqli_num_rows($qps) > 0) {
                                // Convert result to an array of objects
                                $qps = mysqli_fetch_all($qps, MYSQLI_ASSOC);
                                $i = 1;

                                foreach ($qps as $qp): ?>
                                   <tr>
                                        <td>Qp-<?= $i++ ?></td>
                                        <td><?= htmlspecialchars($qp['department_name'])?></td>
                                        <td><?= htmlspecialchars($qp['course_name'])?></td>
                                        <td><?= htmlspecialchars($qp['title'])?></td>
                                        <td><?= htmlspecialchars($qp['semester'])?></td>
                                        <td><?= htmlspecialchars($qp['year'])?></td>
                                        <td><?= htmlspecialchars($qp['upload_date'])?></td>
                                        <td>
                                            <?php if (!empty($qp['upload_file'])): ?>
                                                <a href="../uploads/questions/<?= urlencode($qp['upload_file']) ?>" target="_blank">
                                                    Read Question Paper
                                                </a>
                                            <?php else: ?>
                                                No File
                                            <?php endif; ?>
                                        </td>
                                        <td><?= htmlspecialchars($qp['uploaded_by']) ?></td>
                                        <td>
                                            <?php if (strtolower($qp['is_active']) == '1'): ?>
                                                <span class="btn btn-success btn-sm">Active</span>
                                            <?php else: ?>
                                                 <span class="btn btn-danger btn-sm">Inactive</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a href="edit_book.php?id=<?= $qp['id'];?>" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                            <!-- <a href="?id=<?= $qp['id'];?>" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a> -->
                                        </td>
                                    </tr>
                                <?php endforeach;
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
