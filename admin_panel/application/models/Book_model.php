<?php
class Book_model extends CI_Model{
   
    public function get_school_book(){
            $q = $this->db->query("select book.*,standard.standard_title from book
            inner join standard on standard.standard_id = book.book_standard
             where book.school_id="._get_current_user_id($this));
            return $q->result();
    }
          public function get_school_exam_by_id($book_id){
        $q = $this->db->query("select * from book where  book_id = '".$book_id."' limit 1");
        return $q->row();
    }
     
    
 public function get_school_exam_by_id_manage_result($book_id){
        $q = $this->db->query("select exam.*,standard.standard_title from exam 
        inner join standard on standard.standard_id = exam.exam_standard
         where  exam_id = '".$book_id."' limit 1");
        return $q->row();
    }
    
     
}
?>