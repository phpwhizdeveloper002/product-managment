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
}
?>
