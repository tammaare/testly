<?php

class auth {
function index (){
	global $_REQUEST;
	global $_ERRORS;
	if(isset($_SESSION['session_expired'])){
		$_ERRORS[] = "sessioon on aegnud";
		unset($_SESSION['session_expired']);
	}
	if (isset($_POST['username'])){
		$username = $_POST['username'];
		$password = $_POST['password'];
		$user_id = get_one("SELECT user_id FROM user WHERE username='$username'AND password='$password'");
	if (! emty($user_id)){
		$_SESSION['user_id']=$user_id;
		$_REQUEST->redirect('tests');

	}
		$_ERRORS[]="vale kasutajanimi voi parool!";
	}
	require 'views/auth_view.php';
}
	function log_out(){
		global $request;
		session_destroy();
		$request->redirect('auth');
		
}
}