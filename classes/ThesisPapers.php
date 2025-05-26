<?php
    
    class ThesisPapers extends Config{

       // Add TP
       public function add_tp($Data, $File){

            $title = $Data['title'];
            $department_id = $Data['department_id'];
            $student_id = $Data['student_id'];
            $submission_date = $Data['submission_date'];
            $supervisor_name = $Data['supervisor_name'];
            $is_approval = $Data['is_approval'];

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
                    $safeFileName = uniqid('thesis_') . '.' . $fileExtension;
                    $uploadDir = '../uploads/thesisPaper/'; // ensure this folder exists and is writable
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

            $sql = "INSERT INTO `thesis_paper`(`department_id`, `student_id`, `title`, `submission_date`, `supervisor_name`, `upload_file`, `approved_status`) VALUES ('$department_id','$student_id','$title','$submission_date','$supervisor_name','$upload_file','$is_approval')";

            $result = $this->con->query($sql);

            if($result){
                $_SESSION['status'] = "success";
                $_SESSION['msg'] = "Thesis Paper Inserted!";
            }else{
                $_SESSION['status'] = "error";
                $_SESSION['msg'] = "Thesis paper not Inserted!";
            }
        }

       // Manage TP
       public function manage_tp(){
        return $this->con->query("SELECT thesis_paper.*, department.name AS department_name, students.student_name FROM `thesis_paper` JOIN students ON thesis_paper.student_id = students.id JOIN department ON thesis_paper.department_id = department.id;"); 
       }

       // Edit TP 
       public function edit_tp($id){
            return $result = $this->con->query("SELECT * FROM `thesis_paper` WHERE id = '$id'");
       }

       // Update TP 
       public function update_tp($Data, $File){
         
        $id = $Data['id'];
        $title = $Data['title'];
        $department_id = $Data['department_id'];
        $student_id = $Data['student_id'];
        $submission_date = $Data['submission_date'];
        $supervisor_name = $Data['supervisor_name'];
        $is_approval = $Data['is_approval'];

        // Step 1: Get the current file name from DB
        $query = $this->con->query("SELECT upload_file FROM thesis_paper WHERE id = '$id'");
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
                $newFileName = uniqid('thesis_') . '.' . $fileExtension;
                $uploadDir = '../uploads/thesisPaper/';
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

        $sql = "UPDATE `thesis_paper` SET `department_id`='$department_id',`student_id`='$student_id',`title`='$title',`submission_date`='$submission_date',`supervisor_name`='$supervisor_name',`upload_file`='$upload_file',`approved_status`='$is_approval' WHERE id = '$id'";
          
        $result = $this->con->query($sql);
      
        if ($result) {
            $_SESSION['status'] = "success";
            $_SESSION['msg'] = "Thesis Paper Updated!";

        } else {
            $_SESSION['status'] = "error";
            $_SESSION['msg'] = "Thesis Paper not Updated!";
        }
      }

    // Delete TP
    public function delete_tp($id) {
        // Step 1: Get the file name first
        $query = $this->con->query("SELECT upload_file FROM thesis_paper WHERE id = '$id'");
    
        if ($query && $query->num_rows > 0) {
            $row = $query->fetch_assoc();
            $file = $row['upload_file'];
            $file_path = '../uploads/thesisPaper/' . $file;

            // Step 2: Delete the file if it exists
            if (!empty($file) && file_exists($file_path)) {
                unlink($file_path);
            }

            // Step 3: Delete the qp record
            $result = $this->con->query("DELETE FROM thesis_paper WHERE id = '$id'");

            if ($result) {
                $_SESSION['status'] = "success";
                $_SESSION['msg'] = "Thesis paper deleted!";
            } else {
                $_SESSION['status'] = "error";
                $_SESSION['msg'] = "Thesis paper not deleted!";
            }
        } else {
            $_SESSION['status'] = "error";
            $_SESSION['msg'] = "Thesis paper not found!";
        }
    }
}

?>