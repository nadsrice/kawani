<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Some class description here...
 *
 * @package     KAWANI
 * @subpackage  subpackage
 * @category    category
 * @author      joseph.gono@systemantech.com
 * @link        http://systemantech.com
 */
class Position_model extends MY_Model {

    protected $_table = 'positions';
    protected $primary_key = 'id';
    protected $return_type = 'array';

    /**
     * Callbacks or Observers
     */
    protected $before_create = ['generate_date_created_status'];
    protected $after_get = ['set_default_data'];

    protected function generate_date_created_status($position)
    {
        $position['created'] = date('Y-m-d H:i:s');
        $position['active_status'] = 1;
        $position['created_by'] = '0';
        return $position;
    }

    protected function set_default_data($position)
    {   
        $position['active_status']  = ($position['active_status'] == 1) ? 'Active' : 'Inactive';
        return $position;
    }

    public function get_position_by($param)
    {
        $query = $this->db;
        $query->select('*');
        $query->join('employee_info', 'employee_info.position_id = positions.id');

        return $this->get_by($param);
    }

    public function get_many_position_by($param)
    {
        $query = $this->db;
        $query->select('*');
        $query->join('employee_info', 'employee_info.position_id = positions.id');

        return $this->get_many_by($param);
    }

    public function get_position_all()
    {
        $query = $this->db;
        $query->select('*');
        return $this->get_all();
    }

    public function get_position_data($from = 'positions', $where = '')
    {
        if ( ! empty($where)) {
            $this->db->where($where);
        }
        $query = $this->db->select('*')->from($from)->get();

        return $query->result_array();

    }
}