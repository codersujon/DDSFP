<?php
    
    class Notices extends Config{

       // Add Notice
       public function add_notice($Data, $File){

          $title = $Data['title'];
          $notice_type = $Data['notice_type'];
          $target_audience = $Data['target_audience'];
          $description = $Data['description'];
          $date_posted = $Data['date_posted'];
          $valid_until = $Data['valid_until'];
          $is_Active = $Data['status'];

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
                    $safeFileName = uniqid('notice_') . '.' . $fileExtension;
                    $uploadDir = '../uploads/notices/'; // ensure this folder exists and is writable
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

          $sql = "INSERT INTO `notices`(`title`, `description`, `notice_type`, `target_audience`, `date_posted`, `valid_until`, `upload_file`, `is_Active`) VALUES ('$title','$description','$notice_type','$target_audience','$date_posted','$valid_until','$upload_file','$is_Active')";

          $result = $this->con->query($sql);

          if($result){
               $_SESSION['status'] = "success";
               $_SESSION['msg'] = "Notice Inserted Successfully!";
          }else{
               $_SESSION['status'] = "error";
               $_SESSION['msg'] = "Notice not added!";
          }
       }

       // Manage Notice
       public function manage_notice(){
            return $this->con->query("SELECT * FROM `notices`"); 
       }

       // Edit Notice 
       public function edit_notice($id){
            return $result = $this->con->query("SELECT * FROM `notices` WHERE id = '$id'");
       }

       // Update Notice 
       public function update_notice($Data, $File){
         
          $id = $Data['id'];
          $title = $Data['title'];
          $notice_type = $Data['notice_type'];
          $target_audience = $Data['target_audience'];
          $description = $Data['description'];
          $date_posted = $Data['date_posted'];
          $valid_until = $Data['valid_until'];
          $is_Active = $Data['status'];

          // Step 1: Get the current file name from DB
          $query = $this->con->query("SELECT upload_file FROM notices WHERE id = '$id'");
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
                    $newFileName = uniqid('notice_') . '.' . $fileExtension;
                    $uploadDir = '../uploads/notices/';
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
      
          $sql = "UPDATE `notices` SET `title`='$title',`description`='$description',`notice_type`='$notice_type',`target_audience`='$target_audience',`date_posted`='$date_posted',`valid_until`='$valid_until',`upload_file`='$upload_file',`is_Active`='$is_Active' WHERE id = '$id'";
          
          $result = $this->con->query($sql);
      
          if ($result) {
              $_SESSION['status'] = "success";
              $_SESSION['msg'] = "Notice Updated Successfully!";

          } else {
              $_SESSION['status'] = "error";
              $_SESSION['msg'] = "Notice not Updated!";
          }

      }

       // Delete Notice
       public function delete_notice($id){

          // Step 1: Get the file name first
          $query = $this->con->query("SELECT upload_file FROM notices WHERE id = '$id'");
     
          if ($query && $query->num_rows > 0) {
               $row = $query->fetch_assoc();
               $file = $row['upload_file'];
               $file_path = '../uploads/notices/' . $file;

               // Step 2: Delete the file if it exists
               if (!empty($file) && file_exists($file_path)) {
                    unlink($file_path);
               }

               // Step 3: Delete the qp record
               $result = $this->con->query("DELETE FROM notices WHERE id = '$id'");

               if ($result) {
                    $_SESSION['status'] = "success";
                    $_SESSION['msg'] = "Notice Deleted!";
               } else {
                    $_SESSION['status'] = "error";
                    $_SESSION['msg'] = "Notice not Deleted!";
               }
          } else {
               $_SESSION['status'] = "error";
               $_SESSION['msg'] = "Notice File not found!";
          }

       }

     // Total Book
     public function totalNotice(){
          return $this->con->query("SELECT COUNT(*) as total_notices FROM notices");
     }

    }

?>