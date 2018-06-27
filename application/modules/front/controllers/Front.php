<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Front extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    public function index($msg = NULL)
    {
        $data['body']       = 'main_bar';
        $where              = array(
            'is_active' => 1
        );
        $data['speciality'] = $this->model->getAllwhere('speciality', $where, 'all');
        $this->controller->load_view($data);
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
        $data = $this->input->post();
        if ($data) {
            $this->form_validation->set_rules('login_username', 'Username', 'trim|required');
            $this->form_validation->set_rules('login_password', 'Password', 'trim|required|callback_check_database');
            if ($this->form_validation->run() == false) {
                redirect('front/index');
            } else {
                if ($this->checkSession()) {
                    $log = $this->session->userdata['user_role'];
                    if ($log == 1 || $log == 4) {
                        redirect('admin/dashboard');
                    } else if ($log == 2) {
                        redirect('doctor/dashboard');
                    } else if ($log == 3) {
                        redirect('patient/dashboard');
                    } else {
                        
                    }
                }
            }
        }
    }

    public function checkSession()
    {
        if (!empty($this->session->userdata('user_role'))) {
            $log = $this->session->userdata('user_role');
            if (!empty($log)) {
                return true;
            } else {
                return false;
            }
        }
    }
    
    public function check_database($password)
    {
        $username = $this->input->post('login_username', TRUE);
        $where    = array(
            'username' => $username,
            'password' => md5($password),
            'is_active' => 1
        );
        $result   = $this->model->getsingle('users', $where);
        if (!empty($result)) {
            $sess_array = array(
                'id' => $result->id,
                'username' => $result->username,
                'email' => $result->email,
                'user_role' => $result->user_role,
                'first_name' => $result->first_name,
                'last_name' => $result->last_name,
                'hospital_id' => $result->hospital_id
            );
            if ($result->user_role == 1 || $result->user_role == 3) {
                unset($sess_array['hospital_id']);
            }
            if ($result->user_role == 4) {
                $where                = array(
                    'user_id' => $result->id
                );
                $sess_array['rights'] = $this->model->getsingle('user_rights', $where);
            }
            
            $this->session->set_userdata($sess_array);
            return true;
        } else {
            $this->form_validation->set_message('check_database', 'Invalid Credentials ! Please try again with valid username and password');
            return false;
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
            $this->session->set_flashdata('success_msg', 'Password Successfully Updated!!!');
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
        $msg = "You have been logged out Successfully...";
        $this->index($msg);
    }
    
    public function alpha_dash_space($str)
    {
        if (!preg_match("/^([-a-z_ ])+$/i", $str)) {
            $this->form_validation->set_message('check_captcha', 'Only Aplphabates allowed in this field');
        } else {
            return true;
        }
    }
    
    
    public function check_password()
    {
        $old_password = $this->input->post('data');
        $where        = array(
            'id' => $this->session->userdata('id'),
            'password' => md5($old_password)
        );
        $result       = $this->model->getsingle('users', $where);
        if (!empty($result)) {
            echo '0';
        } else {
            echo '1';
        }
    }
    
    
    public function add_user()
    {
        $this->form_validation->set_rules('signup_first_name', 'First Name', 'trim|required|callback_alpha_dash_space|min_length[2]');
        $this->form_validation->set_rules('signup_last_name', 'Last Name', 'trim|required|callback_alpha_dash_space|min_length[2]');
        $this->form_validation->set_rules('signup_dob', 'Date Of Birth', 'trim|required');
        $this->form_validation->set_rules('signup_username', 'User Name', 'trim|required|is_unique[users.username]');
        $this->form_validation->set_rules('signup_email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('signup_password', 'Password', 'trim|required|min_length[6]|alpha_numeric');
        $this->form_validation->set_rules('signup_sex', 'Gender', 'trim|required');
        $this->form_validation->set_rules('signup_type', 'User Type', 'trim|required');
        $this->form_validation->set_rules('signup_contact', 'Contact', 'trim|required');
        $this->form_validation->set_rules('signup_address', 'Address', 'trim|required');
        
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('errors', validation_errors());
            $data['body'] = 'main_bar';
            $this->controller->load_view($data);
        } else {
            
            $first_name       = $this->input->post('signup_first_name');
            $last_name        = $this->input->post('signup_last_name');
            $dob              = $this->input->post('signup_dob');
            $username         = $this->input->post('signup_username');
            $email            = $this->input->post('signup_email');
            $password         = $this->input->post('signup_password');
            $confirm_password = $this->input->post('signup_confirm_password');
            $sex              = $this->input->post('signup_sex');
            $user_type        = $this->input->post('signup_type');
            $contact          = $this->input->post('signup_contact');
            $address          = $this->input->post('signup_address');
            
            if (!empty($_FILES)) {
                $file_name = $this->file_upload('image');
            } else {
                $file_name = '';
            }
            
            $data = array(
                'first_name' => $first_name,
                'last_name' => $last_name,
                'username' => $username,
                'email' => $email,
                'password' => MD5($password),
                'date_of_birth' => $dob,
                'gender' => $sex,
                'is_active' => 1,
                'user_role' => $user_type,
                'created_at' => date('Y-m-d H:i:s'),
                'profile_pic' => $file_name,
                'mobile' => $contact,
                'address' => $address
            );
            
            $result = $this->model->insertData('users', $data);
            if ($user_type == 2) {
                if (!empty($address)) {
                    $formattedAddr   = str_replace(' ', '+', $address);
                    $geocodeFromAddr = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address=' . $formattedAddr . '&sensor=false&key=AIzaSyCSZ2Wy8ghd5Zby2FlNwgzUXPYgg0xqVIA');
                    $output          = json_decode($geocodeFromAddr, true);
                    
                    if (!empty($output)) {
                        $latitude  = $output['results'][0]['geometry']['location']['lat'];
                        $longitude = $output['results'][0]['geometry']['location']['lng'];
                    } else {
                        $latitude  = NULL;
                        $longitude = NULL;
                    }
                }
                
                $data = array(
                    'doctor_id' => $result,
                    'is_active' => 1,
                    'latitude' => $latitude,
                    'longitude' => $longitude,
                    'created_at' => date('Y-m-d H:i:s')
                );
                $data = $this->model->insertData('doctor', $data);
            }
        }
        redirect('front/index');
    }
    
    
    public function search_doctor()
    {
        $city_name = $_COOKIE['user_location'];;
        $id        = $this->uri->segment(3);
        $where     = array('name' => $city_name);
        $city      = $this->model->getsingle('cities', $where);
        $field_val = 'doctor.consultancy_fees,doctor.experience,doctor.degree,users.first_name,users.last_name,users.profile_pic,users.address';
        if (!empty($city->id)) {
            $where   = array(
                'doctor.city' => $city->id,
                'doctor.specialization' => $id
            );
            $data['doctors'] = $this->model->GetJoinRecord('doctor', 'doctor_id', 'users', 'id', $field_val, $where);
            $data['body']    = 'search_doctor';
            $this->controller->load_view1($data);
            
        }
    }
}