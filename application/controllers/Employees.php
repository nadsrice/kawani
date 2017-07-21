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
        $this->load->library('ion_auth');
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

        $employee_joins = $this->config->item('joins', 'employee');
        $this->data['page_header'] = 'Employee Management';
        $this->data['civil_status'] = $this->employee_model->get_civil_status();

        $this->load_view('forms/employee-add-2');

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

    public function ajax($function = '')
    {
        switch ($function) {
            case 'addEmployee':
                $this->_addEmployee();
            break;
        }
    }

    private function _addEmployee()
    {
        // posted data from ajax request
        $post_data = $this->input->post();

        // check if employee name is multiple then splice it and make it as one word
        $exploded_name = explode(' ', strtolower($post_data['first_name']));
        $first_name    = implode('', $exploded_name);

        // User account parameters
        $last_name = $post_data['last_name'];
        $identity  = $first_name.'.'.$last_name;
        $password  = $this->_generate_password();
        $email     = strtolower($this->input->post('email'));

        $additional_data = array(
            'first_name' => $post_data['first_name'],
            'last_name'  => $post_data['last_name'],
        );

        $user_id   = $this->ion_auth->register($identity, $password, $email, $additional_data, [1]);

        $user_data = $this->ion_auth->users();

        dump($this->ion_auth->messages());
        dump($identity);
        dump($password);
        dump($email);
        dump($additional_data);
        dump($user_id);
        dump($user_data);

        exit;

        $employee_id = $this->employee_model->insert($post_data);

        echo json_encode([
            'post_data' => $post_data,
            'employee_id' => $employee_id,
            'status'    => 'success',
            'message'   => 'Successfully!'
        ]);
    }

    public function _generate_password()
	{
		$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
		$pass = array(); //remember to declare $pass as an array
		$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache

		for ($i = 0; $i < 15; $i++)
		{
			$n = rand(0, $alphaLength);
			$pass[] = $alphabet[$n];
		}

		return implode($pass);
	}
}
