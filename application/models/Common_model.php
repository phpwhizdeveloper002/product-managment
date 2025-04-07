<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Common_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    function get_record($table_name, $where = '', $field = '*')
	{
        
		$this->db->select($field, false);
		$this->db->from($table_name);
		$this->db->order_by('id', 'DESC'); 

		if (!empty($where)) {
			if (is_array($where)) {
				foreach ($where as $key => $val) {
					$this->db->where($key, $val);
				}
			} else {
				$this->db->where($where);
			}
		}

		return $res = $this->db->get();
	}

    public function insert_data($table, $data) {

        if (!empty($data) && is_array($data)) {
            $this->db->insert($table, $data);
            
            if ($this->db->affected_rows() > 0) {
                return true;
            }
        }

        return false;
    }

	public function update_data($table, $where, $data) {
		if (!empty($data) && is_array($data)) {
			$this->db->where($where);
			return $this->db->update($table, $data);
		}
		return false;
	}

	public function get_data($table, $where = array()) {
		if (!empty($where)) {
			$this->db->where($where);
		}
		$query = $this->db->get($table);
		return $query->row_array(); // returns a single record as an associative array
	}
	
}
?>
