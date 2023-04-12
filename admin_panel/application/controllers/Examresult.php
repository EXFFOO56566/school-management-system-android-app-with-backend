<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Examresult extends CI_Controller {
    public function __construct()
    {
                parent::__construct();
                // Your own constructor code
                $this->load->database();
                $this->load->helper('login_helper');
    }
 
  function manage_result($exam_id,$student_id=0){
        if(_is_user_login($this)){
            $data = array();
            
           /* get standard exam list */
            $this->load->model("exam_model");
            $examid = $this->exam_model->get_school_exam_by_id_manage_result($exam_id);
            $data["exam"] = $examid;
            
           /* get student  */
            $this->load->model("student_model");
            $studenttid = $this->student_model->get_school_student_by_id($student_id);
            $data["studentdata"] = $studenttid;
            
            /* get standard student list */
            $standardid = $examid->exam_standard;
            $this->load->model("student_model");
            $data["student"] = $this->student_model->get_school_standard_student_manage_result($standardid);
            
             /* get student  result */
            $this->load->model("examresult_model");
           $data["studentmark"] = $this->examresult_model->get_student_exam_result($student_id,$exam_id);
            
            
            if(isset($_REQUEST["saveresult"])){
                $this->load->library('form_validation');
                
                $this->form_validation->set_rules('subject_name', 'Subject Name', 'trim|required');
                $this->form_validation->set_rules('mark_obtain', 'Mark Obtain', 'trim|required|numeric');
                $this->form_validation->set_rules('total_mark', 'Total Mark', 'trim|required|numeric');
                
                if ($this->form_validation->run() == FALSE) 
        		{
        		  
        			$data["error"] = '<div class="alert alert-warning alert-dismissible" role="alert">
                                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                  <strong>Warning!</strong> '.$this->form_validation->error_string().'
                                </div>';
                    
        		}else
                {
                        
                       
                        $data = array(
                            "exam_id"=>$this->input->post("exam_id"),
                            "student_id"=>$this->input->post("student_id"),
                            "subject"=>$this->input->post("subject_name"),
                            "mark_obtain"=>$this->input->post("mark_obtain"),
                            "total_mark"=>$this->input->post("total_mark")
                            
                            );
                    $this->load->model("common_model");
                    $this->common_model->data_insert("exam_result",$data);               
       
            
                            $this->session->set_flashdata("message", '<div class="alert alert-success alert-dismissible" role="alert">
                                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                  <strong>Success!</strong> Student Mark Added Successfully
                                </div>');
                                $currenturl = current_url();
                             redirect($currenturl);   
                        
                }
            }
            
             if(isset($_REQUEST["updatemark"])){
                $this->load->library('form_validation');
                
                $this->form_validation->set_rules('subject_name', 'Subject Name', 'trim|required');
                $this->form_validation->set_rules('mark_obtain', 'Mark Obtain', 'trim|required|numeric');
                $this->form_validation->set_rules('total_mark', 'Total Mark', 'trim|required|numeric');
                
                if ($this->form_validation->run() == FALSE) 
        		{
        		  
        			$data["error"] = '<div class="alert alert-warning alert-dismissible" role="alert">
                                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                  <strong>Warning!</strong> '.$this->form_validation->error_string().'
                                </div>';
                    
        		}else
                {
                        
                       
                        $data = array(
                             "subject"=>$this->input->post("subject_name"),
                            "mark_obtain"=>$this->input->post("mark_obtain"),
                            "total_mark"=>$this->input->post("total_mark")
                            
                            );
                      $this->load->model("common_model");
                            $this->common_model->data_update("exam_result",$data,array("exam_result_id"=>$this->input->post("result_id")));
            
                            $this->session->set_flashdata("message", '<div class="alert alert-success alert-dismissible" role="alert">
                                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                  <strong>Success!</strong> Student Mark Update Successfully
                                </div>');
                          
                             $currenturl = current_url();
                             redirect($currenturl);   
                        
                }
            }
            
            
            $this->load->view("examresult/manage_result",$data);
        }
    }
    
     function delete_examresult($result_id){
                
                $q = $this->db->query("select * from exam_result where exam_result_id = '".$result_id."'");
                $urldata = $q->row();
                $exam_id = $urldata->exam_id;
                $student_id = $urldata->student_id;
                $this->db->query("Delete from exam_result where exam_result_id = '".$result_id."'");
                redirect("examresult/manage_result/".$exam_id,$student_id);
    
    }
    
  
}
?>