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
    
    public function add_doctor()
    {
        if ($this->controller->checkSession()) {
            $data['body'] = 'add_doctor';
            $this->controller->load_view($data);
        } else {
            $this->index();
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
            $data['body'] = 'main_bar';
            $this->controller->load_view($data);
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
        $result   = $this->model->getsingle('users', $where);

        if (!empty($result)) {
            
            $sess_array = array(
                'id' => $result->id,
                'username' => $result->username,
                'email' => $result->email,
                'user_role' => $result->user_role,
                'first_name' => $result->first_name,
                'last_name' => $result->last_name
            );
            
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
        $this->form_validation->set_rules('old_password', 'Old Password', 'trim|required|callback_oldpass_check');
        $this->form_validation->set_rules('new_password', 'New Password', 'trim|required|md5');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|matches[new_password]|md5');
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('errors', validation_errors());
            
            $data['body'] = 'change_password';
            
            $this->controller->load_view($data);
        } else {
            if ($this->controller->checkSession()) {
                $data  = array(
                    'password' => $this->input->post('new_password', TRUE)
                );
                $where = array(
                    
                    'id' => $this->session->userdata('id')
                );
                $table = 'users';
                
                $result = $this->model->updateFields($table, $data, $where);
                redirect('admin/change_password', 'refresh');
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
        $port_data = $this->model->get_matching_record($table, $val);
        echo json_encode($port_data);
    }
    
        
    public function register($id = null, $user_role = null)
    {
        $role = $user_role;
        
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|alpha|min_length[2]');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|alpha|min_length[2]');
        $this->form_validation->set_rules('dob', 'Date Of Birth', 'trim|required');
        if (empty($id)) {
            $this->form_validation->set_rules('user_name', 'User Name', 'trim|required|is_unique[users.username]');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|alpha_numeric');
        }       
        
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('errors', validation_errors());
            $data['body']      = 'register';
            $data['user_role'] = "$role";
            $this->controller->load_view($data);
        } else {
            if ($this->controller->checkSession()) {
                $user_role   = $this->input->post('user_role');
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
                    $where = array(
                        'id' => $id
                    );
                    
                    unset($data['created_at']);
                    unset($data['email']);
                    unset($data['password']);
                    
                    $result = $this->model->updateFields('users', $data, $where);
                    
                } else {
                    $result = $this->model->insertData('users', $data);
                }
                $this->users_list($user_role);
            }
        }
    }
    
    
    
    
    
    public function users_list($user_role = null)
    {

        $where = array(
            'user_role ' => $user_role
        );
        
        $where1            = array(
            'role_id ' => $user_role
        );
        $data['users']     = $this->model->getAllwhere('users', $where);
        $data['user_role'] = $this->model->getAllwhere('user_role', $where1);
        $data['body']      = 'users_list';
        
        $this->controller->load_view($data);
    }
    
    
    public function subadmin_users_list($user_role)
    {
        $where = array(
            'user_role ' => $user_role
        );
        
        $where1            = array(
            'role_id ' => $user_role
        );
        $data['users']     = $this->model->getAllwhere('users', $where);
        $data['user_role'] = $this->model->getAllwhere('user_role', $where1);
        $data['body']      = 'subadmin_users_list';
        
        $this->controller->load_view($data);
    }
    
    public function assign_rights($id)
    {
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
        
    }
    
    public function addRights($id = null)
    {
        $actions = array(
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
        
        
        $data = array(
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
        $this->subadmin_users_list('4');
    }
    
    
    public function edit_user($id)
    {
        $where             = array(
            'id ' => $id
        );
        $where1            = array(
            'role_id >' => $this->session->userdata('user_role')
        );
        $data['user_role'] = $this->model->getAllwhere('user_role', $where1);
        $data['users']     = $this->model->getAllwhere('users', $where);
        $data['body']      = 'edit_user';
        $this->controller->load_view($data);
    }
    
    
    public function delete()
    {
        $id    = $this->input->post('id');
        $table = $this->input->post('table');
        $where = array(
            'id' => $id
        );
        $this->model->delete($table, $where);
    }
    
    public function change_status()
    {
        $id     = $this->input->post('id');
        $table  = $this->input->post('table');
        $where  = array(
            'id' => $id
        );
        $data   = array(
            'is_active' => 0
        );
        $result = $this->model->updateFields($table, $data, $where);
        
    }
        
    public function schedule()
    {
        $data['body']   = 'add_schedule';
        $where          = array('user_role' => 2);
        $data['doctor'] = $this->model->getAllwhere('users', $where);
        $this->controller->load_view($data);
    }
    
    public function addSchedule($id = null)
    {
        $data      = $this->input->post();
        $doctor_id = $data['doctor_id'];
        $new       = array();
        
        foreach ($data['schedule'] as $daykey => $day) {
            foreach ($data['starttime'] as $timekey => $time) {
                foreach ($data['endtime'] as $endkey => $end) {
                    $new[$daykey]['doctor_id']  = $doctor_id;
                    $new[$daykey]['day']        = $day;
                    $new[$daykey]['starttime']  = $time;
                    $new[$daykey]['endtime']    = $end;
                    $new[$daykey]['created_at'] = date('Y-m-d H:i:s');
                    
                }
            }
        }
        
        if (!empty($id)) {
            $where  = array(
                'doctor_id' => $doctor_id
            );
            $delete = $this->model->delete('schedule', $where);
            $result = $this->model->insertBatch('schedule', $new);
            
        } else {
            
            $result = $this->model->insertBatch('schedule', $new);
        }
        
        $this->session->set_flashdata("info_message", "schedule added Successfully..");
        redirect("admin/schedule");
    }
    
    
    public function list_schedule()
    {
        $data['body']         = 'list_schedule';
        $data['scheduleList'] = $this->Common_model->getSchedule('schedule');
        $this->controller->load_view($data);
    }
    
    
    public function edit_schedule($id)
    {
        $data['body']   = 'edit_schedule';
        $where          = array(
            'schedule.doctor_id' => $id
        );
        $where1         = array(
            'user_role' => 2
        );
        $data['doctor'] = $this->model->getAllwhere('users', $where1);
        
        $data['schedule'] = $this->model->GetJoinRecord('schedule', 'doctor_id', 'users', 'id', 'schedule.sc_id,schedule.doctor_id,schedule.day,schedule.starttime,schedule.endtime,users.first_name', $where);
        
        $this->controller->load_view($data);
        
    }
    
    public function delete_schedule()
    {
        $id    = $this->input->post('id');
        $where = array(
            'doctor_id' => $id
        );
        $this->model->delete('schedule', $where);
        
    }
    
    public function Appointment()
    {
        $data['body'] = 'add_appointment';
        
        $where  = array(
            'user_role' => 2
        );
        $wheres = array(
            'user_role ' => 3
        );
        
        $data['doctor']  = $this->model->getAllwhere('users', $where);
        $data['patient'] = $this->model->getAllwhere('users', $wheres);
        $this->controller->load_view($data);
    }
    
    public function addAppointment($id = null)
    {
        
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
            $data['body'] = 'add_appointment';
            
            $where  = array(
                'user_role' => 2
            );
            $wheres = array(
                'user_role ' => 3
            );
            
            $data['doctor']  = $this->model->getAllwhere('users', $where);
            $data['patient'] = $this->model->getAllwhere('users', $wheres);
            $this->controller->load_view($data);
        } else {
            
            if ($this->controller->checkSession()) {
                
                $data = $this->input->post();
                
                $data = array(
                    'appointment_id' => 'AP' . mt_rand(100000, 999999),
                    'patient_id' => $data['patient_id'],
                    'doctor_id' => $data['doctor_id'],
                    'appointment_date' => $data['appointment_date'],
                    'appointment_time' => $data['appointment_time'],
                    'problem' => $data['problem'],
                    'created_at' => date('Y-m-d H:i:s')
                );
                
                if (!empty($id)) {
                    
                    $where = array(
                        'ap_id' => $id
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
        }
    }
    
    
    public function appointment_list()
    {
        $where                   = array(
            'user_role' => 2
        );
        $data['appointmentList'] = $this->model->GetJoinRecord('appointment', 'doctor_id', 'users', 'id', '', $where);
        
        $data['body'] = 'list_appointment';
        $this->controller->load_view($data);
    }
    
    public function edit_appointment($id)
    {
        
        $where  = array(
            'user_role' => 2
        );
        $wheres = array(
            'user_role ' => 3
        );
        
        $data['doctor']  = $this->model->getAllwhere('users', $where);
        $data['patient'] = $this->model->getAllwhere('users', $wheres);
        
        $where1 = array(
            'ap_id ' => $id
        );
        
        $data['appointment'] = $this->model->GetJoinRecord('appointment', 'doctor_id', 'users', 'id', '', $where1);
        $data['body'] = 'edit_appointment';
        $this->controller->load_view($data);
    }
    
    
    public function delete_appointment()
    {
        $id    = $this->input->post('id');
        $where = array(
            'ap_id' => $id
        );
        $this->model->delete('appointment', $where);
    }
    
    public function profile()
    {
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
                    'blood_group' => $blood_group
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
                redirect('/admin/profile', 'refresh');
                
            }
        }
    }
    
    public function case_study($id = null)
    {
        $where           = array(
            'user_role' => 3
        );
        $data['patient'] = $this->model->getAllwhere('users', $where);
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
            if ($this->controller->checkSession()) {
                
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
                $this->case_study_list();
            }
        }
        
    }
    
    public function case_study_list()
    {
        $where                  = array(
            'doctor_id' => $this->session->userdata('id')
        );
        $field_val              = 'case_study.*,users.first_name,users.last_name';
        $data['documents_list'] = $this->model->GetJoinRecord('case_study', 'patient_id', 'users', 'id', $field_val, $where);
        $data['body']           = 'case_study_list';
        $this->controller->load_view($data);
    }
    
    
    public function notices($id = null)
    {
        
        $this->form_validation->set_rules('title', 'title', 'trim|required');
        $this->form_validation->set_rules('description', 'description', 'trim|required');
        
        if (empty($id)) {
            $this->form_validation->set_rules('title', 'title', 'trim|required');
            $this->form_validation->set_rules('description', 'description', 'trim|required');
        }
        
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('errors', validation_errors());
            $data['body'] = 'add_notice';
            
            if (!empty($id)) {
                $where           = array(
                    'id' => $id
                );
                $data['notices'] = $this->model->getAllwhere('notices', $where);
                
                $data['body'] = 'edit_notices';
            }
            
            $this->controller->load_view($data);
        } else {
            if ($this->controller->checkSession()) {
                
                $title       = $this->input->post('title');
                $description = $this->input->post('description');
                $start_date  = $this->input->post('start_date');
                $end_date    = $this->input->post('end_date');
                
                $data = array(
                    'title' => $title,
                    'description' => $description,
                    'start_date' => date('Y-m-d', strtotime($start_date)),
                    'end_date' => date('Y-m-d', strtotime($end_date)),
                    'created_at' => date('Y-m-d H:i:s')
                );
                
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
        }
    }
    
    public function notices_list()
    {
        $data['notice_list'] = $this->model->getAll('notices');
        $data['body']        = 'list_notice';
        
        $this->controller->load_view($data);
    }
    
    public function send_mail()
    {
        $where = array(
            'user_role != ' => $this->session->userdata('user_role')
        );
        $data['users'] = $this->model->getAllwhere('users', $where);
        $this->form_validation->set_rules('reciever_id', 'Mail to', 'trim|required');
        $this->form_validation->set_rules('subject', 'Subject', 'trim|required');
        $this->form_validation->set_rules('message', 'Message', 'trim|required');
        
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('errors', validation_errors());
            $data['body'] = 'send_message';
            $this->controller->load_view($data);
        } else {
            if ($this->controller->checkSession()) {
                
                $reciever_id = $this->input->post('reciever_id');
                $subject     = $this->input->post('subject');
                $message     = $this->input->post('message');
                
                $data = array(
                    'reciever_id' => $reciever_id,
                    'sender_id' => $this->session->userdata('id'),
                    'subject' => $subject,
                    'message' => trim($message),
                    'is_active' => 1,
                    'created_at' => date('Y-m-d H:i:s')
                );
                
                $config = Array(
                    'protocol' => 'smtp',
                    'smtp_host' => 'ssl://smtp.googlemail.com',
                    'smtp_port' => 465,
                    'smtp_user' => 'webdeskytechnical@gmail.com',
                    'smtp_pass' => 'webdesky@2017',
                    'mailtype' => 'html',
                    'charset' => 'iso-8859-1'
                );
                
                $this->load->library('email', $config);
                $this->email->set_newline("\r\n");
                $this->email->from($this->session->userdata('email'), "Admin Team");
                $this->email->to($reciever_id);
                $this->email->subject($subject);
                $this->email->message($message);
                
                // if($this->email->send()){     
                //     $error['message'] = "Mail sent...";   
                // }else{
                //     $error['message'] = show_error($this->email->print_debugger());
                // }
                
                $result = $this->model->insertData('mail', $data);
                $this->mail_list();
            }
        }
    }
    
    public function mail_list()
    {
        $where = array(
            'reciever_id' => $this->session->userdata('email'),
            'sender_id !=' => $this->session->userdata('id')
        );
        $field_val = 'mail.*,users.first_name,users.last_name';
        $data['mail_list'] = $this->model->GetJoinRecord('mail', 'sender_id', 'users', 'id', $field_val, $where);
        $data['body'] = 'message_list';
        $this->controller->load_view($data);
        
    }
    
    public function send_message()
    {
        $where = array(
            'user_role != ' => $this->session->userdata('user_role')
        );
        $data['users'] = $this->model->getAllwhere('users', $where);
        
        $this->form_validation->set_rules('reciever_id', 'Mail to', 'trim|required');
        $this->form_validation->set_rules('subject', 'Subject', 'trim|required');
        $this->form_validation->set_rules('message', 'Message', 'trim|required');
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('errors', validation_errors());
            $data['body'] = 'send_mail';
            $this->controller->load_view($data);
        } else {
            if ($this->controller->checkSession()) {
                
                $reciever_id = $this->input->post('reciever_id');
                $subject     = $this->input->post('subject');
                $message     = $this->input->post('message');
                
                $data = array(
                    'reciever_id' => $reciever_id,
                    'sender_id' => $this->session->userdata('id'),
                    'subject' => $subject,
                    'message' => trim($message),
                    'is_active' => 1,
                    'created_at' => date('Y-m-d H:i:s')
                );
                
                $result = $this->model->insertData('message', $data);
            }
        }
    }
    
    public function message_list()
    {
        $where = array(
            'reciever_id' => $this->session->userdata('id'),
            'sender_id !=' => $this->session->userdata('id')
        );
        
        $field_val = 'message.*,users.first_name,users.last_name';
        $data['messages_list'] = $this->model->GetJoinRecord('message', 'sender_id', 'users', 'id', $field_val, $where);
        $data['body'] = 'mail_list';
        $this->controller->load_view($data);
    }
    
    public function add_inventory($id = null)
    {
        $this->form_validation->set_rules('equipment_name', 'Equipment Name', 'trim|required');
        $this->form_validation->set_rules('no_of_equipment', 'No of Equipment', 'trim|required|numeric|xss_clean');
        
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('errors', validation_errors());
            $data['body'] = 'inventory';
            $this->controller->load_view($data);
        } else {
            if ($this->controller->checkSession()) {
                
                $equipment_name  = $this->input->post('equipment_name');
                $no_of_equipment = $this->input->post('no_of_equipment');
                $others          = $this->input->post('others');
                
                $data = array(
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
        }
    }
    
    public function inventory_list()
    {
        
        $field_val              = 'inventory.*,users.first_name,users.last_name';
        $where                  = array(
            'inventory.is_active' => 1
        );
        $data['inventory_list'] = $this->model->GetJoinRecord('inventory', 'doctor_id', 'users', 'id', $field_val, $where);
        $data['body']           = 'inventory_list';
        $this->controller->load_view($data);
        
    }
    
    public function edit_inventory($id)
    {
        $where             = array(
            'id' => $id
        );
        $data['inventory'] = $this->model->getAllwhere('inventory', $where);
        $data['body']      = 'edit_inventory';
        $this->controller->load_view($data);
        
    }
    
}
