<?php
class user
{

	public $logged_in = FALSE;
	function __construct()
	{

		session_start();
		if (isset($_SESSION['user_id'])) {

			$this->logged_in = TRUE;
}
}
	public function require_auth()
	{
	global $REQUEST;
		if($this->logged_in !== TRUE){
			if (isset($_SERVER['HTTP_X_REQUESTED_WITH'])
			&& $_SERVER['HTTP_X_REQUESTED_WITH']=='XMLHttpRequest'){}
			header('HTTP/1.0 401 Unauthorized');
				exit (json_encode(array('data'=>'session_expired')));
			}
			else {
				$_SESSION['session_expired']= TRUE;
				$_SESSION->redirect('auth');			}
			)
		}
	}
}
$_user=new user;