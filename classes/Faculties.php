<?php
    
    class Faculties extends Config{
     
     // Add Faculty
     public function add_faculty($data) {
          // Escape and sanitize input to prevent SQL injection
          $faculty_name = $this->con->real_escape_string($data['faculty_name']);
          $faculty_email = $this->con->real_escape_string($data['faculty_email']);
          $faculty_phone = $this->con->real_escape_string($data['faculty_phone']);
          $faculty_designation = $this->con->real_escape_string($data['faculty_designation']);
          $hire_date = $this->con->real_escape_string($data['hire_date']);
          $salary = $this->con->real_escape_string($data['salary']);
          $department_id = $this->con->real_escape_string($data['department_id']);
      
          // Validate required fields (basic check)
          if (empty($faculty_name) || empty($faculty_email) || empty($department_id)) {
              $_SESSION['status'] = "error";
              $_SESSION['msg'] = "Required fields are missing!";
              return false;
          }
      
          $sql = "INSERT INTO `faculty` (`name`, `email`, `phone`, `designation`, `hire_date`, `salary`, `department_id`) 
                  VALUES ('$faculty_name', '$faculty_email', '$faculty_phone', '$faculty_designation', '$hire_date', '$salary', '$department_id')";

          $password = md5("12345678");

          $sql2 = "INSERT INTO `users`(`name`, `email`,`password`, `role`, `status`) VALUES ('$faculty_name','$faculty_email', '$password', 'faculty', '1')";
      
          $result = $this->con->query($sql);
          $result2 = $this->con->query($sql2);
      
          if ($result && $result2) {
              $_SESSION['status'] = "success";
              $_SESSION['msg'] = "Faculty Added Successfully!";
              return true;
          } else {
              $_SESSION['status'] = "error";
              $_SESSION['msg'] = "Faculty not added! Error: " . $this->con->error;
              return false;
          }
     }

     // Manage Faculty
     public function manage_faculty(){
          return $this->con->query("SELECT * FROM `faculty`");
     }

    // Edit Faculty 
    public function edit_faculty($id){
        return $result = $this->con->query("SELECT * FROM `faculty` WHERE id = '$id'");
    }

    // Update Faculty 
    public function update_faculty($data){
        $id = $data['id'];
        $faculty_name = $data['faculty_name'];
        $faculty_email = $data['faculty_email'];
        $faculty_phone = $data['faculty_phone'];
        $faculty_designation = $data['faculty_designation'];
        $hire_date = $data['hire_date'];
        $salary = $data['salary'];
        $department_id = $data['department_id'];
    
        $sql = "UPDATE `faculty` SET `name`='$faculty_name',`email`='$faculty_email',`phone`='$faculty_phone',`designation`='$faculty_designation',`hire_date`='$hire_date',`salary`='$salary',`department_id`='$department_id' WHERE id = '$id'";
        $result = $this->con->query($sql);
    
        if ($result) {
            $_SESSION['status'] = "success";
            $_SESSION['msg'] = "Faculty Updated Successfully!";

        } else {
            $_SESSION['status'] = "error";
            $_SESSION['msg'] = "Faculty not Updated!";
        }
    }

     // Delete Department
     public function delete_faculty($id) {
          // Sanitize the ID
          $id = $this->con->real_escape_string($id);
     
          // Validate that ID is numeric to avoid accidental/malicious input
          if (!is_numeric($id)) {
          $_SESSION['status'] = "error";
          $_SESSION['msg'] = "Invalid Faculty ID!";
          return false;
          }
     
          $sql = "DELETE FROM `faculty` WHERE id = '$id'";
          $result = $this->con->query($sql);
     
          if ($result) {
          $_SESSION['status'] = "success";
          $_SESSION['msg'] = "Faculty Deleted!";
          return true;
          } else {
          $_SESSION['status'] = "error";
          $_SESSION['msg'] = "Faculty not Deleted! Error: " . $this->con->error;
          return false;
          }
     }

    // Total Faculty
    public function totalFaculty(){
        return $this->con->query("SELECT COUNT(*) as total_faculty FROM faculty");
    }
      
    }

?>