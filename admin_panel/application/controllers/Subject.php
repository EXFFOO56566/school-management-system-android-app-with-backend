<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subject extends CI_Controller {
    public function __construct()
    {
                parent::__construct();
                // Your own constructor code
                $this->load->database();
                $this->load->helper('login_helper');
    }
 
    public function manage_subject(){
        if(_is_user_login($this)){
             $data["error"] = "";
            $this->load->model("subject_model");
            $data["subject"] = $this->subject_model->get_school_subject();
          
          $this->load->model("subject_model");
          $data["school_standard"] = $this->subject_model->get_school_standard();
            if($_POST){
                $this->load->library('form_validation');
                
              $this->form_validation->set_rules('subject_title', 'Subject Title', 'trim|required');
               $this->form_validation->set_rules('subject_total_ques', 'Subject Total Question', 'trim|required');
                $this->form_validation->set_rules('quiz_time', 'Quiz Title', 'trim|required');
              
                if ($this->form_validation->run() == FALSE) 
        		{
        		  
        			$data["error"] = '<div class="alert alert-warning alert-dismissible" role="alert">
                                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                  <strong>Warning!</strong> '.$this->form_validation->error_string().'
                                </div>';
                    
        		}else
                {
                    
                           $subject_title = $this->input->post("subject_title");  
                           $standard = $this->input->post("standard");
                           $subject_total_ques = $this->input->post("subject_total_ques");
                           $quiz_time = $this->input->post("quiz_time");
                           
                            $this->load->model("common_model");
                            $this->common_model->data_insert("subject",
                            array("subject_title"=>$subject_title, "school_id"=>_get_current_user_id($this),  
                                  "quiz_time"=>$quiz_time,"subject_total_ques"=>$subject_total_ques,"subject_standard"=>$standard
                                  ));
                            $this->session->set_flashdata("message", '<div class="alert alert-success alert-dismissible" role="alert">
                                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                  <strong>Success!</strong> Exam Added Successfully
                                </div>');
                                redirect("subject/manage_subject");
                       
                }
            }
            
            $this->load->view("subject/manage_subject",$data);
        }
    }
    public function edit_subject($subject_id){
        if(_is_user_login($this)){
            $data = array();
            $this->load->model("subject_model");
            $subid = $this->subject_model->get_subject_by_id($subject_id);
            $data["subject"] = $subid;
            
            $this->load->model("subject_model");
          $data["school_standard"] = $this->subject_model->get_school_standard();
            if($_POST){
                $this->load->library('form_validation');
                
             
              
              $this->form_validation->set_rules('subject_title', 'Subject Title', 'trim|required');
               $this->form_validation->set_rules('subject_total_ques', 'Subject Total Question', 'trim|required');
                $this->form_validation->set_rules('quiz_time', 'Quiz Title', 'trim|required');
              
                if ($this->form_validation->run() == FALSE) 
        		{
        		  
        			$data["error"] = '<div class="alert alert-warning alert-dismissible" role="alert">
                                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                  <strong>Warning!</strong> '.$this->form_validation->error_string().'
                                </div>';
                    
        		} else{
                        $this->session->set_flashdata("message", '<div class="alert alert-success alert-dismissible" role="alert">
                                          <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                          <strong>Warning!</strong> Standard Already Exist.Please Enter Another Name
                                        </div>'); 
                       
                           
                            $subject_title = $this->input->post("subject_title");  
                           $standard = $this->input->post("standard");
                           $subject_total_ques = $this->input->post("subject_total_ques");
                           $quiz_time = $this->input->post("quiz_time");
                           
                
                        $update_array = array("subject_title"=>$subject_title, "school_id"=>_get_current_user_id($this),
                        "quiz_time"=>$quiz_time, "subject_total_ques"=>$subject_total_ques,"subject_standard"=>$standard);
                        
                         
                        
                            $this->load->model("common_model");
                            $this->common_model->data_update("subject",$update_array,array("subject_id"=>$subject_id)
                                );
                            $this->session->set_flashdata("message", '<div class="alert alert-success alert-dismissible" role="alert">
                                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                  <strong>Success!</strong> Exam Update Successfully
                                </div>');
                                redirect("subject/manage_subject");
                    
                }
            }
            
            
            $this->load->view("subject/edit_subject",$data);
        }
    }
    function delete_subject($subject_id){
                $this->db->query("Delete from subject where subject_id = '".$subject_id."'");
                redirect("subject/manage_subject");
    
    }
   
    function view_quiz_result($subject_id){
            $this->load->model("subject_model");
            $data["quiz_result"] = $this->subject_model->get_result_by_standard($subject_id); 
            $this->load->view("subject/view_quiz_result",$data);
    }
  
}

?>