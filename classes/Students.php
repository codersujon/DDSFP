<?php
    
    class Students extends Config{
     
     // Add Student
     public function add_student($data) {
       
            $student_name = trim($data['student_name']);
            $student_email = trim($data['student_email']);
            $student_phone = trim($data['student_phone']);
            $gender = trim($data['gender']);
            $dob = trim($data['dob']);
            $department_id = (int)$data['department_id'];
            $program_id = (int)$data['program_id'];
            $enrollment_year = trim($data['enrollment_year']);
            $semester = trim($data['semester']);
            $address = trim($data['address']);
      
          // Validate required fields (basic check)
          if (empty($student_name) || empty($student_email) || empty($department_id) || empty($program_id)) {
              $_SESSION['status'] = "error";
              $_SESSION['msg'] = "Required fields are missing!";
              return false;
          }
      
          $sql = "INSERT INTO `students`(`department_id`, `program_id`, `student_name`, `gender`, `email`, `dob`, `phone`, `enrollment_year`, `semester`, `address`) VALUES ('$department_id','$program_id','$student_name','$gender','$student_email','$dob','$student_phone','$enrollment_year','$semester','$address')";

          $password = md5("12345678");

          $sql2 = "INSERT INTO `users`(`name`, `email`,`password`, `role`, `status`) VALUES ('$student_name','$student_email', '$password', 'student', '1')";
      
          $result = $this->con->query($sql);
          $result2 = $this->con->query($sql2);
      
          if ($result && $result2) {
              $_SESSION['status'] = "success";
              $_SESSION['msg'] = "Student Added Successfully!";
              return true;
          } else {
              $_SESSION['status'] = "error";
              $_SESSION['msg'] = "Student not added! Error: " . $this->con->error;
              return false;
          }
     }

     // Manage Student
     public function manage_student(){
          return $this->con->query("SELECT * FROM `students`");
     }

    // Edit Student 
    public function edit_student($id){
        return $result = $this->con->query("SELECT * FROM `students` WHERE id = '$id'");
    }

    // Update Student 
    public function update_student($data){
        $id = $data['id'];
        $student_name = trim($data['student_name']);
        $student_email = trim($data['student_email']);
        $student_phone = trim($data['student_phone']);
        $gender = trim($data['gender']);
        $dob = trim($data['dob']);
        $department_id = (int)$data['department_id'];
        $program_id = (int)$data['program_id'];
        $enrollment_year = trim($data['enrollment_year']);
        $semester = trim($data['semester']);
        $address = trim($data['address']);

        $sql = "UPDATE `students` SET `department_id`='$department_id',`program_id`='$program_id',`student_name`='$student_name',`gender`='$gender',`email`='$student_email',`dob`='$dob',`phone`='$student_phone',`enrollment_year`='$enrollment_year',`semester`='$semester',`address`='$address' WHERE id = '$id'";
        $result = $this->con->query($sql);
    
        if ($result) {
            $_SESSION['status'] = "success";
            $_SESSION['msg'] = "Student Updated!";

        } else {
            $_SESSION['status'] = "error";
            $_SESSION['msg'] = "Student not Updated!";
        }
    }

     // Delete Student
     public function delete_student($id) {
          // Sanitize the ID
          $id = $this->con->real_escape_string($id);
     
          // Validate that ID is numeric to avoid accidental/malicious input
          if (!is_numeric($id)) {
          $_SESSION['status'] = "error";
          $_SESSION['msg'] = "Invalid Student ID!";
          return false;
          }
     
          $sql = "DELETE FROM `students` WHERE id = '$id'";
          $result = $this->con->query($sql);
     
          if ($result) {
            $_SESSION['status'] = "success";
            $_SESSION['msg'] = "Student Deleted!";
            return true;
          } else {
            $_SESSION['status'] = "error";
            $_SESSION['msg'] = "Student not Deleted! Error: " . $this->con->error;
            return false;
          }
     }

    // Total Student
    public function totalStudent(){
        return $this->con->query("SELECT COUNT(*) as total_students FROM students");
    }
      
    }

?>