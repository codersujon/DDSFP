<?php
    
    class Exams extends Config{

       // Add Exam
       public function add_exam($Data){
         
          $exam_title = $Data['exam_title'];
          $exam_type = $Data['exam_type'];
          $program_id = $Data['program_id'];
          $course_id = $Data['course_id'];
          $exam_date = $Data['exam_date'];
          $start_time = $Data['start_time'];
          $end_time = $Data['end_time'];
          $location = $Data['location'];
          $total_marks = $Data['total_marks'];
          $passing_marks = $Data['passing_marks'];
          $semester = $Data['semester'];
         
          
          $sql = "INSERT INTO `exams`(`program_id`, `course_id`, `exam_title`, `exam_type`, `exam_date`, `start_time`, `end_time`, `location`, `total_marks`, `passing_marks`, `semester`) VALUES ('$program_id','$course_id','$exam_title','$exam_type','$exam_date','$start_time','$end_time','$location','$total_marks','$passing_marks','$semester')";

          $result = $this->con->query($sql);

          if($result){
               $_SESSION['status'] = "success";
               $_SESSION['msg'] = "Exam Added Successfully!";
          }else{
               $_SESSION['status'] = "error";
               $_SESSION['msg'] = "Exam not added!";
          }
       }

       // Manage Exam
       public function manage_exam(){
            return $this->con->query("SELECT * FROM `exams`"); 
       }

       // Edit Exam 
       public function edit_exam($id){
            return $result = $this->con->query("SELECT * FROM `exams` WHERE id = '$id'");
       }

       // Update Exam 
       public function update_exam($prgData){
         
          $id = $prgData['id'];
          $exam_title = $prgData['exam_title'];
          $exam_type = $prgData['exam_type'];
          $program_id = $prgData['program_id'];
          $course_id = $prgData['course_id'];
          $exam_date = $prgData['exam_date'];
          $start_time = $prgData['start_time'];
          $end_time = $prgData['end_time'];
          $location = $prgData['location'];
          $total_marks = $prgData['total_marks'];
          $passing_marks = $prgData['passing_marks'];
          $semester = $prgData['semester'];
      
          $sql = "UPDATE `exams` SET `program_id`='$program_id',`course_id`='$course_id',`exam_title`='$exam_title',`exam_type`='$exam_type',`exam_date`='$exam_date',`start_time`='$start_time',`end_time`='$end_time',`location`='$location',`total_marks`='$total_marks',`passing_marks`='$passing_marks',`semester`='$semester' WHERE id = '$id'";
          
          $result = $this->con->query($sql);
      
          if ($result) {
              $_SESSION['status'] = "success";
              $_SESSION['msg'] = "Exam Updated!";

          } else {
              $_SESSION['status'] = "error";
              $_SESSION['msg'] = "Exam not Updated!";
          }
      }

       // Delete Exam
       public function delete_exam($id){
         $result = $this->con->query("DELETE FROM `exams` WHERE id = '$id'");
         if($result){
            $_SESSION['status'] = "success";
            $_SESSION['msg'] = "Exam Deleted!";
         }else{
               $_SESSION['status'] = "error";
               $_SESSION['msg'] = "Exam not Deleted!";
         }
       }

     // Total Exam
     public function totalExam(){
          return $this->con->query("SELECT COUNT(*) as total_exams FROM exams");
     }

    }

?>