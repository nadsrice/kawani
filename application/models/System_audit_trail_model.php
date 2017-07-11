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

	protected $after_get = ['prep_default_data'];

	protected function prep_default_data($audit_trail)
	{
		if ( ! isset($audit_trail)) return FALSE;

		$created  = ($audit_trail['action_mode'] == 0);
		$modified = ($audit_trail['action_mode'] == 1);
		$deleted  = ($audit_trail['action_mode'] == 2);

		$audit_trail['mode_label'] = $created ? "Created" : ($modified ? "Modified" : ($deleted ? "Deleted" : "Default"));

		return $audit_trail;
	}
}
