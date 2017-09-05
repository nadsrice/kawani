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
class Tax_rates extends MY_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->model([
			'tax_matrix_model',
			'tax_rate_model'
		]);
	}

	public function index()
	{
		$tax_rates = $this->tax_rate_model->get_all();
		
		$this->data['show_modal'] = FALSE;
		$this->data['page_header'] = 'Tax Rates Management';
		$this->data['tax_rates'] = $tax_rates;

		$post = $this->input->post();
		
		if (isset($post['mode'])) {
			$this->data['show_modal'] = TRUE;
		}

		$this->load_view('pages/tax-rates-list');
	}

	public function details()
	{
		$tax_rate_id = $this->uri->segment(3);
		
		$tax_rate = $this->tax_rate_model->get_details('get_by', ['tax_tables.id' => $tax_rate_id]);

		$data['modal_title'] = 'Tax Rates Management';
		$data['tax_rate'] 	 = $tax_rate;

		$this->load->view('modals/modal-tax-rate-details', $data);
	}

	public function activate()
	{
		$tax_matrix_id = $this->uri->segment(3);
		$update = $this->tax_matrix_model->update($tax_matrix_id, ['active_status' => 1]);
		if ($update) {
			$this->session->set_flashdata('success', 'Successfully Activated tax matrix with ID: ' . $tax_matrix_id);
			redirect('tax_matrix');
		} else {
			$this->session->set_flashdata('failed', 'Unable to Activate tax matrix with ID: ' . $tax_matrix_id);
			redirect('tax_matrix');
		}
	}

	public function deactivate()
	{
		$tax_matrix_id = $this->uri->segment(3);
		$update = $this->tax_matrix_model->update($tax_matrix_id, ['active_status' => 0]);
		if ($update) {
			$this->session->set_flashdata('success', 'Successfully Deactivated tax matrix with ID: ' . $tax_matrix_id);
			redirect('tax_matrix');
		} else {
			$this->session->set_flashdata('failed', 'Unable to Deactivate tax matrix with ID: ' . $tax_matrix_id);
			redirect('tax_matrix');
		}
	}

	public function confirmation()
	{
		$mode = $this->uri->segment(3);
		$tax_matrix_id = $this->uri->segment(4);
		
		$tax_matrix = $this->tax_matrix_model->get_by(['id' => $tax_matrix_id]);

		$modal_message = "You're about to <strong>" . $mode . "</strong> tax matrix with ID: " . $tax_matrix_id; 

		$data = array(
			'url' 			=> 'tax_matrix/' . $mode . '/' . $tax_matrix_id,
			'modal_title' 	=> ucfirst($mode),
			'modal_message' => $modal_message
		);

		dump($data);exit;
		$this->load->view('modals/modal-confirmation', $data);
	}

	public function load_form()
	{
		$data['modal_title'] = 'Add Tax Rate';
		$data['tax_matrix_id'] = $this->uri->segment(3);

		// Get the list of tax excemption status
		// first instantiate the model
		$this->load->model('tax_exemption_status_model');

		// then call the method handling the query to get the list and pass it to variable binder
		$data['tax_exemption_status'] = $this->tax_exemption_status_model->get_all();

		$this->load->view('modals/modal-add-tax-rate', $data);
	}

	public function add()
	{
		$post = $this->input->post();

		$tax_matrix_id = $post['tax_matrix_id'];
		
		$data = $post; // <<< TODO: this should be check if data is valid

		// $this->session->set_flashdata('log_parameters', [
		// 	'action_mode' => 0,
		// 	'perm_key'	  => 'add_tax_matrix',
		// 	'old_data'	  => NULL,
		// 	'new_data'	  => $data
		// ]);

		$last_id = $this->tax_rate_model->insert($post);
		
		if ($last_id) {
			$this->session->set_flashdata('success', 'Successfully added new tax rate.');
			redirect('tax_matrix/details/' . $tax_matrix_id);
		} else {
			$this->session->set_flashdata('failed', 'Unable to add tax rate.');
			redirect('tax_matrix/details/' . $tax_matrix_id);
		}
	}

	public function edit()
	{
		$tax_matrix_id = $this->uri->segment(3);
		$post = $this->input->post();
		$data = $post;
		$update = $this->tax_matrix_model->update($tax_matrix_id, $data);
		if ($update) {
			$this->session->set_flashdata('success', 'Successfully updated tax matrix with ID: ' . $tax_matrix_id);
			redirect('tax_matrix');
		} else {
			$this->session->set_flashdata('failed', 'Unable to update tax matrix with ID: ' . $tax_matrix_id);
			redirect('tax_matrix');
		}
	}
}

// End of file Tax_rates.php
// Location: ./application/controllers/Tax_rates.php