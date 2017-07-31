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
class Holiday_model extends MY_Model {

    protected $_table      = 'attendance_holidays';
    protected $primary_key = 'id';
    protected $return_type = 'array';

    /**
     * Callbacks or Observers
     */
    protected $before_create = ['generate_date_created_status'];
    protected $after_get     = ['set_default_data'];
    protected $after_create  = ['write_audit_trail'];
    protected $after_update  = ['write_audit_trail'];

    protected function generate_date_created_status($holiday)
    {
        $holiday['created']       = date('Y-m-d H:i:s');
        $holiday['active_status'] = 1;
        $holiday['created_by']    = 0;
        return $holiday;
    }

    // protected function set_modified_data($holiday)
    // {
    //     $holiday['modified'] = date('Y-m-d H:i:s');
    //     return $holiday;
    // }

    protected function set_default_data($holiday)
    {
        $holiday['active_status'] = ($holiday['active_status'] == 1) ? 'Active' : 'Inactive';
        $holiday['status_label']  = ($holiday['active_status'] == 'Active') ? 'De-activate' : 'Activate';
        return $holiday;
    }

    public function get_holiday_by($param)
    {
        $query = $this->db;
        $query->select('
            attendance_holidays.*,
            companies.name as company_name,
            branches.name as branch_name,
            sites.name as site_name
        ');
        $query->join('companies', 'attendance_holidays.company_id = companies.id', 'left');
        $query->join('branches', 'attendance_holidays.branch_id = branches.id', 'left');
        $query->join('sites', 'attendance_holidays.site_id = sites.id', 'left');

        return $this->get_by($param);
    }

    public function get_many_holiday_by($param)
    {
        $query = $this->db;
        $query->select('
            attendance_holidays.*,
            companies.name as company_name,
            branches.name as branch_name,
            sites.name as site_name
        ');
        $query->join('companies', 'attendance_holidays.company_id = companies.id', 'left');
        $query->join('branches', 'attendance_holidays.branch_id = branches.id', 'left');
        $query->join('sites', 'attendance_holidays.site_id = sites.id', 'left');

        return $this->get_many_by($param);
    }

    public function get_holiday_all()
    {
        $query = $this->db;
        $query->select('
            attendance_holidays.*,
            companies.name as company_name,
            branches.name as branch_name,
            sites.name as site_name
        ');
        $query->join('companies', 'attendance_holidays.company_id = companies.id', 'left');
        $query->join('branches', 'attendance_holidays.branch_id = branches.id', 'left');
        $query->join('sites', 'attendance_holidays.site_id = sites.id', 'left');

        return $this->get_all();
    }
}
