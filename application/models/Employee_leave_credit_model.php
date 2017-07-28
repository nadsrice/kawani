<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class Employee_leave_credit_model extends MY_Model
{
    protected $_table      = 'employee_leave_credits';
    protected $primary_key = 'id';
    protected $return_type = 'array';

    /**
     * Callbacks or Observers
     */
    protected $before_create = ['generate_date_created_status'];
    protected $after_get     = ['set_default_data'];
    protected $after_create  = ['write_audit_trail'];
    protected $after_update  = ['write_audit_trail'];

    protected function generate_date_created_status($leave_credit)
    {
        $leave_credit['created']       = date('Y-m-d H:i:s');
        $leave_credit['active_status'] = 1;
        $leave_credit['created_by']    = 0;
        return $leave_credit;
    }

    protected function set_default_data($leave_credit)
    {
        $leave_credit['active_status']  = ($leave_credit['active_status'] == 1) ? 'Active' : 'Inactive';
        $leave_credit['status_label']   = ($leave_credit['active_status'] == 'Active') ? 'De-activate' : 'Activate';
        return $leave_credit;
    }

    public function get_leave_credit_by($param)
    {
        $query = $this->db;
        $query->select('*');
        return $this->get_by($param);
    }

    public function get_many_leave_credit_by($param)
    {
        $query = $this->db;
        $query->select('*');
        return $this->get_many_by($param);
    }

    public function get_leave_credit_all()
    {
        $query = $this->db;
        $query->select('*');
        return $this->get_all();
    }

    public function get_leave_credits_by($where)
    {
    	$query = $this->db
            ->select('
                    employee_leave_credits.id AS elc_id,
                    employee_leave_credits.position_leave_credit_id AS elc_plc_id,
                    employee_leave_credits.balance AS elc_balance,
                    position_leave_credits.attendance_leave_type_id AS plc_alt_id,
                    position_leave_credits.credits AS elc_credit,
                    attendance_leave_types.name AS leave_type,
                    attendance_leave_types.*
                ')
            ->join('position_leave_credits', 'employee_leave_credits.position_leave_credit_id = position_leave_credits.id', 'left')
            ->join('attendance_leave_types', 'position_leave_credits.attendance_leave_type_id = attendance_leave_types.id', 'left');

        return $this->get_many_by($where);
    }
}
