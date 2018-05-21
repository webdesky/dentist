<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Common_model extends CI_Model
{
	public function find_hospital_records($id){
		$where = array('speciality'=>$id);
        $this->db->select('id, hospital_name');
        $this->db->from('hospitals');
        $this->db->where($where);
        $this->db->or_where('FIND_IN_SET('.$id.',other_speciality)<> 0');
        $query = $this->db->get();
        return $query->result();
    }
    
}
