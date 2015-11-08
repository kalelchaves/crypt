<?php

/*
Constantes de auxilio a criptografia
*/

define('AUX_NUMBER_CRYPT_LIMIT', '654326532175041657942356743');
define('AUX_NUMBER_CALCULATE_CRYPT', rand(3,17));

/* General functions */

function dump($data){

	echo '<pre>';
	var_dump($data);
	echo '</pre>';

}

function stringKeyCryptToOriginArrayAscii($stringCrypt){

	$string = explode(AUX_NUMBER_CRYPT_LIMIT, $stringCrypt);
	return $string;

}

/* To Decrypt */

function convertArrayAsciiToString(array $arrayAscii){

	foreach($arrayAscii as $value) {
		
		$return .= chr($value);

	}

	return $return;

}

function convertArrayCalculatedAsciiToStringAscii(array $arrayCalculatedAscii){

	foreach ($arrayCalculatedAscii as $key => $value) {
		
		$return .= $value / AUX_NUMBER_CALCULATE_CRYPT . AUX_NUMBER_CRYPT_LIMIT;

	}

	return $return;

}

/* To Crypt */
function convertStringToAscii($string){

	for($i=0; $i < strlen($string); $i++) {
		
		$return .= ord($string[$i]).AUX_NUMBER_CRYPT_LIMIT . AUX_NUMBER_CRYPT_LIMIT;

	}

	return $return;

}

function convertArrayAsciiToStringCalculatedAscii(array $arrayAscii){

	foreach ($arrayAscii as $key => $value) {
		
		$return .= $value * AUX_NUMBER_CALCULATE_CRYPT . AUX_NUMBER_CRYPT_LIMIT;

	}

	return $return;

}

/* Aplication functions */

function myCrypt($text){

	
	$text = convertStringToAscii($text);
	$text = convertArrayAsciiToStringCalculatedAscii( stringKeyCryptToOriginArrayAscii($text) );
	$text = base64_encode($text);
	return $text;

}

function deCrypt($text){

	$text = base64_decode($text);
	$text = convertArrayCalculatedAsciiToStringAscii( stringKeyCryptToOriginArrayAscii($text) );
	$text = stringKeyCryptToOriginArrayAscii($text);
	$text = convertArrayAsciiToString($text);
	
	return $text;

}

if($_POST){


	$stringCrypt = myCrypt($_POST[palavra]);
	$stringDeCrypt = deCrypt($stringCrypt);

	dump($stringCrypt);
	dump($stringDeCrypt);

}
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<form action="#" method="post" accept-charset="ISO-8859-1" >
	<label>Palavra:</label>
	<input type="text" name="palavra" id="palavra" />

	<br />

	<button type="submit" >Enviar</button>
</form>





</body>
</html>
