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
class Team_model extends MY_Model {

    protected $_table      = 'teams';
    protected $primary_key = 'id';
    protected $return_type = 'array';

    /**
     * Callbacks or Observers
     */
    protected $before_create = ['generate_date_created_status'];
    protected $after_get     = ['set_default_data'];

    protected function generate_date_created_status($team)
    {
        $user                  = $this->ion_auth->user()->row();
        $team['created']       = date('Y-m-d H:i:s');
        $team['created_by']    = $user->employee_id;
        $team['active_status'] = 1;
        return $team;
    }

    protected function set_default_data($team)
    {
        $team['active_status']  = ($team['active_status'] == 1) ? 'Active' : 'Inactive';
        return $team;
    }

    public function get_team_by($param)
    {
        $query = $this->db;
        $query->select('*');

        return $this->get_by($param);
    }

    public function get_many_team_by($param)
    {
        $query = $this->db;
        $query->select('*');

        return $this->get_many_by($param);
    }

    public function get_team_all()
    {
        $query = $this->db;
        $query->select('*');

        return $this->get_all();
    }

    public function get_team_data($from = 'teams', $where = '')
    {
        if ( ! empty($where)) {
            $this->db->where($where);
        }
        $query = $this->db->select('*')->from($from)->get();

        return $query->result_array();

    }
}
