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
    
    
    public function dashboard()
    {
        if ($this->controller->checkSession()) {
            $data['body'] = 'dashboard';
            $where        = array(
                'is_active' => 1,
                'doctor_id' => $this->session->userdata('id')
            );
            $where3       = array(
                'user_role' => 2,
                'doctor_id' => $this->session->userdata('id')
            );
            $where4       = array(
                
                'reciever_id ' => $this->session->userdata('id')
            );
            
            $field_val                = 'message.*,users.first_name,users.last_name';
            $data['messages_list']    = $this->model->GetJoinRecord('message', 'sender_id', 'users', 'id', $field_val, $where4);
            $data['totalAppointment'] = $this->model->getcount('appointment', $where);
            $data['appointmentList']  = $this->model->GetJoinRecord('appointment', 'doctor_id', 'users', 'id', '', $where3);
            
            $this->controller->load_view($data);
        } else {
            $this->index();
        }
    }
    
    public function change_password()
    {
        if ($this->controller->checkSession()) {
            $this->form_validation->set_rules('old_password', 'Old Password', 'trim|required|callback_oldpass_check');
            $this->form_validation->set_rules('new_password', 'New Password', 'trim|required|md5');
            $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|matches[new_password]|md5');
            if ($this->form_validation->run() == false) {
                $this->session->set_flashdata('errors', validation_errors());
                $data['body'] = 'change_password';
                $this->controller->load_view($data);
            } else {
                $data   = array('password' => $this->input->post('new_password', TRUE));
                $where  = array('id' => $this->session->userdata('id'));
                $table  = 'admins';
                $result = $this->model->updateFields($table, $data, $where);
                redirect('doctor/change_password', 'refresh');
            }
        } else {
            redirect('admin/index');
        }
    }
    public function oldpass_check($oldpass)
    {
        if ($this->controller->checkSession()) {
            $user_id = $this->session->userdata('id');
            $result  = $this->model->check_oldpassword($oldpass, $user_id);
            if ($result == 0) {
                $this->form_validation->set_message('oldpass_check', "%s does not match.");
                return FALSE;
            } else {
                $this->session->set_flashdata('success_msg', 'Password successfully updated!!!');
                return TRUE;
            }
        } else {
            redirect('admin/index');
        }
    }
    
    
    
    public function Appointment()
    {
        if ($this->controller->checkSession()) 
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
        } else {
            redirect('admin/index');
        }
    }
    
    public function addAppointment($id = null)
    {
        if ($this->controller->checkSession()) {
            $this->form_validation->set_rules('patient_id', 'patient_id', 'trim|required');
            $this->form_validation->set_rules('appointment_date', 'appointment_date', 'trim|required');
            $this->form_validation->set_rules('appointment_time', 'appointment_time', 'trim|required');
            if (empty($id)) {
                $this->form_validation->set_rules('patient_id', 'patient_id', 'trim|required');
                $this->form_validation->set_rules('appointment_date', 'appointment_date', 'trim|required');
                $this->form_validation->set_rules('appointment_time', 'appointment_time', 'trim|required');
                $this->form_validation->set_rules('problem', 'problem', 'trim|required');
            }
            
            if ($this->form_validation->run() == false) {
                
                $this->session->set_flashdata('errors', validation_errors());
                $data['body'] = 'add_appointment';
                
                $where  = array('user_role' => 2);
                $wheres = array('user_role ' => 3);
                
                $data['doctor']  = $this->model->getAllwhere('users', $where);
                $data['patient'] = $this->model->getAllwhere('users', $wheres);
                
                $this->controller->load_view($data);
            } else {
                
                if ($this->controller->checkSession()) {
                    
                    $data = $this->input->post();
                    $data = array(
                                'appointment_id'    =>  'AP'.mt_rand(100000, 999999),
                                'patient_id'        =>  $data['patient_id'],
                                'doctor_id'         =>  $data['doctor_id'],
                                'appointment_date'  =>  $data['appointment_date'],
                                'appointment_time'  =>  $data['appointment_time'],
                                'problem'           =>  $data['problem'],
                                'created_at'        =>  date('Y-m-d H:i:s')
                            );
                    
                    if (!empty($id)) {
                        $where = array('id' => $id);
                        unset($data['created_at']);
                        unset($data['appointment_id']);
                        $result = $this->model->updateFields('appointment', $data, $where);
                    } else {
                        $result = $this->model->insertData('appointment', $data);
                    }
                    
                    $this->session->set_flashdata("info_message", "Appointment updated Successfully..");
                    redirect("doctor/appointment_list");
                }
            }
        } else {
            redirect('admin/index');
        }
    }
    
    public function appointment_list()
    {
        if ($this->controller->checkSession()) {
            $where       = array(
                'doctor_id' => $this->session->userdata('id'),
                'appointment_date >=' => date('Y-m-d')
            );
            $field_val   = 'appointment.appointment_id,appointment.id,appointment.appointment_date,appointment.appointment_time,users.first_name,users.last_name,appointment.hospital_id,appointment.is_active';
            $appointment = $this->model->GetJoinRecord('appointment', 'patient_id', 'users', 'id', $field_val, $where);
            if (!empty($appointment)) {
                foreach ($appointment as $key => $value) {
                    $hospital_name                    = $this->model->getAllwhere('hospitals', array(
                        'id' => $value->hospital_id
                    ), 'hospital_name');
                    $appointment[$key]->hospital_name = $hospital_name[0]->hospital_name;
                }
            }
            $data['appointmentList'] = $appointment;
            $data['body']            = 'list_appointment';
            $this->controller->load_view($data);
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
                'user_role ' => 3
            );
            
            $data['doctor']  = $this->model->getAllwhere('users', $where);
            $data['patient'] = $this->model->getAllwhere('users', $wheres);
            
            $where1 = array(
                'appointment.id ' => $id
            );
            
            $appointment = $this->model->GetJoinRecord('appointment', 'doctor_id', 'users', 'id', 'appointment.id,appointment.appointment_id,appointment.hospital_id,appointment.appointment_date,appointment.appointment_time,appointment.appointment_type,users.first_name,users.last_name,appointment.patient_id,appointment.doctor_id,appointment.problem', $where1);
            if (!empty($appointment)) {
                $hospital_name                 = $this->model->getAllwhere('hospitals', array(
                    'id' => $appointment[0]->hospital_id
                ), 'hospital_name');
                $appointment[0]->hospital_name = $hospital_name[0]->hospital_name;
            }
            $data['appointment'] = $appointment;
            $data['body']        = 'edit_appointment';
            
            $this->controller->load_view($data);
        } else {
            redirect('admin/index');
        }
    }
    
    
    public function delete_appointment()
    {
        if ($this->controller->checkSession()) {
            $id    = $this->input->post('id');
            $where = array(
                'ap_id' => $id
            );
            $this->model->delete('appointment', $where);
        } else {
            redirect('admin/index');
        }
    }
    
    
    public function register($id = null)
    {
        if ($this->controller->checkSession()) {
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
                    $username    = $this->input->post('user_name');
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
                        'username' => $username,
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
                            if ($_FILES['image']['error'] == 0) {
                                if (move_uploaded_file($_FILES['image']['tmp_name'], 'asset/uploads/' . $_FILES['image']['name'])) {
                                    
                                    $data['profile_pic'] = $_FILES['image']['name'];
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
                    $this->users_list();
                }
            }
        } else {
            redirect('admin/index');
        }
    }
    
    public function users_list()
    {
        if ($this->controller->checkSession()) {
            $where  = array(
                'user_role >' => $this->session->userdata('user_role'),
                'user_role !=' => '4'
            );
            $where1 = array(
                'role_id >' => $this->session->userdata('user_role'),
                'role_id !=' => '4'
            );
            
            $data['users']     = $this->model->getAllwhere('users', $where);
            $data['user_role'] = $this->model->getAllwhere('user_role', $where1);
            
            $data['body'] = 'users_list';
            $this->controller->load_view($data);
        } else {
            redirect('admin/index');
        }
    }
    
    public function edit_user($id)
    {
        if ($this->controller->checkSession()) {
            $where  = array(
                'id ' => $id
            );
            $where1 = array(
                'role_id >' => $this->session->userdata('user_role')
            );
            
            $data['user_role'] = $this->model->getAllwhere('user_role', $where1);
            $data['users']     = $this->model->getAllwhere('users', $where);
            $data['body']      = 'edit_user';
            $this->controller->load_view($data);
        } else {
            redirect('admin/index');
        }
    }
    
    public function profile()
    {
        if ($this->controller->checkSession()) {
            $where            = array(
                'users.id' => $this->session->userdata('id')
            );
            $where1           = array(
                'doctor.doctor_id' => $this->session->userdata('id')
            );
            $data['users']    = $this->model->GetJoinRecord('users', 'id', 'doctor', 'doctor_id', '', $where);
            $data['category'] = $this->model->getAll('speciality');
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
                    
                    $data = $this->input->post();
                    
                    $user_role            = '3';
                    $first_name           = $this->input->post('first_name');
                    $last_name            = $this->input->post('last_name');
                    $email                = $this->input->post('email');
                    $address              = $this->input->post('address');
                    $phone_no             = $this->input->post('phone');
                    $mobile_no            = $this->input->post('mobile');
                    $dob                  = $this->input->post('date_of_birth');
                    $gender               = $this->input->post('gender');
                    $blood_group          = $this->input->post('blood_group');
                    $category             = $this->input->post('category');
                    $specialization       = $this->input->post('specialization');
                    $registration         = $this->input->post('registration');
                    $registration_number  = $this->input->post('registration_number');
                    $registration_council = $this->input->post('registration_council');
                    $registration_year    = $this->input->post('registration_year');
                    $degree               = $this->input->post('degree');
                    $college              = $this->input->post('college');
                    $completion_year      = $this->input->post('completion_year');
                    $experience           = $this->input->post('experience');
                    $city                 = $this->input->post('city');
                    $consultancy_fees     = $this->input->post('consultancy_fees');
                    $consultancy_time     = $this->input->post('consultancy_time');
                    
                    
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
                    
                    
                    $data1 = array(
                        'category' => $category,
                        'specialization' => $specialization,
                        'registration' => $registration,
                        'registration_number' => $registration_number,
                        'registration_council' => $registration_council,
                        'registration_year' => $registration_year,
                        'degree' => $degree,
                        'college' => $college,
                        'completion_year' => $completion_year,
                        'experience' => $experience,
                        'city' => $city,
                        'consultancy_time' => $consultancy_time,
                        'consultancy_fees' => $consultancy_fees
                        
                    );
                    
                    
                    if (isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])) {
                        if (move_uploaded_file($_FILES['image']['tmp_name'], 'asset/uploads/' . $_FILES['image']['name'])) {
                            
                            $data['profile_pic'] = $_FILES['image']['name'];
                        }
                    }
                    
                    $result  = $this->model->updateFields('users', $data, $where);
                    $result1 = $this->model->updateFields('doctor', $data1, $where1);
                    redirect('/doctor/profile', 'refresh');
                    
                }
            }
        } else {
            redirect('admin/index');
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
    
    public function add_document($id = null)
    {
        if ($this->controller->checkSession()) {
            $wheres          = array(
                'user_role ' => 3
            );
            $data['patient'] = $this->model->getAllwhere('users', $wheres);
            
            if (!empty($id)) {
                $where             = array(
                    'id ' => $id
                );
                $data['documents'] = $this->model->getAllwhere('documents', $where);
            }
            
            $this->form_validation->set_rules('patient_id', 'Patient Name', 'trim|required');
            if (empty($_FILES['file']['name']) && empty($id)) {
                $this->form_validation->set_rules('file', 'Attach File', 'required');
            }
            $this->form_validation->set_rules('description', 'Description', 'trim|required');
            
            if ($this->form_validation->run() == false) {
                $this->session->set_flashdata('errors', validation_errors());
                $data['body'] = 'add_document';
                $this->controller->load_view($data);
            } else {
                if ($this->controller->checkSession()) {
                    $patient_id  = $this->input->post('patient_id');
                    $description = $this->input->post('description');
                    $doctor_id   = $this->session->userdata('id');
                    
                    $data = array(
                        'patient_id' => $patient_id,
                        'description' => $description,
                        'doctor_id' => $doctor_id,
                        'is_active' => 1,
                        'created_at' => date('Y-m-d H:i:s')
                    );
                    
                    
                    if (isset($_FILES['file']['name']) && !empty($_FILES['file']['name'])) {
                        if ($_FILES['file']['error'] == 0) {
                            $f_extension = explode('.', $_FILES['file']['name']); //To breaks the string into array
                            $f_extension = strtolower(end($f_extension)); //end() is used to retrun a last element to the array
                            $f_newfile   = "";
                            
                            if ($_FILES['file']['name']) {
                                $f_newfile    = uniqid() . '.' . $f_extension;
                                $store        = "asset/uploads/" . $f_newfile;
                                $image        = move_uploaded_file($_FILES['file']['tmp_name'], $store);
                                $data['file'] = $f_newfile;
                                
                            }
                        }
                    }
                    if (!empty($id)) {
                        $where = array(
                            'id' => $id
                        );
                        unset($data['created_at']);
                        $result = $this->model->updateFields('documents', $data, $where);
                    } else {
                        $result = $this->model->insertData('documents', $data);
                    }
                    $this->document_list();
                }
            }
        } else {
            redirect('admin/index');
        }
        
    }
    
    public function document_list()
    {
        if ($this->controller->checkSession()) {
            $where                  = array(
                'doctor_id' => $this->session->userdata('id')
            );
            $field_val              = "documents.id as did,users.first_name,documents.description,documents.file,users.id,users.last_name";
            $data['documents_list'] = $this->model->GetJoinRecord('documents', 'patient_id', 'users', 'id', $field_val, $where);
            
            $data['body'] = 'document_list';
            $this->controller->load_view($data);
        } else {
            redirect('admin/index');
        }
    }
    
    public function edit_documents($id)
    {
        if ($this->controller->checkSession()) {
            $wheres            = array(
                'user_role ' => 3
            );
            $data['patient']   = $this->model->getAllwhere('users', $wheres);
            $where             = array(
                'documents.id' => $id
            );
            $field_val         = "documents.id as did,users.first_name,documents.description,documents.file,users.id,users.last_name";
            $data['documents'] = $this->model->GetJoinRecord('documents', 'patient_id', 'users', 'id', $field_val, $where);
            $data['body']      = 'edit_document';
            $this->controller->load_view($data);
        } else {
            redirect('admin/index');
        }
        
    }
    
    public function case_study($id = null)
    {
        if ($this->controller->checkSession()) {
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
        } else {
            redirect('admin/index');
        }
        
    }
    
    public function case_study_list()
    {
        if ($this->controller->checkSession()) {
            $where                  = array(
                'doctor_id' => $this->session->userdata('id')
            );
            $field_val              = 'case_study.*,users.first_name,users.last_name';
            $data['documents_list'] = $this->model->GetJoinRecord('case_study', 'patient_id', 'users', 'id', $field_val, $where);
            $data['body']           = 'case_study_list';
            $this->controller->load_view($data);
        } else {
            redirect('admin/index');
        }
    }
    
    public function send_message()
    {
        if ($this->controller->checkSession()) {
            $this->form_validation->set_rules('reciever_id[]', 'Message to', 'trim|required');
            $this->form_validation->set_rules('subject', 'Subject', 'trim|required');
            $this->form_validation->set_rules('message', 'Message', 'trim|required');
            if ($this->form_validation->run() == false) {
                $doctor_id          = $this->session->userdata('id');
                $where              = array(
                    'id' => $doctor_id
                );
                $field_val          = 'hospital_id';
                $hospitals          = $this->model->getAllwhere('users', $where, $field_val);
                $id                 = $hospitals[0]->hospital_id;
                $select             = 'id, first_name,last_name';
                $table              = 'users';
                $field              = 'hospital_id';
                $data['users_data'] = $this->Common_model->get_hospitals_by_id($id, $table, $select, $field);
                $this->session->set_flashdata('errors', validation_errors());
                $data['body'] = 'send_message';
                $this->controller->load_view($data);
            } else {
                if ($this->controller->checkSession()) {
                    $reciever_id = $this->input->post('reciever_id');
                    $subject     = $this->input->post('subject');
                    $message     = $this->input->post('message');
                    
                    for ($i = 0; $i < count($reciever_id); $i++) {
                        $data[] = array(
                            'reciever_id' => $reciever_id[$i],
                            'sender_id' => $this->session->userdata('id'),
                            'subject' => $subject,
                            'message' => trim($message),
                            'is_active' => 1,
                            'created_at' => date('Y-m-d H:i:s')
                        );
                    }
                    $this->db->insert_batch('message', $data);
                    redirect('doctor/message_list');
                }
            }
        } else {
            redirect('admin/index');
        }
    }
    
    public function message_list()
    {
        if ($this->controller->checkSession()) {
            $where                 = array(
                'message.sender_id' => $this->session->userdata('id'),
                'message.created_at >=' => date('Y-m-d H:i:s')
            );
            $field_val             = 'message.subject,message.message,message.created_at as message_date,users.first_name,users.last_name';
            $data['messages_list'] = $this->model->GetJoinRecord('message', 'reciever_id', 'users', 'id', $field_val, $where, '', 'message_date', 'DESC');
            $data['body']          = 'message_list';
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
    
    
    public function add_prescription($id = null)
    {
        if ($this->controller->checkSession()) {
            $this->form_validation->set_rules('patient_id', 'Patient Name', 'trim|required');
            $this->form_validation->set_rules('blood_pressure', 'High Blood Pressure', 'trim|required');
            $this->form_validation->set_rules('weight', 'Weight', 'trim|required');
            
            if ($this->form_validation->run() == false) {
                $this->session->set_flashdata('errors', validation_errors());
                $where             = array(
                    'user_role' => 3
                );
                $data['patient']   = $this->model->getAllwhere('users', $where);
                $id                = $this->session->userdata('hospital_id');
                $select            = 'id,hospital_name,address';
                $data['hospitals'] = $this->Common_model->get_hospitals_by_id($id, 'hospitals', $select, 'id');
                $data['body']      = 'add_prescription';
                $this->controller->load_view($data);
            } else {
                if ($this->controller->checkSession()) {
                    //echo '<pre>'; print_r($_POST);die;
                    $patient_id     = $this->input->post('patient_id');
                    $hospital_id    = $this->input->post('hospital_id');
                    $appointment_id = $this->input->post('appointment_id');
                    $weight         = $this->input->post('weight');
                    $blood_pressure = $this->input->post('blood_pressure');
                    $reference      = $this->input->post('reference_by');
                    $patient_type   = $this->input->post('patient_type');
                    $patient_notes  = $this->input->post('patient_notes');
                    $visiting_fees  = $this->input->post('visiting_fees');
                    $chief_complain = $this->input->post('chief_complain');
                    $medicine_name  = $this->input->post('medicine_name');
                    $diagnosis_name = $this->input->post('diagnosis_name');
                    
                    $data = array(
                        'patient_id' => $patient_id,
                        'doctor_id' => $this->session->userdata('id'),
                        'hospital_id' => $hospital_id,
                        'appointment_id' => $appointment_id,
                        'weight' => $weight,
                        'blood_pressure' => $blood_pressure,
                        'reference' => $reference,
                        'type' => $patient_type,
                        'patient_note' => $patient_notes,
                        'chief_complain' => $chief_complain,
                        'visiting_fee' => $visiting_fees,
                        'is_active' => 1,
                        'created_at' => date('Y-m-d H:i:s')
                    );
                    if (!empty($id)) {
                        $where = array(
                            'id' => $id
                        );
                        unset($data['created_at']);
                        $result = $this->model->updateFields('prescription', $data, $where);
                    } else {
                        $result = $this->model->insertData('prescription', $data);
                        $where  = array(
                            'appointment_id' => $appointment_id
                        );
                        $data   = array(
                            'is_active' => 0
                        );
                        $this->model->updateFields('appointment', $data, $where);
                        
                        if (!empty($medicine_name[0])) {
                            
                            $medicine_type        = $this->input->post('medicine_type');
                            $medicine_instruction = $this->input->post('medicine_instruction');
                            $medicine_days        = $this->input->post('medicine_days');
                            
                            if (!empty($id)) {
                                $where = array(
                                    'prescription_id' => $id
                                );
                                $this->model->delete('medicine', $where);
                            }
                            for ($i = 0; $i < count($medicine_name); $i++) {
                                $data     = array(
                                    'patient_id' => $patient_id,
                                    'doctor_id' => $this->session->userdata('id'),
                                    'prescription_id' => $result,
                                    'medicine_name' => $medicine_name[$i],
                                    'medicine_type' => $medicine_type[$i],
                                    'instruction' => $medicine_instruction[$i],
                                    'days' => $medicine_days[$i],
                                    'is_active' => 1,
                                    'created_at' => date('Y-m-d H:i:s')
                                );
                                $medicine = $this->model->insertData('medicine', $data);
                            }
                        }
                        
                        if (!empty($diagnosis_name[0])) {
                            $diagnosis_instruction = $this->input->post('diagnosis_instruction');
                            
                            if (!empty($id)) {
                                $where = array(
                                    'prescription_id' => $id
                                );
                                $this->model->delete('diagnosis', $where);
                            }
                            
                            for ($i = 0; $i < count($diagnosis_name); $i++) {
                                $data      = array(
                                    'patient_id' => $patient_id,
                                    'prescription_id' => $result,
                                    'doctor_id' => $this->session->userdata('id'),
                                    'diagnosis' => $diagnosis_name[$i],
                                    'instruction' => $diagnosis_instruction[$i],
                                    'is_active' => 1,
                                    'created_at' => date('Y-m-d H:i:s')
                                );
                                $diagnosis = $this->model->insertData('diagnosis', $data);
                            }
                        }
                    }
                    redirect('doctor/prescription_list');
                }
            }
        } else {
            redirect('admin/index');
        }
    }
    
    public function prescription_list()
    {
        if ($this->controller->checkSession()) {
            $where                     = array(
                'doctor_id' => $this->session->userdata('id')
            );
            $field_val                 = 'prescription.*, users.first_name,users.last_name';
            $data['prescription_list'] = $this->model->GetJoinRecord('prescription', 'patient_id', 'users', 'id', $field_val, $where);
            
            if (!empty($data['prescription_list'])) {
                foreach ($data['prescription_list'] as $key => $value) {
                    $prescription_id = $data['prescription_list'][$key]->id;
                    $wherer1         = array(
                        'prescription_id' => $prescription_id,
                        'is_active' => 1
                    );
                    $review          = $this->model->getAllwhere('review', $wherer1);
                    if (!empty($review[0]->id)) {
                        $data['prescription_list'][$key]->review_id = $review[0]->id;
                    }
                }
            }
            $data['body'] = 'prescription_list';
            $this->controller->load_view($data);
        } else {
            redirect('admin/index');
        }
    }
    
    
    public function notices_list()
    {
        if ($this->controller->checkSession()) {
            $this->db->select('notices.*,CONCAT(u.first_name," ", u.last_name) as sender_name');
            $this->db->from('notices');
            $this->db->join('users as u',"u.id=notices.added_by");
            $this->db->where("CURDATE() BETWEEN notices.start_date AND notices.end_date");
            $this->db->where('notices.is_active' , 1);
            $this->db->where('notices.hospital_id' , NULL);
            $query               =   $this->db->get();
            $data['notice_list'] =   $query->result();
            $data['body']        = 'list_notice';
            $this->controller->load_view($data);
        } else {
            redirect('admin/index');
        }
    }
    
    public function send_mail()
    {
        if ($this->controller->checkSession()) {
            $this->form_validation->set_rules('reciever_id[]', 'Mail to', 'trim|required');
            $this->form_validation->set_rules('subject', 'Subject', 'trim|required');
            $this->form_validation->set_rules('message', 'Message', 'trim|required');
            
            if ($this->form_validation->run() == false) {
                $doctor_id          = $this->session->userdata('id');
                $where              = array(
                    'id' => $doctor_id
                );
                $field_val          = 'hospital_id';
                $hospitals          = $this->model->getAllwhere('users', $where, $field_val);
                $id                 = $hospitals[0]->hospital_id;
                $select             = 'email, first_name,last_name';
                $table              = 'users';
                $field              = 'hospital_id';
                $data['users_data'] = $this->Common_model->get_hospitals_by_id($id, $table, $select, $field);
                $this->session->set_flashdata('errors', validation_errors());
                $data['body'] = 'send_mail';
                $this->controller->load_view($data);
            } else {
                if ($this->controller->checkSession()) {
                    
                    $reciever_id = $this->input->post('reciever_id');
                    $subject     = $this->input->post('subject');
                    $message     = $this->input->post('message');
                    
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
                    for ($i = 0; $i < count($reciever_id); $i++) {
                        $data[] = array(
                            'reciever_id' => $reciever_id[$i],
                            'sender_id' => $this->session->userdata('id'),
                            'subject' => $subject,
                            'message' => trim($message),
                            'is_active' => 1,
                            'created_at' => date('Y-m-d H:i:s')
                        );
                        $this->email->from($this->session->userdata('email'), "Admin Team");
                        $this->email->to($reciever_id[$i]);
                        $this->email->subject($subject);
                        $this->email->message($message);
                    }
                    
                    $this->db->insert_batch('mail', $data);
                    redirect('doctor/mail_list');
                }
            }
        } else {
            redirect('admin/index');
        }
    }
    
    public function mail_list()
    {
        if ($this->controller->checkSession()) {
            $where             = array(
                'mail.sender_id' => $this->session->userdata('id')
            );
            $field_val         = 'mail.id,mail.subject,mail.message,mail.created_at as mail_date,users.first_name,users.last_name';
            $data['mail_list'] = $this->model->GetJoinRecord('mail', 'reciever_id', 'users', 'email', $field_val, $where, '', 'mail_date', 'DESC');
            $data['body']      = 'mail_list';
            $this->controller->load_view($data);
        } else {
            redirect('admin/index');
        }
    }
    
    public function mail_list_me()
    {
        if ($this->controller->checkSession()) {
            $where             = array(
                'reciever_id' => $this->session->userdata('email')
            );
            $field_val         = 'mail.*,users.first_name,users.last_name';
            $data['mail_list'] = $this->model->GetJoinRecord('mail', 'sender_id', 'users', 'id', $field_val, $where);
            $data['body']      = 'message_to_me';
            $this->controller->load_view($data);
        } else {
            redirect('admin/index');
        }
    }
    
    public function get_user()
    {
        if ($this->controller->checkSession()) {
            $where        = array(
                'id' => $this->input->post('id'),
                'is_active' => 1
            );
            $patient_list = $this->model->getAllwhere('users', $where, 'id,first_name,last_name,gender,date(date_of_birth) as date_of_birth', 'DESC');
            echo json_encode($patient_list, TRUE);
        } else {
            redirect('admin/index');
        }
    }
    
    public function view_prescription($id = null)
    {
        if ($this->controller->checkSession()) {
            
            $where                = array(
                'prescription.id' => $id
            );
            $field_val            = 'prescription.*,users.first_name,users.last_name,users.date_of_birth,users.gender,hospitals.hospital_name,hospitals.address';
            $data['prescription'] = $this->model->GetJoinRecordNew('prescription', 'patient_id', 'hospital_id', 'users', 'id', 'hospitals', 'id', 'id', $id, $field_val);
            $where1               = array(
                'prescription_id' => $id
            );
            $data['medicine']     = $this->model->getAllwhere('medicine', $where1, '*', 'DESC');
            $data['diagnosis']    = $this->model->getAllwhere('diagnosis', $where1, '*', 'DESC');
            $data['body']         = 'view_prescription';
            $this->controller->load_view($data);
        } else {
            redirect('admin/index');
        }
    }
    
    
    public function edit_prescription($id = null)
    {
        if ($this->controller->checkSession()) {
            $where                = array(
                'prescription.id' => $id
            );
            $field_val            = 'prescription.*,users.first_name,users.last_name,users.date_of_birth,users.gender';
            $data['prescription'] = $this->model->GetJoinRecord('prescription', 'patient_id', 'users', 'id', $field_val, $where);
            $where1               = array(
                'prescription_id' => $id
            );
            $data['medicine']     = $this->model->getAllwhere('medicine', $where1, '', 'DESC');
            $data['diagnosis']    = $this->model->getAllwhere('diagnosis', $where1, 'id', 'DESC');
            $data['body']         = 'edit_prescription';
            $this->controller->load_view($data);
        } else {
            redirect('admin/index');
        }
    }
    
    public function delete_prescription()
    {
        if ($this->controller->checkSession()) {
            $id = $this->input->post('id');
            $this->Common_model->multiple_delete($id);
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
        } else {
            redirect('admin/index');
        }
    }
    
    public function inventory_list()
    {
        if ($this->controller->checkSession()) {
            $where                  = array(
                'doctor_id' => $this->session->userdata('id')
            );
            $data['inventory_list'] = $this->model->getAllwhere('inventory', $where, 'id', 'DESC');
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
                'doctor_id' => $this->session->userdata('id'),
                'id' => $id
            );
            $data['inventory'] = $this->model->getAllwhere('inventory', $where);
            $data['body']      = 'edit_inventory';
            $this->controller->load_view($data);
        } else {
            redirect('admin/index');
        }
        
    }
    
    
    public function schedule()
    {
        if ($this->controller->checkSession()) {
            $doctor_id             = $this->session->userdata('id');
            $where                 = array(
                'id' => $doctor_id
            );
            $field_val             = 'hospital_id';
            $hospitals             = $this->model->getAllwhere('users', $where, $field_val);
            $id                    = $hospitals[0]->hospital_id;
            $select                = 'id, hospital_name';
            $table                 = 'hospitals';
            $field                 = 'id';
            $data['hospital_data'] = $this->Common_model->get_hospitals_by_id($id, $table, $select, $field);
            $data['body']          = 'add_schedule';
            $this->controller->load_view($data);
        } else {
            redirect('admin/index');
        }
    }
    
    public function addSchedule($id = null)
    {
        if ($this->controller->checkSession()) {
            $data      = $this->input->post();
            $doctor_id = $this->session->userdata('id');
            $new       = array();
            foreach ($data['schedule'] as $daykey => $day) {
                foreach ($data['starttime'] as $timekey => $time) {
                    foreach ($data['endtime'] as $endkey => $end) {
                        $new[$daykey]['doctor_id']   = $this->session->userdata('id');
                        $new[$daykey]['day']         = $day;
                        $new[$daykey]['hospital_id'] = $this->input->post('hospital_id');
                        $new[$daykey]['starttime']   = $time;
                        $new[$daykey]['endtime']     = $end;
                        $new[$daykey]['created_at']  = date('Y-m-d H:i:s');
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
            redirect("doctor/list_schedule");
        } else {
            redirect('admin/index');
        }
    }
    
    
    public function list_schedule()
    {
        if ($this->controller->checkSession()) {
            $data['body']         = 'list_schedule';
            $doctor_id            = $this->session->userdata('id');
            $data['scheduleList'] = $this->Common_model->getSchedule('schedule', $doctor_id);
            $this->controller->load_view($data);
        } else {
            redirect('admin/index');
        }
    }
    
    
    public function edit_schedule($id)
    {
        if ($this->controller->checkSession()) {
            $data['body']     = 'edit_schedule';
            $where            = array(
                'schedule.doctor_id' => $id
            );
            $where1           = array(
                'user_role' => 2
            );
            $data['doctor']   = $this->model->getAllwhere('users', $where1);
            $data['schedule'] = $this->model->GetJoinRecord('schedule', 'doctor_id', 'users', 'id', 'schedule.sc_id,schedule.doctor_id,schedule.day,schedule.starttime,schedule.endtime,users.first_name', $where);
            $this->controller->load_view($data);
        } else {
            redirect('admin/index');
        }
    }
    
    public function get_schedule()
    {
        if ($this->controller->checkSession()) {
            $doctor_id        = $this->input->post('doctor_id');
            $appointment_time = $this->input->post('appointment_time');
            $appointment_date = $this->input->post('appointment_date');
            $hospital_id      = $this->input->post('hospital_id');
            $day              = date('l', strtotime($appointment_date));
            $where            = array(
                'doctor_id' => $doctor_id
            );
            $field_val        = 'UCASE(schedule.day) as day,schedule.starttime,schedule.endtime';
            $data             = $this->model->getAllwhere('schedule', $where, $field_val);
            // echo $this->db->last_query(); 
            // die;
            print_r(json_encode($data));
        } else {
            redirect('admin/index');
        }
        
    }
    
    public function get_time()
    {
        if ($this->controller->checkSession()) {
            $doctor_id        = $this->input->post('doctor_id');
            $appointment_date = $this->input->post('appointment_date');
            $day              = date('l', strtotime($appointment_date));
            
            $where     = array(
                'doctor_id' => $doctor_id,
                'appointment_date' => $appointment_date
            );
            $field_val = 'appointment_time';
            $data      = $this->model->getAllwhere('appointment', $where, '', '', $field_val);
            print_r(json_encode($data));
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
    
    public function view_review($id)
    {
        if ($this->controller->checkSession()) {
            $where          = array(
                'prescription_id ' => $id
            );
            $data['review'] = $this->model->getAllwhere('review', $where);
            $doctor_id      = $data['review'][0]->doctor_id;
            $patient_id     = $data['review'][0]->patient_id;
            $where1         = array(
                'id ' => $doctor_id
            );
            $select         = 'first_name';
            $data['doctor'] = $this->model->getAllwhere('users', $where1, $select);
            $data['body']   = 'view_review';
            
            $this->controller->load_view($data);
        } else {
            redirect('admin/index');
        }
    }
}