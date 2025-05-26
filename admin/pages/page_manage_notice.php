<?php
    $title = "Manage Notice";
    include_once(__DIR__ . '/../../classes/Notices.php');
    $Notice = new Notices();

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $Notice->delete_notice($id);
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
                    <a href="add_notice.php" class="btn btn-primary btn-sm">Add Notice</a>
                </div>
               
                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                    <tr>
                        <th>#Notice_ID</th>
                        <th>Title</th>
                        <th>Notice Type</th>
                        <th>Target Audience</th>
                        <th>Date Posted</th>
                        <th>Valid Until</th>
                        <th>Uploaded Notice</th>
                        <th>status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>

                    <tbody>
                        <?php 
                            $Notices  = $Notice->manage_notice();

                            if (mysqli_num_rows($Notices) > 0) {
                                // Convert result to an array of objects
                                $Notices = mysqli_fetch_all($Notices, MYSQLI_ASSOC);
                                $i = 1;

                                foreach ($Notices as $Notice): ?>
                                   <tr>
                                        <td>Notice-<?= $i++ ?></td>
                                        <td><?= htmlspecialchars($Notice['title']) ?></td>
                                        <!-- <td style="min-width: 150px; word-wrap: break-word;">
                                            <?= htmlspecialchars($Notice['description']) ?>
                                        </td> -->
                                        <td><?= htmlspecialchars($Notice['notice_type']) ?></td>
                                        <td><?= htmlspecialchars($Notice['target_audience']) ?></td>
                                        <td>
                                            <?= date('l, d F Y', strtotime($Notice['date_posted'])) ?>
                                        </td>
                                       <td>
                                            <?= date('l, d F Y', strtotime($Notice['valid_until'])) ?>
                                        </td>
                                        <td>
                                            <?php if (!empty($Notice['upload_file'])): ?>
                                                <a href="../uploads/notices/<?= urlencode($Notice['upload_file']) ?>" target="_blank">
                                                    View Notice
                                                </a>
                                            <?php else: ?>
                                                No File
                                            <?php endif; ?>

                                        </td>
                                        <td>
                                            <?php if (strtolower($Notice['is_Active']) == '1'): ?>
                                                <span class="btn btn-success btn-sm">Active</span>
                                            <?php else: ?>
                                                 <span class="btn btn-danger btn-sm">Inactive</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a href="edit_notice.php?id=<?= $Notice['id'];?>" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                            <a href="?id=<?= $Notice['id'];?>" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
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
