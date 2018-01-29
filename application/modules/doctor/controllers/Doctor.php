<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Doctor extends CI_Controller
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
                $data['user_role'] = $this->model->getAllwhere('user_role');
                $data['msg']       = $msg;
                $this->load->view('admin/login', $data);
            }
        } else {
            if (isset($msg) && !empty($msg)) {
                $data['msg'] = $msg;
            } else {
                $data['msg'] = '';
            }
            $data['user_role'] = $this->model->getAllwhere('user_role');
            $data['msg']       = $msg;
            $this->load->view('admin/login', $data);
        }
    }
    
    public function add_doctor()
    {
        if ($this->controller->checkSession()) {
            $data['body'] = 'add_doctor';
            $this->controller->load_view($data);
        } else {
            $this->index();
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
            $data['body'] = 'change_password';
            $this->controller->load_view($data);
        } else {
            if ($this->controller->checkSession()) {
                $data   = array(
                    'password' => $this->input->post('new_password', TRUE)
                );
                $where  = array(
                    'id' => $this->session->userdata('id')
                );
                $table  = 'admins';
                $result = $this->model->updateFields($table, $data, $where);
                redirect('doctor/change_password', 'refresh');
            }
        }
    }
    public function oldpass_check($oldpass)
    {
        $user_id = $this->session->userdata('id');
        $result  = $this->model->check_oldpassword($oldpass, $user_id);
        if ($result == 0) {
            $this->form_validation->set_message('oldpass_check', "%s does not match.");
            return FALSE;
        } else {
            $this->session->set_flashdata('success_msg', 'Password successfully updated!!!');
            return TRUE;
        }
    }
    
    
    
    // public function insertDoctor()
    // {
        
    //     if ($this->input->post()) {
            
    //         $this->form_validation->set_rules('doctor_fname', 'doctor_fname', 'trim|required');
    //         $this->form_validation->set_rules('doctor_lname', 'doctor_lname', 'trim|required');
    //         $this->form_validation->set_rules('doctor_email', 'doctor_email', 'trim|required');
    //         $this->form_validation->set_rules('doctor_lname', 'doctor_lname', 'trim|required');
    //         $this->form_validation->set_rules('doctor_mobile_no', 'doctor_mobile_no', 'trim|required');
    //         $this->form_validation->set_rules('doctor_password', 'doctor_password', 'trim|required');
    //         if ($this->form_validation->run() == false) {
    //             $data['body'] = 'add_doctor';
    //             $this->load->view('common/templates/default', $data);
    //         } else {
                
    //             if ($this->controller->checkSession()) {
    //                 $data                   = $this->input->post();
    //                 $data['doctor_user_id'] = $this->session->userdata['user_role'];
                    
    //                 unset($data['submit']);
                    
    //                 $config['upload_path']   = 'uploads/';
    //                 $config['allowed_types'] = 'jpg|jpeg|png|gif';
    //                 $config['file_name']     = $_FILES['doctor_image']['name'];
                    
    //                 //Load upload library and initialize configuration
    //                 $this->load->library('upload', $config);
    //                 $this->upload->initialize($config);
                    
    //                 if ($this->upload->do_upload('doctor_image')) {
    //                     $data['doctor_image'] = $config['upload_path'] . $config['file_name'];
    //                 }
                    
    //                 $insert_id = $this->model->insertData('doctor', $data);
    //                 if ($insert_id) {
    //                     $this->session->set_flashdata("info_message", "Doctor Added Successfully..");
    //                     redirect("admin/add_doctor");
    //                 }
    //             }
    //         }
    //     }
    // }
    
    // public function get_doctor()
    // {
        
    //     $data['doctorList'] = $this->model->GetJoinRecord('doctor', 'doctor_user_id', 'user_role', 'role_id');
    //     $data['body']       = 'list_doctor';
    //     $this->load->view('common/templates/default', $data);
        
    // }
    
    // public function edit_doctor()
    // {
        
    //     $id             = $this->uri->segment(3);
    //     $data['doctor'] = json_encode($this->model->getsingle('doctor', $where = "doctor_id=$id"));
    //     $data['body']   = 'edit_doctor';
    //     $this->load->view('common/templates/default', $data);
        
    // }
    
    // public function updateDoctor()
    // {
    //     if ($this->input->post()) {
    //         $data = $this->input->post();
            
    //         $this->form_validation->set_rules('doctor_fname', 'doctor_fname', 'trim|required');
    //         $this->form_validation->set_rules('doctor_lname', 'doctor_lname', 'trim|required');
    //         $this->form_validation->set_rules('doctor_email', 'doctor_email', 'trim|required');
    //         $this->form_validation->set_rules('doctor_lname', 'doctor_lname', 'trim|required');
    //         $this->form_validation->set_rules('doctor_mobile_no', 'doctor_mobile_no', 'trim|required');
            
    //         if ($this->form_validation->run() == false) {
    //             $id             = $data['doctor_id'];
    //             $data['doctor'] = json_encode($this->model->getsingle('doctor', $where = "doctor_id=$id"));
    //             $data['body']   = 'edit_doctor';
    //             $this->load->view('common/templates/default', $data);
    //         } else {
    //             if ($this->controller->checkSession()) {
    //                 $data['doctor_user_id'] = $this->session->userdata['user_role'];
    //                 $doctor_id              = $data['doctor_id'];
    //                 unset($data['doctor_id']);
    //                 unset($data['submit']);
                    
    //                 $config['upload_path']   = 'uploads/';
    //                 $config['allowed_types'] = 'jpg|jpeg|png|gif';
    //                 $config['file_name']     = $_FILES['doctor_image']['name'];
                    
    //                 if ($config['file_name'] == '') {
                        
    //                     $data['doctor_image'] = $data['old_doctor_image'];
    //                     unset($data['old_doctor_image']);
    //                 } else {
    //                     //Load upload library and initialize configuration
    //                     $this->load->library('upload', $config);
    //                     $this->upload->initialize($config);
                        
    //                     if ($this->upload->do_upload('doctor_image')) {
    //                         $data['doctor_image'] = $config['upload_path'] . $config['file_name'];
                            
                            
    //                         unlink($data['old_doctor_image']);
    //                         unset($data['old_doctor_image']);
    //                     }
                        
    //                 }
                    
    //                 $insert_id = $this->model->updateFields('doctor', $data, $where = "doctor_id=$doctor_id");
    //                 if ($insert_id) {
    //                     $this->session->set_flashdata("info_message", "Doctor updated Successfully..");
    //                     redirect("admin/get_doctor");
    //                 }
                    
    //             }
    //         }
            
    //     }
    // }
    
    
    // public function user()
    // {
    //     $data['body'] = 'register';
    //     $this->controller->load_view($data);
        
    // }
    
    // public function updateStatus()
    // {
    //     $doctor_id = $this->input->post('id');
    //     $status    = $this->input->post('status');
    //     if ($status == 0) {
    //         $data['doctor_status'] = 1;
    //     } else {
    //         $data['doctor_status'] = 0;
    //     }
    //     return $insert_id = $this->model->updateFields('doctor', $data, $where = "doctor_id=$doctor_id");
    // }
    
    public function register($id = null)
    {
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|alpha|min_length[2]');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|alpha|min_length[2]');
        if (empty($id)) {
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|alpha_numeric');
        }
        
        $this->form_validation->set_rules('dob', 'Date Of Birth', 'trim|required');
        
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('errors', validation_errors());
            $data['body'] = 'register';
            $this->controller->load_view($data);
        } else {
            if ($this->controller->checkSession()) {
                $user_role   = '3';
                $first_name  = $this->input->post('first_name');
                $last_name   = $this->input->post('last_name');
                $email       = $this->input->post('email');
                $password    = $this->input->post('password');
                $address     = $this->input->post('address');
                $phone_no    = $this->input->post('phone_no');
                $mobile_no   = $this->input->post('mobile_no');
                $dob         = $this->input->post('dob');
                $gender      = $this->input->post('gender');
                $blood_group = $this->input->post('blood_group');
                $status      = $this->input->post('status');
                
                $data = array(
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'email' => $email,
                    'password' => MD5($password),
                    'address' => $address,
                    'phone_no' => $phone_no,
                    'mobile' => $mobile_no,
                    'date_of_birth' => $dob,
                    'gender' => $gender,
                    'blood_group' => $blood_group,
                    'is_active' => $status,
                    'user_role' => $user_role,
                    'created_at' => date('Y-m-d H:i:s')
                );
                
                
                if (isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])) {
                    $count = count($_FILES['image']['name']);
                    for ($i = 0; $i < $count; $i++) {
                        if ($_FILES['image']['error'][$i] == 0) {
                            if (move_uploaded_file($_FILES['image']['tmp_name'][$i], 'asset/uploads/' . $_FILES['image']['name'][$i])) {
                                
                                $data['profile_pic'] = $_FILES['image']['name'][$i];
                            }
                        }
                    }
                }
                if (!empty($id)) {
                    $where = array('id' => $id);
                    unset($data['created_at']);
                    unset($data['email']);
                    unset($data['password']);
                    $result = $this->model->updateFields('users', $data, $where);
                } else {
                    $result = $this->model->insertData('users', $data);
                }
                $this->users_list();
            }
        }
    }
    
    public function users_list()
    {
        $where  = array('user_role >'   => $this->session->userdata('user_role'));
        $where1 = array('role_id >'     => $this->session->userdata('user_role'));
        
        $data['users']     = $this->model->getAllwhere('users', $where);
        $data['user_role'] = $this->model->getAllwhere('user_role', $where1);
        
        $data['body'] = 'users_list';
        $this->controller->load_view($data);
    }
    
    public function edit_user($id)
    {
        $where  = array('id ' => $id);
        $where1 = array('role_id >' => $this->session->userdata('user_role'));
        
        $data['user_role'] = $this->model->getAllwhere('user_role', $where1);
        $data['users']     = $this->model->getAllwhere('users', $where);
        
        $data['body'] = 'edit_user';
        $this->controller->load_view($data);
    }
    
    public function delete()
    {
        $id    = $this->input->post('id');
        $where = array(
            'id' => $id
        );
        $this->model->delete('users', $where);
    }

    public function profile(){
        $where = array('id' => $this->session->userdata('id'));
        $data['users']      = $this->model->getAllwhere('users', $where);
        
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|alpha|min_length[2]');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|alpha|min_length[2]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('date_of_birth', 'Date Of Birth', 'trim|required');
        
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('errors', validation_errors());
            $data['body']       = 'profile';
            $this->controller->load_view($data);
        } else {
            if ($this->controller->checkSession()) {
                $user_role   = '3';
                $first_name  = $this->input->post('first_name');
                $last_name   = $this->input->post('last_name');
                $email       = $this->input->post('email');
                $address     = $this->input->post('address');
                $phone_no    = $this->input->post('phone');
                $mobile_no   = $this->input->post('mobile');
                $dob         = $this->input->post('date_of_birth');
                $gender      = $this->input->post('gender');
                $blood_group = $this->input->post('blood_group');
                
                $data = array(
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'email' => $email,
                    'address' => $address,
                    'phone_no' => $phone_no,
                    'mobile' => $mobile_no,
                    'date_of_birth' => $dob,
                    'gender' => $gender,
                    'blood_group' => $blood_group,
                );
                
                
                // if (isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])) {
                //     $count = count($_FILES['image']['name']);
                //     for ($i = 0; $i < $count; $i++) {
                //         if ($_FILES['image']['error'][$i] == 0) {
                //             if (move_uploaded_file($_FILES['image']['tmp_name'][$i], 'asset/uploads/' . $_FILES['image']['name'][$i])) {
                                
                //                 $data['profile_pic'] = $_FILES['image']['name'][$i];
                //             }
                //         }
                //     }
                // }

                $result = $this->model->updateFields('users', $data, $where);
               redirect('/doctor/profile', 'refresh');

            }
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

}