<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Rait
 * Date: 17.04.13
 * Time: 11:45
 * To change this template use File | Settings | File Templates.
 */

class tests
{

	public $requires_auth = TRUE;

	function index()
	{
		$this->scripts[] = 'tests.js';
		global $request;
		global $_users;
		$tests = get_all("SELECT * FROM test NATURAL JOIN user WHERE test.deleted=0");
		$id=$_SESSION['user_id'];
		$status=get_one("SELECT status FROM user WHERE user_id='$id'");


		//var_dump($tests);
		// Merge master view
		require 'views/master_view.php';
	}

	function remove()
	{
		global $request;
		$id = $request->params[0];
		$result = q("UPDATE test SET deleted=1 WHERE test_id='$id'");
		require 'views/master_view.php';
	}

	function edit(){
		global $request;
		$this->scripts[] = 'test_add_edit.js';
		$id=$request->params[0];
		$test=get_all("SELECT * FROM test NATURAL JOIN question WHERE test_id='$id'");
		$question=get_all("SELECT question_text FROM question WHERE test_id='$id'");
		$test=$test[0];
		$question=isset($question[0])?$question[0]:array('question_text'=>'');
			require 'views/master_view.php';
	}
	function add() {
		global $request;
		$this->scripts[] = 'test_add_edit.js';
		$test=array(
			'test_id' =>'',
			'name' =>'',
			'introduction' =>'',
			'conclusion' =>'',
			'passcode' =>'',
			'question_text' =>'',

		);
		$question= array('question_text'=>'');
		require 'views/master_view.php';

	}
}
