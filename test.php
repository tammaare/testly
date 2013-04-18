<meta charset="UTF-8">
<?php

$array = array(
	'color' => array(
			'front_color' => 'red',
			'back_color' => 'black'),
	'size' => 'big',
	'age' => 5
);
//echo $array['color']['back_color'];

class auto {
	public $color = 'red';
	public $size = 'big';
	public $age = 5;

	public function käivita(){
		echo $this->color . " auto käivitus. Prõnn!";
	}
}
class veoauto extends auto {
	public $cargo_payload_size = 500;
}
$auto = new veoauto;

$teine_auto = new veoauto;
$teine_auto->color = 'valge';
$teine_auto->käivita();

