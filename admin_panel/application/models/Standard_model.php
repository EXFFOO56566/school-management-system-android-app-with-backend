<?php
class Standard_model extends CI_Model{
   
    public function get_school_standard(){
            $q = $this->db->query("select * from standard where school_id="._get_current_user_id($this));
            return $q->result(); 
    }
       public function get_school_standard_by_id($id){
        $q = $this->db->query("select * from standard where  standard_id = '".$id."' limit 1");
        return $q->row();
    }

}
?>