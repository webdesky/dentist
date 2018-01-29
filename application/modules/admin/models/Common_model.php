<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Common_model extends CI_Model
{
    function insertData($table, $dataInsert)
    {
        $this->db->insert($table, $dataInsert);
        return $this->db->insert_id();
    }
    
    function updateFields($table, $data, $where)
    {
        return $this->db->update($table, $data, $where);
    }
    
    function updateAmount($table, $field1, $field2, $amt, $where)
    {
        $this->db->set($field1, "$field1+$amt", FALSE);
        $this->db->set($field2, "$field2+1", FALSE);
        $this->db->where($where);
        $this->db->update($table);
    }
    
    function get_matching_record($table,$val){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where("port_description LIKE '%$val%'");
        $q = $this->db->get();
        $num = $q->num_rows();
        if ($num > 0) {
            foreach ($q->result() as $rows) {
                $data[] = $rows;
            }
            $q->free_result();
            return $data;
        }
    }
    function get_matching_record_from_job($table,$val){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where("job_no LIKE '%$val%'");
        $this->db->order_by('job_id', 'DESC');
        $this->db->limit(1);
        $q = $this->db->get();
        $num = $q->num_rows();
        if ($num > 0) {
            foreach ($q->result() as $rows) {
                $data[] = $rows;
            }
            $q->free_result();
            return $data;
        }
    }
    
    function getsingle($table, $where = '', $fld = NULL, $order_by = '', $order = '')
    {
        if ($fld != NULL) {
            $this->db->select($fld);
        }
        if ($where != '') {
            $this->db->where($where);
        }
        if ($order_by != '') {
            $this->db->order_by($order_by, $order);
        }
        $this->db->limit(1);
        $q   = $this->db->get($table);
        $num = $q->num_rows();
        if ($num > 0) {
            return $q->row();
        }
    }
    
    function GetJoinRecord($table, $field_first, $tablejointo, $field_second, $field_val = '', $where = "",$group_by='')
    {
        if (!empty($field_val)) {
            $this->db->select("$field_val");
        } else {
            $this->db->select("*");
        }
        $this->db->from("$table");
        $this->db->join("$tablejointo", "$tablejointo.$field_second = $table.$field_first");
        if (!empty($where)) {
            $this->db->where($where);
        }
        if(!empty($group_by)){
            $this->db->group_by("$table.$field_first");
        }
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $rows) {
                $data[] = $rows;
            }
            $q->free_result();
            return $data;
        }
    }
    
    function getAllwhere($table, $where = '', $order_fld = '', $order_type = '', $select = 'all', $limit = '', $offset = '')
    {
        if ($order_fld != '' && $order_type != '') {
            $this->db->order_by($order_fld, $order_type);
        }
        if ($select == 'all') {
            $this->db->select('*');
        } else {
            $this->db->select($select);
        }
        if ($where != '') {
            $this->db->where($where);
        }
        if ($limit != '' && $offset != '') {
            $this->db->limit($limit, $offset);
        } else if ($limit != '') {
            $this->db->limit($limit);
        }
        $q        = $this->db->get($table);
        //echo $this->db->last_query(); 
        $num_rows = $q->num_rows();
        if ($num_rows > 0) {
            foreach ($q->result() as $rows) {
                $data[] = $rows;
            }
            $q->free_result();
            return $data;
        }
    }
    
    function getAll($table, $order_fld = '', $order_type = '', $select = 'all', $limit = '', $offset = '')
    {

        if ($order_fld != '' && $order_type != '') {
            $this->db->order_by($order_fld, $order_type);
        }
        if ($select == 'all') {
            $this->db->select('*');
        } else {
            $this->db->select($select);
        }
        if ($limit != '' && $offset != '') {
            $this->db->limit($limit, $offset);
        } else if ($limit != '') {
            $this->db->limit($limit);
        }
        $q        = $this->db->get($table);
        $num_rows = $q->num_rows();
        if ($num_rows > 0) {
            foreach ($q->result_array() as $rows) {
                $data[] = $rows;
            }
            $q->free_result();
            return $data;
        }
    }
    
    function getAllwherenew($table, $where, $select = 'all')
    {
        if ($select == 'all') {
            $this->db->select('*');
        } else {
            $this->db->select($select);
        }
        $this->db->where($where, NULL, FALSE);
        $q        = $this->db->get($table);
        // echo $this->db->last_query();
        // die;
        $num_rows = $q->num_rows();
        if ($num_rows > 0) {
            foreach ($q->result() as $rows) {
                $data[] = $rows;
            }
            $q->free_result();
            return $data;
        } else {
            return 'no';
        }
    }
    
    function getcount($table, $where)
    {
        $this->db->where($where);
        $q = $this->db->count_all_results($table);
        return $q;
    }
    
    function getTotalsum($table, $where, $data)
    {
        $this->db->where($where);
        $this->db->select_sum($data);
        $q = $this->db->get($table);
        return $q->row();
    }
    
    function GetJoinRecordNew($table, $field_first, $tablejointo, $field_second,$tablejointhree, $field_third, $field, $value, $field_val)
    {
        $this->db->select("$field_val");
        $this->db->from("$table");
        $this->db->join("$tablejointo", "$tablejointo.$field_second = $table.$field_first");
        $this->db->join("$tablejointhree", "$tablejointhree.$field_third = $table.$field_first");
        $this->db->where("$table.$field", "$value");
        //$this->db->group_by("$table.$field_first");
        $this->db->limit(1);
        $q = $this->db->get();
        // echo $this->db->last_query();
        // die;
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $rows) {
                $data[] = $rows;
            }
            $q->free_result();
            return $data;
        }
    }


    function GetAppointmentList()
    {
        $this->db->select("*");
        $this->db->from("appointment as ap");
        //$this->db->join('users as u', 'ap.patient_id = u.id' ,'left');
        $this->db->join('users as us', 'us.id = ap.doctor_id','left');
       // $this->db->join("$tablejointhree", "$tablejointhree.$field_third = $table.$field_first");
       // $this->db->where("u.user_role", '3');
       // $this->db->where("u.user_role", '2');
        $q = $this->db->get();

        if ($q->num_rows() > 0) {
            foreach ($q->result() as $rows) {
                $data[] = $rows;
            }
            $q->free_result();
            return $data;
        }
    }

   
    

    function GetSalerecords_for_view($table)
    {
        $this->db->select("*");
        $this->db->from("$table");
        $this->db->order_by('job_id','DESC');
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $rows) {
                $data[] = $rows;
            }
            $q->free_result();
            return $data;
        }
    }
    function getRecords($table)
    {
        $query = $this->db->get($table);
        return $query->result_array();
    }
    
    function getAllRecords($table, $conditions = '')
    {
        $this->db->cache_on();
        if (!empty($conditions)) {
            $query = $this->db->get_where($table, $conditions);
        } else {
            $query = $this->db->get($table);
        }

        $this->db->cache_off();
        return $query->result_array();
    }
    
    function delete($table, $where)
    {
        $this->db->where($where)->delete($table);
    }
    
    function update($table, $update, $where)
    {

        $query = $this->db->where($where)->update($table, $update);
    }
    
    // some extra function start //
    function countRecord($table, $condition)
    {
        $this->db->where($condition);
        $query = $this->db->get($table);
        return $query->num_rows();
    }
    
    function fetchMaxRecord($table, $field)
    {
        $this->db->select_max($field, 'max');
        $query = $this->db->get($table);
        return $query->row_array();
    }
    
    function insertPasswordResetString($email_address, $password_reset_key)
    {
        $this->db->where('email', $email_address);
        $this->db->update(USERS, array(
            "password_reset_key" => $password_reset_key
        ));
    }
    
    function exists($fields)
    {
        $query = $this->db->get_where(USERS, $fields, 1, 0);
        if ($query->num_rows() == 1)
            return TRUE;
        else
            return FALSE;
    }
    
    function updatePassword($password, $password_reset_key)
    {
        $this->db->where('password_reset_key', $password_reset_key);
        $this->db->update(USERS, array(
            "password_reset_key" => "",
            "password" => md5($password)
        ));
    }
    
    function check_oldpassword($oldpass, $user_id)
    {
        $this->db->where('id', $user_id);
        $this->db->where('password', md5($oldpass));
        $query = $this->db->get('admins'); //data table
        return $query->num_rows();
    }

}
