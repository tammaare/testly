<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Rait
 * Date: 16.04.13
 * Time: 13:03
 * To change this template use File | Settings | File Templates.
 */
// uus objektitüüp nimega user
class user
{
//atribuut nimega $logged_in, mis on vaikeväärtusega false
	public $logged_in = FALSE;
// funktsioon, mis käivitatakse iga kord kui selle objektitüübiga objekt luuakse
	function __construct()
	{
		//alusta sessiooni,(server hoiab $_SESSION massiivis alles kasutaja info )
		session_start();

		//kui $_SESSIONIS on "user_id" antud, siis selle klassi atribuudile logged_in omistatakse väärtus true
		if (isset($_SESSION['user_id'])) {
			$this->logged_in = TRUE;
		}
	}

	/**
	 * Kontrollib, kas kasutaja on sisselogitud, kui ei ole, siis suunab auth lehele
	 */
	public function require_auth()
	{
		// Annab ligipääsu request objektile
		global $request;

		//kontrollib, kas kasutaja pole sisse logitud
		if ($this->logged_in !== TRUE) {

			//kontrollin, kas päring tuli ajaxiga või otse
			//kas brauser saatis mulle sellenimelise('HTTP_X_REQUESTED_WITH') elemendi?
			//kas sellel on väärtus 'XMLHttpRequest' ? NB! Guugelda ajaxit
			if (isset($_SERVER['HTTP_X_REQUESTED_WITH'])
				&& $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')
			{
				//vastuses brauserile lisatakse http error code(mida javascript kontrollib)
				header('HTTP/1.0 401 Unauthorized');
				exit(json_encode(array('data' => 'session_expired')));
				//NB! Guugelda ajaxit
			} else {
				$_SESSION['session_expired'] = TRUE;
				$request->redirect('auth');
			}
		}
	}
}
//uus objekt minu klassist
$_user = new user;