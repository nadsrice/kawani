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
class Companies extends MY_Controller {


	private $active_menu = 'System';

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

		$this->data = array(
			'page_header' => 'Branch Management',
			'active_menu' => $this->active_menu,
		);
		
		$this->load_view('pages/branch-list');
	}

	public function add()
	{}

	public function edit($id)
	{}

	public function details($id)
	{}

	public function update($id)
	{}


}
