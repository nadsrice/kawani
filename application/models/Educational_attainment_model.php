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
class Educational_attainment_model extends MY_Model {

    protected $_table = 'educational_attainments';
    protected $primary_key = 'id';
    protected $return_type = 'array';

    /**
     * Callbacks or Observers
     */
    protected $before_create = ['generate_date_created_status'];

    protected function generate_date_created_status($educational_attainment)
    {
        $educational_attainment['created'] = date('Y-m-d H:i:s');
        $educational_attainment['active_status'] = 1;
        $educational_attainment['created_by'] = '0';
        return $educational_attainment;
    }
}
