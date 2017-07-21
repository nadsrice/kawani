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

    public function edit($employee_id)
    {
        $employee_data = $this->employee_model->get_by(['id' => $employee_id]);

        $this->data['page_header'] = 'Employee Details';
        $this->data['employee_id'] = $employee_id;
        $this->data['employee_data'] = $employee_data;

        $this->load_view('forms/employee-edit');
    }
}
