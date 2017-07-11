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
class Cost_center_model extends MY_Model {

    protected $_table = 'cost_centers';
    protected $primary_key = 'id';
    protected $return_type = 'array';

    /**
     * Callbacks or Observers
     */
    protected $before_create = ['generate_date_created_status'];
    protected $after_get = ['set_default_data'];
    // protected $after_update = ['set_modified_data'];

    protected function generate_date_created_status($cost_center)
    {
        $cost_center['created']       = date('Y-m-d H:i:s');
        $cost_center['active_status'] = 1;
        $cost_center['created_by']    = 0;
        return $cost_center;
    }

    // protected function set_modified_data($cost_center)
    // {
    //     $cost_center['modified'] = date('Y-m-d H:i:s');
    //     return $cost_center;
    // }

    protected function set_default_data($cost_center)
    {
        $cost_center['active_status']  = ($cost_center['active_status'] == 1) ? 'Active' : 'Inactive';
        // $cost_center['status_label']   = ($cost_center['active_status'] == 'Active') ? 'De-activate' : 'Activate';
        return $cost_center;
    }

    public function get_branch_by($param)
    {
        $query = $this->db;
        $query->select('cost_centers.*, companies.name as company_name');
        $query->join('companies', 'cost_centers.company_id = companies.id', 'left');
        $query->order_by('cost_centers.name', 'asc');

        return $this->get_by($param);
    }

    public function get_many_branch_by($param)
    {
        $query = $this->db;
        $query->select('cost_centers.*, companies.name as company_name');
        $query->join('companies', 'cost_centers.company_id = companies.id', 'left');
        $query->order_by('cost_centers.name', 'asc');

        return $this->get_many_by($param);
    }

    public function get_branch_all()
    {
        $query = $this->db;
        $query->select('cost_centers.*, companies.name as company_name');
        $query->join('companies', 'cost_centers.company_id = companies.id', 'left');
        $query->order_by('cost_centers.name', 'asc');

        return $this->get_all();
    }
}
