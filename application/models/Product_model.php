<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    function get_record($table_name, $where = '', $field = '*', $join = [])
    {
        $this->db->select($field, false);
        $this->db->from($table_name);

        // Add JOINs if provided
        if (!empty($join) && is_array($join)) {
            foreach ($join as $j) {
                // $j = ['table' => 'category', 'condition' => 'category.id = products.category_id', 'type' => 'left']
                $join_type = isset($j['type']) ? $j['type'] : 'left';
                $this->db->join($j['table'], $j['condition'], $join_type);
            }
        }

        $this->db->order_by('id', 'DESC');

        // Where conditions
        if (!empty($where)) {
            if (is_array($where)) {
                foreach ($where as $key => $val) {
                    $this->db->where($key, $val);
                }
            } else {
                $this->db->where($where);
            }
        }

        return $this->db->get();
    }

}
?>
