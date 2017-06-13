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
class Departments extends MY_Controller {

    private $active_menu = 'Administration';

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

    function index()
    {
        $departments = $this->department_model->get_department_all();
        
        $this->data = array(
            'page_header' => 'Department Management',
            'departments'    => $departments,
            'active_menu' => $this->active_menu,
        );
        $this->load_view('pages/department-lists');
    }

    function add()
    {
        // get all company records where status is equal to active
        $departments = $this->department_model->get_many_department_by(['active_status' => 1]);

        $this->data = array(
            'page_header' => 'Departments Management',
            'departments'   => $departments,
            'active_menu' => $this->active_menu,
        );

        $departments = $this->department_model->get_department_all();
        $data = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('department'));
        
        $this->form_validation->set_data($data);

        if ($this->form_validation->run('department') == TRUE)
        {
            $department_id = $this->department_model->insert($data);

            if ( ! $department_id) {
                $this->session->set_flashdata('failed', 'Failed to add new department.');
                redirect('departments');
            } else {
                $this->session->set_flashdata('success', 'Successfully added new department.');
                redirect('departments');
            }
        }

        
        $this->load_view('forms/department-add');
    }

    function edit($id)
    {

    }

    function details($id)
    {
        $department = $this->department_model->get_department_by(['department.id' => $id]);
        dump($this->db->last_query());
        dump($department);exit;

        $this->data = array(
            'page_header' => 'Department Details',
            'department'      => $department,
            'active_menu' => $this->active_menu,
        );
        $this->load_view('pages/department-details');           
    }
}
