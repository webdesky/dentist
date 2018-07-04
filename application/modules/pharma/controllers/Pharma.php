<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pharma extends CI_Controller
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
            $data['body']          = 'dashboard';
            $where4                = array(
                'reciever_id ' => $this->session->userdata('id')
            );
            $field_val             = 'message.*,users.first_name,users.last_name';
            $data['messages_list'] = $this->model->GetJoinRecord('message', 'sender_id', 'users', 'id', $field_val, $where4);
            
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
                $data  = array(
                    'password' => MD5($this->input->post('new_password', TRUE))
                );
                $where = array(
                    'id' => $this->session->userdata('id')
                );
                
                $table  = 'users';
                $result = $this->model->updateFields($table, $data, $where);
                redirect('pharma/change_password', 'refresh');
                
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
    
    
    
    public function profile()
    {
        
        if ($this->controller->checkSession()) {
            $where = array(
                'users.id' => $this->session->userdata('id')
            );
            //$where1            = array('doctor.doctor_id' => $this->session->userdata('id'));
            // $data['countries'] = $this->model->getall('countries');
            // $data['users']     = $this->model->GetJoinRecord('users', 'id', 'doctor', 'doctor_id', '', $where);
            // $data['category']  = $this->model->getAll('speciality');
            
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
                    
                    $user_role   = '5';
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
                    redirect('/pharma/profile', 'refresh');
                    
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
    
    
    public function send_message()
    {
        if ($this->controller->checkSession()) {
            $this->form_validation->set_rules('reciever_id[]', 'Message to', 'trim|required');
            $this->form_validation->set_rules('subject', 'Subject', 'trim|required');
            $this->form_validation->set_rules('message', 'Message', 'trim|required');
            
            if ($this->form_validation->run() == false) {
                $user_id          = $this->session->userdata('id');
                $where              = array(
                    'id' => $user_id
                );
                $field_val          = 'hospital_id';
                $hospitals          = $this->model->getAllwhere('users', $where, $field_val);
                $id                 = $hospitals[0]->hospital_id;
                $select             = 'id, first_name,last_name';
                $table              = 'users';
                $field              = 'hospital_id';
                $data['users_data'] = $this->Common_model->get_hospitals_by_id($id, $table, $select, $field);
                // echo $this->db->last_query(); 
                // die;
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
                'message.sender_id' => $this->session->id,
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
    
    
    
    
    
    public function notices_list()
    {
        if ($this->controller->checkSession()) {
            $this->db->select('notices.*,CONCAT(u.first_name," ", u.last_name) as sender_name');
            $this->db->from('notices');
            $this->db->join('users as u', "u.id=notices.added_by");
            $this->db->where("CURDATE() BETWEEN notices.start_date AND notices.end_date");
            $this->db->where('notices.is_active', 1);
            $this->db->where('notices.hospital_id', NULL);
            $query               = $this->db->get();
            $data['notice_list'] = $query->result();
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
                $select             = 'email, first_name,last_name,id';
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
                    redirect('pharma/mail_list');
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
    
    public function billing()
    {
        
    }
    
    public function medicine_category($id = NULL)
    {
        if ($this->controller->checkSession()) {
            $this->form_validation->set_rules('category_name', 'Category Name', 'trim|required|alpha|min_length[2]');
            $this->form_validation->set_rules('status', 'Status', 'trim|required');
            $where = array(
                'id' => $id
            );
            if ($this->form_validation->run() == false) {
                if (!empty($id)) {
                    
                    $data['medicine_category'] = $this->model->getAllwhere('medicine_category', $where);
                }
                $this->session->set_flashdata('errors', validation_errors());
                $data['body'] = 'medicine_category';
                $this->controller->load_view($data);
            } else {
                $category_name = $this->input->post('category_name');
                $status        = $this->input->post('status');
                $description   = $this->input->post('description');
                $data          = array(
                    'category_name' => $category_name,
                    'status' => $status,
                    'description' => $description,
                    'added_by' => $this->session->id,
                    'created_at' => date('Y-m-d H:i:s')
                );
                if (!empty($id)) {
                    unset($data['created_at']);
                    $result = $this->model->updateFields('medicine_category', $data, $where);
                } else {
                    $result = $this->model->insertData('medicine_category', $data);
                }
                redirect('pharma/medicine_category_list', 'refresh');
            }
        } else {
            redirect('admin/index');
        }
    }
    
    
    public function medicine_category_list()
    {
        if ($this->controller->checkSession()) {
            $id                        = $this->session->id;
            $where                     = array(
                'added_by' => $id
            );
            $data['medicine_category'] = $this->model->getAllwhere('medicine_category', $where);
            $data['body']              = 'medicine_category_list';
            $this->controller->load_view($data);
        } else {
            redirect('admin/index');
        }
    }
    
    public function add_billing($id = NULL)
    {
        
        $patient_id             = $this->input->post('patient_id');
        $patient_notes          = $this->input->post('patient_notes');
        $prescription_id        = $this->input->post('prescription_id');
        $medicine_name[]        = $this->input->post('medicine_name');
        $medicine_type[]        = $this->input->post('medicine_type');
        $medicine_instruction[] = $this->input->post('medicine_instruction');
        $medicine_days[]        = $this->input->post('medicine_days');
        
        if ($this->controller->checkSession()) {
            $where           = array(
                'user_role' => 3
            );
            $data['patient'] = $this->model->getAllwhere('users', $where);
            
            $this->form_validation->set_rules('patient_id', 'Patient', 'trim|required');
            $this->form_validation->set_rules('prescription_id', 'Prescription ID', 'trim|required|is_unique[billed_patient.prescription_code]');
            $this->form_validation->set_rules('medicine_name[]', 'Medicine Name', 'trim|required');
            $this->form_validation->set_rules('medicine_type[]', 'Medicine Type', 'trim|required');
            $this->form_validation->set_rules('medicine_instruction[]', 'Medicine Instruction', 'trim|required');
            $this->form_validation->set_rules('medicine_days[]', 'Medicine Days', 'trim|required');
            
            $where = array(
                'id' => $id
            );
            if ($this->form_validation->run() == false) {
                // if(!empty($id)){
                //     $data['medicine_category'] = $this->model->getAllwhere('medicine_category', $where);
                // }
                $this->session->set_flashdata('errors', validation_errors());
                $data['body'] = 'add_billing';
                $this->controller->load_view($data);
            } else {
                
                $patient_id      = $this->input->post('patient_id');
                $prescription_id = $this->input->post('prescription_id');
                $patient_notes   = $this->input->post('patient_notes');
                
                $medicine_name        = $this->input->post('medicine_name');
                $medicine_type        = $this->input->post('medicine_type');
                $medicine_instruction = $this->input->post('medicine_instruction');
                $medicine_days        = $this->input->post('medicine_days');
                
                $data = array(
                    'patient_id' => $patient_id,
                    'prescription_code' => $prescription_id,
                    'notes' => $patient_notes,
                    'added_by' => $this->session->id,
                    'created_at' => date('Y-m-d H:i:s'),
                    'is_active' => 1
                );
                
                
                if (!empty($id)) {
                    unset($data['created_at']);
                    $result = $this->model->updateFields('billed_patient', $data, $where);
                } else {
                    $result = $this->model->insertData('billed_patient', $data);
                    
                    if (!empty($medicine_name[0])) {
                        
                        $medicine_type        = $this->input->post('medicine_type');
                        $medicine_instruction = $this->input->post('medicine_instruction');
                        $medicine_days        = $this->input->post('medicine_days');
                        
                        if (!empty($id)) {
                            // $where = array(
                            //     'prescription_id' => $id
                            // );
                            // $this->model->delete('medicine', $where);
                        }
                        for ($i = 0; $i < count($medicine_name); $i++) {
                            $data1[] = array(
                                'prescription_id' => $result,
                                'medicine_name' => $medicine_name[$i],
                                'medicine_type' => $medicine_type[$i],
                                'instruction' => $medicine_instruction[$i],
                                'days' => $medicine_days[$i],
                                'is_active' => 1,
                                'created_at' => date('Y-m-d H:i:s')
                            );
                            
                        }
                        $medicine = $this->model->insertBatch('prescribed_medicine', $data1);
                    }
                }
                redirect('pharma/add_billing', 'refresh');
            }
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
            $patient_list = $this->model->getAllwhere('users', $where, 'id,gender,date(date_of_birth) as date_of_birth,address', 'DESC');
            echo json_encode($patient_list, TRUE);
        } else {
            redirect('admin/index');
        }
    }
    
    
    public function list_billing()
    {
        if ($this->controller->checkSession()) {
            $id       = $this->session->id;
            $where    = array(
                'billed_patient.added_by' => $id
            );
            $group_by = array(
                'billed_patient.prescription_code'
            );
            //$data['billing'] = $this->model->GetJoinRecord('billed_patient', 'id', 'prescribed_medicine', 'prescription_id', '', $where, $group_by);
            
            $data['billing'] = $this->model->getAllwhere('billed_patient', $where);
            $data['body']    = 'list_billing';
            $this->controller->load_view($data);
        } else {
            redirect('admin/index');
        }
    }
    
    public function view_medicine_category($id = NULL)
    {
        if ($this->controller->checkSession()) {
            $where                = array('prescribed_medicine.prescription_id' => $id);
            $field_val            = 'CONCAT(users.first_name," ", users.last_name) as patient_name , users.date_of_birth , users.gender, billed_patient.* ,prescribed_medicine.*';
            $data['prescription'] = $this->model->GetJoinRecordNew('billed_patient', 'patient_id', 'id', 'users', 'id', 'prescribed_medicine', 'prescription_id', 'id', $id, $field_val);
            $where1               = array('prescription_id' => $id);
            $data['body']         = 'view_prescription';
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
                if ($this->controller->checkSession()) {
                    
                    $equipment_name  = $this->input->post('equipment_name');
                    $no_of_equipment = $this->input->post('no_of_equipment');
                    $others          = $this->input->post('others');
                    
                    $data = array(
                        'doctor_id' => $this->session->id,
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
                'doctor_id' => $this->session->id
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
            $where  =  array('doctor_id' => $this->session->id,'id' => $id);
            $data['inventory'] = $this->model->getAllwhere('inventory', $where);
            $data['body']      = 'edit_inventory';
            $this->controller->load_view($data);
        } else {
            redirect('admin/index');
        }
    }  
}