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
         if ($this->controller->checkSession()) {
            $data['body'] = 'add_doctor';
            $this->load_view($data);
        } else {
            $this->index();
        }
    }
    
      //   public function checkSession()
      
    
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
        $data=$this->input->post();
        $this->controller->verifylogin($data);
    }
    public function load_view($page_data)
    {
        $this->load->view('common/templates/default', $page_data);
    }
    
    public function dashboard()
    {
        if ($this->controller->checkSession()) {
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
        $result   = $this->model->getsingle('users', $where);
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

            $data['body'] = 'change_password';

            $this->load_view($data);
        } else {
            if ($this->controller->checkSession()) {
                $data   = array(
                    'password' => $this->input->post('new_password', TRUE)
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



     
    public function register($id=null)
    {        
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|alpha|min_length[2]');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|alpha|min_length[2]');
        if(empty($id)){
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|alpha_numeric');
        }
        
        $this->form_validation->set_rules('dob', 'Date Of Birth', 'trim|required');
        
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('errors', validation_errors());
            $data['body'] = 'register';
            $this->load_view($data);
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
    
        
    
    public function users_list(){
        $where             = array(
            'user_role >' => $this->session->userdata('user_role')
        );

        $where1             = array(
            'role_id >' => $this->session->userdata('user_role')
        );
        $data['users'] = $this->model->getAllwhere('users', $where);
        $data['user_role'] = $this->model->getAllwhere('user_role', $where1);
        $data['body'] = 'users_list';
        $this->load_view($data);
    }

    public function edit_user($id){
        $where             = array('id ' => $id);
        $where1            = array('role_id >' => $this->session->userdata('user_role'));
        $data['user_role'] = $this->model->getAllwhere('user_role', $where1);
        $data['users']     = $this->model->getAllwhere('users', $where);
        $data['body']      = 'edit_user';
        $this->load_view($data);
    }

    
    public function delete()
    {
        $id    = $this->input->post('id');
        $where = array(
            'id' => $id
        );
        $this->model->delete('users', $where);
    }



   
    public function schedule(){
             $data['body'] = 'add_schedule';
             $where = array(
                    'user_role' => 2
                );
             $data['doctor']=$this->model->getAllwhere('users',$where);
             

            
             $this->load->view('common/templates/default', $data);
    }

    public function addSchedule($id=null){
                $data=$this->input->post();
                $id=$data['doctor_id'];
                $new=[];
                foreach ($data['schedule'] as $daykey => $day) {
                   foreach ($data['starttime'] as $timekey => $time) {
                        foreach ($data['endtime'] as $endkey => $end) {
                          $new[$daykey]['doctor_id']=$id;
                          $new[$daykey]['day']=$day;
                          $new[$daykey]['starttime']=$time;
                          $new[$daykey]['endtime']=$end;
                          $new[$daykey]['created_at']=date('Y-m-d H:i:s');

                        }
                   }
                }

                if (!empty($id)) {

                    
                    unset($new['created_at']);
                  
                    $id = $this->model->updateBatch('schedule', $new, 'doctor_id');

                } else {
                   $id=  $this->model->insertBatch('schedule',$new);
                }
               
            //  $id=  $this->model->insertBatch('schedule',$new);
              if(!empty($id)){
                $this->session->set_flashdata("info_message","schedule added Successfully..");
                redirect("admin/schedule");
              }


    }


    public function list_schedule(){
            $data['body'] = 'list_schedule';
            $data['scheduleList'] = $this->Common_model->getSchedule('schedule');
            
            $this->load->view('common/templates/default', $data);
    }


    public function edit_schedule($id){
          $data['body'] = 'edit_schedule';
          $where             = array(
                    'doctor_id' => $id
                );
         $where1 = array(
                    'user_role' => 2
                );
             $data['doctor']=$this->model->getAllwhere('users',$where1);
          $data['schedule']=$this->model->GetJoinRecord('schedule','doctor_id','users','id','',$where);
          $this->load->view('common/templates/default', $data);

    }

    public function Appointment(){
             $data['body'] = 'add_appointment';
                    
            $where             = array(
                    'user_role' => 2
                );
             $wheres            = array(
                  'user_role ' => 3
                );
            
             $data['doctor'] = $this->model->getAllwhere('users', $where);
             $data['patient'] = $this->model->getAllwhere('users', $wheres);
             
                
             $this->load->view('common/templates/default', $data);
    }

    public function addAppointment($id=null){
        
            $this->form_validation->set_rules('patient_id', 'patient_id', 'trim|required');
            $this->form_validation->set_rules('doctor_id', 'doctor_id', 'trim|required');
            $this->form_validation->set_rules('appointment_date', 'appointment_date', 'trim|required');
            $this->form_validation->set_rules('appointment_time', 'appointment_time', 'trim|required');
            $this->form_validation->set_rules('problem', 'problem', 'trim|required');
           
            if(empty($id)){
            $this->form_validation->set_rules('patient_id', 'patient_id', 'trim|required');
            $this->form_validation->set_rules('doctor_id', 'doctor_id', 'trim|required');
            $this->form_validation->set_rules('appointment_date', 'appointment_date', 'trim|required');
            $this->form_validation->set_rules('appointment_time', 'appointment_time', 'trim|required');
            $this->form_validation->set_rules('problem', 'problem', 'trim|required');
                 }

            if ($this->form_validation->run() == false) {
            
            $this->session->set_flashdata('errors', validation_errors());
            $data['body'] = 'add_appointment';
           
            $where             = array(
                    'user_role' => 2
                );
             $wheres            = array(
                  'user_role ' => 3
                );
            
             $data['doctor'] = $this->model->getAllwhere('users', $where);
             $data['patient'] = $this->model->getAllwhere('users', $wheres);

          
             
                
             $this->load->view('common/templates/default', $data);
        } else {
           
            if ($this->controller->checkSession()) {

             $data=$this->input->post();
             
             $data = array(
                    'appointment_id'=>'AP'.mt_rand(100000, 999999),
                    'patient_id' => $data['patient_id'],
                    'doctor_id' => $data['doctor_id'],
                    'appointment_date' => $data['appointment_date'],
                    'appointment_time' =>$data['appointment_time'],
                    'problem' => $data['problem'],
                    'created_at' => date('Y-m-d H:i:s')
                );
                   
                if(!empty($id)){
                 
                    $where = array('ap_id'=>$id);
                    unset($data['created_at']);
                    unset($data['appointment_id']);
                    $result = $this->model->updateFields('appointment', $data, $where);
                }else{
                     $result = $this->model->insertData('appointment', $data);
                }
           
                $this->session->set_flashdata("info_message","Appointment updated Successfully..");
                redirect("admin/appointment_list");
            


         }
     }

    }


    public function appointment_list(){
         $where             = array(
                    'user_role' => 2
                );
        $data['appointmentList'] =$this->model->GetJoinRecord('appointment','doctor_id','users','id','' ,$where);
       
        $data['body'] = 'list_appointment';
        $this->load->view('common/templates/default', $data);
    }

    public function edit_appointment($id){

              $where             = array(
                    'user_role' => 2
                );
                 $wheres            = array(
                  'user_role ' => 3
                );
            
             $data['doctor'] = $this->model->getAllwhere('users', $where);
             $data['patient'] = $this->model->getAllwhere('users', $wheres);
       
              $where1            = array('ap_id ' => $id);
            
              $data['appointment']=$this->model->GetJoinRecord('appointment','doctor_id','users','id','' ,$where1);
               
                $data['body']      = 'edit_appointment';
                $this->load_view($data);
    }


    public function delete_appointment(){
        $id = $this->input->post('id');
        $where = array('ap_id'=>$id);
        $this->model->delete('appointment', $where);
    }




}
