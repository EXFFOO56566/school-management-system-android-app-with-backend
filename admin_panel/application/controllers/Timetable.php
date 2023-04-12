<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Timetable extends CI_Controller {
    public function __construct()
    {
                parent::__construct();
                // Your own constructor code
                $this->load->database();
                $this->load->helper('login_helper');
    }
 
    public function manage_timetable(){
        if(_is_user_login($this)){
             $data["error"] = "";
             $this->load->model("timetable_model");
             $data["days_name"]=$this->timetable_model->get_days();
            $data["day"] =$this->timetable_model->get_day_by_id();
            
          $this->load->model("standard_model");
          $data["school_standard"] = $this->standard_model->get_school_standard();
          $data["teacher"] = $this->timetable_model->get_teacher();
            if($_POST){
                $this->load->library('form_validation');
                
              $this->form_validation->set_rules('standard', 'Standard', 'trim|required');
              $this->form_validation->set_rules('day', 'Day Name', 'trim|required');
              $this->form_validation->set_rules('teacher', 'Teacher', 'trim|required');
              $this->form_validation->set_rules('subject', 'Subject', 'trim|required');
              $this->form_validation->set_rules('start_time', 'Start Time', 'trim|required');
               $this->form_validation->set_rules('end_time', 'End Time', 'trim|required');
                if ($this->form_validation->run() == FALSE) 
        		{
        		  
        			$data["error"] = '<div class="alert alert-warning alert-dismissible" role="alert">
                                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                  <strong>Warning!</strong> '.$this->form_validation->error_string().'
                                </div>';
                    
        		}else
                {
                    /* $q = $this->db->query("Select timetable.* from `timetable` where ((`standard`='".$this->input->post("standard")."' and start_time ='".$this->input->post("start_time")."' > `standard`='".$this->input->post("standard")."' and start_time ='".$this->input->post("start_time")."' ) 
                                                                                    And (`standard`='".$this->input->post("standard")."' and day_id ='".$this->input->post("day")."')");
                   $result = $q->result();*/  
                     
                    
                           $standard = $this->input->post("standard");
                           $day = $this->input->post("day");
                           $teacher = $this->input->post("teacher");
                           $subject = $this->input->post("subject");
                           $start_time = $this->input->post("start_time");
                           $end_time = $this->input->post("end_time"); 
                            $this->load->model("common_model");
                            $this->common_model->data_insert("timetable",
                            array("standard_id"=>$standard,  
                                  "day_id"=>$day,
                                  "teacher_id"=>$teacher,
                                  "school_id"=>_get_current_user_id($this),
                                  "subject"=>$subject,
                                  "start_time"=>$start_time,
                                  "end_time"=>$end_time 
                                  ));
                            $this->session->set_flashdata("message", '<div class="alert alert-success alert-dismissible" role="alert">
                                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                  <strong>Success!</strong> Exam Added Successfully
                                </div>');
                                redirect("timetable/manage_timetable");
                       
                }
            }
            
            $this->load->view("timetable/manage_timetable",$data);
        }
    }
    public function edit_timetable($id){
        if(_is_user_login($this)){
            $data = array();
            $this->load->model("timetable_model");
            $timetable = $this->timetable_model->get_timetable_by_id($id);
            $data["timetable"] = $timetable;
            $data["days_name"]=$this->timetable_model->get_days();
            $this->load->model("standard_model");
          $data["school_standard"] = $this->standard_model->get_school_standard();
          $data["teacher"] = $this->timetable_model->get_teacher();
            if($_POST){
                $this->load->library('form_validation');
                
            $this->form_validation->set_rules('standard', 'Standard', 'trim|required');
              $this->form_validation->set_rules('day', 'Day Name', 'trim|required');
              $this->form_validation->set_rules('teacher', 'Teacher', 'trim|required');
              $this->form_validation->set_rules('subject', 'Subject', 'trim|required');
              $this->form_validation->set_rules('start_time', 'Start Time', 'trim|required');
               $this->form_validation->set_rules('end_time', 'End Time', 'trim|required');
              
                if ($this->form_validation->run() == FALSE) 
        		{
        		  
        			$data["error"] = '<div class="alert alert-warning alert-dismissible" role="alert">
                                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                  <strong>Warning!</strong> '.$this->form_validation->error_string().'
                                </div>';
                    
        		} else{
                        $this->session->set_flashdata("message", '<div class="alert alert-success alert-dismissible" role="alert">
                                          <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                          <strong>Warning!</strong> Timetable Already Exist.Please Enter Another Name
                                        </div>');
                       
                      
                        
                         $standard = $this->input->post("standard");
                           $day = $this->input->post("day");
                           $teacher = $this->input->post("teacher");
                           $subject = $this->input->post("subject");
                           $start_time = $this->input->post("start_time");
                           $end_time = $this->input->post("end_time"); 
                           
                
                        $update_array = array("standard_id"=>$standard, 
                                                "day_id"=>$day,
                                                "teacher_id"=>$teacher,
                                                "subject"=>$subject,
                                                "start_time"=>$start_time,
                                                "end_time"=>$end_time);
                        
                            $this->load->model("common_model");
                            $this->common_model->data_update("timetable",$update_array,array("id"=>$id)
                                );
                            $this->session->set_flashdata("message", '<div class="alert alert-success alert-dismissible" role="alert">
                                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                  <strong>Success!</strong> Timetable Update Successfully
                                </div>');
                                redirect("timetable/manage_timetable");
                    
                }
            }
            
            
            $this->load->view("timetable/edit_timetable",$data);
        }
    }
    function delete_timetable($id){
                $this->db->query("Delete from timetable where id = '".$id."'");
                redirect("timetable/manage_timetable");
    
    }
   
 
  
}

?>