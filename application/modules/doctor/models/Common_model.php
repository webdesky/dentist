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
    
}
