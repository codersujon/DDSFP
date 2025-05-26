<?php
    
    class QuestionPapers extends Config{

       // Add QP
       public function add_qp($Data, $File){

        $title = $Data['title'];
        $department_id = $Data['department_id'];
        $course_id = $Data['course_id'];
        $semester = $Data['semester'];
        $year = $Data['year'];
        $upload_date = $Data['upload_date'];
        $uploaded_by = $Data['uploaded_by'];
        $is_active = $Data['is_active'];

        // Allow multiple file types
        $allowedExtensions = ['pdf', 'doc', 'docx', 'ppt', 'pptx', 'txt', 'zip', 'rar'];
        $upload_file = '';

        // File Upload Logic
        if (isset($File['upload_file']) && $File['upload_file']['error'] === 0) {
            $fileTmpPath = $File['upload_file']['tmp_name'];
            $fileName = $File['upload_file']['name'];
            $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

            // Validate extension
            if (in_array($fileExtension, $allowedExtensions)) {
                $safeFileName = uniqid('qp_') . '.' . $fileExtension;
                $uploadDir = '../uploads/questions/'; // ensure this folder exists and is writable
                $destPath = $uploadDir . $safeFileName;

                // Move file to destination
                if (move_uploaded_file($fileTmpPath, $destPath)) {
                    $upload_file = $safeFileName;
                } else {
                    $_SESSION['status'] = "error";
                    $_SESSION['msg'] = "Failed to move uploaded file.";
                    return;
                }
            } else {
                $_SESSION['status'] = "error";
                $_SESSION['msg'] = "File type not allowed. Allowed: " . implode(', ', $allowedExtensions);
                return;
            }
        } else {
            $_SESSION['status'] = "error";
            $_SESSION['msg'] = "No file uploaded or upload error.";
            return;
        }

        $sql = "INSERT INTO `question_papers`(`department_id`, `course_id`, `title`, `semester`, `year`, `upload_date`, `uploaded_by`, `upload_file`, `is_active`) VALUES ('$department_id','$course_id','$title','$semester','$year','$upload_date','$uploaded_by','$upload_file','$is_active')";

        $result = $this->con->query($sql);

        if($result){
            $_SESSION['status'] = "success";
            $_SESSION['msg'] = "Question Paper Inserted!";
        }else{
            $_SESSION['status'] = "error";
            $_SESSION['msg'] = "Question paper not Inserted!";
        }
    }

       // Manage QP
       public function manage_qp(){
        return $this->con->query("SELECT question_papers.*, courses.course_name AS course_name, department.name AS department_name FROM `question_papers` JOIN courses ON question_papers.course_id = courses.id JOIN department ON question_papers.department_id = department.id;"); 
       }

       // Edit QP 
       public function edit_qp($id){
            return $result = $this->con->query("SELECT * FROM `question_papers` WHERE id = '$id'");
       }

       // Update QP 
       public function update_qp($Data, $File){
         
        $id = $Data['id'];
        $title = $Data['title'];
        $department_id = $Data['department_id'];
        $course_id = $Data['course_id'];
        $semester = $Data['semester'];
        $year = $Data['year'];
        $upload_date = $Data['upload_date'];
        $uploaded_by = $Data['uploaded_by'];
        $is_active = $Data['is_active'];

        // Step 1: Get the current file name from DB
        $query = $this->con->query("SELECT upload_file FROM question_papers WHERE id = '$id'");
        $oldFile = '';
        if ($query && $query->num_rows > 0) {
            $row = $query->fetch_assoc();
            $oldFile = $row['upload_file'];
        }

        // Step 2: Handle new file upload (PDF)
        $upload_file = $oldFile; // default to old file
        if (isset($File['upload_file']) && $File['upload_file']['error'] === 0) {
            $fileTmpPath = $File['upload_file']['tmp_name'];
            $fileName = $File['upload_file']['name'];
            $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

            if ($fileExtension === 'pdf') {
                $newFileName = uniqid('qp_') . '.' . $fileExtension;
                $uploadDir = '../uploads/questions/';
                $destPath = $uploadDir . $newFileName;

                if (move_uploaded_file($fileTmpPath, $destPath)) {
                    // Unlink old file
                    if (!empty($oldFile) && file_exists($uploadDir . $oldFile)) {
                        unlink($uploadDir . $oldFile);
                    }
                    $upload_file = $newFileName;
                } else {
                    $_SESSION['status'] = "error";
                    $_SESSION['msg'] = "Failed to move uploaded file.";
                    return;
                }
            } else {
                $_SESSION['status'] = "error";
                $_SESSION['msg'] = "Only PDF files are allowed.";
                return;
            }
        }

        $sql = "UPDATE `question_papers` SET `department_id`='$department_id',`course_id`='$course_id',`title`='$title',`semester`='$semester',`year`='$year',`upload_date`='$upload_date',`uploaded_by`='$uploaded_by',`upload_file`='$upload_file',`is_active`='$is_active' WHERE id='$id'";
          
        $result = $this->con->query($sql);
      
        if ($result) {
            $_SESSION['status'] = "success";
            $_SESSION['msg'] = "Question Paper Updated!";

        } else {
            $_SESSION['status'] = "error";
            $_SESSION['msg'] = "Question Paper not Updated!";
        }
      }

    // Delete QP
    public function delete_qp($id) {
        // Step 1: Get the file name first
        $query = $this->con->query("SELECT upload_file FROM question_papers WHERE id = '$id'");
    
        if ($query && $query->num_rows > 0) {
            $row = $query->fetch_assoc();
            $file = $row['upload_file'];
            $file_path = '../uploads/questions/' . $file;

            // Step 2: Delete the file if it exists
            if (!empty($file) && file_exists($file_path)) {
                unlink($file_path);
            }

            // Step 3: Delete the qp record
            $result = $this->con->query("DELETE FROM question_papers WHERE id = '$id'");

            if ($result) {
                $_SESSION['status'] = "success";
                $_SESSION['msg'] = "Question paper deleted!";
            } else {
                $_SESSION['status'] = "error";
                $_SESSION['msg'] = "Question paper not deleted!";
            }
        } else {
            $_SESSION['status'] = "error";
            $_SESSION['msg'] = "QP not found!";
        }
    }
}

?>