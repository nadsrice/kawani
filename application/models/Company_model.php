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
class Company_model extends MY_Model {

    protected $_table = 'companies';
    protected $primary_key = 'id';
    protected $return_type = 'array';
    /**
     * Callbacks or Observers
     */
    protected $before_create = ['generate_date_created_status'];
    protected $after_get = ['set_default_data'];

    protected function generate_date_created_status($company)
    {
        $company['created'] = date('Y-m-d H:i:s');
        $company['active_status'] = 1;
        $company['created_by'] = '0';
        return $company;
    }

    protected function set_default_data($company)
    {   
        $company['active_status']  = ($company['active_status'] == 1) ? 'Active' : 'Inactive';
        $company['status_label']  = ($company['active_status'] == 'Active') ? 'De-activate' : 'Activate';
        return $company;
    }

    public function get_company_by($param)
    {
        $query = $this->db;
        $query->select('companies.*');
        $query->join('branches', 'branches.company_id = companies.id');
        $query->order_by('companies.name', 'asc');
        return $this->get_by($param);
    }
    public function get_many_company_by($param)
    {
        $query = $this->db;
        $query->select('companies.*');
        $query->order_by('name', 'asc');
        return $this->get_many_by($param);
    }
    public function get_company_all()
    {
        $query = $this->db;
        $query->select('companies.*');
        $query->order_by('name', 'asc');
        return $this->get_all();
    }
}