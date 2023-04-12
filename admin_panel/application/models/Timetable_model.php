<?php
class Timetable_model extends CI_Model{
   
     
     public function get_day_by_id(){
        $q = $this->db->query("select timetable.*,standard.standard_title,teacher_detail.teacher_name,days.day_name from timetable
                                inner join standard on standard.standard_id = timetable.standard_id
                                 inner join teacher_detail on teacher_detail.teacher_id = timetable.teacher_id
                                 inner join days on days.id = timetable.day_id where timetable.school_id="._get_current_user_id($this));
       return $q->result();
    } 
     
    public function get_timetable_by_id($id){
        $q = $this->db->query("select * from timetable where  id = '".$id."' limit 1");
        return $q->row();
    }
    public function get_days(){
        $q = $this->db->query("select * from days");
       return $q->result();
    } 
    public function get_teacher(){
        $q = $this->db->query("select * from teacher_detail where school_id="._get_current_user_id($this));
       return $q->result();
    } 
}
?>