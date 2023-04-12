<?php
class Notification_model extends CI_Model{
   
     
          public function get_notification(){
        $q = $this->db->query("select * from notification where school_id="._get_current_user_id($this));
        return $q->result();
    }
    

}
?>