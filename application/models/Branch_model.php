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
class Branch_model extends MY_Model {

    protected $_table = 'branches';
    protected $primary_key = 'id';
    protected $return_type = 'array';

    /**
     * Callbacks or Observers
     */
    protected $before_create = ['generate_date_created_status'];

    protected function generate_date_created_status($branch)
    {
        $branch['created'] = date('Y-m-d H:i:s');
        $branch['active_status'] = 1;
        $branch['created_by'] = '0';
        return $branch;
    }

    public function get_branch_by($param)
    {
        $query = $this->db;
        $query->select('branches.*, companies.registered_name as company_name');
        $query->join('companies', 'branches.company_id = companies.id', 'left');

        return $this->get_by($param);
    }

    public function get_branch_all()
    {
        $query = $this->db;
        $query->select('branches.*, companies.registered_name as company_name');
        $query->join('companies', 'branches.company_id = companies.id', 'left');
        $query->order_by('companies.id', 'asc');

        return $this->get_all();
    }
}
