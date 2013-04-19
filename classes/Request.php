<?php
class Request
{

	public $controller = DEFAULT_CONTROLLER;
	public $action = 'index';
	public $params = array();

	public function __construct()
	{

		// Kui kasutaja on kirjutanud aadressirea lõppu parameetreid juurde
		if (isset($_SERVER['PATH_INFO'])) {

			// $_SERVER['PATH_INFO'] = /kasutajad/vaatamine/23 - tekib 4 liiget
			if ($path_info = explode('/', $_SERVER['PATH_INFO'])) {

				// Kustutab 1. liikme, reastab liikmed uuesti,
				array_shift($path_info);

				// Kontrollitakse, kas pathinfo [0] - 1. liige on olemas, siis antud classi controller omaduse väärtuseks saab
				// pathinfo massivi esimene liige (mis samas ka eemaldatakse pathinfost). Juhul, kui pathinfos pole
				// esimest liiget, pannakse antud classi controller omaduse väärtuseks 'weolcome'
				$this->controller = isset($path_info[0]) ? array_shift($path_info) : 'welcome';

				// Kontrollitakse, kas pathinfo [0] - 1. liige on olemas ja pole tyhi, siis antud classi actioni väärtuseks
				// saab allesjäänud pathinfo 1. liige, (mis samas ka eemaldatakse). Juhul, kui pathinfos pole esimest liiget
				// pannkse antud classi actioni omaduse väärtuseks index.
				$this->action = isset($path_info[0]) && ! empty ($path_info[0]) ? array_shift($path_info) : 'index';

				// Kontrollitakse, kas pathinfo [0] - 1. liige on olemas, siis antud classi parameetriteks saab
				// pathinfo massiivi allesjäänud liikmed (23)
				$this->params = isset($path_info[0]) ? $path_info : NULL;
			}
		}
	}

	// Fn  ümbersuunamiseks. Parameetriks on $destination, mis saab oma väärtuse sellel hetkel, kui ta välja kutsutakse.
	// nt auth.php $request->redirect('tests'); kus string tests omistatakse $destinationi väärtuseks.

	public function redirect($destination)
	{

		// redirect - meetod, mis omab parameetrit nimega $destination ja käivitumisel seab brauseri URL-iks antud juhul
		// BASE_URL (/testly/) ja liimib sellele otsa $destination (tests) väärtuse.
		header('Location: '.BASE_URL.$destination);
	}
}

// Kui kuskil tehakse $requesti vastu päring, siis käivitab uuesti Request classi.
$request = new Request;
