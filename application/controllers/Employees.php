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

        $this->config->load('employee', TRUE);
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

        $this->data['page_header'] = 'Employee Management';
        $employee_joins = $this->config->item('joins', 'employee');

        // dump($employee_joins);

        $this->load_view('forms/employee-add-2');
        // exit;

        //
        // if ($this->form_validation->run() == TRUE)
        // {
        //     $email    = 'saguncristhiankevin@yahoo.com'; // strtolower($this->input->post('email'));
        //     $identity = 'cristhiankevin.sagun'; // ($identity_column === 'email') ? $email : $this->input->post('identity');
        //     $password = $this->_generate_password();
        //
        //     $additional_data = array(
        //         'first_name' => 'cristhian kevin', //$this->input->post('first_name'),
        //         'last_name'  => 'sagun', //$this->input->post('last_name'),
        //         'company'    => 'systemantech inc', //$this->input->post('company'),
        //         'phone'      => '09068133327', //$this->input->post('phone'),
        //     );
        //
        //     $user_id = $this->ion_auth->register($identity, $password, $email, $additional_data);
        //     dump($user_id);
        //
        //     // $this->session->set_flashdata('message', 'Successfully created new employee.');
        //     // redirect("employees", 'refresh');
        // }
        // else
        // {
        //     $this->load_view('forms/employee-add-2');
        // }
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
