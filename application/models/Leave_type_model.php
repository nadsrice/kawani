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
class Leave_type_model extends MY_Model {

    protected $_table = 'leave_types';
    protected $primary_key = 'id';
    protected $return_type = 'array';

    /**
     * Callbacks or Observers
     */
    protected $before_create = ['generate_date_created_status'];
    protected $after_get = ['set_default_data'];

    protected function generate_date_created_status($leave_type)
    {
        $leave_type['created'] = date('Y-m-d H:i:s');
        $leave_type['active_status'] = 1;
        $leave_type['created_by'] = '0';
        return $leave_type;
    }

    protected function set_default_data($leave_type)
    {   
        $leave_type['active_status']  = ($leave_type['active_status'] == 1) ? 'Active' : 'Inactive';
        $leave_type['status_label']  = ($leave_type['active_status'] == 'Active') ? 'De-activate' : 'Activate';
        return $leave_type;
    }
    
    public function get_leave_type_by($param)
    {
        $query = $this->db;
        $query->select('leave_types.*');
        $query->order_by('name', 'asc');
        //$query->join('companies', 'leave_types.company_id = companies.id', 'left');

        return $this->get_by($param);
    }

    public function get_many_leave_type_by($param)
    {
        $query = $this->db;
        $query->select('leave_types.*');
        $query->order_by('name', 'asc');

        return $this->get_many_by($param);
    }

    public function get_leave_type_all()
    {
        $query = $this->db;
        $query->select('*');
        $query->order_by('name', 'asc');

        return $this->get_all();
    }
}
