<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Patient extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }
    
    public function index($msg = NULL)
    {
        if (!empty($this->session->userdata['user_role'])) {
            $log = $this->session->userdata['user_role'];
            if (isset($log) && $log == 1) {
                $this->dashboard();
            } else {
                $data['user_role'] = $this->Common_model->getAllwhere('user_role');
                $data['msg']    = $msg;
                $this->load->view('admin/login', $data);
            }
        } else {
            if (isset($msg) && !empty($msg)) {
                $data['msg'] = $msg;
            } else {
                $data['msg'] = '';
            }
            $data['user_role'] = $this->Common_model->getAllwhere('user_role');
            $data['msg']    = $msg;
            $this->load->view('admin/login', $data);
        }
    }
    
    public function dashboard()
    {
        if ($this->controller->checkSession()) {
            $data['body'] = 'main_bar';
            $this->controller->load_view($data);
        } else {
            $this->index();
        }
    }
    
    public function change_password()
    {
        $this->form_validation->set_rules('old_password', 'Old Password', 'trim|required|callback_oldpass_check');
        $this->form_validation->set_rules('new_password', 'New Password', 'trim|required|md5');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|matches[new_password]|md5');
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('errors', validation_errors());
            $data['body'] = 'changepassword';
            $this->controller->load_view($data);
        } else {
            if ($this->controller->checkSession()) {
                $data   = array(
                    'password' => $this->input->post('new_password', TRUE)
                );
                $where  = array(
                    'id' => 1
                );
                $table  = 'admins';
                $result = $this->Common_model->updateFields($table, $data, $where);
                redirect('admin/change_password', 'refresh');
            }
        }
    }
    public function oldpass_check($oldpass)
    {
        $user_id = $this->session->userdata('id');
        $result  = $this->Common_model->check_oldpassword($oldpass, $user_id);
        if ($result == 0) {
            $this->form_validation->set_message('oldpass_check', "%s does not match.");
            return FALSE;
        } else {
            $this->session->set_flashdata('success_msg', 'Password successfully updated!!!');
            return TRUE;
        }
    }
   

       

}