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
            $data['body']              = 'dashboard';
            $where                     = array(
                'is_active' => 1
            );
            $where4                    = array(
                'sender_id' => $this->session->userdata('id')
            );
            $field_val                 = 'message.*,users.first_name,users.last_name';
            $data['messages_list']     = $this->model->GetJoinRecord('message', 'reciever_id', 'users', 'id', $field_val, $where4);
            $data['totalAppointment']  = $this->model->getcount('appointment', $where);
            $data['total_users_count'] = $this->Common_model->get_user_count();
            $data['totalHospital']     = $this->model->getcount('hospitals', $where);
            $field_val1                = 'cs.appointment_id,cs.appointment_type,cs.appointment_date,cs.appointment_time,us.first_name as doctor_name, u.first_name as patient_name';
            $data['appointmentList']   = $this->Common_model->get_Patient_Doctor_Record('appointment', $field_val1);
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
        $this->form_validation->set_rules('old_password', 'Old Password', 'trim|required');
        $this->form_validation->set_rules('new_password', 'New Password', 'trim|required');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required');
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('errors', validation_errors());
            $data['body'] = 'change_password';
            $this->controller->load_view($data);
        } else {
            if ($this->controller->checkSession()) {
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
            if ($role == 2) {
                $this->form_validation->set_rules('specialization', 'Specialization', 'trim|required');
            }
        }
        
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('errors', validation_errors());
            if ($id !== 'null') {
                $this->edit_user($id);
            } else {
                $where             = array(
                    'is_active' => 1
                );
                $data['countries'] = $this->model->getall('countries');
                $data['category']  = $this->model->getAllwhere('speciality', $where);
                $field_val         = 'id,hospital_name,other_speciality';
                $data['hospitals'] = $this->model->getAllwhere('hospitals', $where, $field_val);
                $data['body']      = 'register';
                $data['user_role'] = "$role";
                $this->controller->load_view($data);
            }
        } else {
            if ($this->controller->checkSession()) {
                if (empty($id)) {
                    $user_role = $this->input->post('user_role');
                } else {
                    $user_role = $role;
                }
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
                if ($user_role == 2) {
                    $specialization = $this->input->post('specialization');
                }
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
                if (!empty($id)) {
                    $where = array(
                        'id' => $id
                    );
                    unset($data['created_at']);
                    unset($data['email']);
                    unset($data['password']);
                    $result = $this->model->updateFields('users', $data, $where);
                } else {
                    if ($user_role == 2) {
                        $data['hospital_id'] = $this->input->post('hospitals_id');
                    }
                    $result = $this->model->insertData('users', $data);
                    if ($user_role == 2) {
                        $data = array(
                            'doctor_id' => $result,
                            'city' => $this->input->post('specialization'),
                            'specialization' => $specialization,
                            'is_active' => $status,
                            'created_at' => date('Y-m-d H:i:s')
                        );
                        $data = $this->model->insertData('doctor', $data);
                    }
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
        
        $where1 = array(
            'role_id ' => $user_role
        );
        
        $data['role']      = $user_role;
        $data['category']  = $this->model->getAll('category');
        $data['users']     = $this->model->getAllwhere('users', $where);
        $data['user_role'] = $this->model->getAllwhere('user_role', $where1);
        $data['body']      = 'users_list';
        
        $this->controller->load_view($data);
    }
    public function subadmin_users_list($user_role)
    {
        $where             = array(
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
        $where         = array(
            'id ' => $id
        );
        $data['users'] = $this->model->getAllwhere('users', $where);
        if ($data['users'][0]->user_role == 2) {
            $field_val         = 'id,hospital_name';
            $data['hospitals'] = $this->model->getAllwhere('hospitals', '', $field_val);
            $where             = array(
                'doctor_id ' => $id
            );
            $field_val         = 'specialization';
            $data['doctor']    = $this->model->getAllwhere('doctor', $where, $field_val);
        }
        $data['body'] = 'edit_user';
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
    public function delete_hospital_from_user()
    {
        $id    = $this->input->post('id');
        $table = $this->input->post('table');
        $where = array(
            'hospital_id' => $id
        );
        $this->model->delete($table, $where);
        echo $this->db->last_query();
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
        $data['body']      = 'add_schedule';
        $field_val         = 'id,hospital_name';
        $data['hospitals'] = $this->model->getAllwhere('hospitals', '', $field_val);
        $this->controller->load_view($data);
    }
    public function addSchedule($id = null)
    {
        $this->form_validation->set_rules('doctor_id', 'Doctor Name', 'trim|required');
        $where              =  array('doctor_id' =>$this->input->post('doctor_id'),'hospital_id!=' => $this->input->post('hospital_id'));
        $schedule_record    = $this->model->getAllwhere('schedule', $where);
        if ($this->form_validation->run() == false) {
            $this->schedule();
        }elseif(!empty($schedule_record)){
            $doctor_id      =   $this->input->post('doctor_id');
            $hospital_id    =   $this->input->post('hospital_id');
            $schedule       =   $this->input->post('schedule');
            $starttime      =   $this->input->post('starttime');
            $endtime        =   $this->input->post('endtime');
            for ($i = 0; $i < count($schedule); $i++) { 
               
                if(!empty($starttime[$i]) && !empty($schedule[$i]) && !empty($endtime[$i])){
                    $where              =   array("doctor_id" =>$doctor_id,"hospital_id !=" =>$hospital_id,"day" => $schedule[$i],"starttime >="=>$starttime[$i],'endtime <=' => $endtime[$i]);
                    $schedule_record    =   $this->model->getAllwhere('schedule', $where);
                    //echo $this->db->last_query(); 
                    if(!empty($schedule_record)){
                        $this->session->set_flashdata("info_message", "Schedule already added for this day and time.. Please try another");
                        redirect("admin/schedule");
                    }
                }
            }
        } else {
            $doctor_id   = $this->input->post('doctor_id');
            $hospital_id = $this->input->post('hospital_id');
            $schedule    = $this->input->post('schedule');
            $starttime   = $this->input->post('starttime');
            $endtime     = $this->input->post('endtime');
            if(!empty($schedule)){
                for ($i = 0; $i < count($schedule); $i++) {
                    $data[$i]['day']         = $schedule[$i];
                    $data[$i]['starttime']   = $starttime[$i];
                    $data[$i]['endtime']     = $endtime[$i];
                    $data[$i]['created_at']  = date('Y-m-d H:i:s');
                    $data[$i]['doctor_id']   = $doctor_id;
                    $data[$i]['hospital_id'] = $hospital_id;
                }
                if (!empty($id)) {
                    $where  = array('doctor_id' => $doctor_id,'hospital_id'=>$hospital_id);
                    $delete = $this->model->delete('schedule', $where);
                }
                $result = $this->model->insertBatch('schedule', $data);
                $this->session->set_flashdata("info_message", "Schedule Added Successfully..");
                redirect("admin/schedule");
            }
        }
    }
    public function list_schedule()
    {
        $data['body']         = 'list_schedule';
        $data['scheduleList'] = $this->Common_model->getSchedule('schedule');
        $this->controller->load_view($data);
    }
    public function edit_schedule($id, $hospital_id)
    {
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
        $data['body']      = 'add_appointment';
        $wheres            = array(
            'user_role' => 3
        );
        $data['patient']   = $this->model->getAllwhere('users', $wheres);
        $field_val         = 'id,hospital_name';
        $data['hospitals'] = $this->model->getAllwhere('hospitals', '', $field_val);
        $this->controller->load_view($data);
        
        
        // $data['result'] = $this->Common_model->get_Patient_Doctor_Record('appointment');
        // $data['body'] = 'add_appointment';
        // $field_val         = 'id,hospital_name';
        // $data['hospitals'] = $this->model->getAllwhere('hospitals', '', $field_val);
        // $this->controller->load_view($data);
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
            
            if ($this->controller->checkSession()) {
                $data = $this->input->post();
                $data = array(
                                'appointment_type'  =>  $data['appointment_type'],
                                'appointment_id'    =>  'AP' . mt_rand(100000, 999999),
                                'patient_id'        =>  $data['patient_id'],
                                'doctor_id'         =>  $data['doctor_id'],
                                'appointment_date'  =>  $data['appointment_date'],
                                'appointment_time'  =>  $data['appointment_time'],
                                'problem'           =>  $data['problem'],
                                'created_at'        =>  date('Y-m-d H:i:s')
                            );
                
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
        }
    }
    public function appointment_list()

    {
        $where                   = array(
            'user_role' => 2
        );
        $data['appointmentList'] = $this->model->GetJoinRecord('appointment', 'doctor_id', 'users', 'id', 'appointment.id  as ap_id,appointment.appointment_id,appointment.appointment_time,appointment.appointment_date,users.first_name,users.last_name,appointment.is_active,appointment.appointment_type,appointment.patient_id', $where);
        
        $data['body'] = 'list_appointment';

        $this->controller->load_view($data);
    }
    public function update_status()
    {
        $id     = $this->input->post('id');
        $active = $this->input->post('active');
        $data   = array(
            'is_active' => $active
        );
        $where  = array(
            'ap_id' => $id
        );
        $this->model->update('appointment', $data, $where);
    }
    public function edit_appointment($id)
    {

        
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
        
        $data['appointment'] = $this->model->GetJoinRecord('appointment', 'doctor_id', 'users', 'id', 'appointment.id as ap_id,appointment.appointment_id,appointment.appointment_date,appointment.appointment_time,appointment.problem,appointment.appointment_type,appointment.patient_id,appointment.doctor_id', $where1);
        $data['body']        = 'edit_appointment';

      
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
                    /*$count = count($_FILES['image']['name']);
                    for ($i = 0; $i < $count; $i++) {
                    if ($_FILES['image']['error'][$i] == 0) {
                    if (move_uploaded_file($_FILES['image']['tmp_name'][$i], 'asset/uploads/' . $_FILES['image']['name'][$i])) {
                    >>>>>>> a8efd675ac5c56fadf558494c61425a84d8344de
                    
                    $data['profile_pic'] = $_FILES['image']['name'][$i];
                    }
                    }
                    }*/
                }
                
                $result = $this->model->updateFields('users', $data, $where);
                
                
                redirect('/admin/profile', 'refresh');
                
            }
        }
    }
    public function case_study($id = null)
    {
        $where             = array(
            'user_role' => 3
        );
        $field_val         = 'id,hospital_name';
        $data['hospitals'] = $this->model->getAllwhere('hospitals', '', $field_val);
        $data['patient']   = $this->model->getAllwhere('users', $where);
        
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
                $this->case_study_list();
            }
        }
    }
    public function case_study_list()
    {
        $where     = array(
            'doctor_id' => $this->session->userdata('id')
        );
        $field_val = 'case_study.*,users.first_name,users.last_name';
        
        $data['documents_list'] = $this->model->GetJoinRecord('case_study', 'patient_id', 'users', 'id', $field_val,'');
        
        $data['body'] = 'case_study_list';
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
                $data['body']    = 'edit_notices';
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
        $where         = array(
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
                    'smtp_user' => 'webdeskytechnical@gmail.com',
                    'smtp_pass' => 'webdesky@2017',
                    'mailtype' => 'html',
                    'charset' => 'iso-8859-1',
                    'newline' => "\r\n"
                );
                
                $this->load->library('email', $config_mail);
                $this->email->set_mailtype("html");
                $this->email->set_newline("\r\n");
                $this->email->from($this->session->userdata('email'), "Admin Team");
                $this->email->to($reciever_id);
                $this->email->subject($subject);
                $this->email->message($message);
                
                if (!$this->email->send()) {
                    show_error($this->email->print_debugger());
                }
                
                $result = $this->model->insertData('mail', $data);
                $this->mail_list();
            }
        }
    }
    public function mail_list()
    {
        $where             = array(
            'sender_id =' => $this->session->userdata('id')
        );
        $field_val         = 'mail.*,users.first_name,users.last_name';
        $data['mail_list'] = $this->model->GetJoinRecord('mail', 'reciever_id', 'users', 'id', $field_val, $where);
        $data['body']      = 'mail_list';
        $this->controller->load_view($data);
    }
    public function send_message()
    {
        $where         = array(
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
                $sender_id   = $this->session->userdata('id');
                
                $data = array(
                    'reciever_id' => $reciever_id,
                    'sender_id' => $sender_id,
                    'subject' => $subject,
                    'message' => trim($message),
                    'is_active' => 1,
                    'created_at' => date('Y-m-d H:i:s')
                );
                
                $result = $this->model->insertData('message', $data);
                $this->message_list();
            }
        }
    }
    public function message_list()
    {
        $where = array(
            'sender_id ' => $this->session->userdata('id')
        );
        
        $field_val             = 'message.*,users.first_name,users.last_name';
        $data['messages_list'] = $this->model->GetJoinRecord('message', 'reciever_id', 'users', 'id', $field_val, $where);
        $data['body']          = 'message_list';
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
            
            if ($this->controller->checkSession()) {
                
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
                
                $data  = array(
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
                $this->hospitals_list();
            }
        }
    }
    
    
    public function hospitals_list()
    {
        $data['hospitals_list'] = $this->model->getAll('hospitals');
        $data['body']           = 'hospitals_list';
        $this->controller->load_view($data);
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
            $field      => $id,
            'user_role' => 2,
            'is_active' => 1
        );
        $states = $this->model->find_record($table, $where, $select);
        echo json_encode($states);
    }
    public function get_schedule()
    {
        $doctor_id        = $this->input->post('doctor_id');
        $appointment_time = $this->input->post('appointment_time');
        $appointment_date = $this->input->post('appointment_date');
<<<<<<< HEAD
        $hospital_id      = $this->input->post('hospital_id');
=======
>>>>>>> 7147e0b2d0f1ebb838fc947e07576441d380e4f6
        $day              = date('l', strtotime($appointment_date));
        if(!empty($hospital_id)){
        $where            = array('doctor_id' => $doctor_id,'hospital_id'=>$hospital_id);
        }else{
        $where            = array('doctor_id' => $doctor_id);
        }
        $data             = $this->model->GetJoinRecord('schedule','hospital_id','hospitals','id','', $where);
       
        print_r(json_encode($data));
    }

    public function check_schedule(){
       $doctor_id        = $this->input->post('doctor_id');
       $date             = $this->input->post('date');
       $starttime        = $this->input->post('starttime');
       $endtime          = $this->input->post('endtime');
    }

    public function get_time()
    {
        $doctor_id        = $this->input->post('doctor_id');
        $appointment_date = $this->input->post('appointment_date');
        $day              = date('l', strtotime($appointment_date));
        $hospital_id      = $this->input->post('hospital_id');
        $where     = array(
            'doctor_id'        => $doctor_id,
            'appointment_date' => $appointment_date,
            'hospital_id'      => $hospital_id
        );
        $field_val = 'appointment_time';
        $data      = $this->model->getAllwhere('appointment', $where, '', '', $field_val);
        print_r(json_encode($data));
    }
    public function review_list()
    {
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
    }
    public function view_review($id)
    {
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
    }
    public function update_review()
    {
        $id     = $this->input->post('id');
        $active = $this->input->post('active');
        $data   = array(
            'is_active' => $active
        );
        $where  = array(
            'id' => $id
        );
        $this->model->update('review', $data, $where);
    }
    public function speciality($id = NULL)
    {
        $this->form_validation->set_rules('speciality_name', 'Speciality Name', 'trim|required');
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
            if ($this->controller->checkSession()) {
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
                $this->speciality_list();
            }
        }
    }
    
    public function speciality_list()
    {
        $data['speciality'] = $this->model->getAll('speciality');
        $data['body']       = 'speciality_list';
        $this->controller->load_view($data);
    }
    
    public function get_speciality_by_hospital()
    {
        if (!empty($this->input->get('id'))) {
            $id   = explode(",", str_replace(" ", "", trim($this->input->get('id'))));
            $data = $this->Common_model->find_records('speciality', $id);
            print_r(json_encode($data));
        }
    }
    public function assign_doctor()
    {
        $where             = array('user_role' => 2,'is_active' => 1);
        $where1            = array('is_active' => 1);
        $field_val1        = 'id,hospital_name';
        $field_val         = 'id,first_name,last_name';
        $data['doctors']   = $this->model->getAllwhere('users', $where, $field_val);
        $data['hospitals'] = $this->model->getAllwhere('hospitals', $where1, $field_val1);
        $data['body']      = 'assign_doctor';
        $this->controller->load_view($data);
    }
    public function get_hospitals()
    {
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
    }
    public function assign_hospital()
    {
        $this->form_validation->set_rules('hospital_ids[]', 'Hospitals', 'trim|required');
        $this->form_validation->set_rules('doctor_id', 'Doctor', 'trim|required');
        if($this->form_validation->run() == false) {
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
            $this->schedule();
        }
    }
}