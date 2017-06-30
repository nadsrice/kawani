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
class Attendance_leave_model extends MY_Model {

    protected $_table = 'attendance_leaves';
    protected $primary_key = 'id';
    protected $return_type = 'array';

    /**
     * Callbacks or Observers
     */
    protected $before_create = ['generate_date_created_status'];
    protected $after_get = ['set_default_data'];

    protected function generate_date_created_status($leave)
    {
        $leave['created'] = date('Y-m-d H:i:s');
        $leave['created_by'] = '0';
        $leave['approval_status'] = 2;
        return $leave;
    }

    protected function set_default_data($leave)
    {   
        $leave['active_status']  = ($leave['active_status'] == 1) ? 'Active' : 'Inactive';
        $leave['status_label']  = ($leave['active_status'] == 'Active') ? 'De-activate' : 'Activate';
        return $leave;
    }
    
    public function get_leave_by($param)
    {
        $query = $this->db;
        $query->select('attendance_leaves.*');
        //$query->order_by('name', 'asc');
        //$query->join('companies', 'attendance_leaves.company_id = companies.id', 'left');

        return $this->get_by($param);
    }

    public function get_many_leave_by($param)
    {
        $query = $this->db;
        $query->select('attendance_leaves.*');
        //$query->order_by('name', 'asc');

        return $this->get_many_by($param);
    }

    public function get_leave_all()
    {
        $query = $this->db;
        $query->select('*');
        //$query->order_by('name', 'asc');

        return $this->get_all();
    }
}
