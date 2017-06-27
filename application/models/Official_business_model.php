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

class Official_business_model extends MY_Model {

    protected $_table = 'official_businesses';
    protected $primary_key = 'id';
    protected $return_type = 'array';

    /**
     * Callbacks or Observers
     */
    protected $before_create = ['generate_date_created_status'];
    protected $after_get = ['set_default_data'];

    protected function generate_date_created_status($official_business)
    {
        $official_business['created'] = date('Y-m-d H:i:s');
        //$official_business['active_status'] = 1;
        $official_business['created_by'] = '0';
        return $official_business;
    }

    protected function set_default_data($official_business)
    {   
        $official_business['active_status']  = ($official_business['status'] == 1) ? 'Active' : 'Inactive';
        return $official_business;
    }
    
    public function get_ob_by($param)
    {
        $query = $this->db;
        $query->select('official_businesses.*, 
                        CONCAT_WS(' . '" "' . ', employees.first_name," " ,employees.last_name) as full_name');
        $query->join('employees', 'employees.id = official_businesses.employee_id', 'left');
        $query->order_by('full_name', 'asc');
        //$query->join('companies', 'official_businesses.company_id = companies.id', 'left');

        return $this->get_by($param);
    }

    public function get_many_ob_by($param)
    {
        $query = $this->db;
        $query->select('official_businesses.*, 
                        CONCAT_WS(' . '" "' . ', employees.first_name," " ,employees.last_name) as full_name');
        $query->join('employees', 'employees.id = official_businesses.employee_id', 'left');
        $query->order_by('full_name', 'asc');
        // $query->join('companies', 'official_businesses.company_id = companies.id', 'left');
        // $query->order_by('companies.id', 'asc');

        return $this->get_many_by($param);
    }

    public function get_ob_all()
    {
        $query = $this->db;
        $query->select('official_businesses.*, 
                       CONCAT_WS(' . '" "' . ', employees.first_name," " ,employees.last_name) as full_name,
                       CONCAT_WS(' . '" "' . ', contact_persons.first_name," " ,contact_persons.last_name) as contact_person,
                       CONCAT_WS(' . '" "' . ', official_businesses.time_start," - " ,official_businesses.time_end) as ob_time,
                       accounts.name as account_name');
        $query->join('employees', 'employees.id = official_businesses.employee_id', 'left');
        $query->join('accounts', 'accounts.id = official_businesses.account_id', 'left');
        $query->join('contact_persons', 'contact_persons.id = official_businesses.contact_person_id', 'left');

        return $this->get_all();
    }
}
