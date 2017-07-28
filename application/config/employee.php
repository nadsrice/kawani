<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$config['log_modes'] = [
    'CREATED',
    'MODIFIED',
    'APPROVED',
    'REJECTED',
    'CANCELLED',
    'ACTIVATED',
    'DEACTIVATED'
];

$config['joins']['users']           = 'system_users';
$config['joins']['groups']          = 'system_groups';
$config['joins']['users_groups']    = 'system_users_groups';
$config['joins']['login_attempts']  = 'system_login_attempts';


/* End of file employee.php */
/* Location: ./application/config/employee.php */
