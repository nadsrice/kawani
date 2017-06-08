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
class Department_model extends MY_Model {

    protected $_table = 'departments';
    protected $primary_key = 'id';
    protected $return_type = 'array';

    /**
     * Callbacks or Observers
     */
    protected $before_create = ['generate_date_created_status'];

    protected function generate_date_created_status($department)
    {
        $department['created'] = date('Y-m-d H:i:s');
        $department['active_status'] = 1;
        $department['created_by'] = '0';
        return $department;
    }
}
