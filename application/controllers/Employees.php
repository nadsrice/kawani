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
        $employees = $this->employee_model->get_employee_all();

        $this->data = array(
            'page_header' => 'Employee Management',
            'employees'   => $employees,
            'active_menu' => $this->active_menu,
        );

        $this->load_view('pages/employee-lists');
    }

    function add()
    {
        // TODO: insert first to users table
            // TODO: get the last user.id
        // TODO: insert to employees table with basic infos
            // employee_13th_month
            // employee_address
            // employee_attachments
            // employee_awards
            // employee_benefits
            // employee_certifications
            // employee_daily_schedules
            // employee_dependents
            // employee_educational_background
            // employee_emergency_contacts
            // employee_examinations
            // employee_government_id_numbers
            // employee_incentives
            // employee_info
            // employee_languages
            // employee_leave_credits
            // employee_positions
            // employee_salaries
            // employee_skills
            // employee_spouses
            // employee_trainings
            // employee_work_experiences


        $this->data['page_header'] = 'Employee Management';

        if ($this->form_validation->run() == true)
        {
            $email    = strtolower($this->input->post('email'));
            $identity = ($identity_column === 'email') ? $email : $this->input->post('identity');
            $password = $this->_generate_password();

            $additional_data = array(
                'first_name' => $this->input->post('first_name'),
                'last_name'  => $this->input->post('last_name'),
                'company'    => $this->input->post('company'),
                'phone'      => $this->input->post('phone'),
            );
        }
        if ($this->form_validation->run() == true && $this->ion_auth->register($identity, $password, $email, $additional_data))
        {
            $this->session->set_flashdata('message', 'Successfully created new employee.');
            redirect("employees", 'refresh');
        }
        else
        {
            $this->load_view('forms/employee-add-2', $this->data);
        }
    }

    function edit($id)
    {

    }

    function details($id)
    {

    }

    public function save_user_data()
    {
        dump($this->input->post());
    }
}
