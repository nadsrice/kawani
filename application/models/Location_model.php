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
class Location_model extends MY_Model {

	protected $_table = 'locations';
	protected $primary_key = 'id';
	protected $return_type = 'array';

	/**
	 * Callbacks or Observers
	 */
	
	public function get_locations()
	{
        $query = $this->db;

        $query->select('
            CONCAT_WS(", ", "barangay", "city", "province") as loc
        ');

        return $this->get_all();
	}
}
