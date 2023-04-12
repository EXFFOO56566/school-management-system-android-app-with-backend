<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chat extends CI_Controller {
    public function __construct()
    {
                parent::__construct();
                // Your own constructor code
                $this->load->database();
                $this->load->helper('login_helper');
    }
 
    public function manage_chat(){
        if(_is_user_login($this)){
             $data["error"] = "";
            $this->load->model("chat_model");
            $data["chat"] = $this->chat_model->get_school_chat();
            
            $this->load->view("chat/manage_chat",$data);
        }
    }
    public function chat_reply($id){
        if(_is_user_login($this)){
             $data["error"] = "";
            $this->load->model("chat_model");
            $data["chat"] = $this->chat_model->get_school_chat_by_id($id);
             if(isset($_REQUEST["chat"])){
                $this->load->library('form_validation');
                
              $this->form_validation->set_rules('editor1', 'Reply Message', 'trim|required');
              
                if ($this->form_validation->run() == FALSE) 
        		{
        		  
        			$data["error"] = '<div class="alert alert-warning alert-dismissible" role="alert">
                                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                  <strong>Warning!</strong> '.$this->form_validation->error_string().'
                                </div>';
                    
        		}else
                {
                    
                       
                           $reply = $this->input->post("editor1");
                           
                            $this->load->model("common_model");
                            
                              $update_array = array(
                                 "reply"=>$reply,
                                );
                            $this->load->model("common_model");
                            $this->common_model->data_update("school_student_chat",$update_array,array("chat_id"=>$id)
                                );
                            $this->session->set_flashdata("message", '<div class="alert alert-success alert-dismissible" role="alert">
                                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                  <strong>Success!</strong> Reply Added Successfully
                                </div>');
                                redirect("chat/manage_chat");
                       
                }
            }
            
            $this->load->view("chat/chat_reply",$data);
        }
    } 
    function delete_chat($chat_id){
                $this->db->query("Delete from school_student_chat where chat_id = '".$chat_id."'");
                redirect("chat/manage_chat");
    
    }
   
 
  
}