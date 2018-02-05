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
        $this->form_validation->set_rules('appointment_date', 'appointment_date', 'trim|required');
        $this->form_validation->set_rules('appointment_time', 'appointment_time', 'trim|required');
        $this->form_validation->set_rules('problem', 'problem', 'trim|required');
        
        if (empty($id)) {
            $this->form_validation->set_rules('patient_id', 'patient_id', 'trim|required');
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
        $this->load_view($data);
    }
    
    
    public function delete_appointment()
    {
        $id    = $this->input->post('id');
        $where = array(
            'ap_id' => $id
        );
        $this->model->delete('appointment', $where);
    }
    
    
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
    }
    
    public function users_list()
    {
        $where  = array(
            'user_role >' => $this->session->userdata('user_role')
        );
        $where1 = array(
            'role_id >' => $this->session->userdata('user_role')
        );
        
        $data['users']     = $this->model->getAllwhere('users', $where);
        $data['user_role'] = $this->model->getAllwhere('user_role', $where1);
        
        $data['body'] = 'users_list';
        $this->controller->load_view($data);
    }
    
    public function edit_user($id)
    {
        $where  = array(
            'id ' => $id
        );
        $where1 = array(
            'role_id >' => $this->session->userdata('user_role')
        );
        
        $data['user_role'] = $this->model->getAllwhere('user_role', $where1);
        $data['users']     = $this->model->getAllwhere('users', $where);
        
        $data['body'] = 'edit_user';
        $this->controller->load_view($data);
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
    
    public function add_document($id = null)
    {
        $wheres          = array(
            'user_role ' => 3
        );
        $data['patient'] = $this->model->getAllwhere('users', $wheres);
        $this->form_validation->set_rules('patient_id', 'Patient Name', 'trim|required');
        if (empty($_FILES['file']['name'])) {
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
                    if ($_FILES['file']['error'][$i] == 0) {
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
        
    }
    
    public function document_list()
    {
        $where                  = array(
            'doctor_id' => $this->session->userdata('id')
        );
        $data['documents_list'] = $this->model->GetJoinRecord('documents', 'patient_id', 'users', 'id', '', $where);
        $data['body']           = 'document_list';
        $this->controller->load_view($data);
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
    
    public function send_message()
    {
        $data['users'] = $this->model->getAllwhere('users');
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
        $where                 = array(
            'sender_id' => $this->session->userdata('id')
        );
        $field_val             = 'message.*,users.first_name,users.last_name';
        $data['messages_list'] = $this->model->GetJoinRecord('message', 'reciever_id', 'users', 'id', $field_val, $where);
        $data['body']          = 'mail_list';
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
    
    
    public function add_prescription($id = null)
    {

        $where = array(
            'doctor_id' => $this->session->userdata('id'),
            'is_active' => 1
        );
        
        $data['patient'] = $this->model->getAllwhere('appointment', $where, 'ap_id', 'DESC', 'patient_id,appointment_id');
        
        $this->form_validation->set_rules('patient_id', 'Patient Name', 'trim|required');
        $this->form_validation->set_rules('blood_pressure', 'High Blood Pressure', 'trim|required');
        $this->form_validation->set_rules('weight', 'Weight', 'trim|required');
        
        if ($this->form_validation->run() == false) {
            
            $this->session->set_flashdata('errors', validation_errors());
            $data['body'] = 'add_prescription';
            $this->controller->load_view($data);
            
        } else {
            if ($this->controller->checkSession()) {
                
                $patient_id     = $this->input->post('patient_id');
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
                    $result = $this->model->updateFields('appointment', $data, $where);
                    
                }
                
                
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
                        $data = array(
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
                        $data = array(
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
                
                $this->prescription_list();
            }
        }
        
    }
    
    public function prescription_list()
    {
        $where                     = array(
            'doctor_id' => $this->session->userdata('id')
        );
        $field_val                 = 'prescription.*, users.first_name,users.last_name';
        $data['prescription_list'] = $this->model->GetJoinRecord('prescription', 'patient_id', 'users', 'id', $field_val, $where);
        $data['body']              = 'prescription_list';
        $this->controller->load_view($data);
    }
    
    
    public function notices_list()
    {
        $where               = array(
            'is_active' => 1
        );
        $data['notice_list'] = $this->model->getAllwhere('notices', $where, 'id', 'DESC');
        $data['body']        = 'list_notice';
        $this->controller->load_view($data);
    }
    
    public function send_mail()
    {
        $data['users'] = $this->model->getAllwhere('users');
        
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
        $where             = array(
            'sender_id' => $this->session->userdata('id')
        );
        $data['mail_list'] = $this->model->getAllwhere('mail', $where, 'id', 'DESC');
        $data['body']      = 'message_list';
        $this->controller->load_view($data);
        
    }
    
    public function mail_list_me()
    {
        
        $where             = array(
            'reciever_id' => $this->session->userdata('email')
        );
        $field_val         = 'mail.*,users.first_name,users.last_name';
        $data['mail_list'] = $this->model->GetJoinRecord('mail', 'sender_id', 'users', 'id', $field_val, $where);
        $data['body']      = 'message_to_me';
        $this->controller->load_view($data);
    }
    
    public function get_user()
    {
        $where        = array(
            'id' => $this->input->post('id'),
            'is_active' => 1
        );
        $patient_list = $this->model->getAllwhere('users', $where, 'id', 'DESC');
        echo json_encode($patient_list, TRUE);
    }
    
    public function view_prescription($id = null)
    {
        
        $where = array(
            'prescription.id' => $id
        );
        
        $field_val = 'prescription.*,users.first_name,users.last_name,users.date_of_birth,users.gender';
        
        $data['prescription'] = $this->model->GetJoinRecord('prescription', 'patient_id', 'users', 'id', $field_val, $where);
        
        $where1 = array(
            'prescription_id' => $id
        );
        
        $data['medicine'] = $this->model->getAllwhere('medicine', $where1, 'id', 'DESC');
        
        $data['diagnosis'] = $this->model->getAllwhere('diagnosis', $where1, 'id', 'DESC');
        
        $data['body'] = 'view_prescription';
        
        $this->controller->load_view($data);
    }
    
    
    public function edit_prescription($id = null)
    {
        
        $where = array(
            'prescription.id' => $id
        );
        
        $field_val = 'prescription.*,users.first_name,users.last_name,users.date_of_birth,users.gender';
        
        $data['prescription'] = $this->model->GetJoinRecord('prescription', 'patient_id', 'users', 'id', $field_val, $where);
        
        $where1 = array(
            'prescription_id' => $id
        );
        
        $data['medicine'] = $this->model->getAllwhere('medicine', $where1, 'id', 'DESC');
        
        $data['diagnosis'] = $this->model->getAllwhere('diagnosis', $where1, 'id', 'DESC');
        
        $data['body'] = 'edit_prescription';
        
        $this->controller->load_view($data);
        
    }

    public function delete_prescription(){
        $id = $this->input->post('id');
        $this->Common_model->multiple_delete($id);

    }

    public function add_inventory($id=null){
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
                                'equipment_name'=>$equipment_name,
                                'no_of_equipment'=>$no_of_equipment,
                                'others'=>$others,
                                'is_active'=>1,
                                'created_at'=>date('Y-m-d H:i:s')
                            );

                if (!empty($id)) {
                    $where = array(
                        'id' => $id
                    );
                    unset($data['created_at']);
                    $result = $this->model->updateFields('inventory', $data, $where);
                }else{
                    $result = $this->model->insertData('inventory', $data);
                }

                $this->inventory_list();

            }
        }
    }

    public function inventory_list(){
        $where             = array(
            'doctor_id' => $this->session->userdata('id')
        );
        $data['inventory_list'] = $this->model->getAllwhere('inventory', $where, 'id', 'DESC');
        $data['body']      = 'inventory_list';
        $this->controller->load_view($data);

    }

    public function edit_inventory($id){
        $where             = array('doctor_id' => $this->session->userdata('id'),'id'=>$id);
        $data['inventory'] = $this->model->getAllwhere('inventory', $where);
        $data['body']      = 'edit_inventory';
        $this->controller->load_view($data);

    }
    
}