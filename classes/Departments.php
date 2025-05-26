<?php
    
    class Departments extends Config{

       // Add Department
       public function add_department($dptData){
          $dpt_name  = $dptData['dpt_name'];
          $dpt_phone  = $dptData['dpt_phone'];
          $head_of_dpt = $dptData['head_of_dpt'];
          $esta_year = $dptData['esta_year'];
          $office_location = $dptData['office_location'];
          
          $sql = "INSERT INTO `department`(`name`, `phone`, `head_of_department`, `established_year`, `building_location`) VALUES ('$dpt_name','$dpt_phone','$head_of_dpt','$esta_year','$office_location')";

          $result = $this->con->query($sql);

          if($result){
               $_SESSION['status'] = "success";
               $_SESSION['msg'] = "Department Added Successfully!";
          }else{
               $_SESSION['status'] = "error";
               $_SESSION['msg'] = "Department not added!";
          }
       }

       // Manage Department
       public function manage_department(){
            return $this->con->query("SELECT * FROM `department`");
       }

       // Edit Department 
       public function edit_department($id){
            return $result = $this->con->query("SELECT * FROM `department` WHERE id = '$id'");
       }

       // Update Department 
       public function update_department($data){
         
          $id = $data['id'];
          $dpt_name  = $data['dpt_name'];
          $dpt_phone  = $data['dpt_phone'];
          $head_of_dpt = $data['head_of_dpt'];
          $esta_year = $data['esta_year'];
          $office_location = $data['building_location'];
      
          $sql = "UPDATE `department` SET `name`='$dpt_name',`phone`='$dpt_phone',`head_of_department`='$head_of_dpt',`established_year`='$esta_year',`building_location`='$office_location' WHERE id = '$id'";
          $result = $this->con->query($sql);
      
          if ($result) {
              $_SESSION['status'] = "success";
              $_SESSION['msg'] = "Department Updated Successfully!";

          } else {
              $_SESSION['status'] = "error";
              $_SESSION['msg'] = "Department not Updated!";
          }
      }

       // Delete Department
       public function delete_dpt($id){
         $result = $this->con->query("DELETE FROM `department` WHERE id = '$id'");
         if($result){
            $_SESSION['status'] = "success";
            $_SESSION['msg'] = "Department Deleted!";
         }else{
               $_SESSION['status'] = "error";
               $_SESSION['msg'] = "Department not Deleted!";
         }
       }

     // Total Department
     public function totalDpt(){
          return $this->con->query("SELECT COUNT(*) as total_departments FROM department");
     }


    }

?>