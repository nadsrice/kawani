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

	function __construct()
	{
		parent::__construct();
		$this->load->model(['user_model']);
	}

	function index()
	{
		if ( ! $this->ion_auth_acl->has_permission('view_users'))
		{
			$this->session->set_flashdata('failed', 'Sorry you have no permission to access this function.');
			redirect('/', '');
		}
		$this->data['page_header'] = 'User Management';
		$this->data['active_menu'] = $this->active_menu;

		//list the users
		$this->data['users'] = $this->ion_auth->users()->result();
		foreach ($this->data['users'] as $k => $user)
		{
			$this->data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
		}

		$this->load_view('pages/user-list');
	}

	public function confirmation()
	{
		$user_id = $this->uri->segment(3);
		$user = $this->ion_auth->user($user_id)->row();
		$data['user_data'] = $user;

		$this->load->view('modals/modal-update-user-status', $data);
	}

	public function update_status($id)
	{
		$user_data = $this->ion_auth->user($id)->row();
		$data['user_data'] = $user_data;

		$users = $this->user_model->get_User_all();
		$data = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('User_add'));

		$this->form_validation->set_data($data);


		$post = $this->input->post();

		if ( ! isset($post['mode']))
		{
			$this->load->view('modals/modal-update-role-status', $data);
		}

		$result = ($post['mode'] == 1) ? $this->user_model->update($id, ['active' => 0]) : $this->user_model->update($id, ['active' => 1]);
		$mode_label = ($post['mode'] == 1) ? 'De-activated':'Activated';
		if ($result)
		{
			$this->session->set_flashdata('message', 'Successfully '.$mode_label.' user status.');
			redirect('users');
		}
		else
		{
			$this->session->set_flashdata('failed', 'Unable to '.$mode_label.' user status.');
			redirect('users');
		}
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

	public function update_default_role()
	{
		$this->load->model('user_roles_model');
		$post = $this->input->post();

		$user = $this->ion_auth->user($post['user_id'])->row();
		// get the current default user role
		$current_role = $this->user_roles_model->get_by([
			'system_user_id' => $post['user_id'],
			'default_status' => 1
		]);
		
		if ($current_role['id'] != $post['user_role_id']) {
			$updated = $this->db->set('default_status', 1)
								->where('system_user_id', $post['user_id'])
								->where('system_group_id', $post['user_role_id'])
								->update('system_users_groups');

			if ($updated) {
				$test = $this->db->set('default_status', 0)
					->where('system_user_id', $post['user_id'])
					->where('system_group_id', $current_role['system_group_id'])
					->update('system_users_groups');

				if ($test) {
					$this->session->set_flashdata('success', 'Successfully updated default role of user named '.$user->first_name.' '.$user->last_name);
					redirect('users');
				}
			}
		}
	}
}
