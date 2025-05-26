<?php
    
    class Notes extends Config{

       // Add Note
       public function add_note($Data, $File){

            $title = $Data['title'];
            $course_id = $Data['course_id'];
            $uploaded_at = $Data['uploaded_at'];
            $uploadedByRole = $Data['uploadedByRole'];

            // Allow multiple file types
            $allowedExtensions = ['pdf', 'doc', 'docx', 'jpeg', 'ppt', 'pptx', 'txt', 'zip', 'rar', 'jpg', 'png'];
            $upload_file = '';

            // File Upload Logic
            if (isset($File['upload_file']) && $File['upload_file']['error'] === 0) {
                $fileTmpPath = $File['upload_file']['tmp_name'];
                $fileName = $File['upload_file']['name'];
                $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

                // Validate extension
                if (in_array($fileExtension, $allowedExtensions)) {
                    $safeFileName = uniqid('note_') . '.' . $fileExtension;
                    $uploadDir = '../uploads/notes/'; // ensure this folder exists and is writable
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

            $sql = "INSERT INTO `notes`(`course_id`, `title`, `upload_file`, `uploaded_by_role`, `uploaded_at`) VALUES ('$course_id','$title','$upload_file','$uploadedByRole','$uploaded_at')";

            $result = $this->con->query($sql);

            if($result){
                $_SESSION['status'] = "success";
                $_SESSION['msg'] = "Notes Added Succcessfully!";
            }else{
                $_SESSION['status'] = "error";
                $_SESSION['msg'] = "Notes not Inserted!";
            }
        }

       // Manage Note
       public function manage_note(){
        return $this->con->query("SELECT notes.*, courses.course_name AS course_name FROM `notes` JOIN courses ON notes.course_id = courses.id;"); 
       }

       // Edit Note     
       public function edit_note($id){
            return $result = $this->con->query("SELECT * FROM `notes` WHERE id = '$id'");
       }

       // Update Note 
       public function update_note($Data, $File){
         
        $id = $Data['id'];
        $title = $Data['title'];
        $course_id = $Data['course_id'];
        $uploaded_at = $Data['uploaded_at'];
        $uploadedByRole = $Data['uploadedByRole'];

        // Step 1: Get the current file name from DB
        $query = $this->con->query("SELECT upload_file FROM notes WHERE id = '$id'");
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
                $newFileName = uniqid('note_') . '.' . $fileExtension;
                $uploadDir = '../uploads/notes/';
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

        $sql = "UPDATE `notes` SET `course_id`='$course_id',`title`='$title',`upload_file`='$upload_file',`uploaded_by_role`='$uploadedByRole',`uploaded_at`='$uploaded_at' WHERE id = '$id'";
          
        $result = $this->con->query($sql);
      
        if ($result) {
            $_SESSION['status'] = "success";
            $_SESSION['msg'] = "Notes Updated!";

        } else {
            $_SESSION['status'] = "error";
            $_SESSION['msg'] = "Notes not Updated!";
        }
      }

      // Delete Note
      public function delete_note($id) {
        // Step 1: Get the file name first
        $query = $this->con->query("SELECT upload_file FROM notes WHERE id = '$id'");
    
        if ($query && $query->num_rows > 0) {
            $row = $query->fetch_assoc();
            $file = $row['upload_file'];
            $file_path = '../uploads/notes/' . $file;

            // Step 2: Delete the file if it exists
            if (!empty($file) && file_exists($file_path)) {
                unlink($file_path);
            }

            // Step 3: Delete the qp record
            $result = $this->con->query("DELETE FROM notes WHERE id = '$id'");

            if ($result) {
                $_SESSION['status'] = "success";
                $_SESSION['msg'] = "Notes deleted!";
            } else {
                $_SESSION['status'] = "error";
                $_SESSION['msg'] = "Notes not deleted!";
            }
        } else {
            $_SESSION['status'] = "error";
            $_SESSION['msg'] = "Notes not found!";
        }
     }
}

?>