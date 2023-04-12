<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Event extends CI_Controller {
    public function __construct()
    {
                parent::__construct();
                // Your own constructor code
                $this->load->database();
                $this->load->helper('login_helper');
    }
 
    public function manage_event(){
        if(_is_user_login($this)){
             $data["error"] = "";
            $this->load->model("event_model");
            $data["event"] = $this->event_model->get_school_event();
            
            if($_POST){
                $this->load->library('form_validation');
                
              $this->form_validation->set_rules('event_title', 'Event Title', 'trim|required');
              $this->form_validation->set_rules('event_description', 'Event Description', 'trim|required');
              $this->form_validation->set_rules('start_date', 'Event Start Date', 'trim|required');
              $this->form_validation->set_rules('end_date', 'Event End Date', 'trim|required');
             
                if ($this->form_validation->run() == FALSE) 
        		{
        		  
        			$data["error"] = '<div class="alert alert-warning alert-dismissible" role="alert">
                                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                  <strong>Warning!</strong> '.$this->form_validation->error_string().'
                                </div>';
                    
        		}else
                {
                    
                      $file_name="";
                        $config['upload_path'] = './uploads/eventphoto/';
                		$config['allowed_types'] = 'gif|jpg|png|jpeg';
                       $this->load->library('upload', $config);
                            
                 if($_FILES["event_photo"]["size"] > 0)
                		if ( ! $this->upload->do_upload('event_photo'))
                		{
                			$error = array('error' => $this->upload->display_errors());
                
                			$this->load->view('upload_form', $error);
                		}
                		else
                		{
                			$file_data = $this->upload->data();
                            $file_name = $file_data["file_name"];
                    
                		}
                           $event_title = $this->input->post("event_title");
                           $event_description = $this->input->post("event_description");
                           $start_date = $this->input->post("start_date");
                           $end_date = $this->input->post("end_date");
                           
                            $this->load->model("common_model");
                            $this->common_model->data_insert("event",
                            array("event_title"=>$event_title, "school_id"=>_get_current_user_id($this), 
                                  "event_description"=>$event_description,"event_start"=>$start_date,
                                   "event_image"=>$file_name,
                                  "event_end"=>$end_date,"event_status"=>"1"
                                  ));
                            $this->session->set_flashdata("message", '<div class="alert alert-success alert-dismissible" role="alert">
                                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                  <strong>Success!</strong> Event Added Successfully
                                </div>');
                                redirect("event/manage_event");
                       
                }
            }
            
            $this->load->view("event/manage_event",$data);
        }
    }
    public function edit_event($event_id){
        if(_is_user_login($this)){
            $data = array();
            $this->load->model("event_model");
            $eventid = $this->event_model->get_school_event_by_id($event_id);
            $data["event"] = $eventid;
            if($_POST){
                $this->load->library('form_validation');
                
              $this->form_validation->set_rules('event_title', 'Event Title', 'trim|required');
              $this->form_validation->set_rules('event_description', 'Event Description', 'trim|required');
              $this->form_validation->set_rules('start_date', 'Event Start Date', 'trim|required');
              $this->form_validation->set_rules('end_date', 'Event End Date', 'trim|required');
                if ($this->form_validation->run() == FALSE) 
        		{
        		  
        			$data["error"] = '<div class="alert alert-warning alert-dismissible" role="alert">
                                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                  <strong>Warning!</strong> '.$this->form_validation->error_string().'
                                </div>';
                    
        		} else{
                        
                         $file_name=$eventid->event_image;
                        $config['upload_path'] = './uploads/eventphoto/';
                		$config['allowed_types'] = 'gif|jpg|png|jpeg';
                       $this->load->library('upload', $config);
                            
                 if($_FILES["event_photo"]["size"] > 0)
                		if ( ! $this->upload->do_upload('event_photo'))
                		{
                			$error = array('error' => $this->upload->display_errors());
                
                			$this->load->view('upload_form', $error);
                		}
                		else
                		{
                			$file_data = $this->upload->data();
                            $file_name = $file_data["file_name"];
                    
                		}
                      
                        
                         $event_title = $this->input->post("event_title");
                           $event_description = $this->input->post("event_description");
                           $start_date = $this->input->post("start_date");
                           $end_date = $this->input->post("end_date");
                           
                
                        $update_array = array(
                                  "event_title"=>$event_title,"event_end"=>$end_date,"event_image"=>$file_name,
                                  "event_description"=>$event_description,"event_start"=>$start_date
                                  
                                );
                            $this->load->model("common_model");
                            $this->common_model->data_update("event",$update_array,array("event_id"=>$event_id)
                                );
                            $this->session->set_flashdata("message", '<div class="alert alert-success alert-dismissible" role="alert">
                                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                  <strong>Success!</strong> Event Update Successfully
                                </div>');
                                redirect("event/manage_event");
                    
                }
            }
            
            
            $this->load->view("event/edit_event",$data);
        }
    }
    function delete_event($event_id){
                $this->db->query("Delete from event where event_id = '".$event_id."'");
                redirect("event/manage_event");
    
    }
   
 
  
}