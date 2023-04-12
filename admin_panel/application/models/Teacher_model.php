<?php
class Teacher_model extends CI_Model{
     
    public function get_school_teacher(){
           
             $sql = "select * from teacher_detail where school_id="._get_current_user_id($this);
            
            $q = $this->db->query($sql);
            return $q->result();
    } 
    public function get_school_teacher_by_id($id){
        $q = $this->db->query("select * from teacher_detail where teacher_id = '".$id."' limit 1");
        return $q->row();
    }     
    public function get_school_teacher_detail($teacher_id){
            $q = $this->db->query("select * from teacher_detail where teacher_id=".$teacher_id);
            return $q->row();
    }  
       

}
?>