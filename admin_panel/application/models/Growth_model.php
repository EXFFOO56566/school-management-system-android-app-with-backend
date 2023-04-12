<?php
class Growth_model extends CI_Model{
   
 /* get student growth */  
  public function get_school_standard_student_growth($student_id){
            $q = $this->db->query("select * from student_growth where student_id=".$student_id);
            return $q->result();
    }

 
}
?>