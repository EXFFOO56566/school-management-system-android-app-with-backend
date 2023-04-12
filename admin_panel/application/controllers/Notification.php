<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification extends CI_Controller {
    public function __construct()
    {
                parent::__construct();
                // Your own constructor code
                $this->load->database();
                $this->load->helper('login_helper');
    }
 
    public function manage_notification(){
        if(_is_user_login($this)){
             $data["error"] = "";
            $this->load->model("notification_model");
            $data["notification"] = $this->notification_model->get_notification();
            
            $this->load->view("notification/manage_notification",$data);
        }
    }
     function delete_notification($noti_id){
                $this->db->query("Delete from notification where noti_id = '".$noti_id."'");
                redirect("notification/manage_notification");
    
    } 
  
}