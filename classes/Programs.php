<?php
    
    class Programs extends Config{

       // Add Program
       public function add_program($prgData){
          // print_r($prgData);
          // die();
          $program_name  = $prgData['program_name'];
          $level  = $prgData['level'];
          $duration_years = $prgData['duration_years'];
          $total_credits = $prgData['total_credits'];
          $department_id = $prgData['department_id'];
          $program_code = $prgData['program_code'];
          
          $sql = "INSERT INTO `programs`(`department_id`, `program_name`, `level`, `duration_years`, `total_credits`, `program_code`) VALUES ('$department_id','$program_name','$level','$duration_years','$total_credits','$program_code')";

          $result = $this->con->query($sql);

          if($result){
               $_SESSION['status'] = "success";
               $_SESSION['msg'] = "Program Added Successfully!";
          }else{
               $_SESSION['status'] = "error";
               $_SESSION['msg'] = "Program not added!";
          }
       }

       // Manage Program
       public function manage_program(){
            return $this->con->query("SELECT * FROM `programs`"); 
       }

       // Edit Program 
       public function edit_program($id){
            return $result = $this->con->query("SELECT * FROM `programs` WHERE id = '$id'");
       }

       // Update Program 
       public function update_program($prgData){
         
          $id = $prgData['id'];
          $program_name  = $prgData['program_name'];
          $level  = $prgData['level'];
          $duration_years = $prgData['duration_years'];
          $total_credits = $prgData['total_credits'];
          $department_id = $prgData['department_id'];
          $program_code = $prgData['program_code'];
      
          $sql = "UPDATE `programs` SET `department_id`='$department_id',`program_name`='$program_name',`level`='$level',`duration_years`='$duration_years',`total_credits`='$total_credits',`program_code`='$program_code' WHERE id = '$id'";
          
          $result = $this->con->query($sql);
      
          if ($result) {
              $_SESSION['status'] = "success";
              $_SESSION['msg'] = "Program Updated Successfully!";

          } else {
              $_SESSION['status'] = "error";
              $_SESSION['msg'] = "Program not Updated!";
          }
      }

       // Delete Program
       public function delete_program($id){
         $result = $this->con->query("DELETE FROM `programs` WHERE id = '$id'");
         if($result){
            $_SESSION['status'] = "success";
            $_SESSION['msg'] = "Program Deleted!";
         }else{
               $_SESSION['status'] = "error";
               $_SESSION['msg'] = "Program not Deleted!";
         }
       }

     // Total Programs
     public function totalProgram(){
          return $this->con->query("SELECT COUNT(*) as total_programs FROM programs");
     }

    }

?>