<?php

class Controller {
	function __construct(){
		$this->db = new Model();
	}
	
	public function loadModel($name)
	{
		require(APP_DIR .'models/'. strtolower($name) .'.php');

		$model = new $name;
		return $model;
	}
	
	public function loadView($name, $data=true)
	{
		$view = new View($name);
		if(is_array($data)){
			foreach ($data as $key => $value) {
				$view->set($key, $value);
			}
		}
		return $view->render();
	}
	
	public function loadPlugin($name)
	{
		require(APP_DIR .'plugins/'. strtolower($name) .'.php');
	}
	
	public function loadHelper($name)
	{
		require(APP_DIR .'helpers/'. strtolower($name) .'.php');
		$helper = new $name;
		return $helper;
	}
	
	public function redirect($loc)
	{
		global $config;
		header('Location: '. BASE_URL.$config['base_file'].'/' . $loc);
	}
	public function is_admin()
	{
		global $config;

		if(!isset($_SESSION[$config['admin_field']]) || $_SESSION[$config['admin_field']] != $_SESSION[$config['admin_type']]){
			return true;
		}
		return false;
	}
	public function is_loged_in()
	{
		if(isset($_SESSION['id'])){
			return true;
		}
		return false;
	}
	public function check_login()
	{
		global $config;
		if(!$this->is_loged_in()){
			$this->redirect($config['login_controler']);
		}
		return true;
	}    
}

?>