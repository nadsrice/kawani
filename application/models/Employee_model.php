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
class Employee_model extends MY_Model {

    protected $_table = 'employees';
    protected $primary_key = 'id';
    protected $return_type = 'array';

    /**
     * Callbacks or Observers
     */
    protected $before_create = ['generate_date_created_status'];
    protected $after_get = ['set_default_data'];

    protected function generate_date_created_status($employee)
    {
        $employee['created'] = date('Y-m-d H:i:s');
        $employee['active_status'] = 1;
        $employee['created_by'] = '0';
        return $employee;
    }

    protected function set_default_data($employee)
    {   
        $full_name = $employee['last_name'].', '.$employee['first_name'].' '.$employee['middle_name'];
        $employee['full_name'] = strtoupper($full_name);
        $employee['active_status']  = ($employee['active_status'] == 1) ? 'Active' : 'Inactive';
        return $employee;
    }


    public function get_employee_by($param)
    {
        $query = $this->db;
        $query->select('*');
        $query->order_by('last_name', 'asc');

        return $this->get_by($param);
    }

    public function get_many_employee_by($param)
    {
        $query = $this->db;
        $query->select('*');
        $query->order_by('last_name', 'asc');

        return $this->get_many_by($param);
    }

    public function get_employee_all()
    {
        $query = $this->db;

        $query->select('
            employees.id as employee_id,
            employees.employee_code,
            employees.first_name,
            employees.middle_name,
            employees.last_name,
            employees.active_status,
            companies.name as company_name
        ');
        $query->join('companies', 'employees.company_id = companies.id', 'left');

        $query->select('*');

        $query->order_by('last_name', 'asc');

        return $this->get_all();
    }

    public function get_employee_data($from = 'employees', $where = '')
    {
        if ( ! empty($where)) {
            $this->db->where($where);
        }
        $query = $this->db->select('*')->from($from)->get();

        return $query->result_array();

    }

    // public function get_employee_details()
    // {
    //     $query = $this->db;
    //     $query->select('employees.*, positions.name as position, teams.name as team');
    //     $query->join('positions', 'positions.id = employees.position_id')
    // }
}