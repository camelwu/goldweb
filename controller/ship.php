<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends HomeBase_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['todo_list'] = array('Clean House', 'Call Mom', 'Run Errands');
		$data['title'] = "welcome";
		$data['heading'] = "My Tasks";

		//php new数组
		$arry = array(
				'Parameters' => array(
						'LastUpdateTime' => '2010-01-01',
				),
				'Code' => 70100008,
				'ForeEndType' =>4
		);
		 var_dump($arry);
		$json_string = json_encode($arry);
		var_dump($json_string);
		$data['list']=parent::post_json($json_string);
		//var_dump($data['list']);
		$this->load->view('demo/welcome', $data);
	}
}
