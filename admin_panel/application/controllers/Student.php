<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends CI_Controller {
    public function __construct()
    {
                parent::__construct();
                // Your own constructor code
                $this->load->database();
                $this->load->helper('login_helper');
    }
  
      function add_student(){
        if(_is_user_login($this)){
               
          
          
          $this->load->model("standard_model");
          $data["school_standard"] = $this->standard_model->get_school_standard();
            
          $data["error"] = "";
            
           if(isset($_REQUEST["savestudent"])){
                $this->load->library('form_validation');
                
                $this->form_validation->set_rules('student_name', 'Student Name', 'trim|required');
                $this->form_validation->set_rules('student_birthdate', 'Student Birthdate', 'trim|required');
                $this->form_validation->set_rules('student_username', 'Student Login User Name', 'trim|required|is_unique[student_detail.student_user_name]');
                $this->form_validation->set_rules('student_roll_no', 'Student Roll No', 'trim|required');
                $this->form_validation->set_rules('student_password', 'Student Password', 'trim|required');
                $this->form_validation->set_rules('student_address', 'Student Address', 'trim|required');
                $this->form_validation->set_rules('student_city', 'Student City', 'trim|required');
                $this->form_validation->set_rules('student_phone', 'Student Phone', 'trim|required');
               
                if ($this->form_validation->run() == FALSE) 
        		{
        		  
        			$data["error"] = '<div class="alert alert-warning alert-dismissible" role="alert">
                                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                  <strong>Warning!</strong> '.$this->form_validation->error_string().'
                                </div>';
                    
        		}else
                {
                    
                      $q = $this->db->query("select * from student_detail where student_standard=".$this->input->post('student_standard')." AND student_roll_no='".$this->input->post('student_roll_no')."'");
                      $duplicate_check =  $q->row();
                      if(isset($duplicate_check)){
                        $this->session->set_flashdata("message", '<div class="alert alert-danger alert-dismissible" role="alert">
                                          <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                          <strong>Warning!</strong> Student Roll No Already Exist With Selected Standard.Please Enter Another Roll No.
                                        </div>');
                      }
                      else{
                        
                        $file_name="";
                        $config['upload_path'] = './uploads/studentphoto/';
                		$config['allowed_types'] = 'gif|jpg|png|jpeg';
                       $this->load->library('upload', $config);
                            
                 if($_FILES["student_photo"]["size"] > 0)
                		if ( ! $this->upload->do_upload('student_photo'))
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
                        
                            $this->load->model("common_model");
                            $this->common_model->data_insert("student_detail",
                             array(
                            "student_name"=>$this->input->post("student_name"),
                            "student_birthdate"=>$this->input->post("student_birthdate"),
                            "student_unique_no"=>$this->input->post("student_unique_no"),
                            "student_roll_no"=>$this->input->post("student_roll_no"),
                            "student_user_name"=>$this->input->post("student_username"),
                            "student_password"=>md5($this->input->post("student_password")),
                            "student_orgpassword"=>$this->input->post("student_password"),
                            "student_standard"=>$this->input->post("student_standard"),
                            "student_address"=>$this->input->post("student_address"),
                            "student_city"=>$this->input->post("student_city"),
                            "student_phone"=>$this->input->post("student_phone"),
                            "student_parent_phone"=>$this->input->post("student_parent_phone"),
                            "student_enr_no"=>$this->input->post("student_enr_no"),
                            "student_email"=>$this->input->post("student_email"),
                            "student_branch"=>$this->input->post("student_branch"),
                            "student_semester"=>$this->input->post("student_semester"),
                            "student_division"=>$this->input->post("student_division"),
                            "student_batch"=>$this->input->post("student_batch"),
                            "student_photo"=>$file_name,
                            "school_id"=>_get_current_user_id($this)
                            ));
                            $this->session->set_flashdata("message", '<div class="alert alert-success alert-dismissible" role="alert">
                                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                  <strong>Success!</strong> Student Data Added Successfully
                                </div>');
                                redirect("student/add_student");
                    }    
                }
            }
            
            
            $this->load->view("student/add_student",$data);
        }
    }
  public function edit_student($student_id){
        if(_is_user_login($this)){
            $data = array();
            
            if($_POST){
                $this->load->library('form_validation');
                
                $this->form_validation->set_rules('student_name', 'Student Name', 'trim|required');
                $this->form_validation->set_rules('student_birthdate', 'Student Birthdate', 'trim|required');
                $this->form_validation->set_rules('student_roll_no', 'Student Roll No', 'trim|required');
                $this->form_validation->set_rules('student_address', 'Student Address', 'trim|required');
                $this->form_validation->set_rules('student_city', 'Student City', 'trim|required');
                $this->form_validation->set_rules('student_phone', 'Student Phone', 'trim|required');
              
                if ($this->form_validation->run() == FALSE) 
        		{
        		  
        			$data["error"] = '<div class="alert alert-warning alert-dismissible" role="alert">
                                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                  <strong>Warning!</strong> '.$this->form_validation->error_string().'
                                </div>';
                    
        		} else{
        		  
                  
            		       
                             
                         
                        $update_array = array(
                            "student_name"=>$this->input->post("student_name"),
                            "student_birthdate"=>$this->input->post("student_birthdate"),
                            "student_roll_no"=>$this->input->post("student_roll_no"),
                            "student_standard"=>$this->input->post("student_standard"),
                            "student_address"=>$this->input->post("student_address"),
                            "student_city"=>$this->input->post("student_city"),
                            "student_phone"=>$this->input->post("student_phone"),
                            "student_parent_phone"=>$this->input->post("student_parent_phone"),
                            "student_enr_no"=>$this->input->post("student_enr_no"),
                            "student_email"=>$this->input->post("student_email"),
                            "student_branch"=>$this->input->post("student_branch"),
                            "student_semester"=>$this->input->post("student_semester"),
                            "student_division"=>$this->input->post("student_division"),
                            "student_batch"=>$this->input->post("student_batch")
                            
                            
                            );
                            
                           
                                
                     if($_FILES["student_photo"]["size"] > 0){
                         $config['upload_path'] = './uploads/studentphoto/';
                    		$config['allowed_types'] = 'gif|jpg|png|jpeg';
                           $this->load->library('upload', $config);
                    		if ( ! $this->upload->do_upload('student_photo'))
                    		{
                    			$error = array('error' => $this->upload->display_errors());
                    
                    			$this->load->view('upload_form', $error);
                    		}
                    		else
                    		{
                    			$file_data = $this->upload->data();
                                $file_name = $file_data["file_name"];
                                $update_array["student_photo"] = $file_name;
                    		//	$student_profile["student_photo"] = $file_name;
                    		}  
                           } 
                            $this->load->model("common_model");
                            $this->common_model->data_update("student_detail",$update_array,array("student_id"=>$student_id)
                                );
                            $this->session->set_flashdata("message", '<div class="alert alert-success alert-dismissible" role="alert">
                                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                  <strong>Success!</strong> Student Update Successfully
                                </div>');
                               // redirect("student/list_student");
                    
                }
            }
            
            $this->load->model("student_model");
            $studenttid = $this->student_model->get_school_student_by_id($student_id);
            $data["student"] = $studenttid;
            $this->load->model("standard_model");
           $data["school_standard"] = $this->standard_model->get_school_standard();
            $this->load->view("student/edit_student",$data);
        }
    }
    
 	public function list_student()
	{
		if(_is_user_login($this)){
           // $data = array();
            
          $filter = array();   
           if(isset($_GET['standard'])){
                $filter['student_standard'] = $_GET['standard'];
            }
            $this->load->model("student_model");
            $data["student"] = $this->student_model->get_school_student($filter);
            
            /* get school standard */
           $this->load->model("standard_model");
          $data["school_standard"] = $this->standard_model->get_school_standard();
          
            $this->load->view("student/list_student",$data);
        }
    }
    	public function student_excel_download()
	{
		if(_is_user_login($this)){
 
        
        // print_r($company);   

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');
 $this->load->library('PHPExcel');
if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');


// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("Fedenaa")
							 ->setLastModifiedBy("Fedenaa")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("School Student List")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Fedenaa");

//$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:G1');
  
// Add some data
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'ID')
            ->setCellValue('B1', 'Student Name')
            ->setCellValue('C1', 'Student Roll No')
            ->setCellValue('D1', 'Standard')
            ->setCellValue('E1', 'Birthdate')
            ->setCellValue('F1', 'Student Address')
            ->setCellValue('G1', 'Student City')
            ->setCellValue('H1', 'Student Mobile No')
            ->setCellValue('I1', 'Parent Mobile No');
 
                                                                    $q = $this->db->query("select student_detail.*, standard.standard_title from student_detail 
                                                                        inner join standard on standard.standard_id = student_detail.student_standard where student_detail.school_id="._get_current_user_id($this));
                                                                        $stud_item = $q->result();
                                                                       
                                                            $row_index = 2;
                                                            foreach($stud_item as $item){
                                                                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$row_index, $item->student_id)
                                                                ->setCellValue('B'.$row_index, $item->student_name)
                                                                ->setCellValue('C'.$row_index, $item->student_roll_no)
                                                                ->setCellValue('D'.$row_index, $item->standard_title)
                                                                ->setCellValue('E'.$row_index, $item->student_birthdate)
                                                                ->setCellValue('F'.$row_index, $item->student_address)
                                                                ->setCellValue('G'.$row_index, $item->student_city)
                                                                ->setCellValue('H'.$row_index, $item->student_phone)
                                                                ->setCellValue('I'.$row_index, $item->student_parent_phone);
                                                                
                                                                $row_index++;
                                                            }
                                                            

$objPHPExcel->setActiveSheetIndex(0)->getStyle('A1:I1')
    ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('A1:I1')->getFill()
    ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
    ->getStartColor()->setARGB('E5E5E5');
for($i = 1 ; $i <= $row_index ; $i++){
    for($j = 'A' ; $j <= 'I' ; $j++){

    
$objPHPExcel->getActiveSheet()->getStyle($j.$i)
    ->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$objPHPExcel->getActiveSheet()->getStyle($j.$i)
    ->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$objPHPExcel->getActiveSheet()->getStyle($j.$i)
    ->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$objPHPExcel->getActiveSheet()->getStyle($j.$i)
    ->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    
    }
}

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Student Data');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="StudentData.xlsx"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;

            
         
        }
    }
public function student_print(){
      if(_is_user_login($this)){
           
            $this->load->model("student_model");
            $data["student"] = $this->student_model->get_school_student();
           
            $this->load->view("student/student_print",$data);
        }
}
  public function change_status(){
        $table = $this->input->post("table");
        $id = $this->input->post("id");
        $on_off = $this->input->post("on_off");
        $id_field = $this->input->post("id_field");
        $status = $this->input->post("status");
        
        $this->db->update($table,array("$status"=>$on_off),array("$id_field"=>$id));
    } 
 public function student_detail($student_id){
        if(_is_user_login($this)){
            $data = array();
            $this->load->model("student_model");
             $data["student_detail"] = $this->student_model->get_school_student_detail($student_id);
             
             
            $this->load->model("growth_model");
             $data["student_growth"] = $this->growth_model->get_school_standard_student_growth($student_id);
          
            $this->load->view("student/student_detail",$data);
        }
    }
     function delete_student($student_id){
        $data = array();
            $this->load->model("student_model");
            $id  = $this->student_model->get_school_student_by_id($student_id);
           if($id){
                $this->db->query("Delete from student_detail where student_id = '".$id->student_id."'");
                
                // remove uploaded student image
                unlink("uploads/studentphoto/".$id->student_photo);
                
                $this->db->query("Delete from student_growth where student_id = '".$id->student_id."'");
                redirect("student/list_student");
           }
    }
 
       
}
?>