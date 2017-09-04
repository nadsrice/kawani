<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Employee_information_model extends MY_Model
{
	protected $_table = 'employee_information';
	protected $primary_key = 'id';
	protected $return_type = 'array';

	public function get_details($method, $where)
	{
		$foo = $this->db->select('
					employee_information.id as employee_information_id,
					employee_information.employee_id,
					employee_information.date_hired,
					employee_information.active_status,
					employee_information.reports_to,
					employee.first_name,
					employee.middle_name,
					employee.last_name,
					company.name AS company,
					branch.name AS branch,
					cost_center.name AS cost_center,
					department.name AS department,
					team.name AS team,
					site.name AS site,
					position.id AS position_id,
					position.name AS position,
				')
				->join('employees as employee', 'employee_information.employee_id = employee.id', 'left')
				->join('companies as company', 'employee_information.company_id = company.id', 'left')
				->join('branches as branch', 'employee_information.branch_id = branch.id', 'left')
				->join('positions as position', 'employee_information.position_id = position.id', 'left')
				->join('cost_centers as cost_center', 'employee_information.cost_center_id = cost_center.id', 'left')
				->join('departments as department', 'employee_information.department_id = department.id', 'left')
				->join('teams as team', 'employee_information.team_id = team.id', 'left')
				->join('sites as site', 'employee_information.site_id = site.id', 'left');

		dump($foo);exit;
		return $this->{$method}($where);
	}
}

// End of file Employee_information_model.php
// Location: ./applicaiton/model/Employee_information_model.php
