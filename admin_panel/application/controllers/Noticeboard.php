<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Noticeboard extends CI_Controller {
    public function __construct()
    {
                parent::__construct();
                // Your own constructor code
                $this->load->database();
                $this->load->helper('login_helper');
    }
 
    public function manage_noticeboard(){
        if(_is_user_login($this)){
            $data["error"] = "";
            $this->load->model("noticeboard_model");
            $data["noticeboard"] = $this->noticeboard_model->get_school_noticeboard();
          
          
            if($_POST){
                $this->load->library('form_validation');
                
              $this->form_validation->set_rules('notice_description', 'Notice Description', 'trim|required');
              
                if ($this->form_validation->run() == FALSE) 
        		{
        		  
        			$data["error"] = '<div class="alert alert-warning alert-dismissible" role="alert">
                                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                  <strong>Warning!</strong> '.$this->form_validation->error_string().'
                                </div>';
                    
        		}else
                {
                    
                           $notice_description = $this->input->post("notice_description");
                           $notice_type = $this->input->post("notice_type");
                           $send_SMS = $this->input->post("send_SMS");
                           
                           //my code
                           file_put_contents("test_log.txt",$notice_description."\n",FILE_APPEND);
                           file_put_contents("test_log.txt",$notice_type."\n",FILE_APPEND);
                           file_put_contents("test_log.txt",$send_SMS."\n",FILE_APPEND);
                           
                           if($send_SMS == 'YES') {
                               $q = $this->db->query("select student_phone from student_detail where NOT student_phone='0' AND school_id="._get_current_user_id($this));
                               $result = $q->result();
                               foreach ($result as $student) {
                                   $phones = $phones.",".$student->student_phone;
                                }
                                // write your logic here to send sms to all students
                           }
                           
                            $this->load->model("common_model");
                            $this->common_model->data_insert("notice_board",
                            array("notice_description"=>$notice_description, "school_id"=>_get_current_user_id($this), 
                                  "notice_type"=>$notice_type,"notice_status"=>"1"
                                  ));
                            $this->session->set_flashdata("message", '<div class="alert alert-success alert-dismissible" role="alert">
                                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                  <strong>Success!</strong> Notice Added Successfully
                                </div>');
                                redirect("noticeboard/manage_noticeboard");
                       
                }
            }
            
            $this->load->view("noticeboard/manage_noticeboard",$data);
        }
    }
    
   public function change_status(){
        $table = $this->input->post("table");
        $id = $this->input->post("id");
        $on_off = $this->input->post("on_off");
        $id_field = $this->input->post("id_field");
        $status = $this->input->post("status");
        
        $this->db->update($table,array("$status"=>$on_off),array("$id_field"=>$id));
    }   
    public function edit_noticeboard($notice_id){
        if(_is_user_login($this)){
            $data = array();
            $this->load->model("noticeboard_model");
            $noticeid = $this->noticeboard_model->get_school_noticeboard_by_id($notice_id);
            $data["noticelist"] = $noticeid;
            
            if($_POST){
                $this->load->library('form_validation');
                
             $this->form_validation->set_rules('notice_description', 'Notice Description', 'trim|required');
              
                if ($this->form_validation->run() == FALSE) 
        		{
        		  
        			$data["error"] = '<div class="alert alert-warning alert-dismissible" role="alert">
                                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                  <strong>Warning!</strong> '.$this->form_validation->error_string().'
                                </div>';
                    
        		} else{ 
                        $notice_description = $this->input->post("notice_description");
                           $notice_type = $this->input->post("notice_type");
                
                        $update_array =array("notice_description"=>$notice_description,"notice_type"=>$notice_type );
                        
                            $this->load->model("common_model");
                            $this->common_model->data_update("notice_board",$update_array,array("notice_id"=>$notice_id)
                                );
                            $this->session->set_flashdata("message", '<div class="alert alert-success alert-dismissible" role="alert">
                                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                  <strong>Success!</strong> Notice Update Successfully
                                </div>');
                                redirect("noticeboard/manage_noticeboard");
                    
                }
            }
            
            
            $this->load->view("noticeboard/edit_noticeboard",$data);
        }
    }
    function delete_notice($notice_id){
                $this->db->query("Delete from notice_board where notice_id = '".$notice_id."'");
                redirect("noticeboard/manage_noticeboard");
    
    }
   
 
  
}

?>