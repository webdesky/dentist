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
// SELECT doctor_id, GROUP_CONCAT(day SEPARATOR ', ')
// FROM schedule GROUP BY doctor_id
