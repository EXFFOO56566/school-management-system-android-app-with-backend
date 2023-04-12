<?php
class Noticeboard_model extends CI_Model{
   
    public function get_school_noticeboard(){
            $q = $this->db->query("select * from notice_board where school_id="._get_current_user_id($this));
            return $q->result();
    }
          public function get_school_noticeboard_by_id($id){
        $q = $this->db->query("select * from notice_board where notice_id = '".$id."' limit 1");
        return $q->row();
    }
    
 
     
}
?>