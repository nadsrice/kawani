<?php


defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author      cristhiansagun@systemantech.com
 * @date        July 24, 2017
 */
class Employee_dependent_model extends MY_Model
{
    protected $_table = 'employee_dependents';
    protected $primary_key = 'id';
    protected $return_type = 'array';
}

// End of file Employee_dependent_model.php
// Location: ./application/models/Employee_dependent_model.php
