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
		global $request;
		global $_users;
		$tests=get_all("SELECT * FROM test NATURAL JOIN user WHERE test.deleted=0");
		//var_dump($tests);
		// Merge master view
		require 'views/master_view.php';
	}
}
