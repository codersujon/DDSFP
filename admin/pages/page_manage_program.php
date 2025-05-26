<?php
    $title = "Manage Program";
    include_once(__DIR__ . '/../../classes/Programs.php');
    $program = new Programs();

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $program->delete_program($id);
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
                    <a href="add_program.php" class="btn btn-primary btn-sm">Add Program</a>
                </div>
               
                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                    <tr>
                        <th>#Program_ID</th>
                        <th>Program Name</th>
                        <th>Department ID</th>
                        <th>Level</th>
                        <th>Duration Years</th>
                        <th>Total Credits</th>
                        <th>Program Code</th>
                        <th>Actions</th>
                    </tr>
                    </thead>

                    <tbody>
                        <?php 
                            $programs  = $program->manage_program();

                            if (mysqli_num_rows($programs) > 0) {
                                // Convert result to an array of objects
                                $programs = mysqli_fetch_all($programs, MYSQLI_ASSOC);
                                $i = 1;

                                foreach ($programs as $prg): ?>
                                   <tr>
                                        <td>PRG-<?= $i++ ?></td>
                                        <td><?= htmlspecialchars($prg['program_name']) ?></td>
                                        <td>DPT-<?= htmlspecialchars($prg['department_id']) ?></td>
                                        <td><?= htmlspecialchars($prg['level']) ?></td>
                                        <td><?= htmlspecialchars($prg['duration_years']) ?></td>
                                        <td><?= htmlspecialchars($prg['total_credits']) ?></td>
                                        <td><?= htmlspecialchars($prg['program_code']) ?></td>
                                        <td>
                                            <a href="edit_program.php?id=<?= $prg['id'];?>" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                            <a href="?id=<?= $prg['id'];?>" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
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
