<?php
class Exam_model extends CI_Model{
   
    public function get_school_exam(){
            $q = $this->db->query("select exam.*,standard.standard_title from exam
            inner join standard on standard.standard_id = exam.exam_standard
             where exam.school_id="._get_current_user_id($this));
            return $q->result();
    }
          public function get_school_exam_by_id($id){
        $q = $this->db->query("select * from exam where  exam_id = '".$id."' limit 1");
        return $q->row();
    }
    
    
 public function get_school_exam_by_id_manage_result($id){
        $q = $this->db->query("select exam.*,standard.standard_title from exam 
        inner join standard on standard.standard_id = exam.exam_standard
         where  exam_id = '".$id."' limit 1");
        return $q->row();
    }
    
     
}
?>