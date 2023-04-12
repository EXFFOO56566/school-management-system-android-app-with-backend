<?php
class Question_model extends CI_Model{
   
    public function get_question_by_subject($subject_id){
            $q = $this->db->query("select * from question where subject_id='".$subject_id."'");
            return $q->result();
    }
          public function get_school_question_by_id($id){
        $q = $this->db->query("select * from question where  ques_id = '".$id."' limit 1");
        return $q->row();
    } 
     public function get_school_question_by_status(){
            $q = $this->db->query("select * from question where status=1 AND subject_id="._get_current_user_id($this));
            return $q->result();
    }


}
?>