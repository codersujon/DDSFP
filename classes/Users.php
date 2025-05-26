<?php
    session_start();
    require_once("config/Config.php");
    
    class Users extends Config{

        #LOGIN
        public function login($data){
            $role = $data['role'];
            $email = $data['email'];
            $password = md5($data['password']);
            $sql = "SELECT * FROM `users` WHERE `email`='$email' AND `password`='$password' AND `role` = '$role'";
            $result = $this->con->query($sql);
            if($row = mysqli_fetch_assoc($result)){
               
                if($row['role'] === "admin"){
                    $_SESSION['admin_name'] = $row['name'];
                    $_SESSION['admin_email'] = $row['email'];
                    $_SESSION['admin_password'] = $row['password'];
                    header("Location: admin/dashboard.php");
                }elseif($row['role'] === "faculty" && $row['status'] == 1){
                    $_SESSION['faculty_name'] = $row['name'];
                    $_SESSION['faculty_email'] = $row['email'];
                    $_SESSION['faculty_password'] = $row['password'];
                    header("Location: faculty/dashboard.php");
                }elseif($row['role'] === "student"){
                    $_SESSION['student_name'] = $row['name'];
                    $_SESSION['student_email'] = $row['email'];
                    $_SESSION['student_password'] = $row['password'];
                    header("Location: student/dashboard.php");
                }

            }else{
                
                if(empty($email && empty($password))){
                    $_SESSION['msg'] = "Email and Password doesn't match!";
                }

            }
        }

        #LOGOUT
        public function logout(){
            session_destroy();
            header("Location: ../index.php");
            exit();
        }

        public function user_profile($email){
            return $result = $this->con->query("SELECT * FROM `users` WHERE email = '$email'");
        }

        // Update Profile
        public function update_profile($Data, $File){
          
            $id = $Data['id'];
            $name = $Data['name'];
            $email = $Data['email'];
            $password = md5($Data['password']);
                

            // Step 1: Get the current file name from DB
            $query = $this->con->query("SELECT upload_image FROM users WHERE id = '$id'");
            $oldFile = '';
            if ($query && $query->num_rows > 0) {
                $row = $query->fetch_assoc();
                $oldFile = $row['upload_image'];
            }

            // Step 2: Handle new file upload (Image)
            $upload_file = $oldFile; // default to old file
            if (isset($File['upload_image']) && $File['upload_image']['error'] === 0) {
                $fileTmpPath = $File['upload_image']['tmp_name'];
                $fileName = $File['upload_image']['name'];
                $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

                // Allowed image extensions
                $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

                if (in_array($fileExtension, $allowedExtensions)) {
                    $newFileName = uniqid('img_') . '.' . $fileExtension;
                    $uploadDir = '../uploads/users/';
                    $destPath = $uploadDir . $newFileName;

                    if (move_uploaded_file($fileTmpPath, $destPath)) {
                        // Delete old file if it exists
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
                    $_SESSION['msg'] = "Only image files (JPG, JPEG, PNG, GIF) are allowed.";
                    return;
                }
            }

            $sql = "UPDATE `users` SET `name`='$name',`email`='$email',`upload_image`='$upload_file',`password`='$password' WHERE id = '$id'";
          
            $result = $this->con->query($sql);
        
            if ($result) {
                $_SESSION['status'] = "success";
                $_SESSION['msg'] = "User Profile Updated!";
            } else {
                $_SESSION['status'] = "error";
                $_SESSION['msg'] = "User Profile not Updated!";
            }
        }
    }
?>
