<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin extends CI_Controller
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
                $this->load->view('admin/login', $msg);
            }
        } else {
            if (isset($msg) && !empty($msg)) {
                $data['msg'] = $msg;
            } else {
                $data['msg'] = '';
            }
            $this->load->view('admin/login', $data);
        }
    }

     public function add_doctor()
    {
         if ($this->checkSession()) {
            $data['body'] = 'add_doctor';
            $this->load_view($data);
        } else {
            $this->index();
        }
    }
    
    public function checkSession()
    {
        if (!empty($this->session->userdata['user_role'])) {
            $log = $this->session->userdata['user_role'];
            if (isset($log)) {
                return true;
            } else {
                return false;
            }
        }
    }
    
    public function last_executed_query()
    {
        echo $this->db->last_query();
        die;
    }
    
    public function print_array($data = NULL)
    {
        echo '<pre>';
        print_r($data);
        echo '</pre>';
    }
    
    
    public function verifylogin()
    {
        if ($this->input->post()) {
            $this->form_validation->set_rules('username', 'username', 'trim|required');
            $this->form_validation->set_rules('password', 'password', 'trim|required|callback_check_database');
            if ($this->form_validation->run() == false) {
                $this->load->view('login');
            } else {
               
                if ($this->checkSession()) {
                    //echo 'hi';
                    redirect('admin/dashboard');
                }
            }
        }
    }

   
    public function load_view($page_data)
    {
        $this->load->view('common/templates/default', $page_data);
    }
    
    public function dashboard()
    {
        if ($this->checkSession()) {
            $data['body'] = 'main_bar';
            $this->load_view($data);
        } else {
            $this->index();
        }
    }
    
    public function check_database($password)
    {
        $username = $this->input->post('username', TRUE);
        $where    = array(
            'username' => $username,
            'password' => md5($password),
            'is_active' => 1
        );
        $result   = $this->Common_model->getsingle('users', $where);
        if (!empty($result)) {
            $sess_array = array(
                'id' => $result->id,
                'username' => $result->username,
                'email' => $result->email,
                'user_role' => $result->user_role
            );
            $this->session->set_userdata($sess_array);
            return true;
        } else {
            $this->form_validation->set_message('check_database', 'Invalid Credentials ! Please try again with valid username and password');
            return false;
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
            $this->load_view($data);
        } else {
            if ($this->checkSession()) {
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
    public function logout()
    {
        $user_data = $this->session->all_userdata();
        foreach ($user_data as $key => $value) {
            if ($key != 'session_id' && $key != 'ip_address' && $key != 'user_agent' && $key != 'last_activity') {
                $this->session->unset_userdata($key);
            }
        }
        $this->session->sess_destroy();
        $msg = "You have been successfully logged out!";
        $this->index($msg);
    }
    
    public function get_port_data()
    {
        $val       = $this->input->get('val');
        $table     = $this->input->get('table');
        $port_data = $this->Common_model->get_matching_record($table, $val);
        echo json_encode($port_data);
    }
       

     public function insertDoctor()
    {
        
         if ($this->input->post())
          {
                  
                  $this->form_validation->set_rules('doctor_fname', 'doctor_fname', 'trim|required');
                  $this->form_validation->set_rules('doctor_lname', 'doctor_lname', 'trim|required');
                  $this->form_validation->set_rules('doctor_email', 'doctor_email', 'trim|required');
                  $this->form_validation->set_rules('doctor_lname', 'doctor_lname', 'trim|required');

                  $this->form_validation->set_rules('doctor_mobile_no', 'doctor_mobile_no', 'trim|required');
                  $this->form_validation->set_rules('doctor_password', 'doctor_password', 'trim|required');
                     if ($this->form_validation->run() == false) 
                     {
                         $data['body'] = 'add_doctor';
                         $this->load->view('common/templates/default', $data);

                        //echo "hello";
                     } else {
                       
                        if ($this->checkSession())
                                {
                         $data=$this->input->post();
                         $data['doctor_user_id']= $this->session->userdata['user_role'];
                        
                        unset($data['submit']);
                        $config['upload_path'] = 'uploads/';
                        $config['allowed_types'] = 'jpg|jpeg|png|gif';
                        $config['file_name'] = $_FILES['doctor_image']['name'];
                       
                        //Load upload library and initialize configuration
                        $this->load->library('upload',$config);
                        $this->upload->initialize($config);
                        
                        if($this->upload->do_upload('doctor_image')){
                              $data['doctor_image']=$config['upload_path'].$config['file_name'];
                        }

                        $insert_id=$this->Common_model->insertData('doctor',$data);
                        if($insert_id){
                            $this->session->set_flashdata("info_message","Doctor Added Successfully..");
                            redirect("admin/add_doctor");
                                      }

                                 }
                         }

       }
   
    }

    public function get_doctor(){

        $data['doctorList'] =$this->Common_model->GetJoinRecord('doctor','doctor_user_id','user_role','role_id');

        $data['body'] = 'list_doctor';
        $this->load->view('common/templates/default', $data);

    }

    public function edit_doctor(){

        $id=$this->uri->segment(3);
        $data['doctor']=json_encode($this->Common_model->getsingle('doctor',$where="doctor_id=$id"));
        $data['body'] = 'edit_doctor';
        $this->load->view('common/templates/default', $data);

    }

    public function updateDoctor(){
            if ($this->input->post())
          {
                   $data=$this->input->post();

                  $this->form_validation->set_rules('doctor_fname', 'doctor_fname', 'trim|required');
                  $this->form_validation->set_rules('doctor_lname', 'doctor_lname', 'trim|required');
                  $this->form_validation->set_rules('doctor_email', 'doctor_email', 'trim|required');
                  $this->form_validation->set_rules('doctor_lname', 'doctor_lname', 'trim|required');

                  $this->form_validation->set_rules('doctor_mobile_no', 'doctor_mobile_no', 'trim|required');
                  
                     if ($this->form_validation->run() == false) 
                     {
                         $id=$data['doctor_id'];

                         $data['doctor']=json_encode($this->Common_model->getsingle('doctor',$where="doctor_id=$id"));
                         $data['body'] = 'edit_doctor';
                         $this->load->view('common/templates/default', $data);

                       
                     } else {
                       
                        if ($this->checkSession())
                                {
                        

                         $data['doctor_user_id']= $this->session->userdata['user_role'];
                         $doctor_id=$data['doctor_id'];
                         unset($data['doctor_id']);
                         unset($data['submit']);
                        
                        $config['upload_path'] = 'uploads/';
                        $config['allowed_types'] = 'jpg|jpeg|png|gif';
                        $config['file_name'] = $_FILES['doctor_image']['name'];

                        if($config['file_name']==''){

                            $data['doctor_image']=$data['old_doctor_image'];
                            unset($data['old_doctor_image']);
                        }else{
                        //Load upload library and initialize configuration
                        $this->load->library('upload',$config);
                        $this->upload->initialize($config);
                            
                        if($this->upload->do_upload('doctor_image')){
                              $data['doctor_image']=$config['upload_path'].$config['file_name'];
                              

                              unlink($data['old_doctor_image']);
                              unset($data['old_doctor_image']);
                        }

                        }
                         
                        
                        
                        $insert_id=$this->Common_model->updateFields('doctor',$data,$where="doctor_id=$doctor_id");
                        if($insert_id){
                            $this->session->set_flashdata("info_message","Doctor updated Successfully..");
                            redirect("admin/get_doctor");
                                     }

                                 }
                         }

       }
    }

    public function updateStatus()
    {
       $doctor_id=  $this->input->post('id');
       $status =$this->input->post('status');
       if($status==0){
        $data['doctor_status']=1;
       }else{
        $data['doctor_status']=0;
       }
       return $insert_id=$this->Common_model->updateFields('doctor',$data,$where="doctor_id=$doctor_id");
    }
}