<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Holiday extends CI_Controller {
    public function __construct()
    {
                parent::__construct();
                // Your own constructor code
                $this->load->database();
                $this->load->helper('login_helper');
    }
 
    public function manage_holiday(){
        if(_is_user_login($this)){
              
            $data["error"] = "";
            if(isset($_REQUEST["addholiday"])){
                $this->load->library('form_validation');
                
              $this->form_validation->set_rules('holiday_title', 'Holiday Title', 'trim|required');
              $this->form_validation->set_rules('start_date', 'Holiday Date', 'trim|required');
              $date = $this->input->post('start_date');
             
                if ($this->form_validation->run() == FALSE) 
        		{
        		  
        			$data["error"] = '<div class="alert alert-warning alert-dismissible" role="alert">
                                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                  <strong>Warning!</strong> '.$this->form_validation->error_string().'
                                </div>';
                    
        		}
                
                else
                {
                    
                      $q = $this->db->query("select * from holiday where holiday_date='".$date."' and school_id='"._get_current_user_id($this)."'");
                      $duplicate_check =  $q->row();
                      
                      if(isset($duplicate_check)){
                        $this->session->set_flashdata("message", '<div class="alert alert-danger alert-dismissible" role="alert">
                                          <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                          <strong>Warning!</strong> Holiday Already Exist With Selected Date.Please Enter Another Date.
                                        </div>');
                      }
                else
                {
                           $holiday_title = $this->input->post("holiday_title");
                           $start_date = $this->input->post("start_date");
                           
                            $this->load->model("common_model");
                            $this->common_model->data_insert("holiday",
                            array("holiday_title"=>$holiday_title, "school_id"=>_get_current_user_id($this), 
                                  "holiday_date"=>$start_date
                                  ));
                            $this->session->set_flashdata("message", '<div class="alert alert-success alert-dismissible" role="alert">
                                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                  <strong>Success!</strong> Holiday Added Successfully
                                </div>');
                                redirect("holiday/manage_holiday");
                      }
                }
            }
            $this->load->model("holiday_model");
            $data["up_holiday"] = $this->holiday_model->get_school_upcomming_holiday();
            
            $data['holiday_json'] = $this->holiday_model->get_school_holiday_calender();
            
            $this->load->view("holiday/manage_holiday",$data);
        }
    }
 	public function list_holiday()
	{
		if(_is_user_login($this)){
            $data = array();
            $this->load->model("holiday_model");
            $data["holiday"] = $this->holiday_model->get_school_holiday();
            $this->load->view("holiday/list_holiday",$data);
        }
    }
    function delete_holiday($holiday_id){
                $this->db->query("Delete from holiday where holiday_id = '".$holiday_id."'");
                redirect("holiday/list_holiday");
    
    }
   
 function send_gcm()
 {
    $this->load->helper('gcm_helper');
                $gcm = new GCM();
                $registatoin_ids = array("cQHQZYUnEiY:APA91bGIyb3ZJOfpRcUowrfs6I4ChiPQ5mBPruZMQYOUiyM8b2WSVR-xBU92X79y_UrfLYVR4OmlreEZX-ZIJQAe4xA_9uL8AuxgrdQX-TGY0JCizlYVsFcLfRObOvIjDjLrLvb039Dv");
                $message = array("message" => 'Shreehari GCM Testing',"title"=>'Testing','created_at'=>date('Y-m-d G:i:s'));
              
              

                   $result = $gcm->send_notification($registatoin_ids, $message, $this->config->item("GOOGLE_API_KEY"));
                print_r($result);
 }
  
}