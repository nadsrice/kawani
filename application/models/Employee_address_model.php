<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Employee_address_model extends MY_Model
{
	protected $_table = 'employee_addresses';
	protected $primary_key = 'id';
	protected $return_type = 'array';

	// Callbacks or Observers
	protected $after_get = array('prep_details');

	protected function prep_details($employee_address)
	{
		if ( ! isset($employee_address)) return FALSE;

		return $employee_address;
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

// End of file Employee_address_model.php
// Location: ./applicaiton/model/Employee_address_model.php
