<?php
// this is a dummy controller so please don't use it if you don't know the use of this controller
class Generate extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $this->data['page_header'] = 'Employee Hierarchy';
        $this->load_view('pages/employee-hierarchy');
    }

    public function ajax_sample()
    {
        // Example of data structure need to use in treeview
        // $old_data = array(
        //     array('text' => 'Parent 1', 'href' => '#parent1', 'tags' => array(4), 'nodes' => array(
        //         array('text' => 'Child 1', 'href' => '#child1', 'tags' => array(2), 'nodes' => array(
        //             array('text' => 'Grandchild 1', 'href' => '#grandchild1', 'tags' => array(0)),
        //             array('text' => 'Grandchild 2', 'href' => '#grandchild2', 'tags' => array(0)),
        //         )),
        //         array('text' => 'Child 2', 'href' => '#child2', 'tags' => array(0)),
        //     )),
        //     array('text' => 'Parent 2', 'href' => '#parent2', 'tags' => array(0)),
        //     array('text' => 'Parent 3', 'href' => '#parent3', 'tags' => array(0)),
        //     array('text' => 'Parent 4', 'href' => '#parent4', 'tags' => array(0)),
        // );

        $this->load->model('employee_information_model');
        
        // actual data from database that will use for treeview
        $new_data = $this->employee_information_model->get_employee_hierarchy_data();

        echo json_encode(array('data' => $new_data, 'message' => 'The quick brown fox jumps over the lazy dog.'));
    }
}