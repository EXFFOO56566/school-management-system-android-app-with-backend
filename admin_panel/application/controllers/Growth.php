<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Growth extends CI_Controller {
    public function __construct()
    {
                parent::__construct();
                // Your own constructor code
                $this->load->database();
                $this->load->helper('login_helper');
    }
 
  function manage_growth($student_id){
        if(_is_user_login($this)){
            $data = array();
            $this->load->model("student_model");
            $studentid = $this->student_model->get_school_student_by_id($student_id);
            $data["student"] = $studentid;
            if(isset($_REQUEST["savegrowth"])){
                $this->load->library('form_validation');
                
                //$this->form_validation->set_rules('growth_title', 'Growth Title', 'trim|required');
                $this->form_validation->set_rules('growth_per', 'Growth Percantage', 'trim|required|numeric');
                
                if ($this->form_validation->run() == FALSE) 
        		{
        		  
        			$data["error"] = '<div class="alert alert-warning alert-dismissible" role="alert">
                                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                  <strong>Warning!</strong> '.$this->form_validation->error_string().'
                                </div>';
                    
        		}else
                {
                        if($this->input->post('growth_per')<=25){
                           $growth_title = "Bad"; 
                        }
                        else if($this->input->post('growth_per')<=50){
                           $growth_title = "Medium"; 
                        }
                        else if($this->input->post('growth_per')<=75){
                           $growth_title = "Good"; 
                        }
                        else{
                           $growth_title = "Excellent"; 
                        }
                
                       
                        $data = array(
                            "growth"=>$growth_title,
                            "percentage"=>$this->input->post("growth_per"),
                            "student_id"=>$this->input->post("student_id"),
                            "standard_id"=>$this->input->post("standard_id"),
                            "month"=>$this->input->post("month") 
                            );
                            
                            $update_string= "growth='".$growth_title."',
                                             percentage='".$this->input->post('growth_per')."',
                                             standard_id='".$this->input->post('standard_id')."',
                                             month='".$this->input->post('month')."'";
                            
                             
            $query = $this->db->insert_string("student_growth", $data)
                                               . " ON DUPLICATE KEY UPDATE $update_string ";
            
            $this->db->query($query);
            
                            $this->session->set_flashdata("message", '<div class="alert alert-success alert-dismissible" role="alert">
                                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                  <strong>Success!</strong> Student Growth Update Successfully
                                </div>');
                               $current_url = current_url();
                                redirect($current_url);
                        
                }
            }
            
            
            $this->load->view("growth/manage_growth",$data);
        }
    }
    
 
  
}