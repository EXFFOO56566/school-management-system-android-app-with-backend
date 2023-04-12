<?php
class Attendence_model extends CI_Model{
     
 
    public function get_school_student_attendence_by_id($id){
        $q = $this->db->query("select * from student_detail where  student_id = '".$id."' limit 1");
        return $q->row();
    }     
 
 /* this function are use in manage student attendence  */    
public function get_school_standard_student_attendence($standard_id,$date){
         
            $this->db->select('attendence.*');
            $this->db->from('attendence');
          // $this->db->join('standard', 'standard.standard_id = student_detail.student_standard');
            
            $this->db->where('attendence.standard_id',$standard_id);
            $this->db->where('attendence.attendence_date',$date);
            
            $q = $this->db->get();
            return $q->result();

        }



}
?>