<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teacher extends CI_Controller {
    public function __construct()
    {
                parent::__construct();
                // Your own constructor code
                $this->load->database();
                $this->load->helper('login_helper');
    }
  
      function add_teacher(){
        if(_is_user_login($this)){
            
          $data["error"] = "";
            
           if(isset($_REQUEST["saveteacher"])){
                $this->load->library('form_validation');
                
                $this->form_validation->set_rules('teacher_name', 'Teacher Name', 'trim|required');
                $this->form_validation->set_rules('teacher_birthdate', 'Teacher Birthdate', 'trim|required');
                $this->form_validation->set_rules('teacher_education', 'Teacher Education', 'trim|required');
                $this->form_validation->set_rules('teacher_address', 'Teacher Address', 'trim|required');
                $this->form_validation->set_rules('teacher_phone', 'Teacher Phone', 'trim|required');
                $this->form_validation->set_rules('editor1', 'Teacher Detail', 'trim|required');
                
                if ($this->form_validation->run() == FALSE) 
        		{
        		  
        			$data["error"] = '<div class="alert alert-warning alert-dismissible" role="alert">
                                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                  <strong>Warning!</strong> '.$this->form_validation->error_string().'
                                </div>';
                    
        		}else
                {
                    
                      
                        
                        $file_name="";
                        $config['upload_path'] = './uploads/teacherphoto/';
                		$config['allowed_types'] = 'gif|jpg|png|jpeg';
                       $this->load->library('upload', $config);
                            
                 if($_FILES["teacher_photo"]["size"] > 0)
                		if ( ! $this->upload->do_upload('teacher_photo'))
                		{
                			$error = array('error' => $this->upload->display_errors());
                
                			$this->load->view('upload_form', $error);
                		}
                		else
                		{
                			$file_data = $this->upload->data();
                            $file_name = $file_data["file_name"];
                    
                		}               
                        
                            $this->load->model("common_model");
                            $this->common_model->data_insert("teacher_detail",
                             array(
                            "teacher_name"=>$this->input->post("teacher_name"),
                            "teacher_birthdate"=>$this->input->post("teacher_birthdate"),
                            "gender"=>$this->input->post("gender"),
                            "maritalstatus"=>$this->input->post("maritalstatus"),
                            "teacher_education"=>$this->input->post("teacher_education"),
                            "teacher_address"=>$this->input->post("teacher_address"),
                            "teacher_phone"=>$this->input->post("teacher_phone"),
                            "teacher_email"=>$this->input->post("teacher_email"),
                            "teacher_exp"=>$this->input->post("teacher_exp"),
                            "teacher_notes"=>$this->input->post("teacher_notes"),
                            "teacher_detail"=>$this->input->post("editor1"),
                            "teacher_image"=>$file_name,
                            "school_id"=>_get_current_user_id($this)
                            ));
                            $this->session->set_flashdata("message", '<div class="alert alert-success alert-dismissible" role="alert">
                                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                  <strong>Success!</strong> Teacher Data Added Successfully
                                </div>');
                                redirect("teacher/add_teacher");
                      
                }
            }
            
            
            $this->load->view("teacher/add_teacher",$data);
        }
    }
  public function edit_teacher($teacher_id){
        if(_is_user_login($this)){
            $data = array();
            $this->load->model("teacher_model");
            $teacherid = $this->teacher_model->get_school_teacher_by_id($teacher_id);
            $data["teacher"] = $teacherid;
           
            if($_POST){
                $this->load->library('form_validation');
                
                $this->form_validation->set_rules('teacher_name', 'Teacher Name', 'trim|required');
                $this->form_validation->set_rules('teacher_birthdate', 'Teacher Birthdate', 'trim|required');
                $this->form_validation->set_rules('teacher_education', 'Teacher Education', 'trim|required');
                $this->form_validation->set_rules('teacher_address', 'Teacher Address', 'trim|required');
                $this->form_validation->set_rules('teacher_phone', 'Teacher Phone', 'trim|required');
                $this->form_validation->set_rules('editor1', 'Teacher Detail', 'trim|required');
              
                if ($this->form_validation->run() == FALSE) 
        		{
        		  
        			$data["error"] = '<div class="alert alert-warning alert-dismissible" role="alert">
                                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                  <strong>Warning!</strong> '.$this->form_validation->error_string().'
                                </div>';
                    
        		} else{
        		  
                  
            		        $file_name=$teacherid->teacher_image;
                            $config['upload_path'] = './uploads/teacherphoto/';
                    		$config['allowed_types'] = 'gif|jpg|png|jpeg';
                           $this->load->library('upload', $config);
                                
                     if($_FILES["teacher_photo"]["size"] > 0)
                    		if ( ! $this->upload->do_upload('teacher_photo'))
                    		{
                    			$error = array('error' => $this->upload->display_errors());
                    
                    			$this->load->view('upload_form', $error);
                    		}
                    		else
                    		{
                    			$file_data = $this->upload->data();
                                $file_name = $file_data["file_name"];
                                
                    		//	$student_profile["student_photo"] = $file_name;
                    		}   
                         
                        $update_array = array(
                           "teacher_name"=>$this->input->post("teacher_name"),
                            "teacher_birthdate"=>$this->input->post("teacher_birthdate"),
                            "gender"=>$this->input->post("gender"),
                            "maritalstatus"=>$this->input->post("maritalstatus"),
                            "teacher_education"=>$this->input->post("teacher_education"),
                            "teacher_address"=>$this->input->post("teacher_address"),
                            "teacher_phone"=>$this->input->post("teacher_phone"),
                            "teacher_email"=>$this->input->post("teacher_email"),
                            "teacher_exp"=>$this->input->post("teacher_exp"),
                            "teacher_notes"=>$this->input->post("teacher_notes"),
                            "teacher_detail"=>$this->input->post("editor1"),
                            "teacher_image"=>$file_name
                            );
                            $this->load->model("common_model");
                            $this->common_model->data_update("teacher_detail",$update_array,array("teacher_id"=>$teacher_id)
                                );
                            $this->session->set_flashdata("message", '<div class="alert alert-success alert-dismissible" role="alert">
                                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                  <strong>Success!</strong> Teacher Update Successfully
                                </div>');
                                redirect("teacher/list_teacher");
                    
                }
            }
            
            
            $this->load->view("teacher/edit_teacher",$data);
        }
    }
    
 	public function list_teacher()
	{
		if(_is_user_login($this)){
		  
            $data = array();
            $this->load->model("teacher_model");
            $data["teacher"] = $this->teacher_model->get_school_teacher();
          
            $this->load->view("teacher/list_teacher",$data);
        }
    }
 
 
 public function teacher_detail($teacher_id){
        if(_is_user_login($this)){
            $data = array();
            $this->load->model("teacher_model");
             $data["teacher_detail"] = $this->teacher_model->get_school_teacher_detail($teacher_id);
           
            $this->load->view("teacher/teacher_detail",$data);
        }
    }
     function delete_teacher($teacher_id){
        $data = array();
            $this->load->model("teacher_model");
            $id  = $this->teacher_model->get_school_teacher_by_id($teacher_id);
           if($id){
                $this->db->query("Delete from teacher_detail where teacher_id = '".$id->teacher_id."'");
                
                // remove uploaded student image
                unlink("uploads/teacherphoto/".$id->teacher_image);
               
                redirect("teacher/list_teacher");
           }
    }
 
       
}
?>