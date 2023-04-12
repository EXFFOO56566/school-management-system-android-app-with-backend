<?php
class Holiday_model extends CI_Model{
   
    public function get_school_upcomming_holiday(){
            $q = $this->db->query("select * from holiday where school_id="._get_current_user_id($this)." order by holiday_date desc limit 5");
            return $q->result();
    }
        public function get_school_holiday_calender(){
            $q = $this->db->query("select * from holiday where school_id="._get_current_user_id($this));
            return $q->result();
    }
            public function get_school_holiday(){
            $q = $this->db->query("select * from holiday where school_id="._get_current_user_id($this));
            return $q->result();
    }
          public function get_school_holiday_by_id($id){
        $q = $this->db->query("select * from holiday where  holiday_id = '".$id."' limit 1");
        return $q->row();
    }
    
 


}
?>