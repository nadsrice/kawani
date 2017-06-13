<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Some class description here...
 *
 * @package     KAWANI
 * @subpackage  subpackage
 * @category    category
 * @author      cristhian.kevin@systemantech.com
 * @link        http://systemantech.com
 */
class Department_model extends MY_Model {

    protected $_table = 'departments';
    protected $primary_key = 'id';
    protected $return_type = 'array';

    /**
     * Callbacks or Observers
     */
    protected $before_create = ['generate_date_created_status'];
    protected $after_get = [
        'set_default_data'
    ];

    protected function generate_date_created_status($department)
    {
        $department['created'] = date('Y-m-d H:i:s');
        $department['active_status'] = 1;
        $department['created_by'] = '0';
        return $department;
    }

    protected function set_default_data($department)
    {   
        $department['active_status']  = ($department['active_status'] == 1) ? 'Active' : 'Inactive';
        return $department;
    }
    
    public function get_department_by($param)
    {
        $query = $this->db;
        $query->select('departments.*');
        $query->order_by('name', 'asc');
        //$query->join('companies', 'departments.company_id = companies.id', 'left');

        return $this->get_by($param);
    }

    public function get_many_department_by($param)
    {
        $query = $this->db;
        $query->select('departments.*');
        $query->order_by('name', 'asc');
        // $query->join('companies', 'departments.company_id = companies.id', 'left');
        // $query->order_by('companies.id', 'asc');

        return $this->get_many_by($param);
    }

    public function get_department_all()
    {
        $query = $this->db;
        $query->select('departments.*, companies.name as company_name');
        $query->join('companies', 'departments.company_id = companies.id', 'left');
        $query->order_by('departments.name', 'asc');

        return $this->get_all();
    }
}
