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
class Employee_info_model extends MY_Model {

    protected $_table = 'employee_information';
    protected $primary_key = 'id';
    protected $return_type = 'array';

    /**
     * Callbacks or Observers
     */
    protected $before_create = ['generate_date_created_status'];
    protected $after_get = ['set_default_data'];

    protected function generate_date_created_status($employee)
    {
        $employee_info['created'] = date('Y-m-d H:i:s');
        $employee_info['active_status'] = 1;
        $employee_info['created_by'] = '0';
        return $employee_info;
    }

    protected function set_default_data($employee_info)
    {   
        $employee_info['active_status']  = ($employee_info['active_status'] == 1) ? 'Active' : 'Inactive';
        return $employee_info;
    }

    public function get_employee_info_by($param)
    {
        $query = $this->db;
        $query->select('*');

        return $this->get_by($param);
    }

    public function get_many_employee_info_by($param)
    {
        $query = $this->db;
        $query->select('*');

        return $this->get_many_by($param);
    }

    public function get_employee_info_all()
    {
        $query = $this->db;
        $query->select('employee_info.*, positions.name as position, teams.name as team, employees.employee_code as employee_code,
                        CONCAT_WS(' . '" "' . ', employees.last_name,", " ,employees.first_name) as full_name');
        $query->join('employees', 'employees.id = employee_info.employee_id');
        $query->join('positions', 'positions.id = employee_info.position_id');
        $query->join('teams', 'teams.id = employee_info.team_id');
        $query->order_by('employees.last_name', 'asc');

        return $this->get_all();
    }

    public function get_employee_info_data($where = '')
    {
        if ( ! empty($where)) {
            $this->db->where($where);
        }

        $query = $this->db->select('
                    employee_info.*,
                    positions.name as position,
                    teams.name as team,
                    departments.name as department,
                    employees.employee_code as employee_code,
                    CONCAT_WS(' . '" "' . ', employees.last_name,", " ,employees.first_name) as full_name
                    ')
                ->from($this->_table)
                ->join('employees', 'employees.id = employee_info.employee_id', 'left')
                ->join('positions', 'positions.id = employee_info.position_id', 'left')
                ->join('teams', 'teams.id = employee_info.team_id', 'left')
                ->join('departments', 'departments.id = employee_info.department_id', 'left')
                ->order_by('employees.last_name', 'asc')
                ->get();

        return $query->result_array();

    }

    // public function get_employee_info_details()
    // {
    //     $query = $this->db;
    //     $query->select('employee_infos.*, positions.name as position, teams.name as team');
    //     $query->join('positions', 'positions.id = employee_infos.position_id')
    // }
}