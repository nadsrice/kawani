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
class Branches extends MY_Controller {

	private $active_menu = 'Administration';

	function __construct()
	{
		parent::__construct();
		// $this->load->model(['employee_info_model');
	}

	function index()
	{
		$branches = $this->branch_model->get_branch_all();
		
		$this->data = array(
			'page_header' => 'Branch Management',
			'branches'    => $branches,
			'active_menu' => $this->active_menu,
		);
		$this->load_view('pages/branch-list');
	}

	function add()
	{
		// get all company records where status is equal to active
		$companies = $this->company_model->get_many_by(['active_status' => 1]);

		$this->data = array(
			'page_header' => 'Branch Management',
			'companies'	  => $companies,
			'active_menu' => $this->active_menu,
		);

		$branches = $this->branch_model->get_branch_all();
		$data = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('branch_add'));
		
		$this->form_validation->set_data($data);

		if ($this->form_validation->run('branch_add') == TRUE)
		{
			$branch_id = $this->branch_model->insert($data);

			if ( ! $branch_id) {
				$this->session->set_flashdata('failed', 'Failed to add new branch.');
				redirect('branches');
			} else {
				$this->session->set_flashdata('success', 'Successfully added new branch.');
				redirect('branches');
			}
		}
		$this->load_view('forms/branch-add');
	}

	function details($id)
	{
		$branch = $this->branch_model->get_branch_by(['branches.id' => $id]);
		$site = $this->site_model->get_many_site_by(['sites.branch_id' => $id]);
		$sites = $this->site_model->get_many_site_by(['sites.branch_id' => $id]);
		$employee_infos = $this->employee_info_model->get_employee_info_data(['departments.id' => $id]);
		
		$this->data = array(
			'page_header' => 'Branch Details',
			'branch'      => $branch,
			'sites' => $site,
			'sites' => $sites,
			'employee_infos' => $employee_infos,
			'active_menu' => $this->active_menu,
		);
		$this->load_view('pages/branch-detail');
	}

	function edit($id)
	{
		// get specific branch based on the id
		$branch = $this->branch_model->get_branch_by(['branches.id' => $id]);
		// dump($branch);exit;
		// get all company records where status is equal to active
		$companies = $this->company_model->get_many_by(['active_status' => 1]);
		// dump($this->db->last_query());exit;
		$this->data = array(
			'page_header' => 'Branch Management',
			'branch' 	  => $branch,
			'companies'	  => $companies,
			'active_menu' => $this->active_menu,
		);

		$branches = $this->branch_model->get_branch_all();
		$data = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('branch_add'));
		
		$this->form_validation->set_data($data);

		if ($this->form_validation->run('branch_add') == TRUE)
		{
			$branch_id = $this->branch_model->update($id, $data);

			if ( ! $branch_id) {
				$this->session->set_flashdata('failed', 'Failed to update branch.');
				redirect('branches');
			} else {
				$this->session->set_flashdata('success', 'Branch successfully updated!');
				redirect('branches');
			}
		}
		$this->load_view('forms/branch-edit');
	}

    public function edit_confirmation($id)
    {
        $edit_branch = $this->branch_model->get_by(['id' => $id]);
        $data['edit_branch'] = $edit_branch;

        $this->load->view('modals/modal-update-branch', $data);
    }

    public function update_status($id)
    {
        $branch_data = $this->branch_model->get_by(['id' => $id]);
        $data['branch_data'] = $branch_data;

        $post = $this->input->post();

        if (isset($post['mode']))
        {   
            $result = FALSE;

            if ($post['mode'] == 'De-activate')
            {
                dump('De-activating...');
                $result = $this->branch_model->update($id, ['active_status' => 0]);
                dump($this->db->last_query());
            }
            if ($post['mode'] == 'Activate')
            {
                dump('Activating...');
                $result = $this->branch_model->update($id, ['active_status' => 1]);
                dump($this->db->last_query());
            }

            if ($result)
            {               
                 $this->session->set_flashdata('message', $branch_data['name'].' successfully '.$post['mode'].'d!');
                 redirect('branches');
            }
            else
            {
                $this->session->set_flashdata('failed', 'Unable to '.$post['mode'].' '.$branch_data['name'].'!');
                redirect('branches');
            }
            
        }
        else
        {
            $this->load->view('modals/modal-update-branch-status', $data);
        }
    }
}
