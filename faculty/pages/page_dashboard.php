<?php
    $title = "Dashboard";
    include_once(__DIR__ . '/../../classes/Departments.php');
    $dpt = new Departments();
    $data = $dpt->totalDpt();
    $row = mysqli_fetch_assoc($data);
    $total_dpt = $row['total_departments'];

    include_once(__DIR__ . '/../../classes/Faculties.php');
    $faculty = new Faculties();
    $data = $faculty->totalFaculty(); 
    $row = mysqli_fetch_assoc($data);
    $total_faculty = $row['total_faculty'];

    include_once(__DIR__ . '/../../classes/Programs.php');
    $program = new Programs();
    $data = $program->totalProgram(); 
    $row = mysqli_fetch_assoc($data);
    $total_programs = $row['total_programs'];

    include_once(__DIR__ . '/../../classes/Students.php');
    $student = new Students();
    $data = $student->totalStudent(); 
    $row = mysqli_fetch_assoc($data);
    $total_students = $row['total_students'];
    

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
    <div class="col-xl-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <p class="text-truncate font-size-14 mb-2">Total Departments</p>
                        <h4 class="mb-2"><?= $total_dpt; ?></h4>
                    </div>
                    <div class="avatar-sm">
                        <span class="avatar-title bg-light text-success rounded-3">
                            <i class="ri-community-line font-size-24"></i>
                        </span>
                    </div>
                </div>                                              
            </div><!-- end cardbody -->
        </div><!-- end card -->
    </div><!-- end col -->
    <div class="col-xl-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <p class="text-truncate font-size-14 mb-2">Total Faculties</p>
                        <h4 class="mb-2"><?= $total_faculty;?></h4>
                    </div>
                    <div class="avatar-sm">
                        <span class="avatar-title bg-light text-primary rounded-3">
                            <i class="ri-user-3-line font-size-24"></i>  
                        </span>
                    </div>
                </div>                                              
            </div><!-- end cardbody -->
        </div><!-- end card -->
    </div><!-- end col -->
    <div class="col-xl-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <p class="text-truncate font-size-14 mb-2">Total Programs</p>
                        <h4 class="mb-2"><?= $total_programs; ?></h4>
                    </div>
                    <div class="avatar-sm">
                        <span class="avatar-title bg-light text-success rounded-3">
                            <i class="ri-git-repository-commits-line font-size-24"></i>  
                        </span>
                    </div>
                </div>                                              
            </div><!-- end cardbody -->
        </div><!-- end card -->
    </div><!-- end col -->
    <div class="col-xl-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <p class="text-truncate font-size-14 mb-2">Total Students</p>
                        <h4 class="mb-2"><?= $total_students; ?></h4>
                    </div>
                    <div class="avatar-sm">
                        <span class="avatar-title bg-light text-primary rounded-3">
                            <i class="ri-group-fill font-size-24"></i>  
                        </span>
                    </div>
                </div>                                            
            </div><!-- end cardbody -->
        </div><!-- end card -->
    </div><!-- end col -->
</div><!-- end row -->

