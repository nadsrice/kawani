<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class Employee_leave_credit_model extends MY_Model
{
    protected $_table = 'employee_leave_credits';
    protected $primary_key = 'id';
    protected $return_type = 'array';

    public function get_leave_credits_by($where)
    {
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
            ->join('position_leave_credits', 'employee_leave_credits.position_leave_credit_id = position_leave_credits.id', 'left')
            ->join('attendance_leave_types', 'position_leave_credits.attendance_leave_type_id = attendance_leave_types.id', 'left');

        return $this->get_many_by($where);
    }
}
