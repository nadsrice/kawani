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
    protected $after_get     = ['set_default_menus'];

    protected function generate_date_created_status($leave)
    {
        $leave['created']           = date('Y-m-d H:i:s');
        $leave['created_by']        = 0;
        $leave['status']            = 1;
        $leave['approval_status']   = 2;
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

    public function get_leave_requests($where)
    {
        $this->db->select('
                    attendance_leaves.*,
                    attendance_leave_types.name as leave_type,
                    employees.employee_code,
                    CONCAT_WS(' . '" "' . ', employees.last_name,", " ,employees.first_name) as full_name,
                ')
                ->join('employees', 'attendance_leaves.employee_id = employees.id', 'left')
                ->join('attendance_leave_types', 'attendance_leaves.attendance_leave_type_id = attendance_leave_types.id', 'left');
        return $this->get_many_by($where);
    }

    protected function set_default_menus($attendance_leave)
    {   
        $btn_settings = $this->config->item('btn_settings');

        if ( ! isset($attendance_leave)) {
            return FALSE;
        }

        $hashed_id = generateRandomString().'-'.md5($attendance_leave['id']);

        $attendance_leave['action_menus'] = [
            'approve' => [
                'url'               => site_url('attendance_leaves/approve_leave/'.$attendance_leave['id']),
                'icon'              => 'fa fa-pencil-square-o',
                'label'             => 'Approve',
                'modal_status'      => TRUE,
                'modal_attributes'  => 'data-toggle="modal" data-target="#status-action-approve-'.md5($attendance_leave['id']).'"',
                'modal_id'          => 'status-action-approve-'.md5($attendance_leave['id']),
                'button_style'      => $btn_settings['btn_update']
            ],
            'reject' => [
                'url'               => site_url('attendance_leaves/reject_leave/'.$attendance_leave['id']),
                'icon'              => 'fa fa-pencil-square-o',
                'label'             => 'Reject',
                'modal_status'      => TRUE,
                'modal_attributes'  => 'data-toggle="modal" data-target="#status-action-reject-'.md5($attendance_leave['id']).'"',
                'modal_id'          => 'status-action-reject-'.md5($attendance_leave['id']),
                'button_style'      => $btn_settings['btn_update']
            ],
            'cancel' => [
                'url'               => site_url('attendance_leaves/cancel_leave/'.$attendance_leave['id']),
                'icon'              => 'fa fa-pencil-square-o',
                'label'             => 'Cancel',
                'modal_status'      => TRUE,
                'modal_attributes'  => 'data-toggle="modal" data-target="#status-action-cancel-'.md5($attendance_leave['id']).'"',
                'modal_id'          => 'status-action-cancel-'.md5($attendance_leave['id']),
                'button_style'      => $btn_settings['btn_update']
            ]
        ];

        return $attendance_leave;
    }

    public function get_employee_attendance_leave($where = '')
    {
        $query = $this->db
                ->select('
                    attendance_leaves.id,
                    attendance_leaves.employee_id,
                    attendance_leaves.approver_id,
                    attendance_leaves.reason as leave_reason,
                    attendance_leave_types.name as leave_type,
                    attendance_leaves.date_start,
                    attendance_leaves.date_end,
                    employees.employee_code,
                    CONCAT_WS(' . '" "' . ', employees.last_name,", " ,employees.first_name) as employee_full_name
                ')
                ->join('employees', $this->_table.'.employee_id = employees.id', 'left')
                ->join('attendance_leave_types', $this->_table.'.attendance_leave_type_id = attendance_leave_types.id', 'left');
        
        return $this->get_by($where);
    }
}
