<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Attendence extends CI_Controller {
    public function __construct()
    {
                parent::__construct();
                // Your own constructor code
                $this->load->database();
                $this->load->helper('login_helper');
    }
 
      function add_attendence(){
        if(_is_user_login($this)){
               if(isset($_REQUEST["saveattendence"])){
                $this->load->library('form_validation');
                
                
                $this->form_validation->set_rules('attendencedate', 'Attendence Date', 'trim|required');
                
                
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
                    $date = $this->input->post("attendencedate");
                    
                              foreach($_POST["student_id"] as $atten){
                                    
                                 $query = $this->db->insert_string("attendence", array("student_id"=>$atten, "standard_id"=>$standard_id, "school_id"=>$school_id,"attended"=>$_POST['attendence'.$atten], "attendence_date"=>$date, "attendence_reason"=>$_POST['note'.$atten])) . " ON DUPLICATE KEY UPDATE attended='".$_POST['attendence'.$atten]."', attendence_reason='".$_POST['note'.$atten]."'";
                                 $this->db->query($query);
                                
                                } 
                    
                     
                    $this->session->set_flashdata("message", '<div class="alert alert-success alert-dismissible" role="alert">
                                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                  <strong>Success!</strong> Student Attendence Added Successfully
                                </div>');  
                                
              }                 
                
            } 
       
             
              if(isset($_REQUEST["upload"])){
                $this->load->library('form_validation');
                
                
                 $this->form_validation->set_rules('standard', 'Select Standard', 'trim|required');
                $this->form_validation->set_rules('attendencedate', 'Attendence Date', 'trim|required');
                
                
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
                    $date = $this->input->post("attendencedate");
                    
                 if($_FILES["logfile"]["size"]>0)
            {
                $filepath = "uploads/excelfile/".$_FILES["logfile"]["name"];
               $res = move_uploaded_file($_FILES["logfile"]["tmp_name"],$filepath);
               if($res)
               {
                    ini_set('display_errors', TRUE);
                    ini_set('display_startup_errors', TRUE);
                    
                    define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
                    
                    date_default_timezone_set('Europe/London');
                    
                    /** Include PHPExcel_IOFactory */
                    //require_once  'libraries/PHPExcel/IOFactory.php';
                    $this->load->library('PHPExcel');
                    
                    if (!file_exists($filepath)) {
                        
                    	exit("Please run 05featuredemo.php first." . EOL);
                    }
                    try {
                        $inputFileType = PHPExcel_IOFactory::identify($filepath);
                        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                        $objPHPExcel = $objReader->load($filepath);
                    } catch(Exception $e) {
                        die('Error loading file "'.pathinfo($filepath,PATHINFO_BASENAME).'": '.$e->getMessage());
                    }
                    
                    //  Get worksheet dimensions
                    $sheet = $objPHPExcel->getSheet(0); 
                    $highestRow = $sheet->getHighestRow(); 
                    $highestColumn = $sheet->getHighestColumn();
                    
                    $sql_org = "Insert into attendence (student_id, attended, attendence_reason, standard_id, school_id, attendence_date) VALUES";
                    $sql = $sql_org;
                    //  Loop through each row of the worksheet in turn
                    for ($row = 2; $row <= $highestRow; $row++){ 
                        //  Read a row of data into an array
                        $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                                                        NULL,
                                                        TRUE,
                                                        FALSE);
                        //  Insert row data array into your database of choice here
                        
                        
                        $rows = $rowData[0];
                        
                       $this->db->select();
                       $this->db->from('attendence');
                       $this->db->where('student_id',$rows[0]);
                        $this->db->where('school_id',$school_id);
                        $this->db->where('standard_id',$standard_id);
                        $this->db->where('attendence_date',$date);
                       $q = $this->db->get();
                        $record_found =  $q->row();
                        
                        
                        if(!empty($record_found))
                        {
                            
                            $data = array(
                                   'attended' => $rows[1],
                                   'attendence_reason' => $rows[2]
                                );

                            $this->db->where('attendence_id', $record_found->attendence_id);
                            $this->db->update('attendence', $data); 

                            
                        }
                        else
                        {//ON DUPLICATE KEY UPDATE attended='".$row[1]."',attendence_reason='".$row[2]."'
                            $sql .=" ('".$rows[0]."','".$rows[1]."','".$rows[2]."','".$standard_id."','".$school_id."','".$date."') ";
                            if($row<$highestRow){
                                $sql .=",";     
                           }      
                        
                       }
                        
                     
                 // redirect('attendence/add_attendence'); 
                    }
                  if($sql!=$sql_org)
                    $this->db->query($sql); 
                  
                  $this->session->set_flashdata("message", '<div class="alert alert-success alert-dismissible" role="alert">
                                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                  <strong>Success!</strong> Student Attendence Added Successfully
                                </div>');  
                    
               }else
               {
                    $this->session->set_flashdata("message", '<div class="alert alert-warning alert-dismissible" role="alert">
                                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                  <strong>Warning!</strong> Could Not Upload File
                                </div>'); 
               }
         
        }      
                     
                    
                  }              
                              
                }
                
   if(isset($_REQUEST["download"])){
                $this->load->library('form_validation');
                
                
                 $this->form_validation->set_rules('standard', 'Select Standard', 'trim|required');
                $this->form_validation->set_rules('attendencedate', 'Attendence Date', 'trim|required');
                
                
                if ($this->form_validation->run() == FALSE) 
        		{
        		  
        			$data["error"] = '<div class="alert alert-warning alert-dismissible" role="alert">
                                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                  <strong>Warning!</strong> '.$this->form_validation->error_string().'
                                </div>';
                    
        		}
                else{
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
            ->setCellValue('A1', 'student_id')
            ->setCellValue('B1', 'attended')
            ->setCellValue('C1', 'attendence_reason');
                    $school_id = _get_current_user_id($this);
                    $standard = $this->input->post("standard");
                    $date = $this->input->post("attendencedate");     
                                                                     $this->db->select();
                                                                    $this->db->from('attendence');
                                                                    if(isset($standard) && $standard!="")
                                                                    $this->db->where('standard_id',$standard);
                                                                    if(isset($school_id) && $school_id!="")
                                                                    $this->db->where('school_id',$school_id);
                                                                    if(isset($date) && $date!="")
                                                                    $this->db->where('attendence_date',$date);
                                                                    
                                                                    $q = $this->db->get();
                                                                    
                                                                        $stud_item = $q->result();
                                                                       
                                                            $row_index = 2;
                                                            foreach($stud_item as $item){
                                                                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$row_index, $item->student_id)
                                                                ->setCellValue('B'.$row_index, $item->attended)
                                                                ->setCellValue('C'.$row_index, $item->attendence_reason);
                                                                
                                                                $row_index++;
                                                            }
                                                            

$objPHPExcel->setActiveSheetIndex(0)->getStyle('A1:C1')
    ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('A1:C1')->getFill()
    ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
    ->getStartColor()->setARGB('E5E5E5');
for($i = 1 ; $i <= $row_index ; $i++){
    for($j = 'A' ; $j <= 'C' ; $j++){

    
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
$objPHPExcel->getActiveSheet()->setTitle('Attendence Data');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Attendence Sheet.xlsx"');
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
                
                 /* get school standard */
           $this->load->model("standard_model");
           $data["school_standard"] = $this->standard_model->get_school_standard();
          
                $this->load->library('form_validation');
                
                $this->form_validation->set_rules('standard', 'Select Standard', 'trim|required');
                $this->form_validation->set_rules('attendencedate', 'Attendence Date', 'trim|required');
                
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
                    $data["student"] = $this->student_model->get_school_standard_student_add_attendence($_REQUEST['standard']);
                      
                        $this->load->model("attendence_model");
                      $data["att_student"] = $this->attendence_model->get_school_standard_student_attendence($_REQUEST['standard'],$_REQUEST['attendencedate']);   
              
                }
                 $this->load->view("attendence/add_attendence",$data);
            }
             
           
                  
       
       
    }
 
  
 
       
}
?>