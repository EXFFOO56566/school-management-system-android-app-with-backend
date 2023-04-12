<?php
class Users_model extends CI_Model{
  /*  public function get_users(){
        
        $this->db->select();
            $this->db->from('users');
            $this->db->where_not_in('user_id',_get_current_user_id($this));
            $q = $this->db->get();
            return $q->result();
    }  */
    public function get_users(){
        
        $this->db->select('users.*, ifnull(student.count, 0) as student_count');
            $this->db->from('users');
            $this->db->join('(Select count(student_id) as count, school_id from student_detail group by school_id ) as student', 'student.school_id = users.user_id',"left");
            $this->db->where_not_in('user_id',_get_current_user_id($this));
            $q = $this->db->get();
            return $q->result();
    }
    public function get_user_by_id($id){
        $q = $this->db->query("select * from users where  user_id = '".$id."' limit 1");
        return $q->row();
    }
    public function get_user_type(){
        $q = $this->db->query("select * from user_types");
        return $q->result();
    }
    public function get_user_type_id($id){
        $q = $this->db->query("select * from user_types where user_type_id = '".$id."'");
        return $q->row();
    }
    public function get_user_type_access($type_id){
        $q = $this->db->query("select * from user_type_access where user_type_id = '".$type_id."'");
        return $q->result();
    }
}
?>