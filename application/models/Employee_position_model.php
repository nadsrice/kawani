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
class Employee_position_model extends MY_Model {

    protected $_table = 'employee_positions';
    protected $primary_key = 'id';
    protected $return_type = 'array';

    /**
     * Callbacks or Observers
     */
    protected $before_create = ['generate_date_created_status'];

    protected function generate_date_created_status($employee_position)
    {
        $employee_position['created'] = date('Y-m-d H:i:s');
        $employee_position['active_status'] = 1;
        $employee_position['created_by'] = '0';
        return $employee_position;
    }
}
