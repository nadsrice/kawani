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
        if ( ! isset($employee)) {
            return FALSE;
        }

        $full_name = $employee['last_name'].', '.$employee['first_name'].' '.$employee['middle_name'];
        $employee['full_name'] = strtoupper($full_name);
        $employee['label_status'] = ($employee['active_status'] == 1) ? 'Active' : 'Inactive';

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

    /**
     * NOTE: This functions below is usjt temporary
     */

    public function get_employee_information($where)
    {
        if ( ! empty($where)) $this->db->where($where);

        $query = $this->db->select('*')->from('employee_information')->get();

        return $query->result_array();
    }

    public function get_employee_leave_credit($where = '')
    {
        if ( ! empty($where)) $this->db->where($where);

        $query = $this->db
                ->select('
                        employee_leave_credits.id AS elc_id,
                        employee_leave_credits.position_leave_credit_id AS elc_plc_id,
                        position_leave_credits.attendance_leave_type_id AS plc_alt_id,
                        position_leave_credits.credits AS elc_credit,
                        employee_leave_credits.balance AS elc_balance,
                        attendance_leave_types.name AS leave_type,
                        attendance_leave_types.*
                    ')
                ->from('employee_leave_credits')
                ->join('position_leave_credits', 'employee_leave_credits.position_leave_credit_id = position_leave_credits.id', 'left')
                ->join('attendance_leave_types', 'position_leave_credits.attendance_leave_type_id = attendance_leave_types.id', 'left');

        return $query->get()->result_array();
    }

    public function check_leave_balance($employee_id, $leave_type_id, $leave_request_days)
    {
        $leave_credit = $this->get_employee_leave_credit([
            'employee_leave_credits.employee_id'              => $employee_id,
            'position_leave_credits.attendance_leave_type_id' => $leave_type_id,
        ]);

        if ( ! isset($leave_credit)) return FALSE;

        $leave_credit = (isset($leave_credit[0]['elc_balance'])) ? $leave_credit[0]['elc_balance'] : 0;

        $balance_checker = $leave_request_days <= $leave_credit;

        return $balance_checker;
    }

    public function get_civil_status()
    {
        $query = $this->db
                    ->select('*')
                    ->from('civil_status')
                    ->where('active_status', 1)
                    ->get()
                    ->result_array();

        return $query;
    }

}
