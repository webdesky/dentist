<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Common_model extends CI_Model
{
    
    public function getSchedule($table)
    {
        $this->db->select("s.sc_id, s.doctor_id,u.first_name, GROUP_CONCAT(s.day SEPARATOR ',') as Days");
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
    
    public function getCaseStudy()
    {
        $this->db->select('us.first_name as doctor_name', 'u.first_name as patient_name');
        $this->db->from('case_study as cs');
        $this->db->join('users as u', "u.id=cs.patient_id");
        $this->db->join('users as us', "us.id=cs.doctor_id");
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
}