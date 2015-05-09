<?php

class Login extends Controller {
	function index()
	{	
		$this->loadView('login_view');
	}

	function login_user()
	{
		if (!isset($_POST['username']) || empty($_POST['username'])) {
			$this->redirect('login');
		}
		if (!isset($_POST['password']) || empty($_POST['password'])) {
			$this->redirect('login');
		}
		//Conect to ftp
		//$user = $this->conect_user($_POST['username'], $_POST['password']);
		$user = true;
		$data['msg'] = '';
		if(!$user)
		{
			$data['msg'] = '<div class="alert alert-error"> Invalid data <button type="button" class="close" data-dismiss="alert">&times;</button></div>';
		}else{
			$this->redirect('main');						
		}							
		$this->loadView('login_view',$data);
	}

	function conect_user($username, $password){
		/* global $config;
		$ftp_server = $config['ftp_host'];
		$ftp_user = $username;
		$ftp_pass = $password;

		// set up a connection or die
		//$conn_id = ftp_ssl_connect($ftp_server) or die("Couldn't connect to $ftp_server"); 

		try to login
		if (@ftp_login($conn_id, $ftp_user, $ftp_pass)) {
			$_SESSION['id'] = session_id();
			$_SESSION['username'] = $_POST['username'];
			$_SESSION['password'] = $_POST['password'];
			$_SESSION['connection'] = $conn_id;
		    return true;
		} else {
		    return false;
		}*/
	}

	function logout()
	{
		//when someone logs out, automatically redirect them to the login page.
		session_destroy();
		// close the connection
		//ftp_close($_SESSION['connection']);  
		$this->redirect("login");
	}
}

