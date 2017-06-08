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
    protected $before_create = [
        'set_default_data'
    ];

    protected function set_default_data($company)
    {
        $company['created']       = date('Y-m-d H:i:s');
        $company['active_status'] = 1;
        $company['created_by']    = 0;

        return $company;
    }

    public function get_company_by($param)
    {
        $query = $this->db;
        $query->select('companies.*, branches.name as branch_name');
        $query->join('branches', 'companies.id = branches.company_id', 'left');

        return $this->get_by($param);
    }

    public function get_many_company_by($param)
    {
        $query = $this->db;
        $query->select('companies.*, branches.name as branch_name');
        $query->join('branches', 'companies.id = branches.company_id', 'left');

        return $this->get_many_by($param);
    }

    public function get_company_all()
    {
        $query = $this->db;
        $query->select('companies.*, branches.name as branch_name');
        $query->join('branches', 'companies.id = branches.company_id', 'left');

        return $this->get_all();
    }
}
