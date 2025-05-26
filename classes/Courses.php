<?php
    
    class Courses extends Config{

       // Add Course
       public function add_course($Data){
          $course_name = $Data['course_name'];
          $department_id = $Data['department_id'];
          $credits = $Data['credits'];
          $semester = $Data['semester'];
          $program_id = $Data['program_id'];
          $faculty_id = $Data['faculty_id'];
          $course_code = $Data['course_code'];
         
          
          $sql = "INSERT INTO `courses`(`department_id`, `program_id`, `faculty_id`, `course_name`, `credits`, `semester`, `course_code`) VALUES ('$department_id','$program_id','$faculty_id','$course_name','$credits','$semester','$course_code')";

          $result = $this->con->query($sql);

          if($result){
               $_SESSION['status'] = "success";
               $_SESSION['msg'] = "Course Added Successfully!";
          }else{
               $_SESSION['status'] = "error";
               $_SESSION['msg'] = "Course not added!";
          }
       }

       // Manage Course
       public function manage_course(){
            return $this->con->query("SELECT courses.*, programs.program_name, faculty.name AS faculty_name FROM courses JOIN programs ON courses.program_id = programs.id JOIN faculty ON courses.faculty_id = faculty.id"); 
       }

       // Edit Course 
       public function edit_course($id){
            return $result = $this->con->query("SELECT * FROM `courses` WHERE id = '$id'");
       }

     // Update Course 
       public function update_course($prgData){
         
          $id = $prgData['id'];
          $course_name = $prgData['course_name'];
          $department_id = $prgData['department_id'];
          $credits = $prgData['credits'];
          $semester = $prgData['semester'];
          $program_id = $prgData['program_id'];
          $faculty_id = $prgData['faculty_id'];
          $course_code = $prgData['course_code'];
      
          $sql = "UPDATE `courses` SET `department_id`='$department_id',`program_id`='$program_id',`faculty_id`='$faculty_id',`course_name`='$course_name',`credits`='$credits',`semester`='$semester',`course_code`='$course_code' WHERE id = '$id'";
          
          $result = $this->con->query($sql);
      
          if ($result) {
              $_SESSION['status'] = "success";
              $_SESSION['msg'] = "Course Updated!";

          } else {
              $_SESSION['status'] = "error";
              $_SESSION['msg'] = "Course not Updated!";
          }
      }

     // Delete Course
       public function delete_course($id){
         $result = $this->con->query("DELETE FROM `courses` WHERE id = '$id'");
         if($result){
            $_SESSION['status'] = "success";
            $_SESSION['msg'] = "Course Deleted!";
         }else{
               $_SESSION['status'] = "error";
               $_SESSION['msg'] = "Course not Deleted!";
         }
       }

     // Total Student
     public function totalCourse(){
          return $this->con->query("SELECT COUNT(*) as total_courses FROM courses");
     }

    }

?>