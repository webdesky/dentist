<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Common_model extends CI_Model
{
    
    public function getSchedule($table)
    {
        $this->db->select("s.id, s.doctor_id,s.hospital_id,u.first_name, GROUP_CONCAT(s.day SEPARATOR ',') as Days");
        $this->db->from("schedule s");
        $this->db->join("users u", "u.id = s.doctor_id");
        $this->db->group_by("s.doctor_id");
        $q        = $this->db->get();
        //echo $this->db->last_query();die;
        $num_rows = $q->num_rows();
        if ($num_rows > 0) {
            foreach ($q->result() as $rows) {
                $data[] = $rows;
            }
            $q->free_result();
            return $data;
        } else {
            
        }
    }
    
    public function get_Patient_Doctor_Record($table,$field_val,$where=null)
    {
        $this->db->select("$field_val");
        $this->db->from("$table as cs");
        $this->db->join('users as u',"u.id=cs.patient_id");
        $this->db->join('users as us',"us.id=cs.doctor_id");
        if($where!=''){
            $this->db->where($where);
        }
        $q = $this->db->get();
        $num_rows = $q->num_rows();
        if ($num_rows > 0) {
            foreach ($q->result() as $rows) {
                $data[] = $rows;
            }
            $q->free_result();
            return $data;
        } else {
            
        }
    }

    public function find_records($table,$str){
        $this->db->select('id, name');
        $this->db->from($table);
        $this->db->where_in('id',$str);
        $query = $this->db->get();
        return $query->result();
    }

    function get_user_count($where=null){
        $this->db->select("COUNT(CASE WHEN user_role = '2' THEN id END) AS doctor,COUNT(CASE WHEN user_role = '3' THEN id END) AS patient");
        $this->db->from('users');
        if(!empty($where)){
            $this->db->where('FIND_IN_SET(' . $where['cs.hospital_id'] . ',hospital_id)<> 0');
        }
        $query = $this->db->get();
        return $query->result();
    }

    function GetJoinedRecord($where=null){
        if(!empty($where)){
            $where =  'AND appointment.hospital_id = '.$where['hospital_id'].' AND appointment.appointment_date >= CURDATE()';
        }else{
            $where = ''; 
        }
        $query = $this->db->query('SELECT `appointment`.`id`, `appointment`.`appointment_id`, `appointment`.`appointment_time`, `appointment`.`appointment_date`, CONCAT(u1.first_name," ", u1.last_name) as doctor_name,CONCAT(u2.first_name," ", u2.last_name) as patient_name, `appointment`.`is_active`, `appointment`.`appointment_type`, `appointment`.`patient_id` FROM `appointment`,`users` u1,`users` u2 where `u1`.`id` = `appointment`.`doctor_id` AND `u2`.`id` = `appointment`.`patient_id` '.$where);
        return $query->result_array();
    }
}