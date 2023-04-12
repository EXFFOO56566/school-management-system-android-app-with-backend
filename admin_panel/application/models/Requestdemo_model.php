<?php
class Requestdemo_model extends CI_Model{
  
        public function get_demorequest(){
        
        $this->db->select();
            $this->db->from('demo_enquiry');
            $q = $this->db->get();
            return $q->result();
    }
    public function get_demo_by_id($id){
        $q = $this->db->query("select * from demo_enquiry where  demo_id = '".$id."' limit 1");
        return $q->row();
    }
   

}
?>