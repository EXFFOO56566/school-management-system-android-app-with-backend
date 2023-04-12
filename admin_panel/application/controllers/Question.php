<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Question extends CI_Controller {
    public function __construct()
    {
                parent::__construct();
                // Your own constructor code
                $this->load->database();
                $this->load->helper('login_helper');
    }
 
    public function manage_question($subject_id){
        if(_is_user_login($this)){
             $data["error"] = "";
            $this->load->model("question_model");
            $data["question"] = $this->question_model->get_question_by_subject($subject_id);
              
            if($_POST){ 
                $this->load->library('form_validation');
                
              $this->form_validation->set_rules('question', 'question', 'trim|required'); 
              $this->form_validation->set_rules('r_ans', 'Right Answer', 'trim|required');
              
                if ($this->form_validation->run() == FALSE) 
        		{
        		  
        			$data["error"] = '<div class="alert alert-warning alert-dismissible" role="alert">
                                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                  <strong>Warning!</strong> '.$this->form_validation->error_string().'
                                </div>';
                    
        		}else
                {
                    
                           $question = $this->input->post("question");
                           $r_ans = $this->input->post("r_ans");
                            $textbox_array = $this->input->post("textbox[]");
                           $question_array = array("question"=>$question,
                                  "	r_ans"=>$r_ans,"subject_id"=>$subject_id 
                                  );
                          
                          if($this->input->post("textbox[1]")!= NULL){
                            $question_array["ans_1"] = $this->input->post("textbox[1]");
                          } 
                          
                          if($this->input->post("textbox[2]")!= NULL){
                            $question_array["ans_2"] = $this->input->post("textbox[2]");
                          } 
                          
                          if($this->input->post("textbox[3]")!= NULL){
                            $question_array["ans_3"] = $this->input->post("textbox[3]");
                          } 
                          
                          if($this->input->post("textbox[4]")!= NULL){
                            $question_array["ans_4"] = $this->input->post("textbox[4]");
                          } 
                          
                          if($this->input->post("textbox[5]")!= NULL){
                            $question_array["ans_5"] = $this->input->post("textbox[5]");
                          } 
                          
                          if($this->input->post("textbox[6]")!= NULL){
                            $question_array["ans_6"] = $this->input->post("textbox[6]");
                          } 
                           
                            $this->load->model("common_model");
                            $this->common_model->data_insert("question",$question_array);
                            
                              
                            $this->session->set_flashdata("message", '<div class="alert alert-success alert-dismissible" role="alert">
                                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                  <strong>Success!</strong> Exam Added Successfully
                                </div>');
                                redirect("question/manage_question/$subject_id");
                       
                }
            }
            
            $this->load->view("question/manage_question",$data);
            
        }
    }
    public function edit_question($ques_id){
        if(_is_user_login($this)){
            $data = array();
            $this->load->model("question_model");
            $questionid = $this->question_model->get_school_question_by_id($ques_id);
            $data["question"] = $questionid;
            
            if($_POST){
                $this->load->library('form_validation');
                
              $this->form_validation->set_rules('question', 'question', 'trim|required'); 
              $this->form_validation->set_rules('r_ans', 'Right Answer', 'trim|required');
                if ($this->form_validation->run() == FALSE) 
        		{
        		  
        			$data["error"] = '<div class="alert alert-warning alert-dismissible" role="alert">
                                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                  <strong>Warning!</strong> '.$this->form_validation->error_string().'
                                </div>';
                    
        		} else{
                        
                        $question = $this->input->post("question");
                           $r_ans = $this->input->post("r_ans");
                           /* $textbox_array = $this->input->post("textbox[]");*/
                           $question_array = array("question"=>$question,
                                  "	r_ans"=>$r_ans
                                  );
                          
                          if($this->input->post("ans_1")!= NULL){
                            $question_array["ans_1"] = $this->input->post("ans_1");
                          } 
                          
                          if($this->input->post("ans_2")!= NULL){
                            $question_array["ans_2"] = $this->input->post("ans_2");
                          } 
                          
                          if($this->input->post("ans_3")!= NULL){
                            $question_array["ans_3"] = $this->input->post("ans_3");
                          } 
                          
                          if($this->input->post("ans_4")!= NULL){
                            $question_array["ans_4"] = $this->input->post("ans_4");
                          } 
                          
                          if($this->input->post("ans_5")!= NULL){
                            $question_array["ans_5"] = $this->input->post("ans_5");
                          } 
                          
                          if($this->input->post("ans_6")!= NULL){
                            $question_array["ans_6"] = $this->input->post("ans_6");
                          } 
                       
                            $this->load->model("common_model");
                            $this->common_model->data_update("question",$question_array,array("ques_id"=>$ques_id)
                                );
                            $this->session->set_flashdata("message", '<div class="alert alert-success alert-dismissible" role="alert">
                                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                  <strong>Success!</strong> Event Update Successfully
                                </div>');
                                redirect("question/manage_question/".$questionid->subject_id);
                    
                }
            }
            
            
            $this->load->view("question/edit_question",$data);
        }
    }
    function delete_question($ques_id){
        $this->load->model("question_model");
            $questionid = $this->question_model->get_school_question_by_id($ques_id);
            if(!empty($questionid)){
                $this->db->query("Delete from question where ques_id = '".$ques_id."'");
                redirect("question/manage_question/".$questionid->subject_id);
            }
    }
   
 
  
}