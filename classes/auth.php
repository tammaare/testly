<?php

class auth {
function index (){
	global $_REQuEST;
	global $_ERRORS;
	if(isset($_SESSION['session_expired'])){
		$_ERRORS[] = "sessioon on aegnud";
		unset($_SESSION['session_expired']);
	}
	if (isset($_POST['username'])){
		$username = $_POST['username'];
		$password = $_POST['password'];
		$user_id = get_one("SELECT user_id FROM user WHERE username='$username'AND password='$password'");

	}
}
}