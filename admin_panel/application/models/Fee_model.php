<?php
class Fee_model extends CI_Model{
   
    public function get_fee_type(){
            $q = $this->db->query("select fee_types.*,standard.standard_title from fee_types 
            inner join standard on standard.standard_id = fee_types.standard_id where fee_types.school_id="._get_current_user_id($this));
            return $q->result();
            
    }
    public function get_fee_types_by_id($id){
        $q = $this->db->query("select * from fee_types where  id = '".$id."' limit 1");
        return $q->row();
    } 
    
    public function get_student_by_standard($standard_id){
         $q = $this->db->query("select * from student_detail where  student_standard = '".$standard_id."'");
        return $q->result();
    }
    
      public function get_fees_type_by_standard($fee_types){
         $q = $this->db->query("select * from fee_types where standard_id = '".$fee_types."' and school_id="._get_current_user_id($this));
        return $q->result();
    }
    public function get_fees_amount_by_standard($fee_amount){
         $q = $this->db->query("select * from fee_types where id = '".$fee_amount."' and school_id="._get_current_user_id($this));
        return $q->result();
    }
    public function get_fees_remaining_amount($fees_id,$sudent_id){
         $q = $this->db->query("select fee_types.*, ifnull(paid_fees.paid, 0) as paid, (fee_types.base_amount - ifnull(paid_fees.paid, 0)) as remain_amount from fee_types 
         left outer join (select sum(fee_amount) as paid, fee_types from student_fees where student_id = '".$sudent_id."' group by fee_types) as paid_fees on paid_fees.fee_types = fee_types.id
         where fee_types.id = '".$fees_id."' and fee_types.school_id="._get_current_user_id($this));
        return $q->result();
    }
    
    public function get_student_fees(){
        $q = $this->db->query("select student_fees.*,standard.standard_title,student_detail.student_user_name,fee_types.title  from student_fees
         inner join standard on standard.standard_id = student_fees.standard_id
         inner join student_detail on student_detail.student_id = student_fees.student_id
          inner join fee_types on fee_types.id = student_fees.fee_types
         where student_fees.school_id="._get_current_user_id($this));
        return $q->result();
    } 
    
    public function get_student_fees_list($student_id){ 
        
       
        $q = $this->db->query("select student_fees.*,standard.standard_title,student_detail.student_name,student_detail.student_address,student_detail.student_city,student_detail.student_roll_no,student_detail.student_branch,student_detail.student_phone,fee_types.title,fee_types.year from student_fees 
         inner join student_detail on student_detail.student_id = student_fees.student_id
          inner join fee_types on fee_types.id = student_fees.fee_types 
           inner join standard on standard.standard_id = student_fees.standard_id 
        where student_fees.student_id = '".$student_id."' and student_fees.school_id="._get_current_user_id($this)); 
        return $q->result();
    }
    
      public function get_student_fees_id($student_fees_id){
        $q = $this->db->query("select * from student_fees where student_fees_id = '".$student_fees_id."' limit 1");
        return $q->row();
    } 
}
?>