<?php
class Topstudent_model extends CI_Model{
     
 
    public function get_school_top_student_by_id($id){
        $q = $this->db->query("select * from top_student where  top_id = '".$id."' limit 1");
        return $q->row();
    }     
     
public function get_school_topstudent(){
         
            $this->db->select('top_student.*, standard.standard_title, student_detail.student_name, student_detail.student_roll_no');
            $this->db->from('top_student');
            $this->db->join('standard', 'standard.standard_id = top_student.standard_id');
             $this->db->join('student_detail', 'student_detail.student_id = top_student.student_id');
            $this->db->where('top_student.school_id',_get_current_user_id($this));
            $q = $this->db->get();
            return $q->result();

        } 
     
public function get_school_standard_topstudent($standard_id){
         
            $this->db->select('top_student.*');
            $this->db->from('top_student');
            $this->db->where('top_student.standard_id',$standard_id);
            
            $q = $this->db->get();
            return $q->result();

        }



}
?>