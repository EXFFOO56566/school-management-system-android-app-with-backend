<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fee extends CI_Controller {
    public function __construct()
    {
                parent::__construct();
                // Your own constructor code
                $this->load->database();
                $this->load->helper('login_helper');
    }
 
    public function manage_feetypes(){
        if(_is_user_login($this)){
             $data["error"] = "";
              $this->load->model("standard_model");
          $data["school_standard"] = $this->standard_model->get_school_standard();
            $this->load->model("fee_model"); 
            $data["fee_type"]=$this->fee_model->get_fee_type();
            if($_POST){
                $this->load->library('form_validation');
                  $this->form_validation->set_rules('standard', 'Standard', 'trim|required');
              $this->form_validation->set_rules('fee_title', 'Fee Title', 'trim|required');
              $this->form_validation->set_rules('fee_year', 'Fee Year', 'trim|required');
              $this->form_validation->set_rules('fee_amount', 'Fee Amount', 'trim|required'); 
             
                if ($this->form_validation->run() == FALSE) 
        		{
        		  
        			$data["error"] = '<div class="alert alert-warning alert-dismissible" role="alert">
                                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                  <strong>Warning!</strong> '.$this->form_validation->error_string().'
                                </div>';
                    
        		} else
                {
                     $standard = $this->input->post("standard");
                            $id = $this->input->post('id');
                           $fee_title = $this->input->post("fee_title");
                           $fee_year = $this->input->post("fee_year");
                           $fee_amount = $this->input->post("fee_amount"); 
                            $this->load->model("common_model");
                            $this->common_model->data_insert("fee_types",
                            array( "standard_id"=>$standard,
                                  "title"=>$fee_title,  
                                  "year"=>$fee_year,
                                  "base_amount"=>$fee_amount,
                                  "school_id"=>_get_current_user_id($this)                                  
                                  ));
                            $this->session->set_flashdata("message", '<div class="alert alert-success alert-dismissible" role="alert">
                                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                  <strong>Success!</strong> Exam Added Successfully
                                </div>');
                                redirect("fee/manage_feetypes");
                       
                }
            }
            
            $this->load->view("fee/manage_feetypes",$data);
        }
    }
    public function edit_fee($id){
        if(_is_user_login($this)){
            $data = array();
             $this->load->model("standard_model");
          $data["school_standard"] = $this->standard_model->get_school_standard();
            $this->load->model("fee_model");
            $feeid = $this->fee_model->get_fee_types_by_id($id);
            $data["fee"] = $feeid;
            if($_POST){
                $this->load->library('form_validation');
                 $this->form_validation->set_rules('standard', 'Standard', 'trim|required');
             $this->form_validation->set_rules('fee_title', 'Fee Title', 'trim|required');
              $this->form_validation->set_rules('fee_year', 'Fee Year', 'trim|required');
              $this->form_validation->set_rules('fee_amount', 'Fee Amount', 'trim|required'); 
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
                           $fee_title = $this->input->post("fee_title");
                           $fee_year = $this->input->post("fee_year");
                           $fee_amount = $this->input->post("fee_amount");  
                
                           $update_array = array("standard_id"=>$standard, 
                                  "title"=>$fee_title,"year"=>$fee_year,"base_amount"=>$fee_amount 
                                  
                                );
                            $this->load->model("common_model");
                            $this->common_model->data_update("fee_types",$update_array,array("id"=>$id)
                                );
                            $this->session->set_flashdata("message", '<div class="alert alert-success alert-dismissible" role="alert">
                                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                  <strong>Success!</strong> Event Update Successfully
                                </div>');
                                redirect("fee/manage_feetypes");
                    
                }
            }
            
            
            $this->load->view("fee/edit_feetypes",$data);
        }
    }
    function delete_fee($id){
                $this->db->query("Delete from fee_types where id = '".$id."'");
                redirect("fee/manage_feetypes");
    
    }
    public function add_student_fees(){
        if(_is_user_login($this)){
            $data["error"] = "";
            $this->load->model("standard_model");
            $data["school_standard"] = $this->standard_model->get_school_standard();
            $this->load->model("fee_model"); 
            $data["fee_type"]=$this->fee_model->get_fee_type(); 
             $this->load->model("fee_model"); 
            $data["student_list"]=$this->fee_model->get_student_fees();
             
            if($_POST){
                $this->load->library('form_validation');
                  $this->form_validation->set_rules('standard', 'Standard', 'trim|required');
              $this->form_validation->set_rules('student_id', 'Student Id', 'trim|required');
              $this->form_validation->set_rules('fee_types', 'Fees', 'trim|required');
              $this->form_validation->set_rules('fee_amount', 'Fees Amount', 'trim|required'); 
              $this->form_validation->set_rules('pay_fee_amount', 'Pay Fees Amount', 'trim|required'); 
              $this->form_validation->set_rules('pay_date', 'Pay Date', 'trim|required'); 
             
                if ($this->form_validation->run() == FALSE) 
        		{
        		  
        			$data["error"] = '<div class="alert alert-warning alert-dismissible" role="alert">
                                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                  <strong>Warning!</strong> '.$this->form_validation->error_string().'
                                </div>';
                    
        		} else
                {
                        $standard = $this->input->post("standard");
                        $student_id = $this->input->post('student_id');
                           $fee_types = $this->input->post("fee_types");
                           $fee_year = $this->input->post("fee_year");
                           $fee_amount = $this->input->post("fee_amount"); 
                            $pay_fee_amount = $this->input->post("pay_fee_amount"); 
                             $pay_date = $this->input->post("pay_date"); 
                            $this->load->model("common_model");
                            $this->common_model->data_insert("student_fees",
                            array( "standard_id"=>$standard,
                                  "student_id"=>$student_id,  
                                  "fee_types"=>$fee_types,
                                  "fee_amount"=>$fee_amount,
                                   "pay_fee_amount"=>$pay_fee_amount,
                                    "pay_date"=>$pay_date,
                                  "school_id"=>_get_current_user_id($this)                                  
                                  ));
                            $this->session->set_flashdata("message", '<div class="alert alert-success alert-dismissible" role="alert">
                                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                  <strong>Success!</strong> Student Fees Added Successfully
                                </div>');
                                redirect("fee/add_student_fees");
                       
                }
            }
            
            $this->load->view("fee/manage_student_fees",$data);
        }
    }
    
    public function edit_student_fees($student_fees_id){
        if(_is_user_login($this)){
            $data = array();
            $this->load->model("fee_model"); 
            $student_fees_row =$this->fee_model->get_student_fees_id($student_fees_id); 
          //  print_r ($student_fees_row);
            $data["student_fee_row"] = $student_fees_row;
            $this->load->model("standard_model");
            $standards = $this->standard_model->get_school_standard();
            $data["school_standard"] = $standards;
            
            $students = $this->fee_model->get_student_by_standard($student_fees_row->standard_id); 
            $fees_type = $this->fee_model->get_fees_type_by_standard($student_fees_row->standard_id); 
            
            $data["students"] = $students;
            $data["fees_types"] = $fees_type;
            //print_r ($fees_type);
                
            if($_POST){
              $this->load->library('form_validation');
              $this->form_validation->set_rules('standard', 'Standard', 'trim|required');
              $this->form_validation->set_rules('student_id', 'Student Id', 'trim|required');
              $this->form_validation->set_rules('fee_types', 'Fees', 'trim|required');
              $this->form_validation->set_rules('fee_amount', 'Fee Amount', 'trim|required'); 
              $this->form_validation->set_rules('pay_fee_amount', 'Pay Fees Amount', 'trim|required');
              $this->form_validation->set_rules('pay_date', 'Pay Date', 'trim|required'); 
              
              
              
               
              
                if ($this->form_validation->run() == FALSE) 
        		{
        		  
        			$data["error"] = '<div class="alert alert-warning alert-dismissible" role="alert">
                                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                  <strong>Warning!</strong> '.$this->form_validation->error_string().'
                                </div>';
                    
        		} else{ 
                         
                           $standard = $this->input->post("standard");
                        $student_id = $this->input->post('student_id');
                           $fee_types = $this->input->post("fee_types");
                           $fee_year = $this->input->post("fee_year");
                           $fee_amount = $this->input->post("fee_amount"); 
                            $pay_fee_amount = $this->input->post("pay_fee_amount"); 
                             $pay_date = $this->input->post("pay_date"); 
                             $update_array = array( "standard_id"=>$standard,
                                  "student_id"=>$student_id,  
                                  "fee_types"=>$fee_types,
                                  "fee_amount"=>$fee_amount,
                                   "pay_fee_amount"=>$pay_fee_amount,
                                    "pay_date"=>$pay_date                                  
                                  );
                            $this->load->model("common_model");
                            $this->common_model->data_update("student_fees",$update_array,array("student_fees_id"=>$student_fees_id)
                                );
                            $this->session->set_flashdata("message", '<div class="alert alert-success alert-dismissible" role="alert">
                                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                  <strong>Success!</strong> Event Update Successfully
                                </div>');
                                redirect("fee/add_student_fees");
                    
                }
            }
            
            
            $this->load->view("fee/edit_student_fees",$data);
        }
    }
    public function delete_student_fees($student_fees_id){ 
                $this->db->query("Delete from student_fees where student_fees_id = '".$student_fees_id."' limit 1");
                redirect("fee/add_student_fees");
    
    }
    
    public function list_student_fees_by_student($student_id){
        	if(_is_user_login($this)){
           // $data = array(); 
           $this->load->model("fee_model");
          $data["student_fees"] = $this->fee_model->get_student_fees_list($student_id);
          
            $this->load->view("fee/view_student_fees",$data);
        }
    }
    
      
    public function student_json(){
            header('Content-type: text/json');
      
            $this->load->model("fee_model"); 
            $result = $this->fee_model->get_student_by_standard($this->input->post("standard_id")); 
            echo json_encode($result);
    }
 
    public function free_type_json(){
            header('Content-type: text/json');
      
            $this->load->model("fee_model"); 
            $result = $this->fee_model->get_fees_type_by_standard($this->input->post("fee_types")); 
            echo json_encode($result);
    }
    
     public function free_amount_json(){
            header('Content-type: text/json');
      
            $this->load->model("fee_model"); 
            $result = $this->fee_model->get_fees_remaining_amount($this->input->post("fee_amount"),$this->input->post("student_id")); 
            echo json_encode($result);
    }
}