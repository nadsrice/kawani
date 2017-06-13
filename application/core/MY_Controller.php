<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Some class description here...
 *
 * @package     KAWANI
 * @subpackage  subpackage
 * @category    category
 * @author      joseph.gono@systemantech.com
 * @link        http://systemantech.com
 */
class MY_Controller extends CI_Controller {

	private $_models = [
		'branch_model',
		'company_model',
		'employee_model',
		'department_model',
		'employment_type_model',
		'employee_position_model',
		'educational_attainment_model',
		'site_model',
	];

	protected $data = array();

	function __construct()
	{
		parent::__construct();

		if ( ! $this->ion_auth->logged_in())
		{
			redirect('auth/login');
		}

		$this->load->model($this->_models);
	}

	protected function prep_user_data()
	{
		$user = $this->ion_auth->user()->row();
		$user_roles = $this->ion_auth->get_users_groups($user->id)->result();
		$user_roles[0]->id; // Index 0 for default user_role_id
		$this->data['navigation_menu'] = $this->acl->get_role_navigation_menu($user_roles[0]->id);
		$this->data['user_details'] = $user;
		$this->data['user_role'] = $user_roles[0]->name;
	}

    protected function load_view($sub_view = null)
    {
		$this->data['sub_view'] = (isset($sub_view)) ? $sub_view : 'errors/error_404';
		$this->data['app_version'] = $this->config->item('app_version');

		foreach ($this->config->item('main_components') as $key => $component)
		{
			$this->data[$key] = strtolower(sprintf('%s/%s', 'components', $component));
		}

		foreach ($this->config->item('layout_settings') as $layout_key => $layout_value)
		{
			$this->data[$layout_key] = $layout_value;
		}

		foreach ($this->config->item('btn_settings') as $btn_key => $btn_value)
		{
			$this->data[$btn_key] = $btn_value;
		}

		$this->prep_user_data();

		$this->load->view('layouts/kawani-main-layout', $this->data);
		$this->output->enable_profiler(false);
    }
}
