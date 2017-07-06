<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Audit_trail
{
	const AC_CREATED  = 0;
	const AC_MODIFIED = 1;
	const AC_DELETED  = 2;

	protected $_ci;
	protected $_table = 'system_audit_trails';
	protected $data_model;

	function __construct()
	{
		$this->_ci =& get_instance();
		$this->data_model = $this->_ci->load->model('system_audit_trail_model');
	}

	public function write_log($action_mode, $permission_key = '', $addtional_data = array())
	{
		$user = $this->_ci->ion_auth->user()->row();

		$data = [
			'action_mode' 	 => $action_mode,
			'system_user_id' => $user->id,
			'timestamp'		 => date('Y-m-d H:i:s'),
			'ip_address'	 => $this->_ci->input->ip_address()
		];

		$new_data = array_merge($this->_filter_data($this->_table, $addtional_data), $data);

		$this->_ci->system_audit_trail_model->insert($new_data);
	}

	protected function _filter_data($table, $data)
	{
		$filtered_data = array();
		$columns = $this->_ci->db->list_fields($table);

		if (is_array($data))
		{
			foreach ($columns as $column)
			{
				if (array_key_exists($column, $data))
					$filtered_data[$column] = $data[$column];
			}
		}

		return $filtered_data;
	}
}