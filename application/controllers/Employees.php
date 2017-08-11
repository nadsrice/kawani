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
			'employee_positions_model',
			'employee_salaries_model',
			'employee_benefits_model',
            'employee_employment_information_model',
			'civil_status_model',
			'relationship_model',
			'location_model',
			'country_model'
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

    public function add()
    {
        $this->load->view('modals/modal-add-employee-direct');
    }

    public function save($id = '')
    {
        if (empty($id)) $this->employee_model->create_account();
    }

    public function informations($employee_id)
    {
        // TODO: check permission key = 'employee_information';

        // $spouse_id = $this->uri->segment(4);

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
        $this->data['dependent_information']  = $this->employee_dependent_model->get_by(['employee_id' => $employee_id]);
        $this->data['employment_information'] = $this->employee_employment_information_model->get_details('get_many_by', ['employee_information.employee_id' => $employee_id]);
        $this->data['employee_benefits']	  = $this->employee_benefits_model->get_details('get_many_by', ['employee_benefits.employee_id' => $employee_id]);
        $this->data['employee_positions']	  = $this->employee_positions_model->get_details('get_many_by', ['employee_positions.employee_id' => $employee_id]);
        $this->data['employee_salaries']	  = $this->employee_salaries_model->get_details('get_many_by', ['employee_salaries.employee_id' => $employee_id]);
        $this->data['civil_status']           = $this->civil_status_model->get_many_by(['active_status' => 1]);
        $this->data['relationships']          = $this->relationship_model->get_all();
        $this->data['show_edit_modal']        = FALSE;

        // dump($this->data['employment_information'], 'employment_information');
        // dump($this->data['employee_benefits'], 'employee_benefits');
        // dump($this->data['employee_positions'], 'employee_positions');
        // dump($this->data['employee_salaries'], 'employee_salaries');
        // exit;

        $civil_status_id = $this->data['personal_information']['civil_status_id'];

        $this->data['current_civil_status'] = $this->civil_status_model->get_by(['id' => $civil_status_id]);

        if (isset($post['mode']) && $post['mode'] == 'edit')
        {
            $this->data['show_edit_modal'] = TRUE;
            $this->data['modal_content']   = 'modals/employee/forms/modal-'.$post['information_type'];
        }

        $this->load_view('pages/employee-informations');
    }

    public function confirmation()
    {
        $mode        = $this->uri->segment(3);
        $information = $this->uri->segment(4);
        $employee_id = ( ! empty($this->uri->segment(5))) ? $this->uri->segment(5) : NULL;

        $employee          = $this->employee_model->get_by('id', $employee_id);
        $exploded          = explode('_', $information);
        $information_type  = implode(' ', $exploded);
        $confirm_message   = sprintf(lang('confirmation_edit_employee_detail'), $mode.' '.$information_type, ucwords(strtolower($employee['full_name'])));
        $error_message     = lang('no_spouse_data_found');

        $spouse_id = $this->uri->segment(6);
        $message = ( ! isset($spouse_id)) ? $error_message : $confirm_message;
        $this->session->set_flashdata('spouse_id', $spouse_id);

        $data['modal_title']      = ucwords($information_type);
        $data['modal_message']    = $message;
        $data['mode']             = $mode;
        $data['url']              = 'employees/informations/'.$employee_id;
        $data['information_type'] = implode('-', $exploded);

        // $data['url'] = ($information == 'spouse_information') ? 'employees/informations/'.$employee_id.'/'.$spouse_id : 'employees/informations/'.$employee_id;

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

    public function edit_spouse()
    {
        $post = $this->input->post();

        $employee_id = $this->uri->segment(3);
        $spouse_id = $this->uri->segment(4);

        $this->data['spouse_information'] = $this->employee_spouse_information_model->get_by(['employee_id' => $employee_id, 'id' => $spouse_id]);

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

	public function view_employment_information($employee_information_id)
	{
		$employment_information = $this->employee_employment_information_model->get_details('get_by', ['employee_information.id' => $employee_information_id]);
		
		$data['employment_information'] = $employment_information;
		$this->load->view('modals/employee/details/employment-information', $data);
	}

	public function view_position_information($employee_positions_id)
	{
		$employee_position = $this->employee_positions_model->get_details('get_by', ['employee_positions.id' => $employee_positions_id]);
		
		$data['employee_position'] = $employee_position;
		$this->load->view('modals/employee/details/employee-positions', $data);
	}

	public function view_benefit_information($employee_benefits_id)
	{
		$employee_benefit = $this->employee_benefits_model->get_details('get_by', ['employee_benefits.id' => $employee_benefits_id]);
		
		$data['employee_benefit'] = $employee_benefit;
		$this->load->view('modals/employee/details/employee-benefits', $data);
	}

	public function view_salary_information($employee_salaries_id)
	{
		$employee_salary = $this->employee_salaries_model->get_details('get_by', ['employee_salaries.id' => $employee_salaries_id]);
		
		$data['employee_salary'] = $employee_salary;
		$this->load->view('modals/employee/details/employee-salaries', $data);
	}
}
