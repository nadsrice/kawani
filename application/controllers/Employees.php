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
class Employees extends MY_Controller {

	private $active_menu = 'Employee';

	function __construct()
	{
		parent::__construct();
		$this->load->library('ion_auth');
		$this->config->load('employee', TRUE);
		$this->load->helper('url');
		$this->load->model([
			'employee_personal_information_model',
			'employee_parent_information_model',
			'employee_spouse_information_model',
			'employee_dependent_model',
			'employee_address_model',
			'employee_contact_model',
			'employee_positions_model',
			'employee_salaries_model',
			'employee_benefits_model',
			'employee_information_model',
			'employee_emergency_contact_model',
			'employee_employment_information_model',
			'civil_status_model',
			'relationship_model',
			'location_model',
			'country_model',
			'position_model'
		]);
	}

	public function index()
	{
		$employees = $this->employee_model->get_employee_all();

		$this->data = array(
			'page_header' => 'Employee Management',
			'employees'   => $employees,
			'active_menu' => $this->active_menu,
		);

		$this->load_view('pages/employee-lists');
	}

	// public function add()
	// {
	//     $this->load->view('modals/modal-add-employee-direct');
	// }

	// public function save($id = '')
	// {
	//     if (empty($id)) $this->employee_model->create_account();
	// }

    public function informations($employee_id)
    {
		// TODO: check permission key = 'employee_information';

		$post = $this->input->post();
		$spouse_id = $this->session->flashdata('spouse_id');
		$this->data['spouse_id'] = $spouse_id;

		if ( ! isset($spouse_id)) {
			$spouse_information = $this->employee_spouse_information_model->get_many_by(['employee_id' => $employee_id]);
		} else {
			$spouse_information = $this->employee_spouse_information_model->get_by(['employee_id' => $employee_id, 'id' => $spouse_id]);
		}

		$this->data['page_header']            = 'Employee Informations';
		$this->data['employee_id']            = $employee_id;
		$this->data['spouse_information']     = $spouse_information;
		$this->data['personal_information']   = $this->employee_model->get_by(['id' => $employee_id]);
		$this->data['parents_information']    = $this->employee_parent_information_model->get_many_by(['employee_id' => $employee_id, 'relationship_id' => [2,3]]);
		$this->data['employee_dependents']    = $this->employee_dependent_model->get_details('get_many_by', ['employee_dependents.employee_id' => $employee_id]);
		$this->data['employee_adresses']	  = $this->employee_address_model->get_details('get_many_by', ['employee_addresses.employee_id' => $employee_id]);
		$this->data['employee_contacts']	  = $this->employee_contact_model->get_details('get_many_by', ['employee_contacts.employee_id' => $employee_id]);
		$this->data['employee_benefits']	  = $this->employee_benefits_model->get_details('get_many_by', ['employee_benefits.employee_id' => $employee_id]);
		$this->data['employee_positions']	  = $this->employee_positions_model->get_details('get_many_by', ['employee_positions.employee_id' => $employee_id]);
		$this->data['employee_salaries']	  = $this->employee_salaries_model->get_details('get_many_by', ['employee_salaries.employee_id' => $employee_id]);
		$this->data['emergency_contacts']	  = $this->employee_emergency_contact_model->get_details('get_many_by', ['employee_emergency_contacts.employee_id' => $employee_id]);
		$this->data['employment_information'] = $this->employee_employment_information_model->get_details('get_many_by', ['employee_information.employee_id' => $employee_id]);
		$this->data['civil_status']           = $this->civil_status_model->get_many_by(['active_status' => 1]);
		$this->data['relationships']          = $this->relationship_model->get_all();
		$this->data['show_edit_modal']        = FALSE;

		$civil_status_id = $this->data['personal_information']['civil_status_id'];

		$this->data['current_civil_status'] = $this->civil_status_model->get_by(['id' => $civil_status_id]);

		if (isset($post['mode']))
		{
			$form = array(
				'edit' => 'modals/employee/forms/edit/modal-'.$post['information_type'],
				'add'  => 'modals/employee/forms/add/modal-'.$post['information_type'],
			);
			$explode = explode('-', $post['information_type']);
			$modal_title = $post['mode'].' '.implode(' ', $explode);

			$this->data['show_edit_modal'] = TRUE;
			$this->data['modal_content'] = ($post['mode'] == 'edit') ? $form['edit'] : $form['add'];
			$this->data['modal_title'] = ucwords($modal_title);
			
		}

		$this->load_view('pages/employee-informations');
    }

    public function confirmation()
    {
		$mode 		 = $this->uri->segment(3);
		$information = $this->uri->segment(4);
		$employee_id = ( ! empty($this->uri->segment(5))) ? $this->uri->segment(5) : NULL;

		$employee 			= $this->employee_model->get_by('id', $employee_id);
		$exploded			= explode('_', $information);
		$information_type	= implode(' ', $exploded);
		$confirm_message 	= sprintf(lang('confirmation_message'), $mode.' '.$information_type, ucwords(strtolower($employee['full_name'])));

		$this->session->set_flashdata('spouse_id', $this->uri->segment(6));

		$data = array(
			'modal_title'		=> ucwords($information_type),
			'modal_message'		=> $confirm_message,
			'mode'				=> $mode,
			'url'				=> 'employees/informations/'.$employee_id,
			'information_type'	=> implode('-', $exploded),
		);

		$this->load->view('modals/modal-confirmation', $data);
	}

	public function edit()
	{
		$method = $this->uri->segment(2);
		$param = array(
			'data_model'  => $this->uri->segment(3),
			'employee_id' => $this->uri->segment(4),
			'posted_data' => $this->input->post()
		);

		$this->{$param['data_model'].'_model'}->{$method}($param['employee_id'], $param['posted_data']);
	}

    public function save()
    {
		$param = array(
			'data_model'  => $this->uri->segment(3),
			'employee_id' => $this->uri->segment(4),
			'posted_data' => $this->input->post()
		);

		$this->{$param['data_model'].'_model'}->save($param['employee_id'], $param['posted_data']);
	}

	public function edit_spouse()
	{
		$post = $this->input->post();

		$employee_id = $this->uri->segment(3);
		$spouse_id = $this->uri->segment(4);

		$this->data['spouse_information'] = $this->employee_spouse_information_model->get_by([
			'employee_id' => $employee_id,
			'id' => $spouse_id
		]);

		if (isset($post['mode']) && $post['mode'] == 'edit')
		{
			$this->data['show_edit_modal'] = TRUE;
			$this->data['modal_content']   = 'modals/employee/modal-'.$post['information_type'];
		}
	}

	public function cancel_edit($employee_id)
	{
		redirect('employees/informations/'.$employee_id, 'refresh');
	}

	public function cancel_add($employee_id)
	{
		redirect('employees/informations/'.$employee_id, 'refresh');
	}

	public function view_employment_information($employee_information_id)
	{
		$data['employment_information'] = $this->employee_employment_information_model->get_details('get_by', [
			'employee_information.id' => $employee_information_id
		]);
		
		$this->load->view('modals/employee/details/employment-information', $data);
	}


	public function view_dependent_information($employee_dependent_id)
	{
		$data['employee_dependent'] = $this->employee_dependent_model->get_details('get_by', [
			'employee_dependents.id' => $employee_dependent_id
		]);
		$this->load->view('modals/employee/details/employee-dependent', $data);
	}

	public function view_position_information($employee_positions_id)
	{
		$data['employee_position'] = $this->employee_positions_model->get_details('get_by', [
			'employee_positions.id' => $employee_positions_id
		]);
		$this->load->view('modals/employee/details/employee-positions', $data);
	}

	public function view_benefit_information($employee_benefits_id)
	{
		$data['employee_benefit'] = $this->employee_benefits_model->get_details('get_by', [
			'employee_benefits.id' => $employee_benefits_id
		]);
		$this->load->view('modals/employee/details/employee-benefits', $data);
	}

	public function view_salary_information($employee_salaries_id)
	{
		$$data['employee_salary'] = $this->employee_salaries_model->get_details('get_by', [
			'employee_salaries.id' => $employee_salaries_id
		]);
		$this->load->view('modals/employee/details/employee-salaries', $data);
	}

	public function view_address_information($employee_address_id)
	{
		$data['employee_address'] = $this->employee_address_model->get_details('get_by', [
			'employee_addresses.id' => $employee_address_id
		]);
		$this->load->view('modals/employee/details/employee-address', $data);
	}

	public function view_contact_information($employee_contact_id)
	{
		$data['employee_contact'] = $this->employee_contact_model->get_details('get_by', [
			'employee_contacts.id' => $employee_contact_id
		]);
		$this->load->view('modals/employee/details/employee-contact', $data);
	}

	public function view_emergency_contact($emergency_contact_id)
	{
		$data['emergency_contact'] = $this->employee_emergency_contact_model->get_details('get_by', [
			'employee_emergency_contacts.id' => $emergency_contact_id
		]);
		$this->load->view('modals/employee/details/emergency-contact', $data);
	}

	public function change_designation()
	{
		$employee_id = $this->uri->segment(3);
		$data['employee_id'] = $employee_id;
		$data['modal_title'] = 'Change Designation';
		$data['positions'] 	 = $this->position_model->get_many_by(['active_status' => 1]);

		$data['current_position'] = $this->employee_positions_model->get_details('get_by', [
			'employee_positions.employee_id' => $employee_id,
			'employee_positions.active_status' => 1
		]);
		
		$employee_information = $this->employee_information_model->get_by([
			'employee_id' => $employee_id,
			'active_status' => 1
		]);

		$post = $this->input->post();

		$message = array();

		if (isset($post['mode']) && $post['mode'] === 'post') {

			$insert_data = array(
				'employee_id' 	 => $employee_id,
				'company_id' 	 => $employee_information['company_id'],
				'branch_id' 	 => $employee_information['branch_id'],
				'department_id'  => $employee_information['department_id'],
				'team_id' 		 => $employee_information['team_id'],
				'cost_center_id' => $employee_information['cost_center_id'],
				'site_id' 		 => $employee_information['site_id'],
				'position_id' 	 => $post['position_id'],
				'date_started'	 => $post['date_started'],
				'remarks'		 => $post['remarks'],
				'created'		 => date('Y-m-d H:i:s'),
				'created_by'	 => $this->ion_auth->user()->row()->id,
				'active_status'	 => 1
			);

			$last_id = $this->employee_positions_model->insert($insert_data);
			if ($last_id) {
				$message[] = 'successfully insert new employee position.';
				$current_position_id = $data['current_position']['employee_positions_id'];

				$update = $this->employee_positions_model->update($current_position_id, [
					'active_status' => 0,
					'date_ended'	=> date('Y-m-d H:i:s')
				]);

				if ($update) {
					$message[] = 'successfully updated previous employee position.';
				} else {
					$message[] = 'unable to update previous employee position.';
				}

			} else {
				$message[] = 'unable to insert new employee position.';
			}
			
			$this->session->set_flashdata('message', implode(' ', $message));
			redirect('employees/informations/' . $employee_id);
		}

		$this->load->view('modals/modal-change-designation', $data);
	}

	// AJAX calls
	public function ajax($function = '')
	{
		switch ($function) {
			case 'get-benefits':
				$this->load->model('benefit_model');
				echo json_encode(array('data' => $this->benefit_model->get_all()));
			break;
			case 'get-benefit-by':
				$this->load->model('benefit_model');
				$post = $this->input->post();
				dump($post);
				exit;
				echo json_encode(array('data' => $this->benefit_model->get_by()));
			break;
			case 'get-locations':
				$this->load->model('location_model');
				echo json_encode(array('data' => $this->location_model->get_all()));
			break;
			case 'get-countries':
				$this->load->model('country_model');
				echo json_encode(array('data' => $this->country_model->get_all()));
			break;

			default:
				# code...
			break;
		}
	}
}
