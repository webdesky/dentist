<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Model
{
    var $CI;
    public function __construct($params = array())
    {
        $this->CI =& get_instance();
        $this->CI->load->helper('url');
        $this->CI->config->item('base_url');
        $this->CI->load->library('session', 'form_validation');
        $this->CI->load->database();
    }
    public function insertData($table, $dataInsert)
    {
        $this->CI->db->insert($table, $dataInsert);
        return $this->CI->db->insert_id();
    }
    public function updateFields($table, $data, $where)
    {
        return $this->CI->db->update($table, $data, $where);
    }
    public function get_matching_record($table, $val)
    {
        $this->CI->db->select('*');
        $this->CI->db->from($table);
        $this->CI->db->where("port_description LIKE '%$val%'");
        $q   = $this->CI->db->get();
        $num = $q->num_rows();
        if ($num > 0) {
            foreach ($q->result() as $rows) {
                $data[] = $rows;
            }
            $q->free_result();
            return $data;
        }
    }
    public function getsingle($table, $where = '', $fld = NULL, $order_by = '', $order = '')
    {
        if ($fld != NULL) {
            $this->CI->db->select($fld);
        }
        if ($where != '') {
            $this->CI->db->where($where);
        }
        if ($order_by != '') {
            $this->CI->db->order_by($order_by, $order);
        }
        $this->CI->db->limit(1);
        $q   = $this->CI->db->get($table);
        $num = $q->num_rows();
        if ($num > 0) {
            return $q->row();
        }
    }
    public function GetJoinRecord($table, $field_first, $tablejointo, $field_second, $field_val, $where, $group_by = null, $order_by = null, $order = null)
    {
        if (!empty($field_val)) {
            $this->CI->db->select("$field_val");
        } else {
            $this->CI->db->select("*");
        }
        $this->CI->db->from("$table");
        $this->CI->db->join("$tablejointo", "$tablejointo.$field_second = $table.$field_first");
        if (!empty($where)) {
            $this->CI->db->where($where);
        }
        if (!empty($group_by)) {
            $this->CI->db->group_by("$table.$field_first");
        }
        if ($order_by != '') {
            $this->CI->db->order_by($order_by, $order);
        }
        $q = $this->CI->db->get();
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $rows) {
                $data[] = $rows;
            }
            $q->free_result();
            return $data;
        }
    }
    public function GetJoinRecord1($table, $field_first, $tablejointo, $field_second, $field_val, $where, $group_by = null, $order_by = null, $order = null)
    {
        if (!empty($field_val)) {
            $this->CI->db->select("$field_val");
        } else {
            $this->CI->db->select("*");
        }
        $this->CI->db->from("$table");
        $this->CI->db->join("$tablejointo", "$tablejointo.$field_second = $table.$field_first");
        if (!empty($where)) {
            $this->CI->db->where($where);
        }
        if (!empty($group_by)) {
            $this->CI->db->group_by("$table.$field_first");
        }
        if ($order_by != '') {
            $this->CI->db->order_by($order_by, $order);
        }
        $q = $this->CI->db->get();
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $rows) {
                $data[] = $rows;
            }
            $q->free_result();
            return $data;
        }
    }
    public function getAllwhere($table, $where = '', $select = 'all', $order_fld = '', $order_type = '', $limit = '', $offset = '', $or_where = null)
    {
        if ($order_fld != '' && $order_type != '') {
            $this->CI->db->order_by($order_fld, $order_type);
        }
        if ($select == 'all') {
            $this->CI->db->select('*');
        } else {
            $this->CI->db->select($select);
        }
        if ($where != '') {
            $this->CI->db->where($where);
        }
        if ($or_where != '') {
            $this->CI->db->or_where($or_where);
        }
        if ($limit != '' && $offset != '') {
            $this->CI->db->limit($limit, $offset);
        } else if ($limit != '') {
            $this->CI->db->limit($limit);
        }
        $q        = $this->CI->db->get($table);
        $num_rows = $q->num_rows();
        if ($num_rows > 0) {
            foreach ($q->result() as $rows) {
                $data[] = $rows;
            }
            $q->free_result();
            return $data;
        }
    }
    public function self_join_records($patient_id, $doctor_id)
    {
        $this->CI->db->select('CONCAT(T1.first_name," ",T1.last_name) as doctor_first_name,CONCAT(T2.first_name," ",T2.last_name) as patient_first_name');
        $this->CI->db->from('users T1,users T2');
        $this->CI->db->where('T1.id = ' . $doctor_id . ' and T2.id = ' . $patient_id);
        $q = $this->CI->db->get();
        return $q->result_array();
    }
    public function getAll($table, $select = '', $order_fld = '', $order_type = '', $limit = '', $offset = '')
    {
        if ($order_fld != '' && $order_type != '') {
            $this->CI->db->order_by($order_fld, $order_type);
        }
        if ($select == 'all') {
            $this->CI->db->select('*');
        } else {
            $this->CI->db->select($select);
        }
        if ($limit != '' && $offset != '') {
            $this->CI->db->limit($limit, $offset);
        } else if ($limit != '') {
            $this->CI->db->limit($limit);
        }
        $q        = $this->CI->db->get($table);
        $num_rows = $q->num_rows();
        if ($num_rows > 0) {
            foreach ($q->result_array() as $rows) {
                $data[] = $rows;
            }
            $q->free_result();
            return $data;
        }
    }
    public function getAllwherenew($table, $where, $select = 'all')
    {
        if ($select == 'all') {
            $this->CI->db->select('*');
        } else {
            $this->CI->db->select($select);
        }
        $this->CI->db->where($where, NULL, FALSE);
        $q        = $this->db->get($table);
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
    public function getcount($table, $where)
    {
        $this->CI->db->where($where);
        $q = $this->CI->db->count_all_results($table);
        return $q;
    }
    public function getTotalsum($table, $where, $data)
    {
        $this->CI->db->where($where);
        $this->CI->db->select_sum($data);
        $q = $this->CI->db->get($table);
        return $q->row();
    }
    public function GetJoinRecordNew($table, $field_first, $second_field_join, $tablejointo, $field_second, $tablejointhree, $field_third, $field, $value, $field_val, $where = null)
    {
        $this->CI->db->select("$field_val");
        $this->CI->db->from("$table");
        $this->CI->db->join("$tablejointo", "$tablejointo.$field_second = $table.$field_first");
        if ($tablejointhree && $field_third) {
            $this->CI->db->join("$tablejointhree", "$tablejointhree.$field_third = $table.$second_field_join");
        }
        if (!empty($field) && !empty($value)) {
            $this->CI->db->where("$table.$field", "$value");
        }
        if (!empty($where)) {
            $this->CI->db->where($where);
        }
        if (!empty($group_by)) {
            $this->CI->db->group_by($group_by);
        }
        $q = $this->CI->db->get();
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $rows) {
                $data[] = $rows;
            }
            $q->free_result();
            return $data;
        }
    }
    public function getRecords($table)
    {
        $query = $this->CI->db->get($table);
        return $query->result_array();
    }
    public function getAllRecords($table, $conditions = '')
    {
        if (!empty($conditions)) {
            $query = $this->CI->db->get_where($table, $conditions);
        } else {
            $query = $this->CI->db->get($table);
        }
        return $query->result_array();
    }
    public function delete($table, $where)
    {
        $this->CI->db->where($where)->delete($table);
    }
    public function update($table, $update, $where)
    {
        $query = $this->CI->db->where($where)->update($table, $update);
    }
    // some extra function start //
    public function countRecord($table, $condition)
    {
        $this->CI->db->where($condition);
        $query = $this->CI->db->get($table);
        return $query->num_rows();
    }
    public function fetchMaxRecord($table, $field)
    {
        $this->CI->db->select_max($field, 'max');
        $query = $this->CI->db->get($table);
        return $query->row_array();
    }
    public function insertPasswordResetString($email_address, $password_reset_key)
    {
        $this->CI->db->where('email', $email_address);
        $this->CI->db->update(USERS, array(
            "password_reset_key" => $password_reset_key
        ));
    }
    public function exists($fields)
    {
        $query = $this->CI->db->get_where(USERS, $fields, 1, 0);
        if ($query->num_rows() == 1)
            return TRUE;
        else
            return FALSE;
    }
    public function updatePassword($password, $password_reset_key)
    {
        $this->CI->db->where('password_reset_key', $password_reset_key);
        $this->CI->db->update(USERS, array(
            "password_reset_key" => "",
            "password" => md5($password)
        ));
    }
    public function check_oldpassword($oldpass, $user_id)
    {
        $this->CI->db->where('id', $user_id);
        $this->CI->db->where('password', md5($oldpass));
        $query = $this->CI->db->get('admins'); //data table
        return $query->num_rows();
    }
    public function insertBatch($table, $data)
    {
        $this->CI->db->insert_batch($table, $data);
        return $this->CI->db->insert_id();
    }
    public function updateBatch($table, $data, $condition)
    {
        $this->CI->db->update_batch($table, $data, $condition);
        return $this->CI->db->insert_id();
    }
    public function find_record($table, $where, $select)
    {
        if (empty($select)) {
            $select = '*';
        }
        $query    = $this->CI->db->query('select ' . $select . ' from users where FIND_IN_SET(' . $where['hospital_id'] . ',hospital_id) and user_role = ' . $where['user_role'] . ' and is_active = 1');
        $num_rows = $query->num_rows();
        if ($num_rows > 0) {
            foreach ($query->result() as $rows) {
                $data[] = $rows;
            }
            $query->free_result();
            return $data;
        }
    }
}