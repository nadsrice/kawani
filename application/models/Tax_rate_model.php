<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Some class description here...
 *
 * @package     KAWANI
 * @subpackage  subpackage
 * @category    category
 * @author      cristhian.sagun@systemantech.com
 * @link        http://systemantech.com
 */
class Tax_rate_model extends MY_Model
{
	protected $_table = 'tax_tables';
	protected $primary_key = 'id';
	protected $return_type = 'array';

	protected $after_get = array('prepare_data');

	protected function prepare_data($tax_rate)
	{
		if ( ! isset($tax_rate)) return FALSE;
		
		$tax_rate['tr_status_label']  = ($tax_rate['tr_active_status'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>';
		$tax_rate['tr_status_action'] = ($tax_rate['tr_active_status'] == 1) ? 'Deactivate' : 'Activate';
		$tax_rate['tr_status_icon']   = ($tax_rate['tr_active_status'] == 1) ? 'fa-times text-red' : 'fa-check text-green';
		$tax_rate['tr_status_url']    = ($tax_rate['tr_active_status'] == 1) ? 'deactivate' : 'activate';

		return $tax_rate;
	}


	public function get_details($method, $where)
	{
		$this->db->select('
					tax_tables.id as tax_table_id,
					tax_tables.tax_matrix_id as tr_tax_matrix_id,
					tax_tables.tax_exemption_status_id as tr_tax_exemption_status_id,
					tax_tables.base_tax as tr_base_tax,
					tax_tables.percentage_over as tr_percentage_over,
					tax_tables.minimum_monthly_salary as tr_minimum_monthly_salary,
					tax_tables.maximum_monthly_salary as tr_maximum_monthly_salary,
					tax_tables.active_status as tr_active_status,
					tax_matrix.id as tax_matrix_id,
					tax_matrix.year_effective as tm_year_effective,
					tax_matrix.description as tm_description,
					tax_matrix.attachment as tm_attachment,
					tax_matrix.active_status as tm_active_status,
					tax_exemption_status.id as tax_exemption_status_id,
					tax_exemption_status.tax_status as te_tax_status,
					tax_exemption_status.tax_code as te_tax_code,
					tax_exemption_status.active_status as te_active_status,
					tax_exemption_status.default_status as te_default_status
				')
				->join('tax_matrices as tax_matrix', 'tax_tables.tax_matrix_id = tax_matrix.id', 'left')
				->join('tax_exemption_status', 'tax_tables.tax_exemption_status_id = tax_exemption_status.id', 'left');

		return $this->{$method}($where);
	}
}

// End of file Tax_rate_model.php
// Location: ./application/models/Tax_rate_model.php