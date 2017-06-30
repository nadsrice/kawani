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
class Attendance_undertime_model extends MY_Model {

    protected $_table = 'attendance_undertimes';
    protected $primary_key = 'id';
    protected $return_type = 'array';
    /**
     * Callbacks or Observers
     */
    protected $before_create = ['generate_date_created_status'];
    //protected $after_get = ['set_default_data'];

    protected function generate_date_created_status($undertime)
    {
        $undertime['created']            = date('Y-m-d H:i:s');
        $undertime['created_by']         = 0;
        $undertime['status']             = 1;
        $undertime['approval_status']    = 2;
        return $undertime;
    }

    // protected function set_default_data($undertime)
    // {   
    //     $undertime['active_status']  = ($undertime['active_status'] == 1) ? 'Active' : 'Inactive';
    //     $undertime['status_label']  = ($undertime['active_status'] == 'Active') ? 'De-activate' : 'Activate';
    //     return $undertime;
    // }

    public function get_undertime_by($param)
    {
        $query = $this->db;
        $query->select('attendance_undertimes.*');
        return $this->get_by($param);
    }
    public function get_many_undertime_by($param)
    {
        $query = $this->db;
        $query->select('attendance_undertimes.*');
        return $this->get_many_by($param);
    }
    public function get_undertime_all()
    {
        $query = $this->db;
        $query->select('attendance_undertimes.*');
        return $this->get_all();
    }

    public function get_undertimes($where = '')
    {
        if ( ! empty($where)) {
            $this->db->where($where);
        }

        $query = $this->db->select('
                    attendance_undertimes.*,
                    teams.name as team,
                    departments.name as department,
                    employees.employee_code as employee_code,
                    CONCAT_WS(' . '" "' . ', employees.last_name,", " ,employees.first_name) as full_name,
                    ')
                ->from($this->_table)
                ->join('employees', 'employees.id = attendance_undertimes.employee_id', 'left')
                ->join('teams', 'teams.id = attendance_undertimes.team_id', 'left')
                ->join('departments', 'departments.id = attendance_undertimes.department_id', 'left')
                ->order_by('employees.last_name', 'asc')
                ->order_by('attendance_undertimes.date', 'desc')
                ->get();

        return $query->result_array();

    }
}