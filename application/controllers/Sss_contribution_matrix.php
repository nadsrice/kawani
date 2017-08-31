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
class Sss_contribution_matrix extends MY_Controller
{

	function __construct()
	{
		parent::__construct();

		$this->load->model([
			'sss_contribution_matrix_model',
			'sss_rate_model'
		]);
	}

	public function index()
	{
		$sss_matrices = $this->sss_contribution_matrix_model->get_all();
		
		$this->data['show_modal'] = FALSE;
		$this->data['page_header'] = 'SSS Contribution Matrix Management';
		$this->data['sss_matrices'] = $sss_matrices;

		$post = $this->input->post();
		
		if (isset($post['mode'])) {
			$this->data['show_modal'] = TRUE;
		}

		$this->load_view('pages/sss-contribution-matrix-list');
	}

	public function details()
	{
		$sss_contribution_matrix_id = $this->uri->segment(3);
		
		$sss_contribution_matrix = $this->sss_contribution_matrix_model->get_by(['id' => $sss_contribution_matrix_id]);
		$sss_rates = $this->sss_rate_model->get_details('get_many_by', ['sss_rates.sss_matrix_id' => $sss_contribution_matrix_id]);

		$this->data['page_header'] = 'SSS Contribution Matrix Management';
		$this->data['sss_contribution_matrix']  = $sss_contribution_matrix;
		$this->data['sss_rates'] = $sss_rates;

		$this->load_view('pages/sss-contribution-matrix-details');
	}

	public function activate()
	{
		$sss_contribution_matrix_id = $this->uri->segment(3);
		$update = $this->sss_contribution_matrix_model->update($sss_contribution_matrix_id, ['active_status' => 1]);
		if ($update) {
			$this->session->set_flashdata('success', 'Successfully Activated SSS Contribution Matrix with ID: ' . $sss_contribution_matrix_id);
			redirect('sss_contribution_matrix');
		} else {
			$this->session->set_flashdata('failed', 'Unable to Activate SSS Contribution Matrix with ID: ' . $sss_contribution_matrix_id);
			redirect('sss_contribution_matrix');
		}
	}

	public function deactivate()
	{
		$sss_contribution_matrix_id = $this->uri->segment(3);
		$update = $this->sss_contribution_matrix_model->update($sss_contribution_matrix_id, ['active_status' => 0]);
		if ($update) {
			$this->session->set_flashdata('success', 'Successfully Deactivated SSS Contribution Matrix with ID: ' . $sss_contribution_matrix_id);
			redirect('sss_contribution_matrix');
		} else {
			$this->session->set_flashdata('failed', 'Unable to Deactivate SSS Contribution Matrix with ID: ' . $sss_contribution_matrix_id);
			redirect('sss_contribution_matrix');
		}
	}

	public function confirmation()
	{
		$mode = $this->uri->segment(3);
		$sss_contribution_matrix_id = $this->uri->segment(4);
		
		$sss_contribution_matrix = $this->sss_contribution_matrix_model->get_by(['id' => $sss_contribution_matrix_id]);

		$modal_message = "You're about to <strong>" . $mode . "</strong> SSS Contribution Matrix with ID: " . $sss_contribution_matrix_id; 

		$data = array(
			'url' 			=> 'sss_contribution_matrix/' . $mode . '/' . $sss_contribution_matrix_id,
			'modal_title' 	=> ucfirst($mode),
			'modal_message' => $modal_message
		);
		$this->load->view('modals/modal-confirmation', $data);
	}

	public function load_form()
	{
		$data = array(
			'modal_title' => 'Add SSS Contribution Matrix',
			'years'		  => incremental_year(10)
		);
		$this->load->view('modals/modal-add-sss-contribution-matrix', $data);
	}

	public function add()
	{
		$post = $this->input->post();
		
		$data = $post; // <<< TODO: this should be check if data is valid

		$this->session->set_flashdata('log_parameters', [
			'action_mode' => 0,
			'perm_key'	  => 'add_sss_contribution_matrix',
			'old_data'	  => NULL,
			'new_data'	  => $data
		]);

		$last_id = $this->sss_contribution_matrix_model->insert($post);
		
		if ($last_id) {
			$this->session->set_flashdata('success', 'Successfully added new SSS Contribution Matrix.');
			redirect('sss_contribution_matrix');
		} else {
			$this->session->set_flashdata('failed', 'Unable to add SSS Contribution Matrix.');
			redirect('sss_contribution_matrix');
		}
	}

	public function edit()
	{
		$sss_contribution_matrix_id = $this->uri->segment(3);
		$post = $this->input->post();
		$data = $post;
		$update = $this->sss_contribution_matrix_model->update($sss_contribution_matrix_id, $data);
		if ($update) {
			$this->session->set_flashdata('success', 'Successfully updated SSS Contribution Matrix with ID: ' . $sss_contribution_matrix_id);
			redirect('sss_contribution_matrix');
		} else {
			$this->session->set_flashdata('failed', 'Unable to update SSS Contribution Matrix with ID: ' . $sss_contribution_matrix_id);
			redirect('sss_contribution_matrix');
		}
	}
}

// End of file Sss_contribution_matrix.php
// Location: ./application/controllers/Sss_contribution_matrix.php