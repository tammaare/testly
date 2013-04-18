<?php
// loon ühenduse mysql serveriga, kasutan configis loodud konstante, kui ühendust ei saa luua, siis annan mysql errori
mysql_connect(DATABASE_HOSTNAME, DATABASE_USERNAME) or mysql_error();
//valin oma andmebaasi või annan errori
mysql_select_db(DATABASE_DATABASE) or mysql_error();
//päringud, mille saadan serverisse on utf kodeeringuga
mysql_query("SET NAMES 'utf8'");
mysql_query("SET CHARACTER 'utf8'");

// meetod get_one kutsutakse välja näiteks auth.phps, kus antakse talle parameeter $sql(päring)
function get_all($sql){
	$q=mysql_query($sql) or exit(mysql_error());
	while (($result[]=mysql_fetch_assoc($q)) || array_pop($result)) {
	;
	}
	return $result;
}
function get_one($sql, $debug = FALSE)
{
	//Kui debug väärtus on true, siis läbib ifi sisu
	if ($debug) {
		print"<pre>$sql</pre>";
		}
// loome muutuja $q, mille väärtuseks on kas päring($sql) või viskab meid välja funktsioonist ja annab veateade
	$q = mysql_query($sql) or exit(mysql_error());

	/*Juhul kui mysql_num_rows($q) tagastab väärtuse false, siis visatakse mind funktsioonist välja ja antakse $sqlis sisalduv
	info*/
	if (mysql_num_rows($q) === FALSE) {
		exit($sql);
	}
	//loon muutuja $result, millesse salvestan päringutulemuse massiivina
	$result = mysql_fetch_row($q);
/* kontrollin, kas $result on massiiv ja on meil rohkem kui 0 elementi, siis tagastame $result esimese elemendi,
	vastasel juhul tagastame NULL*/
	return is_array($result) && count($result) > 0 ? $result[0] : NULL;
}
