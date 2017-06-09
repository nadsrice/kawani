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
        
        $this->data = array(
            'page_header' => 'Departments Management',
            'active_menu' => $this->active_menu,
        );

        $data = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('department_add'));
        
        $this->form_validation->set_data($data);

        if ($this->form_validation->run('department_add') == TRUE)
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
        // get specific department based on the id
        $department = $this->department_model->get_department_by(['departments.id' => $id]);
        // dump($department);exit;
        // get all company records where status is equal to active
        //$companies = $this->company_model->get_many_by(['active_status' => 1]);
        // dump($this->db->last_query());exit;
        $this->data = array(
            'page_header' => 'Department Management',
            'department'      => $department,
            'active_menu' => $this->active_menu,
        );

        // $departments = $this->department_model->get_department_all();
        $data = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('department_add'));
        
        $this->form_validation->set_data($data);
        // dump($data);exit();

        if ($this->form_validation->run('department_add') == TRUE)
        {
            $department_id = $this->department_model->update($id, $data);

            if ( ! $department_id) {
                $this->session->set_flashdata('failed', 'Failed to update department.');
                redirect('departments');
            } else {
                $this->session->set_flashdata('success', 'Successfully updated department.');
                redirect('departments');
            }
        }
        $this->load_view('forms/department-edit');       
    }

    function details($id)
    {
        $department = $this->department_model->get_department_by(['departments.id' => $id]);

        $this->data = array(
            'page_header' => 'Department Details',
            'department'      => $department,
            'active_menu' => $this->active_menu,
        );
        $this->load_view('pages/department-details');           
    }
}
