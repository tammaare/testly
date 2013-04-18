<?php
//võta nende failide sisu kasutusele
require 'config.php';
require 'classes/Request.php';
require 'classes/user.php';
require 'classes/database.php';

/*1.võtan $request objekti kontrolleri väärtuse 2. liidan saadud väärtuse kahe stringiga
('controllers/' ja '.php' )kontrollime kas saadud nimega kontroller eksisteerib.*/
if (file_exists('controllers/'.$request->controller.'.php')) {

	//võta selle kontrolleri sisu kasutusele
	require 'controllers/'.$request->controller.'.php';

	//tee uus objekt $controller
	$controller = new $request->controller;
	// kui atribuut requires_auth
	// TODO:Henno, seleta!
	if (isset($controller->requires_auth))
	{
		//küsi autentimist
		$_user->require_auth();
	}
	// antud kontrollerile omistame $requestist saadud actioni
	$controller->{$request->action}();
}
//kui tahetud kontrollerit ei leitud, siis kuva veateade
else {
	echo "The page '{$request->controller}' does not exist";

}