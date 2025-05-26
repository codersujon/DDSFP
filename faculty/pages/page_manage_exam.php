<?php
    $title = "Manage Exam";
    include_once(__DIR__ . '/../../classes/Exams.php');
    $exam = new Exams();

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $exam->delete_exam($id);
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
                    <a href="add_exam.php" class="btn btn-primary btn-sm">Add Exam</a>
                </div>
               
                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                    <tr>
                        <th>#Exam_ID</th>
                        <th>Exam Title</th>
                        <th>Course ID</th>
                        <th>Exam Type</th>
                        <th>Exam Date</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Location</th>
                        <th>Total Marks</th>
                        <th>Passing Marks</th>
                        <th>Semester</th>
                        <th>Actions</th>
                    </tr>
                    </thead>

                    <tbody>
                        <?php 
                            $exams  = $exam->manage_exam();

                            if (mysqli_num_rows($exams) > 0) {
                                // Convert result to an array of objects
                                $exams = mysqli_fetch_all($exams, MYSQLI_ASSOC);
                                $i = 1;

                                foreach ($exams as $exam): ?>
                                   <tr>
                                        <td>Ex-<?= $i++ ?></td>
                                        <td><?= htmlspecialchars($exam['exam_title'])?></td>
                                        <td><?= htmlspecialchars($exam['course_id'])?></td>
                                        <td><?= htmlspecialchars($exam['exam_type'])?></td>
                                        <td><?= date('d F Y', strtotime($exam['exam_date'])) ?></td>
                                        <td><?= htmlspecialchars($exam['start_time'])?></td>
                                        <td><?= htmlspecialchars($exam['end_time']) ?></td>
                                        <td><?= htmlspecialchars($exam['location'])?></td>
                                        <td><?= htmlspecialchars($exam['total_marks'])?></td>
                                        <td><?= htmlspecialchars($exam['passing_marks'])?></td>
                                        <td><?= htmlspecialchars($exam['semester'])?></td>
                                        <td>
                                            <a href="edit_exam.php?id=<?= $exam['id'];?>" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                            <a href="?id=<?= $exam['id'];?>" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
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
