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

class Employee_leave_credits extends MY_Controller {

	private $active_menu = 'Administration';

	function __construct()
	{
		parent::__construct();
		$this->load->library('audit_trail');
		$this->load->model(['employee_leave_credit_model']);
	}

	function index()
	{
		$employee_leave_credits = $this->employee_leave_credit_model->get_employee_leave_credit_all();
		$companies 	            = $this->company_model->get_company_all();
		// $teams 				= $this->team_model->get_team_all();

		$this->data = array(
			'page_header'            => 'Employee Leave Credit Management',
			'employee_leave_credits' => $employee_leave_credits,
            'companies'              =
			'active_menu'            => $this->active_menu,
		);
		$this->load_view('pages/employee_leave_credit-lists');
	}

	function add()
	{
		$this->data = array(
			'page_header' => 'Employee Leave Credit Management',
			'active_menu' => $this->active_menu,
		);

		$employee_leave_credits = $this->employee_leave_credit_model->get_employee_leave_credit_all();
		$data     = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('employee_leave_credit_add'));
		// dump($data);exit;
		$this->form_validation->set_data($data);

		if ($this->form_validation->run('employee_leave_credit_add') == TRUE)
		{
			$this->session->set_flashdata('log_parameters', [
				'action_mode' => 0,
				'perm_key' 	  => 'add_leave_credit',
				'old_data'	  => NULL,
				'new_data'    => $data
			]);

			$employee_leave_credit_id = $this->employee_leave_credit_model->insert($data);

			if ( ! $employee_leave_credit_id) {
				$this->session->set_flashdata('failed', 'Failed to add new employee_leave_credit.');
				redirect('employee_leave_credits');
			} else {
				$this->session->set_flashdata('success', 'Successfully added '. $data['name']);
				redirect('employee_leave_credits');
			}
		}
		$this->load_view('forms/employee_leave_credit-add');
	}

	function details($id)
	{
		$employee_leave_credit = $this->employee_leave_credit_model->get_employee_leave_credit_by(['employee_leave_credits.id' => $id]);

		$this->data = array(
			'page_header' => 'Employee Leave Credit Details',
			'employee_leave_credit'     	  => $employee_leave_credit,
			'active_menu' => $this->active_menu,
		);
		$this->load_view('pages/employee_leave_credit-details');
	}

	public function edit($id)
	{
		// get specific employee_leave_credit based on the id
		$employee_leave_credit = $this->employee_leave_credit_model->get_employee_leave_credit_by(['employee_leave_credits.id' => $id]);

		$this->data = array(
			'page_header'            => 'Employee Leave Credit Management',
			'employee_leave_credit'  => $employee_leave_credit,
			'active_menu'            => $this->active_menu,
		);

		$employee_leave_credits = $this->employee_leave_credit_model->get_employee_leave_credit_all();
		$data = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('employee_leave_credit_edit'));

		$this->form_validation->set_data($data);

		if ($this->form_validation->run('employee_leave_credit_edit') == TRUE)
		{
			$this->session->set_flashdata('log_parameters', [
				'action_mode' => 1,
				'perm_key' 	  => 'edit_leave_credit',
				'old_data'	  => $employee_leave_credit,
				'new_data'    => $data
			]);

			$employee_leave_credit_id = $this->employee_leave_credit_model->update($id, $data);

			if ( ! $employee_leave_credit_id) {
				$this->session->set_flashdata('failed', 'Failed to update employee_leave_credit.');
				redirect('employee_leave_credits');
			} else {
				$this->session->set_flashdata('success', $data['name'] .' successfully updated!');
				redirect('employee_leave_credits');
			}
		}
		$this->load_view('forms/employee_leave_credit-edit');
	}

    public function edit_confirmation($id)
    {
        $edit_employee_leave_credit 		= $this->employee_leave_credit_model->get_by(['id' => $id]);
        $data['edit_employee_leave_credit'] = $edit_employee_leave_credit;

        $this->load->view('modals/modal-update-employee_leave_credit', $data);
    }

    public function update_status($id)
    {
        $employee_leave_credit_data = $this->employee_leave_credit_model->get_by(['id' => $id]);
        $data['employee_leave_credit_data'] = $employee_leave_credit_data;

        $post = $this->input->post();

        if (isset($post['mode']))
        {
            $result = FALSE;

            if ($post['mode'] == 'De-activate')
            {
                dump('De-activating...');
                $result = $this->employee_leave_credit_model->update($id, ['active_status' => 0]);
                dump($this->db->last_query());
            }
            if ($post['mode'] == 'Activate')
            {
                dump('Activating...');
                $result = $this->employee_leave_credit_model->update($id, ['active_status' => 1]);
                dump($this->db->last_query());
            }

            if ($result)
            {
                 $this->session->set_flashdata('message', $employee_leave_credit_data['name'].' successfully '.$post['mode'].'d!');
                 redirect('employee_leave_credits');
            }
            else
            {
                $this->session->set_flashdata('failed', 'Unable to '.$post['mode'].' '.$employee_leave_credit_data['name'].'!');
                redirect('employee_leave_credits');
            }

        }
        else
        {
            $this->load->view('modals/modal-update-employee_leave_credit-status', $data);
        }
    }
}
