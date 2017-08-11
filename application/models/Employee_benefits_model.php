<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Employee_benefits_model extends MY_Model
{
	protected $_table = 'employee_benefits';
	protected $primary_key = 'id';
	protected $return_type = 'array';

	// Callbacks or Observers
	protected $after_get = array('prep_details');
	
	protected function prep_details($employee_benefit)
	{
		if ( ! isset($employee_benefit)) return FALSE;
		
		// get middle initial base on middle name
		$middle_initial = (strlen($employee_benefit['middle_name']) > 1) ? substr($employee_benefit['middle_name'], 0, 1) : $employee_benefit['middle_name'];

		$full_name = array(
			$employee_benefit['last_name'].', ',
			$employee_benefit['first_name'].' ',
			$middle_initial
		);

		// concat employee first name, middle name, last name
		$employee_benefit['full_name'] = strtoupper(implode('', $full_name));

		// check if active or inactive then set labels
		$employee_benefit['status_label'] = ($employee_benefit['active_status'] == 1) ? 'ACTIVE':'INACTIVE';

		return $employee_benefit;
	}

	public function get_details($method, $where)
    {
        $this->db->select('
                employee_benefits.id as employee_benefits_id,
                employee_benefits.employee_id,
                employee_benefits.company_id as employee_company_id,
                employee_benefits.benefit_id as employee_benefit_id,
                employee_benefits.amount as employee_benefit_amount,
                employee_benefits.active_status,
                benefit.id as benefit_id,
                benefit.name as benefit_name,
                benefit.amount as benefit_amount,
                employee.first_name,
                employee.middle_name,
                employee.last_name
            ')
            ->join('employees as employee', 'employee_benefits.employee_id = employee.id', 'left')
            ->join('companies as company', 'employee_benefits.company_id = company.id', 'left')
            ->join('benefits as benefit', 'employee_benefits.benefit_id = benefit.id', 'left');

        return $this->{$method}($where);
    }
}

// End of file Employee_benefits_model.php
// Location: ./application/models/Employee_benefits_model.php