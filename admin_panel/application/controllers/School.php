<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class School extends CI_Controller {
    public function __construct()
    {
                parent::__construct();
                // Your own constructor code
                $this->load->database();
                $this->load->helper('login_helper');
    }
    
    
      function dashboard(){
           if(_is_user_login($this))
        {
           $data["error"] = "";
             if($_POST){
                $this->load->library('form_validation');
                
                $this->form_validation->set_rules('noti_title', 'noti_title', 'trim|required');
                $this->form_validation->set_rules('noti_description', 'noti_description', 'trim|required');
                if ($this->form_validation->run() == FALSE) 
        		{
      		        if($this->form_validation->error_string()!="")
                    {
                        $this->session->set_flashdata("message", '<div class="alert alert-warning alert-dismissible" role="alert">
                            <i class="fa fa-warning"></i>
                            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <strong>Warning!</strong> '.$this->form_validation->error_string().'
                            </div>');
                    }
        		}else
                {
                        $message = array("noti_title"=>$this->input->post("noti_title"),
                        "noti_description"=>$this->input->post("noti_description"),"date"=>date("Y-m-d h:i:s"));
                         
                         $noti_image = "";
                         if(isset( $_FILES["noti_image"]) && $_FILES["noti_image"]["size"] > 0)
                         {
                            $config['upload_path']          = './uploads/notification/';
                            $config['allowed_types']        = 'gif|jpg|png|jpeg';
                            
                            if(!is_dir($config['upload_path']))
                            {
                                mkdir($config['upload_path']);
                            }
                            $this->load->library('upload', $config);
                            if ( ! $this->upload->do_upload('noti_image'))
                            {
                                $error = array('error' => $this->upload->display_errors());
                            }
                            else
                            {
                                $img_data = $this->upload->data();
                                $noti_image=$img_data['file_name'];
                                
                                 
                            }
                         }                      
                                 
                        $school_id = _get_current_user_id($this);   
                        $this->load->model("common_model");
                            $this->common_model->data_insert("notification",
                                array(
                                "noti_title"=>$this->input->post("noti_title"),
                                "noti_description"=>$this->input->post("noti_description"), 
                                "noti_image"=>$noti_image,
                                "school_id"=>$school_id,
                                "date"=>date("Y-m-d h:i:s")));
                         
                        $message = array("message" => $this->input->post("noti_description"),"title"=>$this->input->post("noti_title"),"image" =>$noti_image,'created_at'=>date('Y-m-d h:i:s')); 
                         
                        $this->load->helper("gcm_helper");
                        $gcm = new GCM();
                            $result = $gcm->send_topics("/topics/education_".$school_id,$message,"android");    
                   
                    $this->session->set_flashdata("message",'<div class="alert alert-success alert-dismissible" role="alert">
                                            <i class="fa fa-check"></i>
                                          <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                          <strong>Success!</strong> Your Attibute saved successfully...
                                        </div>');         
                }
                
            }
                 
                $this->load->view('school/dashboard',$data);
            
        }
    } 
    
    
      function profile(){
        if(_is_user_login($this)){
               
          $this->load->model("school_model");
          $data["schooldetail"] = $this->school_model->get_school_profile();
          
          $data["error"] = "";
            
           if(isset($_REQUEST["saveprofile"])){
                $this->load->library('form_validation');
                
                $this->form_validation->set_rules('school_name', 'School Name', 'trim|required');
                $this->form_validation->set_rules('school_address', 'School Address', 'trim|required');
                $this->form_validation->set_rules('school_person_name', 'School Person Name', 'trim|required');
                $this->form_validation->set_rules('school_city', 'City Name', 'trim|required');
                $this->form_validation->set_rules('school_phone1', 'School Phone1', 'trim|required');
                $this->form_validation->set_rules('school_email', 'School Email', 'trim|required');
                $this->form_validation->set_rules('school_facebook', 'School Facebook Page Link', 'trim|required');
                if ($this->form_validation->run() == FALSE) 
        		{
        		  
        			$data["error"] = '<div class="alert alert-warning alert-dismissible" role="alert">
                                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                  <strong>Warning!</strong> '.$this->form_validation->error_string().'
                                </div>';
                    
        		}else
                {
                        
                        $file_name="";
                        $config['upload_path'] = './uploads/profile/';
                		$config['allowed_types'] = 'gif|jpg|png|jpeg';
                       $this->load->library('upload', $config);
                        $school_profile = array(
                            "school_name"=>$this->input->post("school_name"),
                            "school_person_name"=>$this->input->post("school_person_name"),
                            "school_address"=>$this->input->post("school_address"),
                            "school_city"=>$this->input->post("school_city"),
                            "school_state"=>$this->input->post("school_state"),
                            "school_postal_code"=>$this->input->post("school_postal_code"),
                            "school_phone1"=>$this->input->post("school_phone1"),
                            "school_phone2"=>$this->input->post("school_phone2"),
                            "school_email"=>$this->input->post("school_email"),
                            "school_fax"=>$this->input->post("school_fax"),
                             "school_facebook"=>$this->input->post("school_facebook"),
                            "user_id"=>_get_current_user_id($this)
                            );
                            
                            $update_string= "school_name='".$this->input->post('school_name')."',
                                               school_person_name='".$this->input->post('school_person_name')."',
                                               school_address='".$this->input->post('school_address')."',
                                               school_city='".$this->input->post('school_city')."',
                                               school_state='".$this->input->post('school_state')."',
                                               school_postal_code='".$this->input->post('school_postal_code')."',
                                               school_phone1='".$this->input->post('school_phone1')."',
                                               school_phone2='".$this->input->post('school_phone2')."',
                                               school_email='".$this->input->post('school_email')."',
                                               school_fax='".$this->input->post('school_fax')."',
                                               school_facebook='".$this->input->post('school_facebook')."'";
                            
               if($_FILES["school_logo"]["size"] > 0)
                		if ( ! $this->upload->do_upload('school_logo'))
                		{
                			$error = array('error' => $this->upload->display_errors());
                
                			$this->load->view('upload_form', $error);
                		}
                		else
                		{
                			$file_data = $this->upload->data();
                            $file_name = $file_data["file_name"];
                            $update_string.=",school_logo='".$file_name."'";
                			$school_profile["school_logo"] = $file_name;
                		}               
            $query = $this->db->insert_string("school_detail", $school_profile)
                                               . " ON DUPLICATE KEY UPDATE $update_string ";
            
            $this->db->query($query);
            
                            $this->session->set_flashdata("message", '<div class="alert alert-success alert-dismissible" role="alert">
                                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                  <strong>Success!</strong> School Profile Update Successfully
                                </div>');
                                redirect("school/profile");
                        
                }
            }
            
            
            $this->load->view("school/profile",$data);
        }
    }
}
?>