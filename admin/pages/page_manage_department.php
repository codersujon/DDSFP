<?php
    $title = "Manage Department";
    include_once(__DIR__ . '/../../classes/Departments.php');
    $dpt = new Departments();

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $dpt->delete_dpt($id);
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
                    <a href="add_department.php" class="btn btn-primary btn-sm">Add Department</a>
                </div>
               
                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                    <tr>
                        <th>#Id</th>
                        <th>Department Name</th>
                        <th>Head Of Department</th>
                        <th>Phone</th>
                        <th>Established Year</th>
                        <th>Office Building</th>
                        <th>Actions</th>
                    </tr>
                    </thead>

                    <tbody>
                        <?php 
                            $departments  = $dpt->manage_department();

                            if (mysqli_num_rows($departments) > 0) {
                                // Convert result to an array of objects
                                $departments = mysqli_fetch_all($departments, MYSQLI_ASSOC);
                                $i = 1;

                                foreach ($departments as $dpt): ?>
                                   <tr>
                                        <td>DPT-<?= $dpt['id'] ?></td>
                                        <td><?= htmlspecialchars($dpt['name']) ?></td>
                                        <td><?= htmlspecialchars($dpt['phone']) ?></td>
                                        <td><?= htmlspecialchars($dpt['head_of_department']) ?></td>
                                        <td><?= date('d-F-Y', strtotime($dpt['established_year'])) ?></td>
                                        <td><?= htmlspecialchars($dpt['building_location']) ?></td>
                                        <td>
                                            <a href="edit_department.php?id=<?= $dpt['id'];?>" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                            <a href="?id=<?= $dpt['id'];?>" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
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
