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
class Employee_schedule_model extends MY_Model {

    protected $_table      = 'attendance_employee_daily_schedules';
    protected $primary_key = 'id';
    protected $return_type = 'array';

    /**
     * Callbacks or Observers
     */
    protected $before_create = ['generate_date_created_status'];
    protected $after_get     = ['set_default_data'];
    protected $after_create  = ['write_audit_trail'];
    protected $after_update  = ['write_audit_trail'];

    protected function generate_date_created_status($employee_schedule)
    {
        $employee_schedule['created']       = date('Y-m-d H:i:s');
        $employee_schedule['active_status'] = 1;
        $employee_schedule['created_by']    = 0;
        return $employee_schedule;
    }

    protected function set_default_data($shift_schedule)
    {
        $shift_schedule['active_status']  = ($shift_schedule['active_status'] == 1) ? 'Active' : 'Inactive';
        $shift_schedule['status_label']   = ($shift_schedule['active_status'] == 'Active') ? 'De-activate' : 'Activate';
        return $shift_schedule;
    }

    public function get_employee_schedule_by($where)
    {
        $query = $this->db;
        $query->select('
                    attendance_employee_daily_schedules.*,
                    companies.name as company_name
                ');
        $query->join('companies', 'attendance_employee_daily_schedules.company_id = companies.id', 'left');

        return $this->get_by($where);
    }

    public function get_many_employee_schedule_by($param)
    {
        $query = $this->db;
        $query->select('*');
        return $this->get_many_by($param);
    }

    public function get_employee_schedule_all()
    {
        $query = $this->db;
        $query->select('
                    attendance_employee_daily_schedules.*,
                    companies.name as company_name
                ');
        $query->join('companies', 'attendance_employee_daily_schedules.company_id = companies.id', 'left');
        return $this->get_all();
    }
}
