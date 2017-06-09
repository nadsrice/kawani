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
class Roles extends MY_Controller {

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

	// list all roles
	public function index()
	{
		// todo: get all records of role/groups from the database
		// todo: past the retrieve records to the view
		// todo: load the view file
			// todo: setup the data needs of view file
			// todo: iterate the record to the view

		// todo: on the view page must have add, view details, edit details <<link>>

		// happy coding!
	}

	// add new role
	public function add()
	{
		// todo: fetch data from input post
		// todo: remove unknown fields
		// todo: set data from posted data
		// todo: validated the data
			// todo: get the role_id of the data inserted
			// todo: get all the records of system_permissions
				// todo: iterate the records of system_permissions
					// todo: get the system_module_id and system_function_id of system_permission_id
					// todo: construct new data_array and follow the field format of system_role_permission
	}

	// edit role detail
	public function edit()
	{}

	// view role detail
	public function details()
	{}

	// update role status
	public function update()
	{}
}
