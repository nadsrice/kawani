<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class User_roles_model extends MY_Model
{
    protected $_table = 'users_groups';
    protected $primary_key = 'id';
    protected $return_type = 'array';
}
