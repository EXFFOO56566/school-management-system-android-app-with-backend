<?php
class Event_model extends CI_Model{
   
    public function get_school_event(){
            $q = $this->db->query("select * from event where school_id="._get_current_user_id($this));
            return $q->result();
    }
          public function get_school_event_by_id($id){
        $q = $this->db->query("select * from event where  event_id = '".$id."' limit 1");
        return $q->row();
    }
    
     public function get_school_event_by_status(){
            $q = $this->db->query("select * from event where status=1 AND school_id="._get_current_user_id($this));
            return $q->result();
    }


}
?>