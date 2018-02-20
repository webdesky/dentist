<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Common_model extends CI_Model
{

	public function multiple_delete($id){

		$this->db->delete('prescription', array('id' => $id)); 
   		$this->db->delete('medicine', array('prescription_id' => $id));
   		$this->db->delete('diagnosis', array('prescription_id' => $id));

	}

	public function getSchedule($table,$doctor_id)
    {
        $this->db->select("s.sc_id, s.doctor_id,u.first_name, GROUP_CONCAT(s.day SEPARATOR ',') as Days");
        $this->db->from("schedule as s");
        $this->db->join("users as u", "u.id = s.doctor_id");
        $this->db->group_by("s.doctor_id");
        $this->db->where('doctor_id',$doctor_id);
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
