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
        // todo: get all companies records from database order by name ascending
            // todo: load company model
            // todo: load view & past the retrieved data from model
<<<<<<< HEAD
        
        $employees = $this->employee_model->get_employee_all();

=======
        $employees = $this->employee_model->get_employee_all();


>>>>>>> 2f47d69ec15fa5a4301b7adcc381e89a32038c01
        $this->data = array(
            'page_header' => 'Employee Management',
            'employees'    => $employees,
            'active_menu' => $this->active_menu,
        );
        
        $this->load_view('pages/employee-lists');
    }

    function add()
    {

    }

    function edit($id)
    {
        
    }

    function details($id)
    {
        
    }
}
