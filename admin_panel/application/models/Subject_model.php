<?php
class Subject_model extends CI_Model{
   
   public function get_school_standard(){
            $q = $this->db->query("select * from standard where school_id="._get_current_user_id($this));
            return $q->result();
    }
       public function get_subject_by_id($subject_id){
        $q = $this->db->query("select * from subject where  subject_id = '".$subject_id."' limit 1");
        return $q->row();
    }
     public function get_school_subject(){
        $q = $this->db->query("select * from subject where school_id="._get_current_user_id($this)); 
       return $q->result();
    }
    
      public function get_result_by_standard($subject_id){ 
         $q = $this->db->query("select distinct quiz_result.*,subject.subject_title, subject.subject_total_ques,subject.quiz_time, student_detail.student_name, student_detail.student_roll_no, student_detail.student_semester, student_detail.student_division, student_detail.student_batch from quiz_result
         inner join student_detail on student_detail.student_id = quiz_result.quiz_student_id
         inner join subject on subject.subject_id = quiz_result.quiz_subject_id  
         where subject.subject_id=".$subject_id." and   quiz_result.quiz_school_id="._get_current_user_id($this)); 
          
        return $q->result();
    }
}
?>