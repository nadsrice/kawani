<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
 * Some class description here...
 *
 * @package     KAWANI
 * @subpackage  subpackage
 * @category    category
 * @author      cristhian.sagun@systemantech.com
 * @link        http://systemantech.com
 */
class Home extends MY_Controller {

	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$a = [];
		for ($i = 0; $i <= 100000; $i++)
		{
			$a[] = ['asd', 'zxc', 'qwe', 'rty', 'fgh', 'lkj', 'uhb'];
		}

		echo memory_get_usage(true);
		dump($a);
		exit;
		$this->data = [
			'page_header' => 'Home',
			'active_menu' => 'home'
		];

		$this->load_view('pages/home');
	}

}
