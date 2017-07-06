<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class system_audit_trail_model extends MY_Model
{
	protected $_table = 'system_audit_trails';
	protected $primary_key = 'id';
	protected $return_type = 'array';
}