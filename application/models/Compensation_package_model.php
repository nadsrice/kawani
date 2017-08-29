<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Compensation_package_model extends MY_Model
{
	protected $_table = 'compensation_packages';
	protected $primary_key = 'id';
	protected $return_type = 'array';

	public function get_details($method, $where)
	{
		$this->db->select('
				compensation_packages.id as compensation_package_id,
				compensation_packages.position_id as cp_position_id,
				compensation_packages.salary_id as cp_salary_id,
				compensation_packages.company_id as cp_company_id,
				compensation_packages.active_status as cp_active_status,
				salary.montly_salary,
				salary.salary_matrix_id,
				company.name as company_name
			')
			->join('positions as position', 'compensation_packages.position_id = position.id', 'left')
			->join('salaries as salary', 'compensation_packages.salary_id = salary.id', 'left')
			->join('companies as company', 'compensation_packages.company_id = company.id', 'left');

		return $this->{$method}($where);
	}
}

// End of file Compensation_package_model.php
// Location: ./applicaiton/model/Compensation_package_model.php
