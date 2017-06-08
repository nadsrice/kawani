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
class Branches extends MY_Controller {

	private $active_menu = 'Administration';

	function __construct()
	{
		parent::__construct();
		$this->load->model([
			'branch_model'
		]);
	}

	function index()
	{

		$branches = $this->branch_model->get_branch_all();

		dump($branches);
		
		// $this->data = array(
		// 	'page_header' => 'Bed Management',
		// 	'active_menu' => $this->active_menu,
		// );
		// $this->load_view('pages/list-beds');
	}

	function add()
	{
		
	}

	function detail($id)
	{
		
	}

	function edit($id)
	{
		
	}
}
