<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Topstudent extends CI_Controller {
    public function __construct()
    {
                parent::__construct();
                // Your own constructor code
                $this->load->database();
                $this->load->helper('login_helper');
    }
 
      function add_topstudent(){
        if(_is_user_login($this)){
            
            
             if(isset($_REQUEST["savetop"])){
                $this->load->library('form_validation');
                
                
                $this->form_validation->set_rules('standard', 'Standard', 'trim|required');
                
                
                if ($this->form_validation->run() == FALSE) 
        		{
        		  
        			$data["error"] = '<div class="alert alert-warning alert-dismissible" role="alert">
                                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                  <strong>Warning!</strong> '.$this->form_validation->error_string().'
                                </div>';
                    
        		}
                else{
                   
                    
                    $school_id = _get_current_user_id($this);
                    $standard_id = $this->input->post("standard");
                   
                   /* delete first top 10 student and after add top 10 student */
                   if($standard_id!=""){
                   $this->db->query("Delete from top_student where standard_id = '".$standard_id."'");
                   }
                              foreach($_POST["student_id"] as $atten){
                               
                                $q = $this->db->query("select * from top_student where standard_id=".$this->input->post('standard')." AND student_rank='".$_POST['note'.$atten]."'");
                      $duplicate_check =  $q->row();
                      if(isset($duplicate_check)){
                        $this->session->set_flashdata("message", '<div class="alert alert-danger alert-dismissible" role="alert">
                                          <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                          <strong>Warning!</strong> Student Rank Already Exist With Selected Standard.Please Enter Another Rank.
                                        </div>');
                      }
                      else{     
                                 $query = $this->db->insert_string("top_student", array("student_id"=>$atten, "standard_id"=>$standard_id, "school_id"=>$school_id, "student_rank"=>$_POST['note'.$atten])) . " ON DUPLICATE KEY UPDATE student_rank='".$_POST['note'.$atten]."'";
                                 $this->db->query($query);
                                
                                 
                    
                     
                    $this->session->set_flashdata("message", '<div class="alert alert-success alert-dismissible" role="alert">
                                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                  <strong>Success!</strong> Student Rank Added Successfully
                                </div>');
                                }  
                }                
              }                 
                
            }
               
                 /* get school standard */
           $this->load->model("standard_model");
           $data["school_standard"] = $this->standard_model->get_school_standard();
          
                $this->load->library('form_validation');
                
                $this->form_validation->set_rules('standard', 'Select Standard', 'trim|required');
                
                if ($this->form_validation->run() == FALSE) 
        		{
        		  if($this->form_validation->error_string()!=""){
        		  
        			$data["error"] = '<div class="alert alert-warning alert-dismissible" role="alert">
                                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                  <strong>Warning!</strong> '.$this->form_validation->error_string().'
                                </div>';
                    }
        		}
                else{
                    
                    $this->load->model("student_model");
                    $data["student"] = $this->student_model->get_school_standard_student_add_rank($_REQUEST['standard']);
                     
                     $this->load->model("topstudent_model");
                      $data["att_student"] = $this->topstudent_model->get_school_standard_topstudent($_REQUEST['standard']);  
                       
                }
                 $this->load->view("topstudent/add_topstudent",$data);
          
    }
 
  }
 
  	public function list_top()
	{
		if(_is_user_login($this)){
		  
            $data = array();
            $this->load->model("topstudent_model");
            $data["topstudent"] = $this->topstudent_model->get_school_topstudent();
          
            $this->load->view("topstudent/list_top",$data);
        }
    }
    
      function delete_topstudent($student_id){
                $this->db->query("Delete from top_student where top_id = '".$student_id."'");
                redirect("topstudent/list_top");
        
    }
       
}
?>