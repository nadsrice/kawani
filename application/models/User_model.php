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
class User_model extends MY_Model {

	protected $_table = 'users';
	protected $primary_key = 'id';
	protected $return_type = 'array';

	protected $after_get = array('remove_sensitive_data', 'concat_name_fields');

	protected function concat_name_fields($user)
	{
		$user['full_name'] = $user['last_name'] . ', ' . $user['first_name'];
		return $user;
	}

	protected function remove_sensitive_data($user)
	{
		$sensitive_fields = [
			'password',
			'ip_address',
			'salt',
			'activation_code',
			'forgotten_password_code',
			'forgotten_password_time',
			'remember_code',
			'created_on',
			'last_login',
		];

		foreach ($sensitive_fields as $field_key => $field_name)
		{
			unset($user[$field_name]);
		}

		return $user;
	}
}
