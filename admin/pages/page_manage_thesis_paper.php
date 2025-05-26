<?php
    $title = "Manage Thesis Paper";
    include_once(__DIR__ . '/../../classes/ThesisPapers.php');
    $tp = new ThesisPapers();

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $tp->delete_tp($id);
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
                    <a href="add_thesis_paper.php" class="btn btn-primary btn-sm">Add Thesis Paper</a>
                </div>
               
                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                    <tr>
                        <th>#TP_ID</th>
                        <th>Title</th>
                        <th>Department Name</th>
                        <th>Student Name</th>
                        <th>Submission Date</th>
                        <th>Supervisor Name</th>
                        <th>Uploaded File</th>
                        <th>Approved Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>

                    <tbody>
                        <?php 
                            $tps  = $tp->manage_tp();

                            if (mysqli_num_rows($tps) > 0) {
                                // Convert result to an array of objects
                                $tps = mysqli_fetch_all($tps, MYSQLI_ASSOC);
                                $i = 1;

                                foreach ($tps as $tp): ?>
                                   <tr>
                                       <td>Tp-<?= $i++ ?></td>
                                       <td><?= htmlspecialchars($tp['title'])?></td>
                                       <td><?= htmlspecialchars($tp['department_name'])?></td>
                                       <td><?= htmlspecialchars($tp['student_name'])?></td>
                                       <td><?= htmlspecialchars($tp['submission_date'])?></td>
                                       <td><?= htmlspecialchars($tp['supervisor_name'])?></td>
                                       <td>
                                            <?php if (!empty($tp['upload_file'])): ?>
                                                <a href="../uploads/thesisPaper/<?= urlencode($tp['upload_file']) ?>" target="_blank">
                                                    Read Thesis Paper
                                                </a>
                                            <?php else: ?>
                                                No File
                                            <?php endif; ?>
                                        </td>
                                         <td>
                                            <?php if (strtolower($tp['approved_status']) == 'pending'): ?>
                                                <span class="btn btn-warning btn-sm">Pending</span>
                                            <?php elseif(strtolower($tp['approved_status']) == 'approved'): ?>
                                                 <span class="btn btn-success btn-sm">Approved</span>
                                            <?php else: ?>
                                                <span class="btn btn-danger btn-sm">Rejected</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a href="edit_thesis_paper.php?id=<?= $tp['id'];?>" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                            <a href="?id=<?= $tp['id'];?>" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
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
