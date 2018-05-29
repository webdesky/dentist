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
            if ($log == 1 || $log == 4) {
                redirect('admin/dashboard');
            } else if ($log == 2) {
                redirect('doctor/dashboard');
            } else if ($log == 3) {
                redirect('patient/dashboard');
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
        $this->controller->verifylogin($data);
    }
    public function dashboard()
    {
        if ($this->controller->checkSession()) {
            $user_role             = $this->session->userdata('user_role');
            $data['body']          = 'dashboard';
            $where                 = array(
                'is_active' => 1
            );
            $where4                = array(
                'sender_id' => $this->session->userdata('id')
            );
            $field_val             = 'message.*,users.first_name,users.last_name';
            $data['messages_list'] = $this->model->GetJoinRecord('message', 'reciever_id', 'users', 'id', $field_val, $where4);
            $field_val1            = 'cs.appointment_id,cs.appointment_type,cs.appointment_date,cs.appointment_time,us.first_name as doctor_name, u.first_name as patient_name';
            
            if ($user_role == 4) {
                $where                     = array(
                    'cs.hospital_id' => $this->session->userdata('hospital_id'),
                    'appointment_date >' => date('Y-m-d')
                );
                $data['appointmentList']   = $this->Common_model->get_Patient_Doctor_Record('appointment', $field_val1, $where);
                $data['total_users_count'] = $this->Common_model->get_user_count($where);
                $data['totalAppointment']  = $this->model->getcount('appointment', array(
                    'hospital_id' => $this->session->userdata('hospital_id'),
                    'appointment_date >' => date('Y-m-d')
                ));

            } else {
                $where5                    = array(
                    'appointment_date >' => date('Y-m-d')
                );
                $data['appointmentList']   = $this->Common_model->get_Patient_Doctor_Record('appointment', $field_val1, $where5);
                $data['totalHospital']     = $this->model->getcount('hospitals', $where);
                $data['total_users_count'] = $this->Common_model->get_user_count();
                $data['totalAppointment']  = $this->model->getcount('appointment', $where);
            }
            $this->controller->load_view($data);
        } else {
            redirect('admin/index');
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
    public function change_password()
    {
        if ($this->controller->checkSession()) {
            $this->form_validation->set_rules('old_password', 'Old Password', 'trim|required');
            $this->form_validation->set_rules('new_password', 'New Password', 'trim|required');
            $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required');
            if ($this->form_validation->run() == false) {
                $this->session->set_flashdata('errors', validation_errors());
                $data['body'] = 'change_password';
                $this->controller->load_view($data);
            } else {
                $data   = array(
                    'password' => md5($this->input->post('new_password', TRUE))
                );
                $where  = array(
                    'id' => $this->session->userdata('id')
                );
                $table  = 'users';
                $result = $this->model->updateFields($table, $data, $where);
                redirect('admin/change_password', 'refresh');
            }
        } else {
            redirect('admin/index');
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
    public function get_port_data()
    {
        $val       = $this->input->get('val');
        $table     = $this->input->get('table');
        $port_data = $this->model->get_matching_record($table, $val);
        echo json_encode($port_data);
    }
    
    public function alpha_dash_space($str)
    {
        if (!preg_match("/^([-a-z_ ])+$/i", $str)) {
            $this->form_validation->set_message('check_captcha', 'Only Aplphabates allowed in this field');
        } else {
            return true;
        }
    }
    
    public function add_doctor($id = null)
    {
        if ($this->controller->checkSession()) {
            $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|callback_alpha_dash_space|min_length[2]');
            $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|callback_alpha_dash_space|min_length[2]');
            $this->form_validation->set_rules('dob', 'Date Of Birth', 'trim|required');
            if (empty($id)) {
                $this->form_validation->set_rules('user_name', 'User Name', 'trim|required|is_unique[users.username]');
                $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
                $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|alpha_numeric');
                $this->form_validation->set_rules('specialization', 'Specialization', 'trim|required');
                $this->form_validation->set_rules('country', 'Country', 'trim|required');
                $this->form_validation->set_rules('state', 'State', 'trim|required');
                $this->form_validation->set_rules('city', 'City', 'trim|required');
                $this->form_validation->set_rules('phone_no', 'Phone No.', 'trim|required');
                
                if ($this->session->userdata('user_role') == 4) {
                    $this->form_validation->set_rules('hospital_id', 'Hospital', 'trim|required');
                } else {
                    $this->form_validation->set_rules('hospital_id[]', 'Hospital', 'trim|required');
                }

                $this->form_validation->set_rules('specialization', 'Specialization', 'trim|required');
            }
            
            if ($this->form_validation->run() == false) {

                $this->session->set_flashdata('errors', validation_errors());
                $where             = array(
                    'is_active' => 1
                );
                $data['countries'] = $this->model->getall('countries');
                $data['category']  = $this->model->getAllwhere('speciality', $where);
                $field_val         = 'id,hospital_name,other_speciality';
                $data['hospitals'] = $this->model->getAllwhere('hospitals', $where, $field_val);
                $data['body']      = 'add_doctor';
                $data['user_role'] = 2;
                $this->controller->load_view($data);
            } else {

                if (empty($id)) {
                    $user_role = $this->input->post('user_role');
                } else {
                    $user_role = 2;

                }

                $address = $this->input->post('address');
                
               
                    // $ip=$_SERVER['REMOTE_ADDR'];
                    // echo "<pre>";
                    // echo var_export(unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$ip)));
                    // die;
        
                if(!empty($address)){
                    //Formatted address
                    $formattedAddr = str_replace(' ','+',$address);
                    //Send request and receive json data by address
                    $geocodeFromAddr = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.$formattedAddr.'&sensor=false&key=AIzaSyCSZ2Wy8ghd5Zby2FlNwgzUXPYgg0xqVIA'); 
                    $output = json_decode($geocodeFromAddr,true);
                   
                    if(!empty($output)){
                    //Get latitude and longitute from json data
                    $latitude  = $output['results'][0]['geometry']['location']['lat']; 
                    $longitude = $output['results'][0]['geometry']['location']['lng'];
                    }else{
                        $latitude = NULL;
                        $longitude= NULL;
                    }
                    
                    //Return latitude and longitude of the given address
                }

                $first_name     = $this->input->post('first_name');
                $user_name      = $this->input->post('user_name');
                $last_name      = $this->input->post('last_name');
                $email          = $this->input->post('email');
                $password       = $this->input->post('password');
                $address        = $this->input->post('address');
                $phone_no       = $this->input->post('phone_no');
                $mobile_no      = $this->input->post('mobile_no');
                $dob            = $this->input->post('dob');
                $gender         = $this->input->post('gender');
                $blood_group    = $this->input->post('blood_group');
                $status         = $this->input->post('status');
                $specialization = $this->input->post('specialization');
                if (!empty($_FILES)) {
                    $file_name = $this->file_upload('image');
                } else {
                    $file_name = '';
                }
                
                $data = array(
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'username' => $user_name,
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
                    'created_at' => date('Y-m-d H:i:s'),
                    'profile_pic' => $file_name
                );

                if ($this->session->userdata('user_role') == 4) {
                    $data['hospital_id'] = $this->session->userdata('hospital_id');
                } else {
                    $hospital_id         = $this->input->post('hospital_id');
                    $data['hospital_id'] = implode(',', $hospital_id);
                }
                if (!empty($id)) {
                    $where = array(
                        'id' => $id
                    );
                    unset($data['created_at']);
                    unset($data['email']);
                    unset($data['password']);
                    $result = $this->model->updateFields('users', $data, $where);
                } else {

                    
                    $result = $this->model->insertData('users', $data);
                    if ($user_role == 2) {
                        $data = array(
                            'doctor_id'             => $result,
                            'city'                  => $this->input->post('city'),
                            'specialization'        => $specialization,
                            'is_active'             => $status,
                            'latitude'              => $latitude,
                            'longitude'             => $longitude,
                            'created_at'            => date('Y-m-d H:i:s')

                        );
                        $data = $this->model->insertData('doctor', $data);
                    }
                }
                redirect('admin/users_list/' . $user_role);
            }
        } else {
            redirect('admin/index');
        }
    }
    
    public function register($id = null)
    {
        if ($this->controller->checkSession()) {
            $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|callback_alpha_dash_space|min_length[2]');
            $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|callback_alpha_dash_space|min_length[2]');
            $this->form_validation->set_rules('dob', 'Date Of Birth', 'trim|required');
            if (empty($id)) {
                $this->form_validation->set_rules('user_name', 'User Name', 'trim|required|is_unique[users.username]');
                $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
                $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|alpha_numeric');
            }
            if ($this->form_validation->run() == false) {
                $this->session->set_flashdata('errors', validation_errors());
                $data['countries'] = $this->model->getall('countries');
                $data['body']      = 'register';
                $this->controller->load_view($data);
            } else {
                
                $first_name  = $this->input->post('first_name');
                $user_name   = $this->input->post('user_name');
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
                
                if (!empty($_FILES)) {
                    $file_name = $this->file_upload('image');
                } else {
                    $file_name = '';
                }
                
                $data = array(
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'username' => $user_name,
                    'email' => $email,
                    'password' => MD5($password),
                    'address' => $address,
                    'phone_no' => $phone_no,
                    'mobile' => $mobile_no,
                    'date_of_birth' => $dob,
                    'gender' => $gender,
                    'blood_group' => $blood_group,
                    'is_active' => $status,
                    'user_role' => 3,
                    'created_at' => date('Y-m-d H:i:s'),
                    'profile_pic' => $file_name
                );
                if ($this->session->userdata('user_role') == 4) {
                    $data['hospital_id'] = $this->session->userdata('hospital_id');
                }
                $result = $this->model->insertData('users', $data);
                redirect('admin/users_list/3');
                
            }
        } else {
            redirect('admin/index');
        }
    }
    public function users_list($user_role = null)
    {
        if ($this->controller->checkSession()) {
            $where             = array(
                'user_role' => $user_role
            );
            $where1            = array(
                'role_id' => $user_role
            );
            $data['role']      = $user_role;
            $data['category']  = $this->model->getAll('speciality');
            $data['user_role'] = $this->model->getAllwhere('user_role', $where1);
            $session_user_role = $this->session->userdata('user_role');
            $hospital_id       = $this->session->userdata('hospital_id');
            
            if ($session_user_role == 4) {
                $where         = array(
                    'hospital_id' => $hospital_id,
                    'user_role' => $user_role
                );
                $select        = 'id,CONCAT(first_name," ",last_name) as user_name,email,mobile,gender,user_role';
                $data['users'] = $this->model->find_record('users', $where, $select);
                
                for ($i = 0; $i < count($data['users']); $i++) {
                    $where      = array(
                        'doctor.doctor_id' => $data['users'][$i]->id
                    );
                    $select     = 'speciality.id, speciality.name';
                    $speciality = $this->model->GetJoinRecord('speciality', 'id', 'doctor', 'specialization', $select, $where);
                    if (!empty($speciality)) {
                        $data['users'][$i]->speciality_name = $speciality[0]->name;
                    } else {
                        $data['users'][$i]->speciality_name = 'not mentioned';
                    }
                }
            } else {
                $select        = 'id, hospital_id,CONCAT(first_name," ",last_name) as user_name, email, mobile, gender, user_role';
                $data['users'] = $this->model->getAllwhere('users', $where, $select);
            }
            $data['body'] = 'users_list';
            $this->controller->load_view($data);
        } else {
            redirect('admin/index');
        }
    }
    public function subadmin_users_list($user_role)
    {
        if ($this->controller->checkSession()) {
            $where             = array(
                'user_role' => $user_role
            );
            $where1            = array(
                'role_id' => $user_role
            );
            $data['users']     = $this->model->getAllwhere('users', $where);
            $data['user_role'] = $this->model->getAllwhere('user_role', $where1);
            $data['body']      = 'subadmin_users_list';
            $this->controller->load_view($data);
        } else {
            redirect('admin/index');
        }
    }
    public function assign_rights($id)
    {
        if ($this->controller->checkSession()) {
            $data['user_id']     = $id;
            $where               = array(
                'is_active' => 1
            );
            $data['rights_menu'] = $this->model->getAllwhere('rights_menu', $where);
            $where1              = array(
                'user_id' => $id
            );
            $data['user_rights'] = $this->model->getsingle('user_rights', $where1);
            $data['body']        = 'assign_rights';
            $this->controller->load_view($data);
        } else {
            redirect('admin/index');
        }
    }
    public function addRights($id = null)
    {
        if ($this->controller->checkSession()) {
            $actions    = array(
                'add',
                'edit',
                'delete'
            );
            $user_roles = $this->input->post('user_role');
            $role       = json_encode(implode(',', $user_roles));
            $rights     = '';
            $user_id    = $this->input->post('user_id');
            
            foreach ($user_roles as $user_role) {
                foreach ($actions as $action) {
                    if ($this->input->post($user_role . '_' . $action)) {
                        $rights .= 1;
                    } else {
                        $rights .= 0;
                    }
                }
                $rights .= ',';
            }
            
            $right = json_encode(rtrim($rights, ','));
            $data  = array(
                'user_id' => $user_id,
                'roles' => $role,
                'rights' => $right,
                'created_at' => date('Y-m-d H:i:s'),
                'is_active' => 1
            );
            
            $where = array(
                'user_id' => $user_id
            );
            
            $user_rights = $this->model->getsingle('user_rights', $where);
            
            if (!empty($user_rights)) {
                $result = $this->model->updateFields('user_rights', $data, $where);
            } else {
                $result = $this->model->insertData('user_rights', $data);
            }
            
            redirect('admin/users_list/4');
        } else {
            redirect('admin/index');
        }
    }
    public function edit_user($id)
    {
        if ($this->controller->checkSession()) {
            $where             = array(
                'id' => $id
            );
            $data['users']     = $this->model->getAllwhere('users', $where);
            $data['user_role'] = $data['users'][0]->user_role;
            
            if (!empty($data['users'][0]) && $data['users'][0]->user_role == 2) {
                $field_val          = 'id,hospital_name';
                $data['hospitals']  = $this->model->getAllwhere('hospitals', '', $field_val);
                $where              = array(
                    'doctor_id ' => $id
                );
                $field_val          = 'specialization';
                $data['doctor']     = $this->model->getAllwhere('doctor', $where, $field_val);
                $select             = 'id,name';
                $data['speciality'] = $this->model->getAllwhere('speciality', '', $select);
            }
            $data['body'] = 'edit_user';
            $this->controller->load_view($data);
        } else {
            redirect('admin/index');
        }
    }
    public function delete()
    {
        if ($this->controller->checkSession()) {
            $id    = $this->input->post('id');
            $table = $this->input->post('table');
            $where = array(
                'id' => $id
            );
            $this->model->delete($table, $where);
        } else {
            redirect('admin/index');
        }
    }
    public function delete_hospital_from_user()
    {
        if ($this->controller->checkSession()) {
            $id    = $this->input->post('id');
            $table = $this->input->post('table');
            $where = array(
                'hospital_id' => $id
            );
            $this->model->delete($table, $where);
        } else {
            redirect('admin/index');
        }
    }
    public function change_status()
    {
        if ($this->controller->checkSession()) {
            $id     = $this->input->post('id');
            $table  = $this->input->post('table');
            $where  = array(
                'id' => $id
            );
            $data   = array(
                'is_active' => 0
            );
            $result = $this->model->updateFields($table, $data, $where);
        } else {
            redirect('admin/index');
        }
    }
    public function schedule()
    {
        if ($this->controller->checkSession()) {
            $data['body']      = 'add_schedule';
            $field_val         = 'id,hospital_name';
            $data['hospitals'] = $this->model->getAllwhere('hospitals', '', $field_val);
            $this->controller->load_view($data);
        } else {
            redirect('admin/index');
        }
    }
    public function addSchedule($id = null)
    {
        if ($this->controller->checkSession()) {
            $this->form_validation->set_rules('doctor_id', 'Doctor Name', 'trim|required');
            if ($this->form_validation->run() == false) {
                $where           = array(
                    'doctor_id' => $this->input->post('doctor_id'),
                    'hospital_id!=' => $this->input->post('hospital_id')
                );
                $schedule_record = $this->model->getAllwhere('schedule', $where);
                redirect('admin/schedule');
            } elseif (!empty($schedule_record)) {
                $doctor_id   = $this->input->post('doctor_id');
                $hospital_id = $this->input->post('hospital_id');
                $schedule    = $this->input->post('schedule');
                $starttime   = $this->input->post('starttime');
                $endtime     = $this->input->post('endtime');
                for ($i = 0; $i < count($schedule); $i++) {
                    if (!empty($starttime[$i]) && !empty($schedule[$i]) && !empty($endtime[$i])) {
                        $where           = array(
                            "doctor_id" => $doctor_id,
                            "hospital_id !=" => $hospital_id,
                            "day" => $schedule[$i],
                            "starttime >=" => $starttime[$i],
                            'endtime <=' => $endtime[$i]
                        );
                        $schedule_record = $this->model->getAllwhere('schedule', $where);
                        if (!empty($schedule_record)) {
                            $this->session->set_flashdata("info_message", "Schedule already added for this day and time.. Please try another");
                            redirect('admin/schedule');
                        }
                    }
                }
            } else {
                $doctor_id   = $this->input->post('doctor_id');
                $hospital_id = $this->input->post('hospital_id');
                $schedule    = $this->input->post('schedule');
                $starttime   = $this->input->post('starttime');
                $endtime     = $this->input->post('endtime');
                if (!empty($schedule)) {
                    for ($i = 0; $i < count($schedule); $i++) {
                        $data[$i]['day']         = $schedule[$i];
                        $data[$i]['starttime']   = $starttime[$i];
                        $data[$i]['endtime']     = $endtime[$i];
                        $data[$i]['created_at']  = date('Y-m-d H:i:s');
                        $data[$i]['doctor_id']   = $doctor_id;
                        $data[$i]['hospital_id'] = $hospital_id;
                    }
                    if (!empty($id)) {
                        $where  = array(
                            'doctor_id' => $doctor_id,
                            'hospital_id' => $hospital_id
                        );
                        $delete = $this->model->delete('schedule', $where);
                    }
                    $result = $this->model->insertBatch('schedule', $data);
                    $this->session->set_flashdata("info_message", "Schedule Added Successfully..");
                    redirect('admin/schedule');
                }
            }
        } else {
            redirect('admin/index');
        }
    }
    public function list_schedule()
    {
        if ($this->controller->checkSession()) {
            $data['body']         = 'list_schedule';
            $data['scheduleList'] = $this->Common_model->getSchedule('schedule');
            $this->controller->load_view($data);
        } else {
            redirect('admin/index');
        }
    }
    public function edit_schedule($id, $hospital_id)
    {
        if ($this->controller->checkSession()) {
            $data['body']                    = 'edit_schedule';
            $where                           = array(
                'schedule.doctor_id' => $id,
                'schedule.hospital_id' => $hospital_id
            );
            $where1                          = array(
                'user_role' => 2
            );
            $data['doctor']                  = $this->model->getAllwhere('users', $where1);
            $data['schedule']                = $this->model->GetJoinRecord('schedule', 'doctor_id', 'users', 'id', 'schedule.id,schedule.doctor_id,schedule.day,schedule.starttime,schedule.endtime,users.first_name', $where);
            $data['schedule']['hospital_id'] = $hospital_id;
            $this->controller->load_view($data);
        } else {
            redirect('admin/index');
        }
    }
    public function delete_schedule()
    {
        if ($this->controller->checkSession()) {
            $id    = $this->input->post('id');
            $where = array(
                'doctor_id' => $id
            );
            $this->model->delete('schedule', $where);
        } else {
            redirect('admin/index');
        }
    }
    public function Appointment()
    {
        if ($this->controller->checkSession()) {
            $data['body'] = 'add_appointment';
            if ($this->session->userdata('user_role') == 4) {
                $hospital_id       = $this->session->userdata('hospital_id');
                $where             = array(
                    'hospital_id' => $hospital_id,
                    'user_role' => 3
                );
                $select            = 'id,first_name,last_name';
                $data['patient']   = $this->model->find_record('users', $where, $select);
                $data['hospitals'] = $hospital_id;
            } else {
                $wheres            = array(
                    'user_role' => 3
                );
                $data['patient']   = $this->model->getAllwhere('users', $wheres);
                $field_val         = 'id,hospital_name';
                $data['hospitals'] = $this->model->getAllwhere('hospitals', '', $field_val);
            }
            $this->controller->load_view($data);
        } else {
            redirect('admin/index');
        }
    }
    public function addAppointment($id = null)
    {
        if ($this->controller->checkSession()) {
            $this->form_validation->set_rules('patient_id', 'patient_id', 'trim|required');
            $this->form_validation->set_rules('doctor_id', 'doctor_id', 'trim|required');
            $this->form_validation->set_rules('appointment_date', 'appointment_date', 'trim|required');
            $this->form_validation->set_rules('appointment_time', 'appointment_time', 'trim|required');
            $this->form_validation->set_rules('problem', 'problem', 'trim|required');
            
            if (empty($id)) {
                $this->form_validation->set_rules('patient_id', 'patient_id', 'trim|required');
                $this->form_validation->set_rules('doctor_id', 'doctor_id', 'trim|required');
                $this->form_validation->set_rules('appointment_date', 'appointment_date', 'trim|required');
                $this->form_validation->set_rules('appointment_time', 'appointment_time', 'trim|required');
                $this->form_validation->set_rules('problem', 'problem', 'trim|required');
            }
            
            if ($this->form_validation->run() == false) {

                $this->session->set_flashdata('errors', validation_errors());
                $data['body']    = 'add_appointment';
                $where           = array(
                    'user_role' => 2
                );
                $wheres          = array(
                    'user_role' => 3
                );
                $data['doctor']  = $this->model->getAllwhere('users', $where);
                $data['patient'] = $this->model->getAllwhere('users', $wheres);
                $this->controller->load_view($data);
            } else {
                

                $data = $this->input->post();
               // echo '<pre>'
                $data = array(
                    'appointment_type' => $data['appointment_type'],
                    'appointment_id' => 'AP' . mt_rand(100000, 999999),
                    'patient_id' => $data['patient_id'],
                    'doctor_id' => $data['doctor_id'],
                    'hospital_id' => $data['hospital_id'],
                    'appointment_date' => $data['appointment_date'],
                    'appointment_time' => $data['appointment_time'],
                    'problem' => $data['problem'],
                    'created_at' => date('Y-m-d H:i:s')
                );
                
                if ($this->session->userdata('user_role') == 4) {
                    $data['hospital_id'] = $this->session->userdata('hospital_id');
                }
                
                if (!empty($id)) {
                    $where = array(
                        'id' => $id
                    );
                    unset($data['created_at']);
                    unset($data['appointment_id']);
                    $result = $this->model->updateFields('appointment', $data, $where);
                } else {
                    $result = $this->model->insertData('appointment', $data);
                }
                $this->session->set_flashdata("info_message", "Appointment updated Successfully..");
                redirect("admin/appointment_list");
                
            }
        } else {
            redirect('admin/index');
        }
    }
    public function appointment_list()
    {
        if ($this->controller->checkSession()) {
            $session_user_role = $this->session->userdata('user_role');
            if ($session_user_role == 4) {
                $hospital_id             = $this->session->userdata('hospital_id');
                $where                   = array(
                    'hospital_id' => $hospital_id
                );
                $data['appointmentList'] = $this->Common_model->GetJoinedRecord($where);
            } else {
                $where                   = array(
                    'appointment_date >' => date('Y-m-d')
                );
                $data['appointmentList'] = $this->Common_model->GetJoinedRecord();
            }
            $data['body'] = 'list_appointment';
            $this->controller->load_view($data);
        } else {
            redirect('admin/index');
        }
    }
    public function update_status()
    {
        if ($this->controller->checkSession()) {
            $id     = $this->input->post('id');
            $active = $this->input->post('active');
            $data   = array(
                'is_active' => $active
            );
            $where  = array(
                'id' => $id
            );
            $this->model->update('appointment', $data, $where);
        } else {
            redirect('admin/index');
        }
    }
    public function edit_appointment($id)
    {
        if ($this->controller->checkSession()) {
            $where  = array(
                'user_role' => 2
            );
            $wheres = array(
                'user_role' => 3
            );
            
            $data['doctor']  = $this->model->getAllwhere('users', $where);
            $data['patient'] = $this->model->getAllwhere('users', $wheres);
            
            $where1 = array(
                'appointment.id ' => $id
            );
            
            $data['appointment'] = $this->model->GetJoinRecord('appointment', 'doctor_id', 'users', 'id', 'appointment.id as id,appointment.appointment_id,appointment.appointment_date,appointment.appointment_time,appointment.problem,appointment.appointment_type,appointment.patient_id,appointment.doctor_id', $where1);
            $data['body']        = 'edit_appointment';
            $this->controller->load_view($data);
        } else {
            redirect('admin/index');
        }
    }
    
    public function profile()
    {
        if ($this->controller->checkSession()) {
            $where         = array(
                'id' => $this->session->userdata('id')
            );
            $data['users'] = $this->model->getAllwhere('users', $where);
            $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|alpha|min_length[2]');
            $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|alpha|min_length[2]');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
            $this->form_validation->set_rules('date_of_birth', 'Date Of Birth', 'trim|required');
            
            if ($this->form_validation->run() == false) {
                $this->session->set_flashdata('errors', validation_errors());
                $data['body'] = 'profile';
                $this->controller->load_view($data);
            } else {

                
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
                    'blood_group' => $blood_group
                );
                
                if (isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])) {
                    
                    if (move_uploaded_file($_FILES['image']['tmp_name'], 'asset/uploads/' . $_FILES['image']['name'])) {
                        
                        $data['profile_pic'] = $_FILES['image']['name'];
                    }
                }
                $result = $this->model->updateFields('users', $data, $where);
                redirect('/admin/profile', 'refresh');
                
            }
        } else {
            redirect('admin/index');
        }
    }
    public function case_study($id = null)
    {
        if ($this->controller->checkSession()) {
            if ($this->session->userdata('user_role') == 4) {
                $hospital_id       = $this->session->userdata('hospital_id');
                $where             = array(
                    'hospital_id' => $hospital_id,
                    'user_role' => 3
                );
                $select            = 'id,first_name,last_name';
                $data['patient']   = $this->model->find_record('users', $where, $select);
                $data['hospitals'] = $hospital_id;
            } else {
                $where             = array(
                    'user_role' => 3
                );
                $field_val         = 'id,hospital_name';
                $data['hospitals'] = $this->model->getAllwhere('hospitals', '', $field_val);
                $select            = 'id,first_name,last_name';
                $data['patient']   = $this->model->getAllwhere('users', $where, $select);
            }
            
            $this->form_validation->set_rules('patient_id', 'Patient Name', 'trim|required');
            $this->form_validation->set_rules('diabetic', 'Diabetic', 'trim|required');
            $this->form_validation->set_rules('blood_pressure', 'High Blood Pressure', 'trim|required');
            if ($this->form_validation->run() == false) {
                $this->session->set_flashdata('errors', validation_errors());
                $data['body'] = 'case_study';
                if (!empty($id)) {
                    $where              = array(
                        'id' => $id
                    );
                    $data['case_study'] = $this->model->getAllwhere('case_study', $where);
                    $data['body']       = 'edit_case_study';
                }
                $this->controller->load_view($data);
            } else {
                
                $doctor_id       = $this->input->post('doctor_id');
                $hospital_id     = $this->input->post('hospital_id');
                $patient_id      = $this->input->post('patient_id');
                $diabetic        = $this->input->post('diabetic');
                $blood_pressure  = $this->input->post('blood_pressure');
                $allergies       = $this->input->post('allergies');
                $problem         = $this->input->post('problem');
                $others          = $this->input->post('others');
                $medical_history = $this->input->post('medical_history');
                $status          = $this->input->post('status');
                $reference       = $this->input->post('reference');
                
                $data = array(
                    'doctor_id' => $doctor_id,
                    'hospital_id' => $hospital_id,
                    'patient_id' => $patient_id,
                    'diabetic' => $diabetic,
                    'blood_pressure' => $blood_pressure,
                    'allergies' => $allergies,
                    'problem' => $problem,
                    'others' => $others,
                    'medical_history' => $medical_history,
                    'is_active' => $status,
                    'reference' => $reference,
                    'created_at' => date('Y-m-d H:i:s')
                );
                if (!empty($id)) {
                    $where = array(
                        'id' => $id
                    );
                    unset($data['created_at']);
                    $result = $this->model->updateFields('case_study', $data, $where);
                } else {
                    $result = $this->model->insertData('case_study', $data);
                }
                
                redirect('admin/case_study_list');
                
            }
        } else {
            redirect('admin/index');
        }
    }
    
    public function case_study_list()
    {
        if ($this->controller->checkSession()) {
            if (!empty($this->session->userdata('hospital_id'))) {
                $field = 'hospital_id';
                $value = $this->session->userdata('hospital_id');
            } else {
                $field = '';
                $value = '';
            }
            
            $field_val              = 'case_study.*,CONCAT(u1.first_name," ",u1.last_name) as patient_name,CONCAT(u2.first_name," ",u2.last_name) as doctor_name';
            $data['documents_list'] = $this->model->GetJoinRecordNew('case_study', 'patient_id', 'doctor_id', 'users u1', 'id', 'users u2', 'id', $field, $value, $field_val);
            $data['body']           = 'case_study_list';
            $this->controller->load_view($data);
        } else {
            redirect('admin/index');
        }
    }
    
    public function notices($id = null)
    {
        if ($this->controller->checkSession()) {
            $this->form_validation->set_rules('title', 'title', 'trim|required');
            $this->form_validation->set_rules('description', 'description', 'trim|required');
            if (empty($id)) {
                $this->form_validation->set_rules('title', 'title', 'trim|required');
                $this->form_validation->set_rules('description', 'description', 'trim|required');
            }
            
            if ($this->form_validation->run() == false) {
                $field_val         = 'id,hospital_name';
                $data['hospitals'] = $this->model->getAllwhere('hospitals', '', $field_val);
                $this->session->set_flashdata('errors', validation_errors());
                $data['body'] = 'add_notice';
                
                if (!empty($id)) {

                    $where           = array('id' => $id);

                    $data['notices'] = $this->model->getAllwhere('notices', $where);
                    $data['body']    = 'edit_notices';
                }
                $this->controller->load_view($data);
            } else {
                $title       = $this->input->post('title');
                $description = $this->input->post('description');
                $start_date  = $this->input->post('start_date');
                $end_date    = $this->input->post('end_date');
                
                $data = array(
                    'title' => $title,
                    'description' => $description,
                    'start_date' => date('Y-m-d', strtotime($start_date)),
                    'end_date' => date('Y-m-d', strtotime($end_date)),
                    'created_at' => date('Y-m-d H:i:s'),
                    'added_by' => $this->session->userdata('id')
                );
                
                
                if (!empty($this->session->userdata('hospital_id'))) {
                    $hospital_id         = $this->session->userdata('hospital_id');
                    $data['hospital_id'] = $hospital_id;
                }
                
                if (!empty($id)) {
                    $where = array(
                        'id' => $id
                    );
                    unset($data['created_at']);
                    $result = $this->model->updateFields('notices', $data, $where);
                } else {
                    $result = $this->model->insertData('notices', $data);
                }
                $this->notices_list();
                
            }
        } else {
            redirect('admin/index');
        }
    }
    public function notices_list()
    {
        if ($this->controller->checkSession()) {
            if ($this->session->userdata('user_role') == 4) {
                $where               = '(hospital_id=' . $this->session->userdata('hospital_id') . ' or hospital_id is NULL)';
                $data['notice_list'] = $this->model->getAllwhere('notices', $where);
            } else {
                $data['notice_list'] = $this->model->getAll('notices');
            }
            $data['body'] = 'list_notice';
            $this->controller->load_view($data);
        } else {
            redirect('admin/index');
        }
    }
    public function send_message()
    {
        if ($this->controller->checkSession()) {
            $where = array(
                'user_role != ' => $this->session->userdata('user_role')
            );
            $this->form_validation->set_rules('reciever_id[]', 'Message to', 'trim|required');
            $this->form_validation->set_rules('subject', 'Subject', 'trim|required');
            $this->form_validation->set_rules('message', 'Message', 'trim|required');
            if ($this->form_validation->run() == false) {
                $data['users'] = $this->model->getAllwhere('users', $where);
                $this->session->set_flashdata('errors', validation_errors());
                $data['body'] = 'send_message';
                $this->controller->load_view($data);
            } else {
                
                $reciever_id = $this->input->post('reciever_id');
                $subject     = $this->input->post('subject');
                $message     = $this->input->post('message');
                $sender_id   = $this->session->userdata('id');
                
                for ($i = 0; $i < count($reciever_id); $i++) {
                    
                    $data[] = array(
                        'reciever_id' => $reciever_id[$i],
                        'sender_id' => $sender_id,
                        'subject' => $subject,
                        'message' => trim($message),
                        'is_active' => 1,
                        'created_at' => date('Y-m-d H:i:s')
                    );
                }
                $this->db->insert_batch('message', $data);
                redirect('admin/message_list');
                
            }
        } else {
            redirect('admin/index');
        }
    }
    public function send_mail()
    {
        if ($this->controller->checkSession()) {

            $where = array(

                'user_role != ' => $this->session->userdata('user_role')
            );
            $this->form_validation->set_rules('reciever_id[]', 'Mail to', 'trim|required');
            $this->form_validation->set_rules('subject', 'Subject', 'trim|required');
            $this->form_validation->set_rules('message', 'Message', 'trim|required');
            if ($this->form_validation->run() == false) {
                $this->session->set_flashdata('errors', validation_errors());

                 $data['users'] = $this->model->getAllwhere('users', $where);
                $data['body'] = 'send_mail';

                $this->controller->load_view($data);
            } else {
                
                
                $reciever_id = $this->input->post('reciever_id');
                $subject     = $this->input->post('subject');
                $message     = $this->input->post('message');
                $sender_id   = $this->session->userdata('id');
                
                $data = array(
                    'reciever_id' => $reciever_id,
                    'sender_id' => $sender_id,
                    'subject' => $subject,
                    'message' => trim($message),
                    'is_active' => 1,
                    'created_at' => date('Y-m-d H:i:s')
                );

                
                
                $config_mail = Array(
                    'protocol' => 'smtp',
                    'smtp_host' => 'ssl://smtp.googlemail.com',
                    'smtp_port' => '465',
                    'smtp_user' => '',
                    'smtp_pass' => '',
                    'mailtype' => 'html',
                    'charset' => 'iso-8859-1',
                    'newline' => "\r\n"
                );

                $this->load->library('email', $config_mail);
                $this->email->set_mailtype("html");
                $this->email->set_newline("\r\n");

                

                for ($i = 0; $i < count($reciever_id); $i++) {
                    $this->email->from($this->session->userdata('email'), "Admin Team");
                    $this->email->to($reciever_id[$i]);
                    $this->email->subject($subject);
                    $this->email->message($message);
                    $data[] = array(
                        'reciever_id' => $reciever_id[$i],
                        'sender_id' => $sender_id,
                        'subject' => $subject,
                        'message' => trim($message),
                        'is_active' => 1,
                        'created_at' => date('Y-m-d H:i:s')
                    );
                }
                
                                                       
                if (!$this->email->send()) {
                    show_error($this->email->print_debugger());
                }
                $this->db->insert_batch('mail', $data);
                redirect('admin/mail_list');
                
            }
        } else {
            redirect('admin/index');
        }
    }
    public function mail_list()
    {
        if ($this->controller->checkSession()) {
            $where             = array(
                'sender_id =' => $this->session->userdata('id')
            );
            $field_val         = 'mail.*,users.first_name,users.last_name';
            $data['mail_list'] = $this->model->GetJoinRecord('mail', 'reciever_id', 'users', 'id', $field_val, $where);
            $data['body']      = 'mail_list';
            $this->controller->load_view($data);
        } else {
            redirect('admin/index');
        }
    }
    
    public function message_list()
    {
        if ($this->controller->checkSession()) {
            $where = array(
                'sender_id ' => $this->session->userdata('id')
            );
            
            $field_val             = 'message.*,users.first_name,users.last_name';
            $data['messages_list'] = $this->model->GetJoinRecord('message', 'reciever_id', 'users', 'id', $field_val, $where);
            $data['body']          = 'message_list';
            $this->controller->load_view($data);
        } else {
            redirect('admin/index');
        }
    }
    public function add_inventory($id = null)
    {
        if ($this->controller->checkSession()) {
            $this->form_validation->set_rules('equipment_name', 'Equipment Name', 'trim|required');
            $this->form_validation->set_rules('no_of_equipment', 'No of Equipment', 'trim|required|numeric|xss_clean');
            
            if ($this->form_validation->run() == false) {
                $this->session->set_flashdata('errors', validation_errors());
                $data['body'] = 'inventory';
                $this->controller->load_view($data);
            } else {
                
                $equipment_name  = $this->input->post('equipment_name');
                $no_of_equipment = $this->input->post('no_of_equipment');
                $others          = $this->input->post('others');
                $data            = array(
                    'doctor_id' => $this->session->userdata('id'),
                    'equipment_name' => $equipment_name,
                    'no_of_equipment' => $no_of_equipment,
                    'others' => $others,
                    'is_active' => 1,
                    'created_at' => date('Y-m-d H:i:s')
                );
                
                if (!empty($id)) {
                    $where = array(
                        'id' => $id
                    );
                    unset($data['created_at']);
                    $result = $this->model->updateFields('inventory', $data, $where);
                } else {
                    $result = $this->model->insertData('inventory', $data);
                }
                $this->inventory_list();
                
            }
        } else {
            redirect('admin/index');
        }
    }
    public function inventory_list()
    {
        if ($this->controller->checkSession()) {
            $field_val              = 'inventory.*,users.first_name,users.last_name';
            $where                  = array(
                'inventory.is_active' => 1
            );
            $data['inventory_list'] = $this->model->GetJoinRecord('inventory', 'doctor_id', 'users', 'id', $field_val, $where);
            $data['body']           = 'inventory_list';
            $this->controller->load_view($data);
        } else {
            redirect('admin/index');
        }
    }
    public function edit_inventory($id)
    {
        if ($this->controller->checkSession()) {
            $where             = array(
                'id' => $id
            );
            $data['inventory'] = $this->model->getAllwhere('inventory', $where);
            $data['body']      = 'edit_inventory';
            $this->controller->load_view($data);
        } else {
            redirect('admin/index');
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
    public function hospitals($id = null)
    {
        if ($this->controller->checkSession()) {
            $this->form_validation->set_rules('hospital_name', 'Hospital Name', 'trim|required');
            $this->form_validation->set_rules('registration_number', 'Registration Number', 'trim|required');
            $this->form_validation->set_rules('registration_date', 'Registration Date', 'trim|required');
            $this->form_validation->set_rules('owner_name', 'Owner Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('city', 'City', 'trim|required|xss_clean|numeric');
            $this->form_validation->set_rules('address', 'Address', 'trim|required|xss_clean');
            $this->form_validation->set_rules('no_of_doc', 'Number of Doctor', 'trim|required|numeric');
            $this->form_validation->set_rules('speciality', 'Speciality', 'trim|required|xss_clean');
            $this->form_validation->set_rules('blood_bank', 'Blood Bank', 'trim|required');
            
            if (empty($id)) {
                $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
                $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|alpha_numeric');
                $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean|is_unique[users.username]');
            }
            
            $this->form_validation->set_rules('mobile', 'Mobile', 'trim|required|xss_clean');
            $this->form_validation->set_rules('phone_no', 'Phone', 'trim|required');
            
            if ($this->form_validation->run() == false) {
                $this->session->set_flashdata('errors', validation_errors());
                if (!empty($id)) {
                    $where                     = array(
                        'id' => $id
                    );
                    $where1                    = array(
                        'hospital_id' => $id
                    );
                    $where2                    = array(
                        'is_active' => 1
                    );
                    $data['hospitals']         = $this->model->getAllwhere('hospitals', $where);
                    $data['hospitals_details'] = $this->model->getAllwhere('users', $where);
                    
                    
                    $where_city = array(
                        'id' => $data['hospitals'][0]->city
                    );
                    
                    $state = $this->model->getAllwhere('cities', $where_city);
                    
                    $where_state                      = array(
                        'id' => $state[0]->state_id
                    );
                    $country                          = $this->model->getAllwhere('states', $where_state);
                    $data['hospitals'][0]->state_id   = $state[0]->state_id;
                    $data['hospitals'][0]->state_name = $country[0]->name;
                    $data['hospitals'][0]->country    = $country[0]->country_id;
                    $data['hospitals'][0]->city_name  = $state[0]->name;
                }
                
                $where2             = array(
                    'is_active' => 1
                );
                $field_val          = 'id,name';
                $data['speciality'] = $this->model->getAllwhere('speciality', $where2, $field_val);
                $data['countries']  = $this->model->getAll('countries');
                $data['body']       = 'hospitals';
                $this->controller->load_view($data);

            } else {                

                $hospital_name       = $this->input->post('hospital_name');
                $registration_number = $this->input->post('registration_number');
                $owner_name          = $this->input->post('owner_name');
                $city                = $this->input->post('city');
                $address             = $this->input->post('address');
                $staff_number        = $this->input->post('staff_number');
                $no_of_doc           = $this->input->post('no_of_doc');
                $speciality          = $this->input->post('speciality');
                $no_of_ambulance     = $this->input->post('no_of_ambulance');
                $blood_bank          = $this->input->post('blood_bank');
                $status              = $this->input->post('status');
                $other_speciality    = $this->input->post('other_speciality');
                
                if (!empty($_FILES)) {
                    $file_name = $this->file_upload('logo');
                } else {
                    $file_name = '';
                }
                
                if (!empty($other_speciality)) {
                    $other_speciality = implode(',', $other_speciality);
                }
                
                $data = array(
                    'hospital_name' => $hospital_name,
                    'registration_number' => $registration_number,
                    'owner_name' => $owner_name,
                    'city' => $city,
                    'address' => $address,
                    'staff_number' => $staff_number,
                    'no_of_doc' => $no_of_doc,
                    'speciality' => $speciality,
                    'other_speciality' => $other_speciality,
                    'no_of_ambulance' => $no_of_ambulance,
                    'blood_bank' => $blood_bank,
                    'is_active' => $status,
                    'logo' => $file_name,
                    'created_at' => date('Y-m-d H:i:s')
                );

                if(!empty($id)){

                    $data1 = array(
                        'first_name' => $hospital_name,
                        'date_of_birth' => $this->input->post('registration_date'),
                        'profile_pic' => $file_name,
                        'mobile' => $this->input->post('mobile'),
                        'phone_no' => $this->input->post('phone_no'),
                        'address' => $address,
                        'is_active' => $status,
                        'created_at' => date('Y-m-d H:i:s')
                    );

                }else{

                    $data1 = array(
                        'first_name' => $hospital_name,
                        'date_of_birth' => $this->input->post('registration_date'),
                        'profile_pic' => $file_name,
                        'username' => $this->input->post('username'),
                        'email' => $this->input->post('email'),
                        'password' => MD5($this->input->post('password')),
                        'mobile' => $this->input->post('mobile'),
                        'phone_no' => $this->input->post('phone_no'),
                        'address' => $address,
                        'user_role' => 4,
                        'is_active' => $status,
                        'created_at' => date('Y-m-d H:i:s')
                    );
                }

                if (!empty($id)) {
                    $where  = array(
                        'id' => $id
                    );
                    $where1 = array(
                        'hospital_id' => $id
                    );
                    unset($data1['created_at']);
                    unset($data['created_at']);
                    unset($data1['email']);
                    unset($data1['username']);
                    unset($data1['password']);
                    $result = $this->model->updateFields('hospitals', $data, $where);
                    $result = $this->model->updateFields('users', $data1, $where1);
                } else {
                    $result               = $this->model->insertData('hospitals', $data);
                    $data1['hospital_id'] = $result;
                    $result               = $this->model->insertData('users', $data1);
                }
                redirect('admin/hospitals_list');
            }
        } else {
            redirect('admin/index');
        }
    }
    
    
    public function hospitals_list($id = null)
    {
        if ($this->controller->checkSession()) {
            $field_val = 'hospitals.*,users.id as user_id';
            if (!empty($id)) {
                $field = 'id';
                $value = $id;
            } else {
                $field = '';
                $value = '';
            }

            $field_val              = 'hospitals.hospital_name,hospitals.id,hospitals.registration_number,hospitals.owner_name,hospitals.address,hospitals.staff_number,hospitals.no_of_doc,hospitals.no_of_ambulance,hospitals.blood_bank,hospitals.created_at,u1.id as user_id,u1.user_role,u2.name as speciality';
            $where = array('u1.user_role'=>4);

            $data['hospitals_list'] = $this->model->GetJoinRecordNew('hospitals', 'id', 'speciality', 'users u1', 'hospital_id', 'speciality u2', 'id', $field, $value, $field_val,$where);
            
            $data['body']           = 'hospitals_list';

            $this->controller->load_view($data);
        } else {
            redirect('admin/index');
        }
    }
    public function file_upload($file)
    {
        if (!empty($_FILES["$file"]["name"])) {
            $f_name      = $_FILES["$file"]["name"];
            $f_tmp       = $_FILES["$file"]["tmp_name"];
            $f_size      = $_FILES["$file"]["size"];
            $f_extension = explode('.', $f_name); //To breaks the string into array
            $f_extension = strtolower(end($f_extension)); //end() is used to retrun a last element to the array
            $f_newfile   = "";
            
            if ($f_name) {
                $f_newfile = uniqid() . '.' . $f_extension; // It`s use to stop overriding if the image will be same then uniqid() will generate the unique name of both file.
                $store     = 'asset/uploads/' . $f_newfile;
                $image1    = move_uploaded_file($f_tmp, $store);
                return $f_newfile;
            }
        }
    }
    public function get_record()
    {
        
        $id    = $this->input->get('id');
        $table = $this->input->get('table');
        $field = $this->input->get('field');
        
        if ($field == 'hospital_id') {
            $select = 'id,first_name,last_name';
            $where  = array(
                'hospital_id' => $id,
                'user_role' => 2,
                'is_active' => 1
            );
        } else {
            $where  = array(
                "$field" => $id
            );
            $select = 'id, name';
        }
        $states = $this->model->getAllwhere($table, $where, $select);
        echo json_encode($states);
    }
    
    public function find_record()
    {
        $id     = $this->input->get('id');
        $table  = $this->input->get('table');
        $field  = $this->input->get('field');
        $select = 'id,first_name,last_name';
        $where  = array(
            $field => $id,
            'user_role' => 2,
            'is_active' => 1
        );
        $states = $this->model->find_record($table, $where, $select);
        echo json_encode($states);
    }
    public function get_schedule()
    {
        if ($this->controller->checkSession()) {
            $doctor_id        = $this->input->post('doctor_id');
            $appointment_time = $this->input->post('appointment_time');
            $appointment_date = $this->input->post('appointment_date');
            
            $hospital_id = $this->input->post('hospital_id');
            
            $day = date('l', strtotime($appointment_date));
            if (!empty($hospital_id)) {
                $where = array(
                    'doctor_id' => $doctor_id,
                    'hospital_id' => $hospital_id
                );
            } else {
                $where = array(
                    'doctor_id' => $doctor_id
                );
            }
            $data = $this->model->GetJoinRecord('schedule', 'hospital_id', 'hospitals', 'id', '', $where);
            
            print_r(json_encode($data));
        } else {
            redirect('admin/index');
        }
    }
    
    public function check_schedule()
    {
        
        $doctor_id = $this->input->post('doctor_id');
        $date      = $this->input->post('date');
        $starttime = $this->input->post('starttime');
        $endtime   = $this->input->post('endtime');
    }
    
    public function get_time()
    {
        if ($this->controller->checkSession()) {
            $doctor_id        = $this->input->post('doctor_id');
            $appointment_date = $this->input->post('appointment_date');
            $day              = date('l', strtotime($appointment_date));
            $hospital_id      = $this->input->post('hospital_id');
            $where            = array(
                'doctor_id' => $doctor_id,
                'appointment_date' => $appointment_date,
                'hospital_id' => $hospital_id
            );
            $field_val        = 'appointment_time';
            $data             = $this->model->getAllwhere('appointment', $where, '', '', $field_val);
            print_r(json_encode($data));
        } else {
            redirect('admin/index');
        }
    }
    public function review_list()
    {
        if ($this->controller->checkSession()) {
            $data['review'] = $this->model->getAll('review');
            if (!empty($data['review'])) {
                foreach ($data['review'] as $key => $value) {
                    $doctor_id  = $value['doctor_id'];
                    $patient_id = $value['patient_id'];
                    $patient    = $this->model->self_join_records($patient_id, $doctor_id);
                    
                    if (!empty($patient[0]['doctor_first_name'])) {
                        $data['review'][$key]['doctor_first_name'] = $patient[0]['doctor_first_name'];
                    }
                    if (!empty($patient[0]['patient_first_name'])) {
                        $data['review'][$key]['patient_first_name'] = $patient[0]['patient_first_name'];
                    }
                }
            }
            $data['body'] = 'review_list';
            $this->controller->load_view($data);
        } else {
            redirect('admin/index');
        }
    }
    public function view_review($id)
    {
        if ($this->controller->checkSession()) {
            $where          = array(
                'id ' => $id
            );
            $data['review'] = $this->model->getAllwhere('review', $where);
            $doctor_id      = $data['review'][0]->doctor_id;
            $patient_id     = $data['review'][0]->patient_id;
            $where1         = array(
                'id' => $doctor_id
            );
            $select         = 'first_name';
            $data['doctor'] = $this->model->getAllwhere('users', $where1, $select);
            $data['body']   = 'view_review';
            $this->controller->load_view($data);
        } else {
            redirect('admin/index');
        }
    }
    public function update_review()
    {
        if ($this->controller->checkSession()) {
            $id     = $this->input->post('id');
            $active = $this->input->post('active');
            $data   = array(
                'is_active' => $active
            );
            $where  = array(
                'id' => $id
            );
            $this->model->update('review', $data, $where);
        } else {
            redirect('admin/index');
        }
    }
    public function speciality($id = NULL)
    {
        if ($this->controller->checkSession()) {

            $this->form_validation->set_rules('speciality_name', 'Speciality Name', 'trim|required|is_unique[speciality.name]');

            if (empty($id)) {
                $this->form_validation->set_rules('speciality_name', 'Speciality Name', 'trim|required|is_unique[speciality.name]');
            } else {
                $this->form_validation->set_rules('speciality_name', 'Speciality Name', 'trim|required');
            }
            

            $this->form_validation->set_rules('status', 'Status', 'trim|required');
            if ($this->form_validation->run() == false) {
                $this->session->set_flashdata('errors', validation_errors());
                if (!empty($id)) {
                    $where              = array(
                        'id ' => $id
                    );
                    $data['speciality'] = $this->model->getAllwhere('speciality', $where);
                }
                $data['body'] = 'speciality';
                $this->controller->load_view($data);
            } else {
                
                $speciality_name = $this->input->post('speciality_name');
                $details         = $this->input->post('details');
                $is_active       = $this->input->post('status');
                
                $data = array(
                    'name' => $speciality_name,
                    'details' => $details,
                    'is_active' => $is_active,
                    'created_at' => date('Y-m-d H:i:s')
                );
                
                if (!empty($id)) {
                    $where = array(
                        'id' => $id
                    );
                    unset($data['created_at']);
                    $result = $this->model->updateFields('speciality', $data, $where);
                } else {
                    $result = $this->model->insertData('speciality', $data);
                }
                redirect('admin/speciality_list');
                
            }
        } else {
            redirect('admin/index');
        }
    }
    
    public function speciality_list()
    {
        if ($this->controller->checkSession()) {
            $data['speciality'] = $this->model->getAll('speciality');
            $data['body']       = 'speciality_list';
            $this->controller->load_view($data);
        } else {
            redirect('admin/index');
        }
    }
    
    public function get_speciality_by_hospital()
    {
        if ($this->controller->checkSession()) {
            if (!empty($this->input->get('id'))) {
                $id   = explode(",", str_replace(" ", "", trim($this->input->get('id'))));
                $data = $this->Common_model->find_records('speciality', $id);
                print_r(json_encode($data));
            }
        } else {
            redirect('admin/index');
        }
    }
    public function assign_doctor()
    {
        if ($this->controller->checkSession()) {
            $where             = array(
                'user_role' => 2,
                'is_active' => 1
            );
            $where1            = array(
                'is_active' => 1
            );
            $field_val1        = 'id,hospital_name';
            $field_val         = 'id,first_name,last_name';
            $data['doctors']   = $this->model->getAllwhere('users', $where, $field_val);
            $data['hospitals'] = $this->model->getAllwhere('hospitals', $where1, $field_val1);
            $data['body']      = 'assign_doctor';
            $this->controller->load_view($data);
        } else {
            redirect('admin/index');
        }
    }
    public function get_hospitals()
    {
        if ($this->controller->checkSession()) {
            $doctor_id = $this->input->get('doctor_id');
            if (!empty($doctor_id)) {
                $where     = array(
                    'is_active' => 1,
                    'id' => $doctor_id
                );
                $field_val = 'hospital_id';
                $hospitals = $this->model->getAllwhere('users', $where, $field_val);
                print_r(json_encode($hospitals));
            }
        } else {
            redirect('admin/index');
        }
    }
    public function assign_hospital()
    {
        if ($this->controller->checkSession()) {
            $this->form_validation->set_rules('hospital_ids[]', 'Hospitals', 'trim|required');
            $this->form_validation->set_rules('doctor_id', 'Doctor', 'trim|required');
            if ($this->form_validation->run() == false) {
                $this->session->set_flashdata('errors', validation_errors());
                $this->assign_doctor();
            } else {
                $hospital_ids = $this->input->post('hospital_ids');
                $doctor_id    = $this->input->post('doctor_id');
                $data         = array(
                    'hospital_id' => implode(',', $hospital_ids)
                );
                $where        = array(
                    'id' => $doctor_id
                );
                $result       = $this->model->updateFields('users', $data, $where);
                redirect('admin/schedule');
            }
        } else {
            redirect('admin/index');
        }
    }
    
    public function update_user($id = null, $role = null)
    {
        if ($this->controller->checkSession()) {
            $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|callback_alpha_dash_space|min_length[2]');
            $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|callback_alpha_dash_space|min_length[2]');
            $this->form_validation->set_rules('dob', 'Date Of Birth', 'trim|required');
            

            if (empty($id)) {

                $this->form_validation->set_rules('user_name', 'User Name', 'trim|required|is_unique[users.username]');
                $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
            }
            if ($this->form_validation->run() == false) {
                $this->session->set_flashdata('errors', validation_errors());
                $this->edit_user($id);
            } else {

                $first_name     = $this->input->post('first_name');
                $last_name      = $this->input->post('last_name');
                $address        = $this->input->post('address');
                $phone_no       = $this->input->post('phone_no');
                $mobile_no      = $this->input->post('mobile_no');
                $dob            = $this->input->post('dob');
                $gender         = $this->input->post('gender');
                $blood_group    = $this->input->post('blood_group');
                $status         = $this->input->post('status');
                $hospitals_id   = implode(',', $this->input->post('hospitals_id'));
                $specialization = $this->input->post('specialization');
                
                if (!empty($_FILES)) {
                    $file_name = $this->file_upload('image');
                } else {
                    $file_name = '';
                }

                $data = array(
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'address' => $address,
                    'phone_no' => $phone_no,
                    'mobile' => $mobile_no,
                    'date_of_birth' => $dob,
                    'gender' => $gender,
                    'blood_group' => $blood_group,
                    'is_active' => $status,
                    'user_role' => $role,
                    'profile_pic' => $file_name,
                    'hospital_id' => $hospitals_id
                );
                
                
                $data1 = array(
                    'specialization' => $specialization,
                    'is_active' => $status
                );
                
                
                $where = array(
                    'id' => $id
                );
                
                $where1 = array(
                    'doctor_id' => $id
                );
                
                $result = $this->model->updateFields('users', $data, $where);
                
                $result = $this->model->updateFields('doctor', $data1, $where1);
                

                redirect('admin/users_list/2');
            }
        } else {
            redirect('admin/index');
        }
    }
    public function update_patient($id = null, $role = null)
    {
        if ($this->controller->checkSession()) {
            $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|callback_alpha_dash_space|min_length[2]');
            $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|callback_alpha_dash_space|min_length[2]');
            $this->form_validation->set_rules('phone_no', 'Phone no', 'trim|required');
            $this->form_validation->set_rules('dob', 'Date Of Birth', 'trim|required');
            if ($this->form_validation->run() == false) {
                $this->session->set_flashdata('errors', validation_errors());
                $this->edit_user($id);
            } else {
                
                $user_name   = $this->input->post('user_name');
                $first_name  = $this->input->post('first_name');
                $last_name   = $this->input->post('last_name');
                $email       = $this->input->post('email');
                $phone_no    = $this->input->post('phone_no');
                $mobile_no   = $this->input->post('mobile_no');
                $dob         = $this->input->post('dob');
                $gender      = $this->input->post('gender');
                $status      = $this->input->post('status');
                $blood_group = $this->input->post('blood_group');
                $address     = $this->input->post('address');
                if (!empty($_FILES)) {
                    $file_name = $this->file_upload('image');
                } else {
                    $file_name = '';
                }
                $data   = array(
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'username' => $user_name,
                    'email' => $email,
                    'password' => MD5($password),
                    'address' => $address,
                    'phone_no' => $phone_no,
                    'mobile' => $mobile_no,
                    'date_of_birth' => $dob,
                    'gender' => $gender,
                    'blood_group' => $blood_group,
                    'is_active' => $status,
                    'user_role' => 3,
                    'created_at' => date('Y-m-d H:i:s'),
                    'profile_pic' => $file_name
                );
                $where  = array(
                    'id' => $id
                );
                $result = $this->model->updateFields('users', $data, $where);
                redirect('admin/users_list/3');
                
            }
        } else {
            redirect('admin/index');

        }
    }

    public function get_location(){
        if(!empty($_POST['latitude']) && !empty($_POST['longitude'])){
            //send request and receive json data by latitude and longitude
            $url = 'http://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($_POST['latitude']).','.trim($_POST['longitude']).'&sensor=false';
            $json = @file_get_contents($url);
            $data = json_decode($json);
            $status = $data->status;
            
            //if request status is successful
            if($status == "OK"){
                //get address from json data
                $location = $data->results[0]->formatted_address;
            }else{
                $location =  '';
            }
            
            //return address to ajax 
            echo $location;

        }
    }
}