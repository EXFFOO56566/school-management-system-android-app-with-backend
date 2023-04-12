<?php
class Examresult_model extends CI_Model{
   
  public function get_exam_result_by_id($id){
        $q = $this->db->query("select * from exam_result where  exam_id = '".$id."' limit 1");
        return $q->row();
    }
    public function get_student_exam_result($student_id,$exam_id){
        $q = $this->db->query("select * from exam_result where exam_id = '".$exam_id."' and student_id = '".$student_id."'");
        return $q->result();
    }

}
?>