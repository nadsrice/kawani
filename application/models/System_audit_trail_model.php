<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/**
*
*/
class system_audit_trail_model extends MY_Model
{
	protected $_table 	   = 'system_audit_trails';
	protected $primary_key = 'id';
	protected $return_type = 'array';

	protected $after_get = ['prep_default_data'];

	protected function prep_default_data($audit_trail)
	{
		if ( ! isset($audit_trail)) return FALSE;

		$mode_labels = [
			'CREATED',
			'MODIFIED',
			'APPROVED',
			'REJECTED',
			'CANCELLED'
		];

		$audit_trail['mode_label'] = ($audit_trail['action_mode'] > 4) ? 'N/A' : $mode_labels[$audit_trail['action_mode']];
		return $audit_trail;
	}
}
