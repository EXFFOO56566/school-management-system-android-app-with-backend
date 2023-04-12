<?php
class Student_model extends CI_Model{
     
    public function get_school_student($filter=array()){
           
            $filter_text = "";
             
                if(!empty($filter)){
                    if(key_exists("student_standard",$filter)){
                        $filter_text .= " and  `student_detail`.student_standard = '".$filter['student_standard']."' ";
                    }
                   
                }
                
                 else{
                    
                        $filter_text .= " and  `student_detail`.school_id = "._get_current_user_id($this);
                    
                }
            //$q = $this->db->query("select student_detail.*, standard.standard_title from student_detail 
            //inner join standard on standard.standard_id = student_detail.student_standard
            //where student_detail.school_id="._get_current_user_id($this));
            
             $sql = "select student_detail.*, standard.standard_title,standard.standard_id from student_detail 
            left join standard on standard.standard_id = student_detail.student_standard
            where 1 ".$filter_text;
            
            $q = $this->db->query($sql);
            return $q->result();
    } 
    public function get_school_student_by_id($id){
        $q = $this->db->query("select * from student_detail where student_id = '".$id."' limit 1");
        return $q->row();
    }     
    public function get_school_student_detail($student_id){
            $q = $this->db->query("select student_detail.*, standard.standard_title from student_detail 
            inner join standard on standard.standard_id = student_detail.student_standard
           
            where student_detail.student_id=".$student_id);
            return $q->row();
    } 
/* this function are use in manage result  and exam result controller */  
  public function get_school_standard_student_manage_result($standardid){
            $q = $this->db->query("select * from student_detail where student_detail.student_standard=".$standardid);
            return $q->result();
    } 
  /* this function are use in manage student attendence  */    
public function get_school_standard_student_add_attendence($standard){
         
            $this->db->select('student_detail.*, standard.standard_title, standard.standard_id');
            $this->db->from('student_detail');
            $this->db->join('standard', 'standard.standard_id = student_detail.student_standard');
                        
            if(isset($standard) && $standard!="")
            $this->db->where('student_detail.student_standard',$standard);
            
            $q = $this->db->get();
            return $q->result();

        }
        
  /* this function are use in manage student rank  */    
public function get_school_standard_student_add_rank($standard){
         
            $this->db->select('student_detail.*, standard.standard_title, standard.standard_id');
            $this->db->from('student_detail');
            $this->db->join('standard', 'standard.standard_id = student_detail.student_standard');
                        
            if(isset($standard) && $standard!="")
            $this->db->where('student_detail.student_standard',$standard);
            
            $q = $this->db->get();
            return $q->result();

        }          
        
        

       

}


 