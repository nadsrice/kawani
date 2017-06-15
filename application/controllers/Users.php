<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
 * Some class description here...
 *
 * @package     KAWANI
 * @subpackage  subpackage
 * @category    category
 * @author      cristhian.sagun@systemantech.com
 * @link        http://systemantech.com
 */
class Users extends MY_Controller {

	private $active_menu = 'System';
	private $_smtp_pass = '!Aezakmibaguvixhesoyam8893';

	function __construct()
	{
		parent::__construct();
		$this->load->model([
			'user_model'
		]);
	}

	function index()
	{
		$users = $this->user_model->get_all();
		
		$this->data = array(
			'page_header' => 'User Management',
			'active_menu' => $this->active_menu,
			'users'		  => $users,
		);
		$this->load_view('pages/user-list');
	}

	function add()
	{
		// get all company records where status is equal to active
		$companies = $this->company_model->get_many_by(['active_status' => 1]);

		$this->data = array(
			'page_header' => 'User Management',
			'companies'	  => $companies,
			'active_menu' => $this->active_menu,
		);

		$users = $this->user_model->get_User_all();
		$data = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('User_add'));
		
		$this->form_validation->set_data($data);

		if ($this->form_validation->run('User_add') == TRUE)
		{
			$User_id = $this->user_model->insert($data);

			if ( ! $User_id) {
				$this->session->set_flashdata('failed', 'Failed to add new User.');
				redirect('users');
			} else {
				$this->session->set_flashdata('success', 'Successfully added new User.');
				redirect('users');
			}
		}
		$this->load_view('forms/User-add');
	}

	function details($id)
	{
		$user = $this->user_model->get_by(['id' => $id]);
		dump($user);
	}

	function edit($id)
	{
		// get specific User based on the id
		$User = $this->user_model->get_User_by(['users.id' => $id]);
		// dump($User);exit;
		// get all company records where status is equal to active
		$companies = $this->company_model->get_many_by(['active_status' => 1]);
		// dump($this->db->last_query());exit;
		$this->data = array(
			'page_header' => 'User Management',
			'User' 	  => $User,
			'companies'	  => $companies,
			'active_menu' => $this->active_menu,
		);

		$users = $this->user_model->get_User_all();
		$data = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('User_add'));
		
		$this->form_validation->set_data($data);

		if ($this->form_validation->run('User_add') == TRUE)
		{
			$User_id = $this->user_model->update($id, $data);

			if ( ! $User_id) {
				$this->session->set_flashdata('failed', 'Failed to update User.');
				redirect('users');
			} else {
				$this->session->set_flashdata('success', 'User successfully updated!');
				redirect('users');
			}
		}

		
		$this->load_view('forms/User-edit');
	}
}
