<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Common_model extends CI_Model
{
    
    public function getSchedule($table)
    {
        $this->db->select("s.id, s.doctor_id,u.first_name, GROUP_CONCAT(s.day SEPARATOR ',') as Days");
        $this->db->from("schedule as s");
        $this->db->join("users as u", "u.id = s.doctor_id");
        $this->db->group_by("s.doctor_id");
        $q        = $this->db->get();
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
    
    public function get_Patient_Doctor_Record($table)
    {
        $this->db->select('us.first_name as doctor_name,us.id as doctor_id , u.first_name as patient_name,u.id as patient_id');
        $this->db->from("$table as cs");
        $this->db->join('users as u',"u.id=cs.patient_id");
        $this->db->join('users as us',"us.id=cs.doctor_id");
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
}