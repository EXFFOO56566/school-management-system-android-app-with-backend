<?php
class Chat_model extends CI_Model{
   
    public function get_school_chat(){
            $q = $this->db->query("select school_student_chat.*,standard.standard_title,student_detail.student_name,student_detail.student_roll_no from school_student_chat inner join student_detail on student_detail.student_id = school_student_chat.student_id
            inner join standard on student_detail.student_standard = standard.standard_id  where school_student_chat.school_id="._get_current_user_id($this));
            return $q->result();
    }
          public function get_school_chat_by_id($id){
        $q = $this->db->query("select * from school_student_chat where  chat_id = '".$id."' limit 1");
        return $q->row();
    }
    

}
?>