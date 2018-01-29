<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Controller 
    {

    var $CI;
    public function __construct($params = array())
    {
        $this->CI =& get_instance();

        $this->CI->load->helper('url');
        $this->CI->config->item('base_url');
        $this->CI->load->library('session','form_validation');
        $this->CI->load->database();

       
    }

     public function verifylogin($data)
    {

         
        if ($data) {
            $this->CI->form_validation->set_rules('username', 'username', 'trim|required');
            $this->CI->form_validation->set_rules('password', 'password', 'trim|required|callback_check_database');
            if ($this->CI->form_validation->run() == false) {
                $this->CI->load->view('login');
            } else {

                
                if ($this->checkSession()) {
                    $log = $this->CI->session->userdata['user_role'];
                    if($log==1){
                        redirect('admin/dashboard');
                    }else if($log==2){
                        redirect('doctor/dashboard');
                    }else if($log==3){
                        redirect('patient/dashboard');
                    }else{

                    }
                    
                }
            }
        }
    }

     public function checkSession()
    {
         $this->CI->session->userdata['user_role'];
        if (!empty($this->CI->session->userdata['user_role'])) {
            $log = $this->CI->session->userdata['user_role'];

            if (!empty($log)) {
                return true;
            } else {
                return false;
            }
        }
    }

   

   

}