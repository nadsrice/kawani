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

	public function edit($id)
	{
        // get specific company based on the id
        $company = $this->company_model->get_company_by(['companies.id' => $id]);
        // dump($company);exit;
        // get all company records where status is equal to active
        //$companies = $this->company_model->get_many_by(['active_status' => 1]);
        // dump($this->db->last_query());exit;
        $this->data = array(
            'page_header' => 'Company Management',
            'company'      => $company,
            'active_menu' => $this->active_menu,
        );

        // $companies = $this->company_model->get_company_all();
        $data = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('company_add'));
        
        $this->form_validation->set_data($data);
        // dump($data);exit();

        if ($this->form_validation->run('company_add') == TRUE)
        {
            $company_id = $this->company_model->update($id, $data);

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
        $company = $this->company_model->get_company_by(['companies.id' => $id]);
        $branches = $this->branch_model->get_many_branch_by(['companies.id' => $id]);
        $employees = $this->employee_model->get_many_employee_by(['company_id' => $id]);


        $this->data = array(
            'page_header' => 'Company Details',
            'company'      => $company,
            'branches'    => $branches,
            'employees' => $employees,
            'active_menu' => $this->active_menu,
        );

        $this->load_view('pages/company-details');   		
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
