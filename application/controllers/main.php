<?php

class Main extends Controller {

	function __construct() {
		parent::__construct();
		//$this->check_login();
    }
	
	function index()
	{
		$data = array();
		$template = $this->loadView('main_view',$data);
	}
}