<?php
    $title = "Manage Faculty";
    include_once(__DIR__ . '/../../classes/Faculties.php');
    $faculty = new Faculties();

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $faculty->delete_faculty($id);
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
                    <a href="add_faculty.php" class="btn btn-primary btn-sm">Add Faculty</a>
                </div>
               
                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                    <tr>
                        <th>#Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Designation</th>
                        <th>Department ID</th>
                        <th>Hire Date</th>
                        <th>Salary</th>
                        <th>Actions</th>
                    </tr>
                    </thead>

                    <tbody>
                        <?php 
                            $faculties  = $faculty->manage_faculty();

                            if (mysqli_num_rows($faculties) > 0) {
                                // Convert result to an array of objects
                                $faculties = mysqli_fetch_all($faculties, MYSQLI_ASSOC);
                                $i = 1;

                                foreach ($faculties as $faculty): ?>
                                   <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= htmlspecialchars($faculty['name']) ?></td>
                                        <td><?= htmlspecialchars($faculty['email']) ?></td>
                                        <td><?= htmlspecialchars($faculty['phone']) ?></td>
                                        <td><?= htmlspecialchars($faculty['designation']) ?></td>
                                        <td>DTP-<?= htmlspecialchars($faculty['department_id']) ?></td>
                                        <td><?= date('j F Y', strtotime($faculty['hire_date'])) ?></td>
                                        <td><?= htmlspecialchars($faculty['salary']) ?></td>
                                        <td>
                                            <a href="edit_faculty.php?id=<?= $faculty['id'];?>" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                            <a href="?id=<?= $faculty['id'];?>" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
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
