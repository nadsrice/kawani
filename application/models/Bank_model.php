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
class Bank_model extends MY_Model {

    protected $_table      = 'banks';
    protected $primary_key = 'id';
    protected $return_type = 'array';

    /**
     * Callbacks or Observers
     */
    protected $before_create = ['generate_date_created_status'];
    protected $after_get     = ['set_default_data'];
    protected $after_create  = ['write_audit_trail'];
    protected $after_update  = ['write_audit_trail'];

    protected function generate_date_created_status($bank)
    {
        $bank['created']       = date('Y-m-d H:i:s');
        $bank['active_status'] = 1;
        $bank['created_by']    = 0;
        return $bank;
    }

    protected function set_default_data($bank)
    {
        $bank['active_status']  = ($bank['active_status'] == 1) ? 'Active' : 'Inactive';
        $bank['status_label']   = ($bank['active_status'] == 'Active') ? 'De-activate' : 'Activate';
        return $bank;
    }

    public function get_bank_by($param)
    {
        $query = $this->db;
        $query->select('*');
        return $this->get_by($param);
    }

    public function get_many_bank_by($param)
    {
        $query = $this->db;
        $query->select('*');
        return $this->get_many_by($param);
    }

    public function get_bank_all()
    {
        $query = $this->db;
        $query->select('*');
        return $this->get_all();
    }
}
