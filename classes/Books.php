<?php

    class Books extends Config{

       // Add Book
       public function add_book($Data, $File){
          $department_id = $Data['department_id'];
          $course_id = $Data['course_id'];
          $title = $Data['title'];
          $author = $Data['author'];
          $description = $Data['description'];
          $upload_date = $Data['upload_date'];
          $uploaded_by = $Data['uploaded_by'];
          $is_active = $Data['is_active'];

        // Handle file upload (PDF)
        $upload_file = '';
        if (isset($File['upload_file']) && $File['upload_file']['error'] == 0) {
            $fileTmpPath = $File['upload_file']['tmp_name'];
            $fileName = $File['upload_file']['name'];
            $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

            // Allow only PDF files
            if ($fileExtension === 'pdf') {
                $newFileName = uniqid('book_') . '.' . $fileExtension;
                $uploadDir = '../uploads/books/'; // make sure this directory exists and is writable
                $destPath = $uploadDir . $newFileName;

                if (move_uploaded_file($fileTmpPath, $destPath)) {
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
        } else {
            $_SESSION['status'] = "error";
            $_SESSION['msg'] = "No file uploaded or upload error.";
            return;
        }

          $sql = "INSERT INTO `books`(`department_id`, `course_id`, `title`, `author`, `description`, `upload_date`, `uploaded_by`, `upload_file`, `is_active`) VALUES ('$department_id','$course_id','$title','$author','$description','$upload_date','$uploaded_by','$upload_file','$is_active')";

          $result = $this->con->query($sql);

          if($result){
               $_SESSION['status'] = "success";
               $_SESSION['msg'] = "Book Added Successfully!";
          }else{
               $_SESSION['status'] = "error";
               $_SESSION['msg'] = "Book not added!";
          }
       }

       // Manage Book
       public function manage_book(){
            return $this->con->query("SELECT books.*, courses.course_name AS course_name, department.name AS department_name FROM `books` JOIN courses ON books.course_id = courses.id JOIN department ON books.department_id = department.id;"); 
       }

       // Edit Book 
       public function edit_book($id){
            return $result = $this->con->query("SELECT * FROM `books` WHERE id = '$id'");
       }

       // Update Book 
       public function update_book($Data, $File){
         
        $id = $Data['id'];
        $department_id = $Data['department_id'];
        $course_id = $Data['course_id'];
        $title = $Data['title'];
        $author = $Data['author'];
        $description = $Data['description'];
        $upload_date = $Data['upload_date'];
        $uploaded_by = $Data['uploaded_by'];
        $is_active = $Data['is_active'];

        // Step 1: Get the current file name from DB
        $query = $this->con->query("SELECT upload_file FROM books WHERE id = '$id'");
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
                $newFileName = uniqid('book_') . '.' . $fileExtension;
                $uploadDir = '../uploads/books/';
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

        $sql = "UPDATE `books` SET `department_id`='$department_id',`course_id`='$course_id',`title`='$title',`author`='$author',`description`='$description',`upload_date`='$upload_date',`uploaded_by`='$uploaded_by',`upload_file`='[value-9]',`is_active`='$is_active' WHERE 1";
          
        $result = $this->con->query($sql);
      
        if ($result) {
            $_SESSION['status'] = "success";
            $_SESSION['msg'] = "Book Updated Successfully!";

        } else {
            $_SESSION['status'] = "error";
            $_SESSION['msg'] = "Book not Updated!";
        }
      }

    // Delete Book
    public function delete_book($id) {
        // Step 1: Get the file name first
        $query = $this->con->query("SELECT upload_file FROM books WHERE id = '$id'");
    
        if ($query && $query->num_rows > 0) {
            $row = $query->fetch_assoc();
            $file = $row['upload_file'];
            $file_path = '../uploads/books/' . $file;

            // Step 2: Delete the file if it exists
            if (!empty($file) && file_exists($file_path)) {
                unlink($file_path);
            }

            // Step 3: Delete the book record
            $result = $this->con->query("DELETE FROM books WHERE id = '$id'");

            if ($result) {
                $_SESSION['status'] = "success";
                $_SESSION['msg'] = "Book deleted!";
            } else {
                $_SESSION['status'] = "error";
                $_SESSION['msg'] = "Book not deleted!";
            }
        } else {
            $_SESSION['status'] = "error";
            $_SESSION['msg'] = "Book not found!";
        }
    }

    // Total Book
     public function totalBook(){
          return $this->con->query("SELECT COUNT(*) as total_books FROM books");
     }
}

?>