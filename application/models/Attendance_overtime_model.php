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
class Attendance_overtime_model extends MY_Model {

    protected $_table = 'attendance_overtimes';
    protected $primary_key = 'id';
    protected $return_type = 'array';
    /**
     * Callbacks or Observers
     */
    protected $before_create = ['generate_date_created_status'];
    //protected $after_get = ['set_default_data'];

    protected function generate_date_created_status($overtime)
    {
        $overtime['created']            = date('Y-m-d H:i:s');
        $overtime['created_by']         = 0;
        $overtime['status']             = 1;
        $overtime['approval_status']    = 2;
        return $overtime;
    }

    // protected function set_default_data($overtime)
    // {   
    //     $overtime['active_status']  = ($overtime['active_status'] == 1) ? 'Active' : 'Inactive';
    //     $overtime['status_label']  = ($overtime['active_status'] == 'Active') ? 'De-activate' : 'Activate';
    //     return $overtime;
    // }

    public function get_overtime_by($param)
    {
        $query = $this->db;
        $query->select('attendance_overtimes.*');
        return $this->get_by($param);
    }
    public function get_many_overtime_by($param)
    {
        $query = $this->db;
        $query->select('attendance_overtimes.*');
        return $this->get_many_by($param);
    }
    public function get_overtime_all()
    {
        $query = $this->db;
        $query->select('attendance_overtimes.*');
        return $this->get_all();
    }
}