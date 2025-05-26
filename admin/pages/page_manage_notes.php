<?php
    $title = "Manage Notes";
    include_once(__DIR__ . '/../../classes/Notes.php');
    $note = new Notes();

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $note->delete_note($id);
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
                    <a href="add_notes.php" class="btn btn-primary btn-sm">Add Notes</a>
                </div>
               
                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                    <tr>
                        <th>#N_ID</th>
                        <th>Title</th>
                        <th>Course Name</th>
                        <th>Uploaded File</th>
                        <th>Uploaded By Role</th>
                        <th>Uploaded Time</th>
                        <th>Actions</th>
                    </tr>
                    </thead>

                    <tbody>
                        <?php 
                            $notes  = $note->manage_note();

                            if (mysqli_num_rows($notes) > 0) {
                                // Convert result to an array of objects
                                $notes = mysqli_fetch_all($notes, MYSQLI_ASSOC);
                                $i = 1;

                                foreach ($notes as $note): ?>
                                   <tr>
                                       <td>Note-<?= $i++ ?></td>
                                       <td><?= htmlspecialchars($note['title'])?></td>
                                       <td><?= htmlspecialchars($note['course_name'])?></td>
                                       <td>
                                            <?php if (!empty($note['upload_file'])): ?>
                                                <a href="../uploads/notes/<?= urlencode($note['upload_file']) ?>" target="_blank">
                                                   View Notes
                                                </a>
                                            <?php else: ?>
                                                No File
                                            <?php endif; ?>
                                        </td>
                                        <td><?= htmlspecialchars($note['uploaded_by_role'])?></td>
                                        <td><?= htmlspecialchars($note['uploaded_at'])?></td>
                                        <td>
                                            <a href="edit_notes.php?id=<?= $note['id'];?>" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                            <a href="?id=<?= $note['id'];?>" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
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
