<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Requestdemo extends CI_Controller {
    public function __construct()
    {
                parent::__construct();
                // Your own constructor code
                $this->load->database();
                $this->load->helper('login_helper');
    }
	public function index()
	{
		if(_is_user_login($this)){
            $data = array();
            $this->load->model("requestdemo_model");
            $data["demo"] = $this->requestdemo_model->get_demorequest();
            $this->load->view("demorequest/list",$data);
        }
    }
    
    function delete_demo($user_id){
         
                $this->db->query("Delete from demo_enquiry where demo_id = '".$user_id."'");
                redirect("requestdemo");
           
    }
 
  
}