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
class Companies extends MY_Controller {

	private $active_menu = 'System';

	/**
	 * Some description here
	 *
	 * @param   param
	 * @return  return
	 */

	function __construct()
	{
		parent::__construct();
		$this->load->library('audit_trail');
	}

	public function index()
	{
		// todo: get all companies records from database order by name ascending
			// todo: load company model
			// todo: load view & past the retrieved data from model
		$companies = $this->company_model->get_company_all();

		$this->data = array(
			'page_header' => 'Company Management',
			'companies'    => $companies,
			'active_menu' => $this->active_menu,
		);

		$this->load_view('pages/company-lists');
	}

	public function add()
	{
        $this->data = array(
            'page_header' => 'Company Management',
            'active_menu' => $this->active_menu,
        );

        $data = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('company_add'));

        $this->form_validation->set_data($data);

        if ($this->form_validation->run('company_add') == TRUE)
        {
			$this->session->set_flashdata('log_parameters', [
				'action_mode' => 0,
				'perm_key' 	  => 'add_company',
				'old_data'	  => NULL,
				'new_data'    => $data
			]);

            $company_id = $this->company_model->insert($data);

            if ( ! $company_id) {
                $this->session->set_flashdata('failed', 'Failed to add new company.');
                redirect('companies');
            } else {
                $this->session->set_flashdata('success', 'Successfully added new company.');
                redirect('companies');
            }
        }
        $this->load_view('forms/company-add');
	}

    public function edit($company_id)
    {
		if ( ! $this->ion_auth_acl->has_permission('edit_company'))
		{
			$this->session->set_flashdata('failed', 'You have no permission to access this module');
			redirect('/', 'refresh');
		}

        $company = $this->company_model->get_company_by(['companies.id' => $company_id]);

        $this->data = array(
            'page_header' => 'Company Management',
            'company'     => $company,
            'active_menu' => $this->active_menu,
        );

        $data = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('company_edit'));

        $this->form_validation->set_data($data);

        if ($this->form_validation->run('company_edit') == TRUE)
        {
			$this->session->set_flashdata('log_parameters', [
				'action_mode' => 1,
				'perm_key' 	  => 'edit_company',
				'old_data'	  => $company,
				'new_data'	  => $data
			]);

            $company_id = $this->company_model->update($company_id, $data);

            if ( ! $company_id) {
                $this->session->set_flashdata('failed', 'Failed to update company.');
                redirect('companies');
            } else {
                $this->session->set_flashdata('success', 'Company successfully updated!');
                redirect('companies');
            }
        }
        $this->load_view('forms/company-edit');
    }

    public function details($id)
    {
        $company   = $this->company_model->get_company_by(['companies.id' => $id]);
        $branches  = $this->branch_model->get_many_branch_by(['companies.id' => $id]);
        $employees = $this->employee_model->get_many_employee_by(['company_id' => $id]);


        $this->data = array(
            'page_header' => 'Company Details',
            'company'     => $company,
            'branches'    => $branches,
            'employees'   => $employees,
            'active_menu' => $this->active_menu,
        );
        $this->load_view('pages/company-details');
    }

    public function edit_confirmation($id)
    {
        $company_data = $this->company_model->get_by(['id' => $id]);
        $data['company_data'] = $company_data;

        $this->load->view('modals/modal-update-company', $data);
    }

    public function update_status($id)
    {
        $company_data = $this->company_model->get_by(['id' => $id]);
        $data['company_data'] = $company_data;

        $post = $this->input->post();

        if (isset($post['mode']))
        {
            $result = FALSE;

            if ($post['mode'] == 'De-activate')
            {
                dump('De-activating...');
                $result = $this->company_model->update($id, ['active_status' => 0]);
                dump($this->db->last_query());
            }
            if ($post['mode'] == 'Activate')
            {
                dump('Activating...');
                $result = $this->company_model->update($id, ['active_status' => 1]);
                dump($this->db->last_query());
            }

            if ($result)
            {
                 $this->session->set_flashdata('message', $company_data['name'].' successfully '.$post['mode'].'d!');
                 redirect('companies');
            }
            else
            {
                $this->session->set_flashdata('failed', 'Unable to '.$post['mode'].' '.$company_data['name'].'!');
                redirect('companies');
            }

        }
        else
        {
            $this->load->view('modals/modal-update-company-status', $data);
        }
    }
}
