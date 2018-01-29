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
       

     public function insertDoctor($id=null)
         {
        
         
                  if(empty($id)){
                  $this->form_validation->set_rules('doctor_fname', 'doctor_fname', 'trim|required');
                  $this->form_validation->set_rules('doctor_lname', 'doctor_lname', 'trim|required');
                  $this->form_validation->set_rules('doctor_email', 'doctor_email', 'trim|required');
                  $this->form_validation->set_rules('doctor_lname', 'doctor_lname', 'trim|required');

                  $this->form_validation->set_rules('doctor_mobile_no', 'doctor_mobile_no', 'trim|required');
                  $this->form_validation->set_rules('doctor_password', 'doctor_password', 'trim|required');
                    }
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
            if ($this->checkSession()) {
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
                    'user_role'=>$user_role,
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
                if(!empty($id)){
                    $where = array('id'=>$id);
                    unset($data['created_at']);
                    unset($data['email']);
                    unset($data['password']);
                    $result = $this->Common_model->updateFields('users', $data, $where);
                }else{
                     $result = $this->Common_model->insertData('users', $data);
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
        $data['users'] = $this->Common_model->getAllwhere('users', $where);
        $data['user_role'] = $this->Common_model->getAllwhere('user_role', $where1);
        $data['body'] = 'users_list';
        $this->load_view($data);
    }

    public function edit_user($id){
        $where             = array('id ' => $id);
        $where1            = array('role_id >' => $this->session->userdata('user_role'));
        $data['user_role'] = $this->Common_model->getAllwhere('user_role', $where1);
        $data['users']     = $this->Common_model->getAllwhere('users', $where);
        $data['body']      = 'edit_user';
        $this->load_view($data);
    }

    public function delete(){
        $id = $this->input->post('id');
        $where = array('id'=>$id);
        $this->Common_model->delete('users', $where);
    }


     public function delete_doctor(){
        $id = $this->input->post('id');
        $where = array('doctor_id'=>$id);
        $this->Common_model->delete('doctor', $where);
    }

    public function schedule(){
             $data['body'] = 'add_schedule';
             $data['doctor']=$this->Common_model->getAll('doctor');
            
             $this->load->view('common/templates/default', $data);
    }

    public function addSchedule($id=null){
                $data=$this->input->post();
                echo "<pre>";
                print_r($data);


    }

    public function Appointment(){
             $data['body'] = 'add_appointment';
                    
            $where             = array(
                    'user_role' => 2
                );
             $wheres            = array(
                  'user_role ' => 3
                );
            
             $data['doctor'] = $this->Common_model->getAllwhere('users', $where);
             $data['patient'] = $this->Common_model->getAllwhere('users', $wheres);
             
                
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
            $data['body'] = 'edit_appointment';
           
            $where             = array(
                    'user_role' => 2
                );
             $wheres            = array(
                  'user_role ' => 3
                );
            
             $data['doctor'] = $this->Common_model->getAllwhere('users', $where);
             $data['patient'] = $this->Common_model->getAllwhere('users', $wheres);

            $where1            = array('ap_id ' => $id);
            
            $data['appointment']=$this->Common_model->GetJoinRecord('appointment','doctor_id','users','id','' ,$where1);
             
                
             $this->load->view('common/templates/default', $data);
        } else {
            if ($this->checkSession()) {
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
                    $result = $this->Common_model->updateFields('appointment', $data, $where);
                }else{
                     $result = $this->Common_model->insertData('appointment', $data);
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
        $data['appointmentList'] =$this->Common_model->GetJoinRecord('appointment','doctor_id','users','id','' ,$where);
       
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
            
             $data['doctor'] = $this->Common_model->getAllwhere('users', $where);
             $data['patient'] = $this->Common_model->getAllwhere('users', $wheres);
       
              $where1            = array('ap_id ' => $id);
            
            $data['appointment']=$this->Common_model->GetJoinRecord('appointment','doctor_id','users','id','' ,$where1);
               
                $data['body']      = 'edit_appointment';
                $this->load_view($data);
    }


    public function delete_appointment(){
        $id = $this->input->post('id');
        $where = array('ap_id'=>$id);
        $this->Common_model->delete('appointment', $where);
    }


}