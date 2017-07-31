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

class Holidays extends MY_Controller {

	private $active_menu = 'Administration';

	function __construct()
	{
		parent::__construct();
		$this->load->library('audit_trail');
		$this->load->model([
			'holiday_model',
			'holiday_type_model'
		]);

		header("Access-Control-Allow-Methods: GET, OPTIONS");
		header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
	}

	function index()
	{
		$holidays    = $this->holiday_model->get_holiday_all();
		$companies 	 = $this->company_model->get_company_all();
		$branches 	 = $this->branch_model->get_branch_all();
		$departments = $this->department_model->get_department_all();
		// $teams 				= $this->team_model->get_team_all();

		$this->data = array(
			'page_header' => 'Holiday Management',
			'holidays'    => $holidays,
			'active_menu' => $this->active_menu,
		);
		$this->load_view('pages/holiday-lists');
	}

	function add()
	{
		// get all company records where status is equal to active
		$companies 	   = $this->company_model->get_many_by(['active_status' => 1]);
		$branches 	   = $this->branch_model->get_many_by(['active_status' => 1]);
		$sites 	   	   = $this->site_model->get_many_by(['active_status' => 1]);
		$holiday_types = $this->holiday_type_model->get_many_by(['active_status' => 1]);
		// $teams 		 = $this->team_model->get_many_by(['active_status' => 1]);

		$this->data = array(
			'page_header' 	=> 'Holiday Management',
			'companies'	  	=> $companies,
			'branches'	  	=> $branches,
			'sites'	  	  	=> $sites,
			'holiday_types' => $holiday_types,
			'active_menu'   => $this->active_menu,
		);

		$holidays = $this->holiday_model->get_holiday_all();
		$data     = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('holiday_add'));
		// dump($data);exit;
		$this->form_validation->set_data($data);

		if ($this->form_validation->run('holiday_add') == TRUE)
		{
			// $this->session->set_flashdata('log_parameters', [
			// 	'action_mode' => 0,
			// 	'perm_key' 	  => 'add_holiday',
			// 	'old_data'	  => NULL,
			// 	'new_data'    => $data
			// ]);

			$holiday_id = $this->holiday_model->insert($data);

			if ( ! $holiday_id) {
				$this->session->set_flashdata('failed', 'Failed to add new holiday.');
				redirect('holidays');
			} else {
				$this->session->set_flashdata('success', 'Successfully added ' .$data['name']);
				redirect('holidays');
			}
		}
		$this->load_view('forms/holiday-add');
	}

	function details($id)
	{
		$holiday = $this->holiday_model->get_holiday_by(['holidays.id' => $id]);

		$this->data = array(
			'page_header' => 'Holiday Details',
			'holiday'     => $holiday,
			'active_menu' => $this->active_menu,
		);
		$this->load_view('pages/holiday-detail');
	}

	function edit($id)
	{
		// get specific holiday based on the id
		$holiday = $this->holiday_model->get_holiday_by(['holidays.id' => $id]);
		// dump($holiday);exit;
		// get all company records where status is equal to active
		$companies = $this->company_model->get_many_by(['active_status' => 1]);
		// dump($this->db->last_query());exit;
		$this->data = array(
			'page_header' => 'Holiday Management',
			'holiday' 	  => $holiday,
			'companies'	  => $companies,
			'active_menu' => $this->active_menu,
		);

		$holidays = $this->holiday_model->get_holiday_all();
		$data = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('holiday_add'));

		$this->form_validation->set_data($data);

		if ($this->form_validation->run('holiday_add') == TRUE)
		{
			$this->session->set_flashdata('log_parameters', [
				'action_mode' => 1,
				'perm_key'	  => 'edit_holiday_type',
				'old_data'	  => $holiday,
				'new_data'	  => $data
			]);

			$holiday_id = $this->holiday_model->update($id, $data);

			if ( ! $holiday_id) {
				$this->session->set_flashdata('failed', 'Failed to update holiday.');
				redirect('holidays');
			} else {
				$this->session->set_flashdata('success', 'Holiday successfully updated!');
				redirect('holidays');
			}
		}
		$this->load_view('forms/holiday-edit');
	}

    public function edit_confirmation($id)
    {
        $edit_holiday = $this->holiday_model->get_by(['id' => $id]);
        $data['edit_holiday'] = $edit_holiday;

        $this->load->view('modals/modal-update-holiday', $data);
    }

    public function update_status($id)
    {
        $holiday_data = $this->holiday_model->get_by(['id' => $id]);
        $data['holiday_data'] = $holiday_data;

        $post = $this->input->post();

        if (isset($post['mode']))
        {
            $result = FALSE;

            if ($post['mode'] == 'De-activate')
            {
                dump('De-activating...');
                $result = $this->holiday_model->update($id, ['active_status' => 0]);
                dump($this->db->last_query());
            }
            if ($post['mode'] == 'Activate')
            {
                dump('Activating...');
                $result = $this->holiday_model->update($id, ['active_status' => 1]);
                dump($this->db->last_query());
            }

            if ($result)
            {
                 $this->session->set_flashdata('message', $holiday_data['name'].' successfully '.$post['mode'].'d!');
                 redirect('holidays');
            }
            else
            {
                $this->session->set_flashdata('failed', 'Unable to '.$post['mode'].' '.$holiday_data['name'].'!');
                redirect('holidays');
            }

        }
        else
        {
            $this->load->view('modals/modal-update-holiday-status', $data);
        }
    }

	public function ajax_calendar_event()
	{
		$data['events'] = [
			[
				'title' => 'Event 11',
				'start' => '2017-07-11'
			],
			[
				'title' => 'Event 12',
				'start' => '2017-07-12'
			],
			[
				'title' => 'Event 13',
				'start' => '2017-07-13'
			],
			[
				'title' => 'Event 14',
				'start' => '2017-07-14'
			],
			[
				'title' => 'Event 15',
				'start' => '2017-07-15'
			],
			[
				'title' => 'Event 16',
				'start' => '2017-07-16'
			],
			[
				'title' => 'Event 17',
				'start' => '2017-07-17'
			],
			[
				'title' => 'Event 18',
				'start' => '2017-07-18'
			],
			[
				'title' => "Pres. Duterte's SONA 2017",
				'start' => '2017-07-24'
			]
		];
		print json_encode($data);
	}
}
