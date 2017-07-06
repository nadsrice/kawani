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

class Positions extends MY_Controller {

	private $active_menu = 'Administration';

	function __construct()
	{
		parent::__construct();
		$this->load->model(['position_model']);
	}

	function index()
	{
		$positions = $this->position_model->get_position_all();
		
		$this->data = array(
			'page_header' => 'Position Management',
			'positions'    => $positions,
			'active_menu' => $this->active_menu,
		);
		$this->load_view('pages/position-list');
	}

	function add()
	{
		// get all company records where status is equal to active
		$companies = $this->company_model->get_many_by(['active_status' => 1]);

		$this->data = array(
			'page_header' => 'Position Management',
			'companies'	  => $companies,
			'active_menu' => $this->active_menu,
		);

		$positions = $this->position_model->get_position_all();
		$data = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('position_add'));
		
		$this->form_validation->set_data($data);

		if ($this->form_validation->run('position_add') == TRUE)
		{
			$position_id = $this->position_model->insert($data);

			if ( ! $position_id) {
				$this->session->set_flashdata('failed', 'Failed to add new position.');
				redirect('positions');
			} else {
				$this->session->set_flashdata('success', 'Successfully added new position.');
				redirect('positions');
			}
		}
		$this->load_view('forms/position-add');
	}

	function details($id)
	{
		$position = $this->position_model->get_position_by(['positions.id' => $id]);
		$site = $this->site_model->get_many_site_by(['sites.position_id' => $id]);
		$sites = $this->site_model->get_many_site_by(['sites.position_id' => $id]);
		$employee_infos = $this->employee_info_model->get_employee_info_data(['departments.id' => $id]);
		
		$this->data = array(
			'page_header' => 'Position Details',
			'position'      => $position,
			'sites' => $site,
			'sites' => $sites,
			'employee_infos' => $employee_infos,
			'active_menu' => $this->active_menu,
		);
		$this->load_view('pages/position-detail');
	}

	function edit($id)
	{
		// get specific position based on the id
		$position = $this->position_model->get_position_by(['positions.id' => $id]);
		// dump($position);exit;
		// get all company records where status is equal to active
		$companies = $this->company_model->get_many_by(['active_status' => 1]);
		// dump($this->db->last_query());exit;
		$this->data = array(
			'page_header' => 'Position Management',
			'position' 	  => $position,
			'companies'	  => $companies,
			'active_menu' => $this->active_menu,
		);

		$positions = $this->position_model->get_position_all();
		$data = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('position_add'));
		
		$this->form_validation->set_data($data);

		if ($this->form_validation->run('position_add') == TRUE)
		{
			$position_id = $this->position_model->update($id, $data);

			if ( ! $position_id) {
				$this->session->set_flashdata('failed', 'Failed to update position.');
				redirect('positions');
			} else {
				$this->session->set_flashdata('success', 'Position successfully updated!');
				redirect('positions');
			}
		}
		$this->load_view('forms/position-edit');
	}

    public function edit_confirmation($id)
    {
        $edit_position = $this->position_model->get_by(['id' => $id]);
        $data['edit_position'] = $edit_position;

        $this->load->view('modals/modal-update-position', $data);
    }

    public function update_status($id)
    {
        $position_data = $this->position_model->get_by(['id' => $id]);
        $data['position_data'] = $position_data;

        $post = $this->input->post();

        if (isset($post['mode']))
        {   
            $result = FALSE;

            if ($post['mode'] == 'De-activate')
            {
                dump('De-activating...');
                $result = $this->position_model->update($id, ['active_status' => 0]);
                dump($this->db->last_query());
            }
            if ($post['mode'] == 'Activate')
            {
                dump('Activating...');
                $result = $this->position_model->update($id, ['active_status' => 1]);
                dump($this->db->last_query());
            }

            if ($result)
            {               
                 $this->session->set_flashdata('message', $position_data['name'].' successfully '.$post['mode'].'d!');
                 redirect('positions');
            }
            else
            {
                $this->session->set_flashdata('failed', 'Unable to '.$post['mode'].' '.$position_data['name'].'!');
                redirect('positions');
            }
            
        }
        else
        {
            $this->load->view('modals/modal-update-position-status', $data);
        }
    }
}
