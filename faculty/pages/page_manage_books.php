<?php
    $title = "Manage Books";
    include_once(__DIR__ . '/../../classes/Books.php');
    $book = new Books();

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $book->delete_book($id);
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
                    <a href="add_book.php" class="btn btn-primary btn-sm">Add Book</a>
                </div>
               
                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                    <tr>
                        <th>#Book_ID</th>
                        <th>Department Name</th>
                        <th>Course Name</th>
                        <th>Book Title</th>
                        <th>Author</th>
                        <th>Description</th>
                        <th>Upload Date</th>
                        <th>Uploaded File</th>
                        <th>Uploaded By</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>

                    <tbody>
                        <?php 
                            $books  = $book->manage_book();

                            if (mysqli_num_rows($books) > 0) {
                                // Convert result to an array of objects
                                $books = mysqli_fetch_all($books, MYSQLI_ASSOC);
                                $i = 1;

                                foreach ($books as $book): ?>
                                   <tr>
                                        <td>Bk-<?= $i++ ?></td>
                                        <td><?= htmlspecialchars($book['department_name'])?></td>
                                        <td><?= htmlspecialchars($book['course_name'])?></td>
                                        <td><?= htmlspecialchars($book['title'])?></td>
                                        <td><?= htmlspecialchars($book['author'])?></td>
                                        <td><?= htmlspecialchars($book['description'])?></td>
                                        <td><?= htmlspecialchars($book['upload_date'])?></td>
                                        <td>
                                            <?php if (!empty($book['upload_file'])): ?>
                                                <a href="../uploads/books/<?= urlencode($book['upload_file']) ?>" target="_blank">
                                                    Read Book
                                                </a>
                                            <?php else: ?>
                                                No File
                                            <?php endif; ?>
                                        </td>
                                        <td><?= htmlspecialchars($book['uploaded_by']) ?></td>
                                        <td>
                                            <?php if (strtolower($book['is_active']) == '1'): ?>
                                                <span class="btn btn-success btn-sm">Active</span>
                                            <?php else: ?>
                                                 <span class="btn btn-danger btn-sm">Inactive</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a href="edit_book.php?id=<?= $book['id'];?>" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                            <!-- <a href="?id=<?= $book['id'];?>" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a> -->
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
